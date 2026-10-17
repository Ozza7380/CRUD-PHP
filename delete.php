<?php
require 'config.php';

$id =$_GET['id'] ?? null;
if ($id) {
    $stmt = $pdo->prepare("DELETE FROM todos WHERE id = ?");
    $stmt->execute([$id]);
    $_SESSION['message'] = 'Todo berhasil dihapus!';
}
header('Location index.php');
exit;
?>