<?php
session_start();
include '../config/../config/koneksi.php';
include '../config/csrf.php';

$id = $_POST['id'];

$query = "DELETE FROM tbl_userguide WHERE id=?";
$result = $db1->prepare($query);
$result->bind_param("i", $id);
$result->execute();

echo json_encode(['success' => 'Sukses']);

$db1->close();
?>