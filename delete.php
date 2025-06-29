
<?php
include 'db.php';
$id = (int) ($_GET['id'] ?? 0);
$conn->query("DELETE FROM notes WHERE id = $id");
header("Location: index.php");
exit;
