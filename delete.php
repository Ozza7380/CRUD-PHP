<?php
require 'config.php';
require 'middleware.php';
requireLogin();

$id =$_GET['id'] ?? null;
if ($id) {
    $stmt = $pdo->prepare("DELETE FROM todos WHERE id = ?");
    $stmt->execute([$id]);
    $_SESSION['message'] = 'Todo berhasil dihapus!';
}
header('Location: index.php');
exit;
?>