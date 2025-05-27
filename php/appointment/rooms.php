<?php
require_once __DIR__ . '/../auth/check_login_status.php';
require_once __DIR__ . '/../lang/Language.php';
require_once __DIR__ . '/../auth/db.php';

$lang = Language::getInstance();

$rooms = $conn->query("SELECT * FROM rooms ORDER BY type, name")->fetch_all(MYSQLI_ASSOC);
?>

<div class="container mt-4">
    <div class="row">
        <?php foreach ($rooms as $room): ?>
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
                <?php if ($room['image_url']): ?>
                <img src="<?= htmlspecialchars($room['image_url']) ?>" class="card-img-top" alt="<?= htmlspecialchars($room['name']) ?>">
                <?php endif; ?>
                <div class="card-body">
                    <span class="badge <?= $room['type'] == 'Discussion' ? 'badge-primary' : 'badge-success' ?>">
                        <?= $room['type'] ?> Room
                    </span>
                    <h5 class="card-title mt-2"><?= htmlspecialchars($room['name']) ?></h5>
                    <p class="card-text">
                        <i class="fas fa-users"></i> <?= $lang->get('capacity') ?>: <?= $room['capacity'] ?>
                    </p>
                    <a href="reserve.php?room_id=<?= $room['id'] ?>" class="btn btn-sm btn-outline-primary">
                        <?= $lang->get('book_now') ?>
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
