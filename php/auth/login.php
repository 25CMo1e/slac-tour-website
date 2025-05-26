<?php
// Wang Kaixin - 1306318 (SHA256: 7a9c481e7c4735ab4394d5400e2b31f6a1c36bc9b8f67e9e1d853c8578e44570)

// e78b97273824b1a3fbf285a951251bac4849ad374999be520ebabf0012a022ea
include 'db.php';
// Start session
session_start();

// Load language support
require_once __DIR__ . '/../lang/Language.php';
$lang = Language::getInstance();

// Initialize variables
$username = $password = "";
$username_err = $password_err = $login_err = "";

// Process form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = $lang->get('login_username_required');
    } else {
        $username = trim($_POST["username"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = $lang->get('login_password_required');
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT user_id, username, password FROM users WHERE username = ?";

        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Store result
                $stmt->store_result();

                // Check if username exists, if yes then verify password
                if ($stmt->num_rows == 1) {
                    // Bind result variables
                    $stmt->bind_result($user_id, $username, $hashed_password);
                    if ($stmt->fetch()) {
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $user_id;
                            $_SESSION["username"] = $username;

                            // Redirect user to welcome page
                            header("location: ../../index.php");
                        } else {
                            // Password is not valid
                            $login_err = $lang->get('login_invalid_credentials');
                        }
                    }
                } else {
                    // Username doesn't exist
                    $login_err = $lang->get('login_invalid_credentials');
                }
            } else {
                echo $lang->get('error_general');
            }

            // Close statement
            $stmt->close();
        }
    }

    // Close connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="<?php echo $lang->getCurrentLang(); ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $lang->get('login_title'); ?> - SLAC</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/responsive.css">
    <style>
        .auth-container {
            max-width: 450px;
            margin: 0 auto;
            padding: 2rem;
        }

        .form-container {
            position: relative;
            overflow: hidden;
            min-height: 600px;
        }

        .login-form,
        .register-form {
            transition: all 0.3s ease;
            width: 100%;
            position: relative;
        }

        .register-form {
            position: absolute;
            top: 0;
            left: 100%;
            width: 100%;
            height: auto;
            opacity: 0;
            visibility: hidden;
        }

        .show-register .login-form {
            transform: translateX(-100%);
            opacity: 0;
            visibility: hidden;
        }

        .show-register .register-form {
            transform: translateX(-100%);
            opacity: 1;
            visibility: visible;
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="../../index.php">SLAC</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../../index.php"><?php echo $lang->get('nav_home'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../index.php#about"><?php echo $lang->get('nav_about'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../index.php#facilities"><?php echo $lang->get('nav_facilities'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../contact.php"><?php echo $lang->get('nav_contact'); ?></a>
                    </li>
                    <?php include __DIR__ . '/../components/language_selector.php'; ?>
                    <li class="nav-item active">
                        <a class="nav-link btn btn-outline-light btn-sm ml-2" href="#"><?php echo $lang->get('nav_login'); ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Authentication Section -->
    <section class="py-5">
        <div class="container">
            <div class="auth-container">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="form-container">
                            <!-- Login Form -->
                            <div class="login-form">
                                <h2 class="text-center mb-4"><?php echo $lang->get('login_heading'); ?></h2>

                                <?php
                                if (!empty($login_err)) {
                                    echo '<div class="alert alert-danger">' . $login_err . '</div>';
                                }
                                ?>

                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                    <div class="form-group">
                                        <label><?php echo $lang->get('login_username'); ?></label>
                                        <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                                        <span class="invalid-feedback"><?php echo $username_err; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo $lang->get('login_password'); ?></label>
                                        <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                                        <span class="invalid-feedback"><?php echo $password_err; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block"><?php echo $lang->get('login_button'); ?></button>
                                    </div>
                                    <p class="text-center"><?php echo $lang->get('login_no_account'); ?> <a href="register.php" class="toggle-form"><?php echo $lang->get('login_signup_link'); ?></a></p>
                                </form>
                            </div>

                            <!-- Register Form -->
                            <div class="register-form">
                                <h2 class="text-center mb-4"><?php echo $lang->get('signup_heading'); ?></h2>
                                <p class="text-center"><?php echo $lang->get('signup_instruction'); ?></p>
                                <form action="register.php" method="post">
                                    <div class="form-group">
                                        <label><?php echo $lang->get('login_username'); ?></label>
                                        <input type="text" name="username" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo $lang->get('signup_email'); ?></label>
                                        <input type="email" name="email" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo $lang->get('login_password'); ?></label>
                                        <input type="password" name="password" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo $lang->get('signup_confirm_password'); ?></label>
                                        <input type="password" name="confirm_password" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block"><?php echo $lang->get('signup_button'); ?></button>
                                    </div>
                                    <p class="text-center"><?php echo $lang->get('signup_has_account'); ?> <a href="login.php" class="toggle-form"><?php echo $lang->get('signup_login_link'); ?></a></p>
                                </form>
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
                    <h5><?php echo $lang->get('welcome_subtitle'); ?></h5>
                    <p><?php echo $lang->get('footer_address'); ?></p>
                </div>
                <div class="col-md-3">
                    <h5><?php echo $lang->get('footer_quick_links'); ?></h5>
                    <ul class="list-unstyled">
                        <li><a href="../../index.php" class="text-white"><?php echo $lang->get('nav_home'); ?></a></li>
                        <li><a href="../../index.php#about" class="text-white"><?php echo $lang->get('nav_about'); ?></a></li>
                        <li><a href="../../index.php#floor-plans" class="text-white"><?php echo $lang->get('nav_floor_plans'); ?></a></li>
                        <li><a href="../../contact.php" class="text-white"><?php echo $lang->get('nav_contact'); ?></a></li>
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
    <script src="../../js/main.js"></script>
</body>

</html>