<?php 
// include user_guide class 
include_once 'class/User_guide.php';
// create obj
$userguide = new User_guide();
$userguideInfo = $userguide->getList();
?>

<!DOCTYPE html>
<html> 
<head> 
	<meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<!-- FontAwesome core CSS -->
	<link rel="stylesheet" type="text/css" href="assets/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets/simple-line-icons.css">
	<!-- Custom Layout -->
	<link rel="stylesheet" type="text/css" href="assets/style.css">
	<link rel="stylesheet" type="text/css" href="assets/responsive.css">
	
	<title>User Guide</title>
</head> 

<body>
	<div class="container" style="max-width: 98%; margin-top: 85px;">
		<div class="row">
			<div class="col-md-3 left-area">

				<div class="searching-area">
					<!-- Searching -->
					<div class="input-group">
						<input id="filter" name="filter" class="filter form-control py-2 border-right-0 border" data-alf="#menu" type="search" placeholder="Search by title">
						<span class="input-group-append">
							<div class="input-group-text bg-transparent"><i class="fa fa-search"></i></div>
						</span>
					</div>
				</div>
				<aside class="sidebar">

					<!-- List User Guide -->
					<div id="userguide_list"></div>
				</aside>
			</div>

			<!--- Main Content Load-->
			<div class="col-md-9 right-area">

				<div class="main_content" id="content">
					<section class="showcase">
						<span id="render-userguide-data">
							<?php if(!empty($userguideInfo) && count($userguideInfo)>0) { ?>
								<?php foreach($userguideInfo as $key=>$element) { ?>
									<span id="dyn-<?php print $element['id'];?>">
										<div class="card gedf-card anchor" id="<?php print $element['featLink']; ?>">

											<div class="card-body">

												<!--- Feature Name -->
												<div class="row">

													<div class="col-md-10">
														<h2 class="text-capitalize text-title">
															<?php print $element['featName']; ?>
															<a class='linked-userguide' href='#<?php print $element['featLink']; ?>'><i class='fa fa-link' aria-hidden='true'></i></a>
														</h2>
													</div>
													<div class="col-md-2">
														<div class="editable-content">
															<a href="#show-<?php print $element['id'];?>"><i class="fa fa-caret-down" aria-hidden="true">Action</i></a>
														</div>
														<div id="show-<?php print $element['id'];?>" class="action-content">
															<span><i class="fa fa-caret-down" aria-hidden="true">Action</i><b><a href="#">x</a></b></span>
															<button type="submit" class="btn btn-sm btn-primary update-userguide" data-update-userguideid="<?php print $element['id'];?>">Edit</button>
															<button type="submit" class="btn btn-sm btn-danger delete-userguide" data-delete-userguideid="<?php print $element['id'];?>">Delete</button>
														</div>
													</div>
												</div>

												<!--- Feature Content -->
												<div class="content-feature">
													<div class="card-text">
														<article class="article">
															<div class="text-muted h7 mb-2">
																<?php print $element['lastUpdate']; ?> • <span class="eta"></span>
															</div>
															<hr>
															<?php print $element['featContent']; ?>
														</article>
													</div>
												</div>

											</div>                    
										</div>
									</span>
								<?php } ?>
							<?php } ?>
						</span>
					</section>
				</div>

				<div class="float-right button-add">
					<button type="button" class="btn btn-default" style="border-radius: 100%;" data-toggle="modal" data-target="#ModalNewUserguide"><i class="fa fa-plus" aria-hidden="true"></i>
					</button>
				</div>

				<!-- Modal -->
				<div class="modal fade" id="ModalNewUserguide" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h3 class="modal-title" id="exampleModalLongTitle">Add New Content User Guide</h3>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form id="dynamic-post" class="dynamic-post">
									<input type="hidden" name="action" value="create">
									<div class="row align-items-center">
										<div class="col-md-12">

											<div class="form-group">
												<div class="col-sm-12">          
													<input type="text" class="form-control text-capitalize" id="feat-name" placeholder="Feature Name" name="featName" onkeyup="generateLink();">
												</div>
											</div>
											<div class="form-group">
												<div class="row" style="margin: 0;">
													<div class="col-sm-8">          
														<input type="text" class="form-control" id="feat-link" placeholder="Feature Link" name="featLink">
													</div>
													<div class="col-sm-4">          
														<input type="text" class="form-control" id="last-update"  name="lastUpdate" readonly="readonly">
													</div>
												</div>
											</div> 
											<div class="form-group">
												<div class="col-sm-12">
													<textarea class="form-control" id="userguide-content" name="featContent"></textarea>
													<input type='file' name='fileupload' id='fileupload' style='display: none;'>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<button type="button" class="btn btn-primary float-right" id="save-userguide" onclick="setFocus()">Submit</button>
								</div>
								<?php
								require 'assets/script.php';
								?>
							</form>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
	<!--- Header -->
	<nav>
		<div class="page-hdr">
			<h2>User Guide</h2>
		</div>
	</nav>

	<!-- jQuery -->
	<script type="text/javascript" src='assets/js/jquery.js'></script>
	<!-- Bootstrap -->
	<script type="text/javascript" src='assets/js/popper.js'></script>
	<script type="text/javascript" src='assets/js/bootstrap.js'></script>

	<!-- Textarea Editor TinyMCE -->
	<script type="text/javascript" src="assets/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
	<script type="text/javascript" src="assets/tinymce/custom.tinymce.js"></script>

	<!-- Tree JS -->
	<script type="text/javascript" src="assets/tree.jquery.js"></script>
	<!-- Load Data Tree Js-->
	<script src="user_guide.js"></script> 

	<script type="text/javascript" src="assets/script.js"></script>

	<script type="text/javascript">
		$(function() {
			$('article').each(function() {
				const _this = $(this);
				_this.readingTime({
					readingTimeTarget: _this.find('.eta'),
					success: function(data) {
						//console.log(data);
					},
					error: function(data) {
						_this.find('.eta').remove();
					}
				});
			});
		});
	</script>

	<script type="text/javascript">
		//Button save focus form
		function setFocus() { 
			document.getElementById('feat-name').focus(); 
		}

		var input = document.getElementById('feat-name');
		input.addEventListener("keyup", function(event) {
			if (event.keyCode === 13) {
				event.preventDefault();
				document.getElementById("save-userguide").click();
			}
		});
	</script>


	<script>
		$(document).ready(function() {

			//Modal Focus Form
			$('#ModalNewUserguide').on('shown.bs.modal', function() {
				$('#feat-name').trigger('focus');
			});

			$(function() {
				var tree = $('#userguide_list'),
				filter = $('#filter'),
				filtering = false,
				thread = null;

				tree.tree({
					data: userguide_list,
					animationSpeed: "fast",
					useContextMenu: false,
					selectable: true,
					autoEscape: false,
					autoOpen: true,
					closedIcon: '&#x25B8;',
					openedIcon: '&#x25BE;',
					onCreateLi: function(node, $li) {
						var title = $li.find('.jquser-title'),
						search = filter.val().toLowerCase(),
						value = title.text().toLowerCase();

						if(search !== '') {
							$li.hide();
							if(value.indexOf(search) > -1) {
								$li.show();
								var parent = node.parent;
								while(typeof(parent.element) !== 'undefined') {
									$(parent.element)
									.show()
									.addClass('jquser-filtered');
									parent = parent.parent;
								}
							}
							if(!filtering) {
								filtering = true;
							};
							if(!tree.hasClass('jquser-filtering')) {
								tree.addClass('jquser-filtering');
							};
						} else {
							if(filtering) {
								filtering = false;
							};
							if(tree.hasClass('jquser-filtering')) {
								tree.removeClass('jquser-filtering');
							};
						};	
					},
					onCanMove: function(node) {
						if(filtering) {
							return false;
						} else {
							return true;
						};
					}

				});

				filter.keyup(function() {
					clearTimeout(thread);
					thread = setTimeout(function () {
						tree.tree('loadData', userguide_list);
					}, 50);
				});
			});

		});
	</script>

</body> 
</html>