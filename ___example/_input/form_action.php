<?php
session_start();
include '../config/koneksi.php';
include '../config/csrf.php';

$id 			= stripslashes(strip_tags(htmlspecialchars($_POST['id'] ,ENT_QUOTES)));
$feat_name 		= stripslashes(strip_tags(htmlspecialchars($_POST['feat_name'] ,ENT_QUOTES)));
$feat_parent 	= stripslashes(strip_tags(htmlspecialchars($_POST['feat_parent'] ,ENT_QUOTES)));
$feat_link 		= stripslashes(strip_tags(htmlspecialchars($_POST['feat_link'] ,ENT_QUOTES)));
$feat_content 	= stripslashes(strip_tags(htmlspecialchars($_POST['feat_content'] ,ENT_QUOTES)));

if ($id == "") {
	$query = "INSERT into tbl_userguide (feat_name, feat_parent, feat_link, feat_content) VALUES (?, ?, ?, ?)";
	$result = $db1->prepare($query);
	$result->bind_param("ssss", $feat_name, $feat_parent, $feat_link, $feat_content);
	$result->execute();
} else {
	$query = "UPDATE tbl_userguide SET feat_name=?, feat_parent=?, feat_link=?, feat_content=? WHERE id=?";
	$result = $db1->prepare($query);
	$result->bind_param("ssssi", $feat_name, $feat_parent, $feat_link, $feat_content, $id);
	$result->execute();
}

echo json_encode(['success' => 'Sukses']);

$db1->close();
?>