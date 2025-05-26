<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SLAC - Student Learning & Activity Center</title>
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
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#facilities">Facilities</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.html">Contact</a>
                    </li>
                    <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) : ?>
                        <li class="nav-item">
                            <span class="navbar-text text-white mr-2">Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?></span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-light btn-sm" href="php/auth/logout.php">Logout</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-light btn-sm ml-2" href="php/auth/login.php">Login</a>
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
                    <h1>Welcome to SLAC</h1>
                    <p class="lead">Your hub for learning and activities at Wenzhou-Kean University.</p>
                    <a href="#about" class="btn btn-primary btn-lg">Learn More</a>
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
                    <h2>About SLAC</h2>
                    <p>The Student Learning and Activity Center (SLAC) is a state-of-the-art facility designed to support the academic and extracurricular lives of Wenzhou-Kean University students. With modern classrooms, study areas, and recreational spaces, SLAC is the perfect place to learn, collaborate, and unwind.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Facilities Section -->
    <section id="facilities" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-4">Our Facilities</h2>
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
                            <h5 class="card-title">Modern Classrooms</h5>
                            <p class="card-text">Equipped with the latest technology for effective learning.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <img src="#" class="card-img-top" alt="Activity Spaces">
                        <div class="card-body">
                            <h5 class="card-title">Activity Spaces</h5>
                            <p class="card-text">Versatile areas for clubs, events, and recreational activities.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="#floor-plans" class="btn btn-outline-primary">View Floor Plans</a>
            </div>
        </div>
    </section>

    <!-- Floor Plans Section -->
    <section id="floor-plans" class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Floor Plans</h2>
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
                    <h2>Get in Touch</h2>
                    <p>Have questions or want to book a space? Contact us!</p>
                    <a href="contact.html" class="btn btn-primary btn-lg">Contact Us</a>
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
                    <p>Wenzhou-Kean University<br>88 Daxue Road, Ouhai<br>Wenzhou, Zhejiang, China</p>
                </div>
                <div class="col-md-3">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="index.php" class="text-white">Home</a></li>
                        <li><a href="#about" class="text-white">About</a></li>
                        <li><a href="#floor-plans" class="text-white">Floor Plans</a></li>
                        <li><a href="contact.html" class="text-white">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Connect</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Facebook</a></li>
                        <li><a href="#" class="text-white">Twitter</a></li>
                        <li><a href="#" class="text-white">Instagram</a></li>
                        <li><a href="#" class="text-white">WeChat</a></li>
                    </ul>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 text-center">
                    <p class="mb-0">&copy; 2025 Wenzhou-Kean University. All rights reserved.</p>
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