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
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<!-- FontAwesome core CSS -->
	<link rel="stylesheet" href="assets/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/simple-line-icons.css">
	<!-- Custom Layout -->
	<link rel="stylesheet" href="assets/style.css">
	<link rel="stylesheet" href="assets/responsive.css">
	
	<title>User Guide</title>
</head> 

<body>
	<div class="container" style="margin-top: 85px;">
		<div class="row">
			<div class="col-md-3 left-area">

				<div class="searching-area">
					<!-- Searching -->
					<input id="filter" name="filter" class="filter form-control" data-alf="#menu" placeholder="Search User Guide">
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
														
														<h3 class="text-capitalize text-title">
															<?php print $element['featName']; ?>
															<a class='linked-userguide' href='#<?php print $element['featLink']; ?>'><i class='fa fa-link' aria-hidden='true'></i></a>
														</h3>

														<!--<div class="text-muted h7 mb-2">
															<i class="fa fa-calendar"></i> <?php print $element['lastUpdate']; ?> 
														</div> -->
													</div>
													<div class="col-md-2">
														<div class="editable-content">
															<i class="fa fa-caret-down" aria-hidden="true">Action</i>

															<div class="action-content">
																<button type="submit" class="btn btn-sm btn-primary update-userguide" data-update-userguideid="<?php print $element['id'];?>">Edit</button>
																<button type="submit" class="btn btn-sm btn-danger delete-userguide" data-delete-userguideid="<?php print $element['id'];?>">Delete</button>
															</div>
														</div>
													</div>
												</div>
												<hr>

												<!--- Feature Content -->
												<div class="content-feature">
													<p class="card-text"><?php print $element['featContent']; ?></p>
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
				<div class="modal fade" id="ModalNewUserguide" tabindex="10" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h6 class="modal-title" id="exampleModalLongTitle">Add New Content User Guide</h6>
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
									<button type="button" class="btn btn-primary float-right" id="save-userguide">Submit</button>
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
	<script src='assets/js/jquery.js'></script>
	<!-- Bootstrap -->
	<script src='assets/js/popper.js'></script>
	<script src='assets/js/bootstrap.js'></script>
	
	<!-- Textarea Editor TinyMCE -->
	<script src="assets/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
	<script src="assets/tinymce/custom.tinymce.js"></script>
	
	<!-- Tree JS -->
	<script type="text/javascript" src="assets/tree.jquery.js"></script>
	<!-- Load Data Tree Js-->
	<script src="user_guide.js"></script> 

	<script>
		$(document).ready(function() {

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