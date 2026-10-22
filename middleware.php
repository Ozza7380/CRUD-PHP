<?php
function isLoggedin() {
    return isset($_SESSION['user_id']);
}

function requireLogin() {
    if (!isLoggedin()) {
        $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
        header('Location: /todos/login.php');
        exit;
    }
}

function guestOnly() {
    if (isLoggedin()) {
        header('Location: /todos/dashboard.php');
        exit;
    }
}
?>