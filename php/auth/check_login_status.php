<?php
session_start();

$loggedin = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
$username = $loggedin ? $_SESSION['username'] : null;

// 如果是 AJAX 请求，返回 JSON
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    header('Content-Type: application/json');
    echo json_encode([
        'loggedin' => $loggedin,
        'username' => $username
    ]);
    exit; // 直接退出，避免后续代码执行
}


?>
