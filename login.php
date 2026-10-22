<?php
require 'middleware.php';
require 'config.php';
guestOnly();

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['nama'];
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Email atau Password salah';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">
    <div class="max-w-md mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2x1 font-bold mb-4">Login</h1>

    <?php if ($error): ?>
        <div class="bg-red-100 p-3 rounded mb-4 text-red-700"><?= $error ?></div>
    <?php endif; ?>

    <form action="" method="post">
        <div class="mb-3">
                <label class="block font-medium">Email</label>
                <input type="email" name="email" class="w-full border p-2 rounded" required>
        </div>
        <div class="mb-3">
                <label class="block font-medium">Password</label>
                <input type="password" name="password" class="w-full border p-2 rounded" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 rounded w-full">Login</button>
    </form>
    </div>
</body>
</html>