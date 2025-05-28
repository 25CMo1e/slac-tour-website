<?php
// Wang Kaixin - 1306318 (SHA256: 7a9c481e7c4735ab4394d5400e2b31f6a1c36bc9b8f67e9e1d853c8578e44570)

include 'db.php';
// Start session
session_start();

// Initialize variables
$username = $password = "";
$username_err = $password_err = $login_err = "";

// Process form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username";
    } else {
        $username = trim($_POST["username"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter password";
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
                            $_SESSION["user_id"] = $user_id;
                            $_SESSION["username"] = $username;

                            // Redirect user to welcome page
                            header("location: ../../index.html");
                        } else {
                            // Password is not valid
                            $login_err = "Invalid username or password";
                        }
                    }
                } else {
                    // Username doesn't exist
                    $login_err = "Invalid username or password";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SLAC</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/responsive.css">
    <style>
        .auth-container {
            max-width: 450px;
            margin: 0 auto;
            padding: 2rem;
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="../../index.html">SLAC</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../../index.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../index.html#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../index.html#facilities">Facilities</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../contact.html">Contact</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link btn btn-outline-light btn-sm ml-2" href="#">Login</a>
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
                                <h2 class="text-center mb-4">Login</h2>

                                <?php
                                if (!empty($login_err)) {
                                    echo '<div class="alert alert-danger">' . $login_err . '</div>';
                                }
                                ?>

                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                                        <span class="invalid-feedback"><?php echo $username_err; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                                        <span class="invalid-feedback"><?php echo $password_err; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                                    </div>
                                    <p class="text-center">Don't have an account? <a href="register.php" class="btn btn-link">Sign up</a></p>
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
                    <h5>Welcome to SLAC</h5>
                    <p>123 University Avenue, City, Country</p>
                </div>
                <div class="col-md-3">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="../../index.html" class="text-white">Home</a></li>
                        <li><a href="../../index.html#about" class="text-white">About</a></li>
                        <li><a href="../../index.html#floor-plans" class="text-white">Floor Plans</a></li>
                        <li><a href="../../contact.html" class="text-white">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Connect With Us</h5>
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
                    <p class="mb-0">&copy; <?php echo date("Y"); ?> SLAC. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    
    <!-- Main JavaScript -->
    <script src="../../js/main.js"></script>
</body>
</html>
