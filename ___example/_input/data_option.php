<?php
include '../config/koneksi.php';
$no = 1;
$query = "SELECT * FROM tbl_userguide ORDER BY id DESC";
$user1 = $db1->prepare($query);
$user1->execute();
$res1 = $user1->get_result();

while ($row = $res1->fetch_assoc()) {
	?>
	<option value="<?php echo $row['id']; ?>"><?php echo $row['feat_name']; ?></option>
	<?php 
}
?>