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
    <title>Dashboard</title>
    <script src="https://tailwindcss/com"></script>
</head>
<body class="bg-gray-100 p-10">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Dashboard</h1>
            <a href="/todos/logout.php" class="text-red-500">Logout</a>
        </div>
    </div>
    <p>Selamat datang, <strong><?= htmlspecialchars($_SESSION['user_name']) ?></strong>!</p>
</body>
</html>