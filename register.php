<?php
require 'config.php'; // include koneksi PDO + session_start()

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email =  trim($_POST['email'] ?? '');
    $passsword = trim($_POST['password'] ?? '');
    $confirm = trim($_POST['confirm_password'] ?? '');
echo $passsword.'ini pw';
echo $confirm.'ini conf';
    if ($passsword !== $confirm) {
        $error = 'Password tidak  cocok';
    } elseif (strlen($passsword) <6 ) {
        $error = 'Password minimal 6';
    } else {
        // cek email sudah terdaftar
        $stmt = $pdo->prepare("SELECT id FROM users WHERE id = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $error = 'Email sudah terdaftar';
        } else {
            // hash password dan simpan
            $hashed = password_hash($passsword, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (nama, email, password) VALUES(?, ?, ?)");
            $stmt->execute([$name,$email, $hashed]);
            $_SESSION['message'] = 'Register berhasil! Silahkan login';
            header('Location: /login.php');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<bod class="bg-gray-100 p-100">
    <div class="max--md mx-auto bg-white p-6 rounded shadow">
        <?php if ($error): ?>
        <h1 class="text-2x1 font-bold mb-4 text-red-700"><?= $error ?></h1>
        <?php endif; ?>

        <form method="post">
            <div class="mb-3">
                <label class="black-font-medium">Nama</label>
                <input type="text" name="name" value="<?= htmlspecialchars($name ?? '') ?>" class="w-full border p-2 rounded" required>
            </div>
            <div class="mb-3">
                <label class="block font-medium">Email</label>
                <input type="email" name="email" class="w-full border p-2 rounded" required>
            </div>
            <div class="mb-3">
                <label class="block font-medium">Password</label>
                <input type="password" name="password" class="w-full border p-2 rounded" required>
            </div>
            <div class="mb-3">
                <label class="block font-medium">Konfirmasi Password</label>
                <input type="password" name="confirm_password" class="w-full border p-2 rounded" required>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 rounded w-full">Daftar</button>
        </form>

        <p class="mt-3 text-center">Sudah punya akun? <a href="/todos/login.php" class="text-blue-500">Login</a></p>
    </div>

</body>
</html>