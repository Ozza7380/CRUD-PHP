<?php require 'config.php' ?>

<?php
$id =$_GET['id'] ?? null;
if (!$id) { header('Location: index.php'); exit; }

$stmt = $pdo->prepare("SELECT * FROM todos WHERE id = ?");
$stmt->execute([$id]);
$todo = $stmt->fetch();
if (!$todo) { header('Location: index.php');  exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    $title= trim($_POST['title']);
    if ($title !== '') {
        $stmt = $pdo->prepare("UPDATE todos SET title = ?, description = ? WHERE id = ?");
        $stmt->execute([$title, trim($_POST['description'] ?? ''), $id]);
        $_SESSION['message'] = 'Todo berhasil diupdate!';
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
    <title>Edit todo</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-200 p-10">
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2x1 font-bold mb-4">Edit todo</h1>
        <form method="post">
            <div class="mb-3">
                <label class="block font-medium">Judul</label>
                <input type="text" name="title" value="<?= htmlspecialchars($todo['title']) ?>" class="w-full border p-2 rounded" required>
            </div>
            <div class="mb-3">
                <label class="block font-medium">Deskripsi</label>
                <textarea name="description" class="w-full border p-2"><?= htmlspecialchars($todo['description']) ?></textarea>
            </div>
            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">Update</button>
            <a href="index.php" class="ml-2 text-gray-500">Batal</a>
        </form>
    </div>
</body>
</html>