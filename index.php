<?php 
require 'config.php';
require 'middleware.php';
requireLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-20">

    <div class="max-w2x1 mx-auto bg-white p-6 rounded shadow">
        <div class="flex justify-brteween items-center mb-4">
            <h1 class="text-2x1 font-bold px-4">Todo list</h1>
            <a href="create.php" class="bg-blue-500 text-white px-4 py-2 rounded">+ Tambah</a>
        </div>

        <?php if (isset($_SESSION['message'])): ?>
            <div class="bg-green-100 p-3 rounded mb-4">
                <? $_SESSION['message']; unset($_SESSION['message']); ?>
            </div>
            <?php endif; ?>

            <?php
            $todos = $pdo->query("SELECT * FROM todos ORDER BY id DESC")->fetchAll();
            ?>

            <?php foreach ($todos as $todo): ?>
                <div class="flex items-cneter justify-between border-b p-3">
                    <div>
                        <span class="<?= $todo['completed'] ? 'line-through text-gray-400' : '' ?>">
                            <?= htmlspecialchars($todo['title']) ?>
                        </span>
                        <small class="text-gray-500 ml-2"><?= $todo['created_at'] ?></small>
                    </div>
                    <div class="flex gap-2">
                        <a href="edit.php?id=<?= $todo['id'] ?>" class="text-yellow-500">Edit</a>
                        <a href="delete.php?id=<?= $todo['id'] ?>"  class="text-red-500"
                            onclick="return confirm('hapus')">Hapus</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
</body>
</html>