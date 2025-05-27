<?php
require_once __DIR__ . '/../auth/check_login_status.php';
require_once __DIR__ . '/../lang/Language.php';
require_once __DIR__ . '/../auth/db.php';

$lang = Language::getInstance();

$room_id = (int)$_GET['room_id'];
$room = $conn->query("SELECT * FROM rooms WHERE id = $room_id")->fetch_assoc();

if (!$room) {
    header("Location: rooms.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $conn->real_escape_string($_POST['title']);
    $start_time = $conn->real_escape_string($_POST['start_time']);
    $end_time = $conn->real_escape_string($_POST['end_time']);
    
    // 检查时间冲突
    $conflict = $conn->query("SELECT id FROM reservations 
                            WHERE room_id = $room_id 
                            AND status = 'active'
                            AND (
                                (start_time < '$end_time' AND end_time > '$start_time') OR
                                (start_time >= '$start_time' AND start_time < '$end_time')
                            )")->num_rows;
    
    if ($conflict > 0) {
        $error = $lang->get('time_conflict');
    } else {
        // 创建预约
        $stmt = $conn->prepare("INSERT INTO reservations 
                              (room_id, user_id, title, start_time, end_time) 
                              VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iisss", $room_id, $_SESSION['user_id'], $title, $start_time, $end_time);
        $stmt->execute();
        
        if ($stmt->affected_rows > 0) {
            header("Location: my_reservations.php?success=1");
            exit();
        } else {
            $error = $lang->get('booking_failed');
        }
    }
}
?>

<div class="container mt-4">
    <h3><?= sprintf($lang->get('book_room_title'), htmlspecialchars($room['name'])) ?></h3>
    
    <?php if (isset($error)): ?>
    <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    
    <div class="row">
        <div class="col-md-6">
            <form method="post">
                <div class="form-group">
                    <label><?= $lang->get('event_title') ?></label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label><?= $lang->get('start_time') ?></label>
                    <input type="datetime-local" name="start_time" class="form-control" required 
                           min="<?= date('Y-m-d\TH:i') ?>">
                </div>
                
                <div class="form-group">
                    <label><?= $lang->get('end_time') ?></label>
                    <input type="datetime-local" name="end_time" class="form-control" required 
                           min="<?= date('Y-m-d\TH:i') ?>">
                </div>
                
                <button type="submit" class="btn btn-primary"><?= $lang->get('confirm_booking') ?></button>
            </form>
        </div>
        
        <div class="col-md-6">
            <div id="calendar"></div>
        </div>
    </div>
</div>

<!-- FullCalendar 资源 -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css' rel='stylesheet' />
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
        select: function(info) {
            // 自动填充选择的时间
            document.querySelector('input[name="start_time"]').value = info.startStr.substring(0, 16);
            document.querySelector('input[name="end_time"]').value = info.endStr.substring(0, 16);
        },
        eventClick: function(info) {
            alert(info.event.title);
        },
        slotMinTime: "08:00:00",
        slotMaxTime: "22:00:00"
    });
    calendar.render();
});
</script>
