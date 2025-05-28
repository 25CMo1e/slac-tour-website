<?php
require_once __DIR__ . '/../auth/check_login_status.php';
require_once __DIR__ . '/../auth/db.php';

// 获取用户预约
$reservations = $conn->query("
    SELECT r.*, m.name as room_name, m.type as room_type
    FROM reservations r
    JOIN rooms m ON r.room_id = m.id
    WHERE r.user_id = {$_SESSION['user_id']}
    ORDER BY r.start_time DESC
")->fetch_all(MYSQLI_ASSOC);

// 取消预约
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cancel_id'])) {
    $cancel_id = (int)$_POST['cancel_id'];
    $stmt = $conn->prepare("UPDATE reservations SET status = 'cancelled' 
                           WHERE id = ? AND user_id = ? AND start_time > NOW()");
    $stmt->bind_param("ii", $cancel_id, $_SESSION['user_id']);
    $stmt->execute();
    
    if ($stmt->affected_rows > 0) {
        $success_msg = 'Reservation cancelled successfully';
    } else {
        $error_msg = 'Failed to cancel reservation';
    }
}
?>

<div class="container mt-4">
    <h3>My Reservations</h3>
    
    <?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success">Booking created successfully</div>
    <?php endif; ?>
    
    <?php if (isset($success_msg)): ?>
    <div class="alert alert-success"><?= $success_msg ?></div>
    <?php elseif (isset($error_msg)): ?>
    <div class="alert alert-danger"><?= $error_msg ?></div>
    <?php endif; ?>
    
    <?php if (empty($reservations)): ?>
    <div class="alert alert-info">You have no reservations</div>
    <?php else: ?>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Room</th>
                    <th>Type</th>
                    <th>Title</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservations as $res): ?>
                <tr>
                    <td><?= htmlspecialchars($res['room_name']) ?></td>
                    <td>
                        <span class="badge <?= $res['room_type'] == 'Discussion' ? 'badge-primary' : 'badge-success' ?>">
                            <?= $res['room_type'] ?>
                        </span>
                    </td>
                    <td><?= htmlspecialchars($res['title']) ?></td>
                    <td>
                        <?= date('Y-m-d H:i', strtotime($res['start_time'])) ?><br>
                        <small><?= date('H:i', strtotime($res['end_time'])) ?></small>
                    </td>
                    <td>
                        <?php if ($res['status'] == 'active' && strtotime($res['start_time']) > time()): ?>
                            <span class="badge badge-success">Active</span>
                        <?php elseif ($res['status'] == 'cancelled'): ?>
                            <span class="badge badge-secondary">Cancelled</span>
                        <?php else: ?>
                            <span class="badge badge-info">Completed</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($res['status'] == 'active' && strtotime($res['start_time']) > time()): ?>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="cancel_id" value="<?= $res['id'] ?>">
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure you want to cancel this reservation?')">
                                <i class="fas fa-times"></i> Cancel
                            </button>
                        </form>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</div>
