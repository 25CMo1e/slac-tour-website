<?php
require_once __DIR__ . '/../auth/check_login_status.php';
require_once __DIR__ . '/../lang/Language.php';
require_once __DIR__ . '/../db.php';

$lang = Language::getInstance();

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
        $success_msg = $lang->get('reservation_cancelled');
    } else {
        $error_msg = $lang->get('cancel_failed');
    }
}
?>

<div class="container mt-4">
    <h3><?= $lang->get('my_reservations') ?></h3>
    
    <?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success"><?= $lang->get('booking_success') ?></div>
    <?php endif; ?>
    
    <?php if (isset($success_msg)): ?>
    <div class="alert alert-success"><?= $success_msg ?></div>
    <?php elseif (isset($error_msg)): ?>
    <div class="alert alert-danger"><?= $error_msg ?></div>
    <?php endif; ?>
    
    <?php if (empty($reservations)): ?>
    <div class="alert alert-info"><?= $lang->get('no_reservations') ?></div>
    <?php else: ?>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th><?= $lang->get('room') ?></th>
                    <th><?= $lang->get('type') ?></th>
                    <th><?= $lang->get('title') ?></th>
                    <th><?= $lang->get('time') ?></th>
                    <th><?= $lang->get('status') ?></th>
                    <th><?= $lang->get('actions') ?></th>
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
                            <span class="badge badge-success"><?= $lang->get('active') ?></span>
                        <?php elseif ($res['status'] == 'cancelled'): ?>
                            <span class="badge badge-secondary"><?= $lang->get('cancelled') ?></span>
                        <?php else: ?>
                            <span class="badge badge-info"><?= $lang->get('completed') ?></span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($res['status'] == 'active' && strtotime($res['start_time']) > time()): ?>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="cancel_id" value="<?= $res['id'] ?>">
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('<?= $lang->get('confirm_cancel') ?>')">
                                <i class="fas fa-times"></i> <?= $lang->get('cancel') ?>
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

