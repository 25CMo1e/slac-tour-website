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
    <title><?php echo $lang->get('contact_title'); ?> - SLAC</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php">SLAC</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php"><?php echo $lang->get('nav_home'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#about"><?php echo $lang->get('nav_about'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#facilities"><?php echo $lang->get('nav_facilities'); ?></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="contact.php"><?php echo $lang->get('nav_contact'); ?></a>
                    </li>
                    <?php include __DIR__ . '/php/components/language_selector.php'; ?>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-light btn-sm ml-2" href="php/auth/login.php"><?php echo $lang->get('nav_login'); ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contact Section -->
    <section class="py-5">
        <div class="container">
            <h1 class="text-center mb-5"><?php echo $lang->get('contact_title'); ?></h1>
            <div class="row">
                <!-- Contact Form -->
                <div class="col-lg-8">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h4 class="card-title mb-4"><?php echo $lang->get('contact_form_title', 'Send us a Message'); ?></h4>
                            <div id="formMessage" class="alert" style="display: none;"></div>
                            <form action="php/contact/submit.php" method="POST" id="contactForm">
                                <div class="form-group">
                                    <label for="name"><?php echo $lang->get('contact_name'); ?></label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="email"><?php echo $lang->get('contact_email'); ?></label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="subject"><?php echo $lang->get('contact_subject'); ?></label>
                                    <input type="text" class="form-control" id="subject" name="subject" required>
                                </div>
                                <div class="form-group">
                                    <label for="message"><?php echo $lang->get('contact_message'); ?></label>
                                    <textarea class="form-control" id="message" name="message" rows="5"
                                        required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary"><?php echo $lang->get('contact_submit'); ?></button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Contact Information -->
                <div class="col-lg-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h4 class="card-title mb-4"><?php echo $lang->get('contact_info_title', 'Contact Information'); ?></h4>
                            <div class="mb-4">
                                <h5><?php echo $lang->get('contact_address_title', 'Address'); ?></h5>
                                <p><?php echo $lang->get('footer_address'); ?></p>
                            </div>
                            <div class="mb-4">
                                <h5><?php echo $lang->get('contact_hours_title', 'Operating Hours'); ?></h5>
                                <p><?php echo $lang->get('contact_hours', 'Monday - Friday: 8:00 AM - 10:00 PM<br>Saturday - Sunday: 9:00 AM - 6:00 PM'); ?></p>
                            </div>
                            <div class="mb-4">
                                <h5><?php echo $lang->get('contact_connect_title', 'Connect With Us'); ?></h5>
                                <a href="#" class="text-primary mr-3">Facebook</a>
                                <a href="#" class="text-primary mr-3">Twitter</a>
                                <a href="#" class="text-primary mr-3">Instagram</a>
                                <a href="#" class="text-primary">WeChat</a>
                            </div>
                        </div>
                    </div>
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
                        <li><a href="index.php#about" class="text-white"><?php echo $lang->get('nav_about'); ?></a></li>
                        <li><a href="index.php#floor-plans" class="text-white"><?php echo $lang->get('nav_floor_plans', 'Floor Plans'); ?></a></li>
                        <li><a href="contact.php" class="text-white"><?php echo $lang->get('nav_contact'); ?></a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5><?php echo $lang->get('footer_connect'); ?></h5>
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
    <script>
        $(document).ready(function () {
            // Check login status on page load
            $.ajax({
                url: 'php/auth/check_login_status.php',
                method: 'GET',
                dataType: 'json',
                success: function (response) {
                    if (response.loggedin) {
                        // User is logged in
                        $('#navbarNav .nav-item:last-child').html('<a class="nav-link btn btn-outline-light btn-sm ml-2" href="php/auth/logout.php"><?php echo $lang->get('nav_logout'); ?> (' + response.username + ')</a>');
                    } else {
                        // User is not logged in
                        $('#navbarNav .nav-item:last-child').html('<a class="nav-link btn btn-outline-light btn-sm ml-2" href="php/auth/login.php"><?php echo $lang->get('nav_login'); ?></a>');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error checking login status:', error);
                }
            });

            // Contact form submission
            $('#contactForm').on('submit', function (e) {
                e.preventDefault();
                var formData = $(this).serialize();
                var formMessage = $('#formMessage');

                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: formData,
                    dataType: 'json',
                    success: function (response) {
                        formMessage.removeClass('alert-danger alert-success').hide();
                        if (response.success) {
                            formMessage.addClass('alert-success').text('<?php echo $lang->get('success_message'); ?>').fadeIn();
                            $('#contactForm')[0].reset();
                        } else {
                            formMessage.addClass('alert-danger').text('<?php echo $lang->get('error_message'); ?>').fadeIn();
                        }
                    },
                    error: function (xhr, status, error) {
                        formMessage.removeClass('alert-danger alert-success').hide();
                        formMessage.addClass('alert-danger').text('<?php echo $lang->get('error_message'); ?>').fadeIn();
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
</body>

</html>
