<?php
// Jika Versi PHP 7+ library ini tidak digunakan
require_once '../assets/lib/random.php';

include '../config/auth.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />    
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<title>INPUT KONTEN USER GUIDE</title>
	<!-- Csrf Token -->
	<meta name="csrf-token" content="<?= $_SESSION['csrf_token'] ?>">
	<!-- Bootstrap -->
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" type="text/css" href="../assets/font-awesome-4.7.0/css/font-awesome.min.css">
	<!-- Datatable -->
	<link rel="stylesheet" type="text/css" href="../assets/DataTables-1.10.20/css/jquery.dataTables.min.css">
	<!-- Style -->
	<link rel="stylesheet" type="text/css" href="../assets/style.css">

</head>
<body>

	<div class="container" style="max-width: 98%; margin-top: 85px;">

		<form method="post" class="form-data" id="form-data">  
			<div class="row">
				<div class="col-sm-3">
					<div class="form-group">
						<label>Feature Name</label>
						<input type="hidden" name="id" id="id">
						<input type="text" name="feat_name" id="feat_name" class="form-control" required="true" onkeyup="generateLink();">
						<p class="text-danger" id="err_feat_name"></p>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label>Feature Parent</label>
						<select name="feat_parent" id="feat_parent" class="form-control parent_name" required="true">
						</select>
						<p class="text-danger" id="err_feat_parent"></p>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label>Feature Link</label>
						<input type="text" name="feat_link" id="feat_link" class="form-control" required="true">
						<p class="text-danger" id="err_feat_link"></p>
					</div>
				</div>
			</div>

			<div class="form-group">
				<label>Feature Content</label>
				<textarea name="feat_content" id="feat_content" class="form-control" required="true"></textarea>
				<p class="text-danger" id="err_feat_content"></p>
			</div>

			<div class="form-group">
				<button type="button" name="simpan" id="simpan" class="btn btn-primary">
					<i class="fa fa-save"></i> Simpan
				</button>
			</div>
		</form>
		<hr>

		<div class="data"></div>

	</div>

	<!--- Header -->
	<nav>
		<div class="page-hdr">
			<h2>User Guide</h2>
		</div>
	</nav>

	<!-- JQuery -->
	<script src="../assets/js/jquery.min.js"></script>
	<!-- DataTable -->
	<script src="../assets/DataTables-1.10.20/js/jquery.dataTables.min.js"></script>
	<!-- Bootstrap -->
	<script src='../assets/js/popper.js'></script>
	<script src="../assets/js/bootstrap.min.js"></script>

	<!-- Editor -->

	<script type="text/javascript">
		function generateLink() {
			var str = document.getElementById('feat_name').value;
			document.getElementById('feat_link').value = str = str.replace(/[&\/\\#, +()$~%!@^_,|.'":*?<>{}]/g, '-').toLowerCase();;
		}
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
		//Mengirimkan Token Keamanan
		$.ajaxSetup({
			headers : {
				'Csrf-Token': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$('.data').load("data.php");
		$('.parent_name').load("data_option.php");
		$("#simpan").click(function(){
			var data = $('.form-data').serialize();
			var feat_name 	 = document.getElementById("feat_name").value;
			var feat_parent  = document.getElementById("feat_parent").value;
			var feat_link 	 = document.getElementById("feat_link").value;
			var feat_content = document.getElementById("feat_content").value;

			if (feat_name=="") {
				document.getElementById("err_feat_name").innerHTML = "Feature Name Harus Diisi";
			} else {
				document.getElementById("err_feat_name").innerHTML = "";
			}
			if (feat_parent=="") {
				document.getElementById("err_feat_parent").innerHTML = "Feature Parent Harus Diisi";
			} else {
				document.getElementById("err_feat_parent").innerHTML = "";
			}
			if (feat_link=="") {
				document.getElementById("err_feat_link").innerHTML = "Feature Link Harus Diisi";
			} else {
				document.getElementById("err_feat_link").innerHTML = "";
			}
			if (feat_content=="") {
				document.getElementById("err_feat_content").innerHTML = "Feature Content Harus Diisi";
			} else {
				document.getElementById("err_feat_content").innerHTML = "";
			}

			if (feat_name!="" && feat_parent!=""  && feat_link!=""  && feat_content!="") {
				$.ajax({
					type: 'POST',
					url: "form_action.php",
					data: data,
					success: function() {
						$('.data').load("data.php");
						$('.parent_name').load("data_option.php");
						document.getElementById("id").value = "";
						document.getElementById("form-data").reset();
					}, error: function(response){
						console.log(response.responseText);
					}
				});
			}

		});
	});
</script>
</body>
</html>