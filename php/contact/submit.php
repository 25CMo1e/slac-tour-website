<?php
require_once '../auth/db.php';

// Initialize response array
$response = array(
    'success' => false,
    'message' => ''
);

// Validate form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate input
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
    // e78b97273824b1a3fbf285a951251bac4849ad374999be520ebabf0012a022ea
    // Validate required fields
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $response['message'] = 'All fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['message'] = 'Please enter a valid email address.';
    } else {
        try {
            // Prepare SQL statement
            // Prepare SQL statement
            $stmt = $conn->prepare("INSERT INTO feedback (name, email, subject, message) VALUES (?, ?, ?, ?)");

            // Execute statement
            if ($stmt->bind_param("ssss", $name, $email, $subject, $message) && $stmt->execute()) {
                $response['success'] = true;
                $response['message'] = 'Thank you for your message. We will get back to you soon.';
            } else {
                $response['message'] = 'Failed to submit your message. Please try again later.';
            }
        } catch (PDOException $e) {
            $response['message'] = 'An error occurred. Please try again later.';
            error_log('Contact form error: ' . $e->getMessage());
        }
    }
} else {
    $response['message'] = 'Invalid request method.';
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
