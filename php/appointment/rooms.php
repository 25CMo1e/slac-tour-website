<?php
require_once __DIR__ . '/../auth/check_login_status.php';
require_once __DIR__ . '/../auth/db.php';

$rooms = $conn->query("SELECT * FROM rooms ORDER BY type, name")->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meeting Room Booking System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { padding: 20px; }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <?php foreach ($rooms as $room): ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100">
                    <?php if ($room['image_url']): ?>
                    <img src="<?= htmlspecialchars($room['image_url']) ?>" class="card-img-top" alt="<?= htmlspecialchars($room['name']) ?>">
                    <?php endif; ?>
                    <div class="card-body">
                        <span class="badge <?= $room['type'] == 'Discussion' ? 'bg-primary' : 'bg-success' ?>">
                            <?= $room['type'] ?> Room
                        </span>
                        <h5 class="card-title mt-2"><?= htmlspecialchars($room['name']) ?></h5>
                        <p class="card-text">
                            <i class="fas fa-users"></i> Capacity: <?= $room['capacity'] ?>
                        </p>
                        <a href="reserve.php?room_id=<?= $room['id'] ?>" class="btn btn-sm btn-outline-primary">
                            Book Now
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
