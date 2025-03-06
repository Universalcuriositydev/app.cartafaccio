<?php
require 'session.php';

function validateInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

function generateToken() {
    if (empty($_SESSION['token'])) {
        $_SESSION['token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['token'];
}

function verifyToken($token) {
    if (isset($_SESSION['token']) && hash_equals($_SESSION['token'], $token)) {
        unset($_SESSION['token']); // token can be used only once
        return true;
    }
    return false;
}

function logError($message) {
    error_log($message . PHP_EOL, 3, '../errors.log');
}
?>
