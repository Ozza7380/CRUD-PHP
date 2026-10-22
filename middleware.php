<?php
function isLoggedin() {
    return isset($_SESSION['user_id']);
}

function requireLogin() {
    if (!isLoggedin()) {
        $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
        header('Location: /todos/index.php');
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