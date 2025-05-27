<?php
require_once __DIR__ . '/../auth/check_login_status.php';
require_once __DIR__ . '/../auth/db.php';



// 验证房间ID
$room_id = isset($_GET['room_id']) ? (int)$_GET['room_id'] : 0;
if ($room_id <= 0) {
    header("Location: rooms.php");
    exit();
}

// 使用预处理语句获取房间信息
$stmt = $conn->prepare("SELECT * FROM rooms WHERE id = ?");
$stmt->bind_param("i", $room_id);
$stmt->execute();
$room = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$room) {
    header("Location: rooms.php");
    exit();
}

$error = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 验证输入
    $title = isset($_POST['title']) ? trim($_POST['title']) : '';
    $start_time = isset($_POST['start_time']) ? $_POST['start_time'] : '';
    $end_time = isset($_POST['end_time']) ? $_POST['end_time'] : '';
    
    // 基本验证
    if (empty($title) || empty($start_time) || empty($end_time)) {
        $error = "Please fill in all fields";
    } elseif (strtotime($start_time) >= strtotime($end_time)) {
        $error = "End time must be after start time";
    } else {
        // 检查时间冲突
        $stmt = $conn->prepare("SELECT id FROM reservations 
                              WHERE room_id = ? 
                              AND status = 'active'
                              AND (
                                  (start_time < ? AND end_time > ?) OR
                                  (start_time >= ? AND start_time < ?)
                              )");
        $stmt->bind_param("issss", $room_id, $end_time, $start_time, $start_time, $end_time);
        $stmt->execute();
        $conflict = $stmt->get_result()->num_rows;
        $stmt->close();
        
        if ($conflict > 0) {
            $error = "The selected time slot is already booked";
        } else {
            // 创建预约
            $stmt = $conn->prepare("INSERT INTO reservations 
                                  (room_id, user_id, title, start_time, end_time, status) 
                                  VALUES (?, ?, ?, ?, ?, 'active')");
            $stmt->bind_param("iisss", $room_id, $_SESSION['user_id'], $title, $start_time, $end_time);
            $stmt->execute();
            
            if ($stmt->affected_rows > 0) {
                header("Location: my_reservations.php?success=1");
                exit();
            } else {
                $error = "Booking failed. Please try again.";
            }
            $stmt->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Meeting Room</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- FullCalendar CSS -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css' rel='stylesheet' />
    <style>
        body { padding: 20px; }
        #calendar { margin-top: 20px; }
        
        /* 时间冲突提示 */
        .fc-highlight {
            background-color: #ffcccc !important;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h3>Book Room: <?= htmlspecialchars($room['name']) ?></h3>
        
        <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        
        <div class="row">
            <div class="col-md-6">
                <form method="post" id="bookingForm">
                    <div class="form-group mb-3">
                        <label>Event Title</label>
                        <input type="text" name="title" class="form-control" required
                               maxlength="100" value="<?= isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '' ?>">
                    </div>
                    
                    <div class="form-group mb-3">
                        <label>Start Time</label>
                        <input type="datetime-local" name="start_time" class="form-control" required 
                               min="<?= date('Y-m-d\TH:i') ?>" 
                               value="<?= isset($_POST['start_time']) ? htmlspecialchars($_POST['start_time']) : '' ?>">
                    </div>
                    
                    <div class="form-group mb-3">
                        <label>End Time</label>
                        <input type="datetime-local" name="end_time" class="form-control" required 
                               min="<?= date('Y-m-d\TH:i') ?>"
                               value="<?= isset($_POST['end_time']) ? htmlspecialchars($_POST['end_time']) : '' ?>">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Confirm Booking</button>
                    <a href="rooms.php" class="btn btn-secondary">Back to Rooms</a>
                </form>
            </div>
            
            <div class="col-md-6">
                <div id="calendar"></div>
            </div>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js'></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridWeek',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'timeGridDay,timeGridWeek'
            },
            events: 'api/get_events.php?room_id=<?= $room_id ?>',
            selectable: true,
            selectOverlap: false,
            select: function(info) {
                // 自动填充选择的时间
                document.querySelector('input[name="start_time"]').value = info.startStr.substring(0, 16);
                document.querySelector('input[name="end_time"]').value = info.endStr.substring(0, 16);
            },
            eventClick: function(info) {
                alert('Event: ' + info.event.title + '\nTime: ' + info.event.start.toLocaleString() + ' - ' + info.event.end.toLocaleString());
            },
            slotMinTime: "08:00:00",
            slotMaxTime: "22:00:00",
            selectAllow: function(selectInfo) {
                // 确保选择的时间在当前时间之后
                return selectInfo.start > new Date();
            },
            eventColor: '#378006',
            eventTimeFormat: { 
                hour: '2-digit',
                minute: '2-digit',
                meridiem: false
            }
        });
        calendar.render();
        
        // 表单提交前验证
        document.getElementById('bookingForm').addEventListener('submit', function(e) {
            var start = document.querySelector('input[name="start_time"]').value;
            var end = document.querySelector('input[name="end_time"]').value;
            
            if (new Date(start) >= new Date(end)) {
                alert("End time must be after start time");
                e.preventDefault();
            }
        });
    });
    </script>
</body>
</html>
