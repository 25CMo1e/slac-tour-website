<?php
session_start();
// V2FuZyBLYWl4aW4gLSAxMzA2MzE4
header('Content-Type: application/json');

$response = ['loggedin' => false];

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $response['loggedin'] = true;
    $response['username'] = $_SESSION['username'];
}

echo json_encode($response);
