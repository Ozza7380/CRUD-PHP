<?php
session_start();
session_destroy();
header('Location: /todos/index.php');
exit;
?>