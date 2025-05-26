<?php
class Language {
    private static $instance = null;
    private $translations = [];
    private $currentLang = 'en';
    private $availableLangs = ['en', 'zh'];

    private function __construct() {
        $this->setLanguage();
        $this->loadTranslations();
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function setLanguage() {
        if (isset($_SESSION['lang']) && in_array($_SESSION['lang'], $this->availableLangs)) {
            $this->currentLang = $_SESSION['lang'];
        } else if (isset($_COOKIE['lang']) && in_array($_COOKIE['lang'], $this->availableLangs)) {
            $this->currentLang = $_COOKIE['lang'];
        } else {
            // Default to browser language if available
            $browserLang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? 'en', 0, 2);
            $this->currentLang = in_array($browserLang, $this->availableLangs) ? $browserLang : 'en';
        }
        $_SESSION['lang'] = $this->currentLang;
        setcookie('lang', $this->currentLang, time() + (86400 * 30), "/"); // 30 days
    }

    private function loadTranslations() {
        $langFile = __DIR__ . '/' . $this->currentLang . '.php';
        if (file_exists($langFile)) {
            $this->translations = require $langFile;
        }
    }

    public function get($key, $default = '') {
        return $this->translations[$key] ?? $default;
    }

    public function getCurrentLang() {
        return $this->currentLang;
    }

    public function getAvailableLangs() {
        return $this->availableLangs;
    }

    public function setLang($lang) {
        if (in_array($lang, $this->availableLangs)) {
            $_SESSION['lang'] = $lang;
            setcookie('lang', $lang, time() + (86400 * 30), "/");
            $this->currentLang = $lang;
            $this->loadTranslations();
            return true;
        }
        return false;
    }
}
