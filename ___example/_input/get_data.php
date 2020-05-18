<?php
session_start();
include '../config/koneksi.php';
include '../config/csrf.php';

$id = $_POST['id'];
$query = "SELECT * FROM tbl_userguide WHERE id=? ORDER BY id DESC";
$result = $db1->prepare($query);
$result->bind_param('i', $id);
$result->execute();
$res1 = $result->get_result();
while ($row = $res1->fetch_assoc()) {
	$h['id'] 			= $row["id"];
	$h['feat_name'] 	= $row["feat_name"];
	$h['feat_parent'] 	= $row["feat_parent"];
	$h['feat_link'] 	= $row["feat_link"];
	$h['feat_content'] 	= $row["feat_content"];
}
echo json_encode($h);

$db1->close();
?>