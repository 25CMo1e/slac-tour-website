<?php
session_start();
require_once __DIR__ . '/php/lang/Language.php';
$lang = Language::getInstance();
?>
<!DOCTYPE html>
<html lang="<?php echo $lang->getCurrentLang(); ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $lang->get('welcome_title'); ?> - <?php echo $lang->get('welcome_subtitle'); ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php">SLAC</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php"><?php echo $lang->get('nav_home'); ?> <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about"><?php echo $lang->get('nav_about'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#facilities"><?php echo $lang->get('nav_facilities'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.html"><?php echo $lang->get('nav_contact'); ?></a>
                    </li>
                    <?php include __DIR__ . '/php/components/language_selector.php'; ?>

                    <li class="nav-item">
                        <a class="nav-link" href="rooms.php">
                            <?php echo $lang->get('book_room'); ?>
                        </a>
                    </li>
                    
                    <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) : ?>
                        <li class="nav-item">
                            <span class="navbar-text text-white mr-2">Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?></span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-light btn-sm" href="php/auth/logout.php"><?php echo $lang->get('nav_logout'); ?></a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-light btn-sm ml-2" href="php/auth/login.php"><?php echo $lang->get('nav_login'); ?></a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1><?php echo $lang->get('welcome_title'); ?></h1>
                    <p class="lead"><?php echo $lang->get('welcome_subtitle'); ?></p>
                    <a href="#about" class="btn btn-primary btn-lg"><?php echo $lang->get('learn_more'); ?></a>
                </div>
                <div class="col-md-6">
                    <!-- Optional: Add an image or illustration here -->
                </div>
            </div>
        </div>
    </header>

    <!-- About Section -->
    <section id="about" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 text-center">
                    <h2><?php echo $lang->get('about_title'); ?></h2>
                    <p><?php echo $lang->get('about_description'); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Facilities Section -->
    <section id="facilities" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-4"><?php echo $lang->get('facilities_title'); ?></h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <img src="#" class="card-img-top" alt="Study Areas">
                        <div class="card-body">
                            <h5 class="card-title">Study Areas</h5>
                            <p class="card-text">Quiet and collaborative spaces equipped with Wi-Fi and power outlets.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <img src="#" class="card-img-top" alt="Classrooms">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $lang->get('facilities_classrooms_title'); ?></h5>
                            <p class="card-text"><?php echo $lang->get('facilities_classrooms_desc'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <img src="#" class="card-img-top" alt="Activity Spaces">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $lang->get('facilities_spaces_title'); ?></h5>
                            <p class="card-text"><?php echo $lang->get('facilities_spaces_desc'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="#floor-plans" class="btn btn-outline-primary"><?php echo $lang->get('view_floor_plans_button'); ?></a>
            </div>
        </div>
    </section>

    <!-- Floor Plans Section -->
    <section id="floor-plans" class="py-5">
        <div class="container">
            <h2 class="text-center mb-4"><?php echo $lang->get('floor_plans_title'); ?></h2>
            <div class="row">
                <div class="col-md-12">
                    <img src="#" class="img-fluid" alt="Floor Plans">
                    <!-- Replace # with actual image path -->
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section (Link to contact.html) -->
    <section id="contact-link" class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 text-center">
                    <h2><?php echo $lang->get('contact_title'); ?></h2>
                    <p><?php echo $lang->get('contact_description'); ?></p>
                    <a href="contact.php" class="btn btn-primary btn-lg"><?php echo $lang->get('contact_button'); ?></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>Student Learning & Activity Center</h5>
                    <p><?php echo $lang->get('footer_address'); ?></p>
                </div>
                <div class="col-md-3">
                    <h5><?php echo $lang->get('footer_quick_links'); ?></h5>
                    <ul class="list-unstyled">
                        <li><a href="index.php" class="text-white"><?php echo $lang->get('nav_home'); ?></a></li>
                        <li><a href="#about" class="text-white"><?php echo $lang->get('nav_about'); ?></a></li>
                        <li><a href="#floor-plans" class="text-white"><?php echo $lang->get('nav_floor_plans'); ?></a></li>
                        <li><a href="contact.php" class="text-white"><?php echo $lang->get('nav_contact'); ?></a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5><?php echo $lang->get('footer_connect'); ?></h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white"><?php echo $lang->get('social_facebook'); ?></a></li>
                        <li><a href="#" class="text-white"><?php echo $lang->get('social_twitter'); ?></a></li>
                        <li><a href="#" class="text-white"><?php echo $lang->get('social_instagram'); ?></a></li>
                        <li><a href="#" class="text-white"><?php echo $lang->get('social_wechat'); ?></a></li>
                    </ul>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 text-center">
                    <p class="mb-0"><?php echo $lang->get('footer_copyright'); ?></p>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript Dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/floorplan.js"></script>
</body>

</html>