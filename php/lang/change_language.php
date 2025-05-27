<?php
session_start();
require_once 'Language.php';

if (isset($_POST['lang'])) {
    $lang = $_POST['lang'];
    $language = Language::getInstance();
    if ($language->setLang($lang)) {
        $redirect = $_SERVER['HTTP_REFERER'] ?? '../index.php';
        header("Location: $redirect");
        exit;
    }
}

header("Location: ../index.php");
exit;
