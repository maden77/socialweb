
<?php
include 'db.php';
$id = $_GET['id'] ?? null;
if (!$id) die("ID tidak ditemukan");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $note = $conn->real_escape_string($_POST['note']);
    $conn->query("UPDATE notes SET content='$note' WHERE id=$id");
    header("Location: index.php");
    exit;
}

$result = $conn->query("SELECT * FROM notes WHERE id=$id");
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Catatan</title>
</head>
<body>
    <h1>Edit Catatan</h1>
    <form method="post">
        <textarea name="note"><?= htmlspecialchars($row['content']) ?></textarea><br>
        <button type="submit">Update</button>
    </form>
    <a href="index.php">Kembali</a>
</body>
</html>
