
<?php
include 'db.php';
$notes = $conn->query("SELECT * FROM notes ORDER BY id DESC");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['note'])) {
    $note = $conn->real_escape_string($_POST['note']);
    $conn->query("INSERT INTO notes (content) VALUES ('$note')");
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Catatan Saya</title>
    <link rel="manifest" href="manifest.json">
    <link rel="stylesheet" href="style.css">
    <script>
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('service-worker.js');
    }
    </script>
</head>
<body>
    <h1>Catatan Saya</h1>
    <form method="post">
        <textarea name="note" placeholder="Tulis catatan di sini..."></textarea><br>
        <button type="submit">Simpan</button>
    </form>
    <ul>
        <?php while ($row = $notes->fetch_assoc()): ?>
            <li>
                <?= htmlspecialchars($row['content']) ?>
                <a href="edit.php?id=<?= $row['id'] ?>">Edit</a> |
                <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Hapus catatan ini?')">Hapus</a>
            </li>
        <?php endwhile; ?>
    </ul>
</body>
</html>
