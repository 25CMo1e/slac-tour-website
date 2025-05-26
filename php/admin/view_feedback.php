<?php
// Include the database connection file
include '../auth/db.php';

// SQL query to select all data from the feedback table
$sql = "SELECT feedback_id, name, email, subject, message, submission_time, status FROM feedback ORDER BY submission_time DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Feedback - SLAC Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/responsive.css">
    <!-- e78b97273824b1a3fbf285a951251bac4849ad374999be520ebabf0012a022ea -->
    <style>
        .container {
            margin-top: 20px;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <!-- Navigation Bar (Optional: Add an admin specific nav bar or reuse the main one) -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="../../index.html">SLAC</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
                        <a class="nav-link" href="view_feedback.php">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-light btn-sm ml-2" href="../auth/login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1 class="text-center mb-4">Feedback Messages</h1>

        <?php
        if ($result->num_rows > 0) {
            echo "<table class='table table-bordered table-striped'>";
            echo "<thead class='thead-dark'>";
            echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Subject</th><th>Message</th><th>Submission Time</th><th>Status</th></tr>";
            echo "</thead>";
            echo "<tbody>";
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["feedback_id"] . "</td>";
                echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["subject"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["message"]) . "</td>";
                echo "<td>" . $row["submission_time"] . "</td>";
                echo "<td>" . $row["status"] . "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<div class='alert alert-info'>No feedback messages found.</div>";
        }
        $conn->close();
        ?>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>Student Learning & Activity Center</h5>
                    <p>Wenzhou-Kean University<br>88 Daxue Road, Ouhai<br>Wenzhou, Zhejiang, China</p>
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
    <script src="../../js/main.js"></script>
    <script>
        $(document).ready(function() {
            // Check login status on page load
            $.ajax({
                url: '../auth/check_login_status.php',
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.loggedin) {
                        // User is logged in
                        $('#navbarNav .nav-item:last-child').html('<a class="nav-link btn btn-outline-light btn-sm ml-2" href="../auth/logout.php">Logout (' + response.username + ')</a>');
                    } else {
                        // User is not logged in
                        $('#navbarNav .nav-item:last-child').html('<a class="nav-link btn btn-outline-light btn-sm ml-2" href="../auth/login.php">Login</a>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error checking login status:', error);
                }
            });
        });
    </script>
</body>

</html>