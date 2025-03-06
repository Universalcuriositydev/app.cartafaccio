<?php
session_start();

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function getUserId() {
    return $_SESSION['user_id'];
}

function login($user_id) {
    $_SESSION['user_id'] = $user_id;
}

function logout() {
    session_unset();
    session_destroy();
}
?>
