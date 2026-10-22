<?php 
require 'config.php';
require 'middleware.php';
requireLogin();
?>

<?php
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    if ($title !== '') {
        $stmt = $pdo->prepare("INSERT INTO todos (title, description) VALUES (?, ?)");
        $stmt->execute([$title, trim($_POST['description'] ?? '')]);
        $_SESSION['message'] = 'Todo berhasil ditambahkan!';
        header('Location: index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah todo</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2x1 font-boldmb-4">Tambah Todo</h1>
        <form method="post">
            <div class="mb-3">
                <label class="block font-medium">Judul</label>
                <input type="text" name="title" class="w-full border p-2 rounded" required>
            </div>
            <div class="mb-3">
                <label class="block font-medium">Deskripsi</label>
                <textarea name="description" class="w-full border p-2 rounded"></textarea>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
            <a href="index.php" class="ml-2 text-gray-500">Batal</a>
        </form>
    </div>
</body>
</html>