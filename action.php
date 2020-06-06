<?php
// include user_guide class 
include_once 'class/User_guide.php';
// create obj
$userguide = new User_guide();
// post method
$post = $_POST;
// define array
$json = array();

// create record in database
if(!empty($post['action']) && $post['action']=="create") {
  require 'assets/script.php';
	$userguide->setFeatName($post['featName']);
	$userguide->setFeatLink($post['featLink']);
  $userguide->setFeatContent($post['featContent']);
	$userguide->setLastUpdate($post['lastUpdate']);
	$status = $userguide->create();
	if(!empty($status)){
		$json['msg'] = 'success';
		$json['task_id'] = $status;
	} else {
		$json['msg'] = 'failed';
		$json['task_id'] = '';
	}
	header('Content-Type: application/json');	
	echo '<span id="dyn-'.$status.'">
      <div class="card gedf-card anchor" id="'.$post['featLink'].'">
        <div class="card-body">
          <!--- Feature Name -->
          <div class="row">
            <div class="col-md-10">

              <h2 class="text-capitalize text-title">
                '.$post['featName'].'
                <a class="linked-userguide" href="#'.$post['featLink'].'"><i class="fa fa-link" aria-hidden="true"></i></a>
              </h2>
            </div>

            <div class="col-md-2">
              <div class="editable-content">
                <a href="#show-'.$status.'"><i class="fa fa-caret-down" aria-hidden="true">Action</i></a>
              </div>
              <div id="show-'.$status.'" class="action-content">
                <span><i class="fa fa-caret-down" aria-hidden="true">Action</i><b><a href="#">x</a></b></span>
                <button type="submit" class="btn btn-sm btn-primary update-userguide" data-update-userguideid="'.$status.'">Edit</button>
                <button type="submit" class="btn btn-sm btn-danger delete-userguide" data-delete-userguideid="'.$status.'">Delete</button>
              </div>
            </div>
          </div>

          <!--- Feature Content -->
          <div class="content-feature">
            <div class="card-text">
              <article class="article">
                <div class="text-muted h7 mb-2">
                  '.$post['lastUpdate'].' • <span class="eta"></span>
                </div>
                <hr>
                '.$post['featContent'].'
              </article>
            </div>
          </div>
        </div>                    
      </div>
    </span>

    <script type="text/javascript">
      $(function() {
        $("article").each(function() {
          const _this = $(this);
          _this.readingTime({
            readingTimeTarget: _this.find(".eta"),
            success: function(data) {
              //console.log(data);
            },
            error: function(data) {
              _this.find(".eta").remove();
            }
          });
        });
      });
    </script>

    <script type="text/javascript">
      $(document).ready(function() {
        $("img").attr("data-action", "zoom");
      });
    </script>';
}

// update record in database
if(!empty($post['action']) && $post['action']=="fetch_userguide") {
	require 'assets/script.php';
  $userguide->setUserguideID($post['userguide_id']);
	$fetchUserguide = $userguide->getUserguide();
	header('Content-Type: application/json');
	echo '<form id="dynamic-post-'.$post['userguide_id'].'" class="dynamic-post"">
	<input type="hidden" name="action" value="update">
    <input type="hidden" name="userguide_id" value="'.$fetchUserguide['id'].'">
		<input type="hidden" name="LastUpdate" value="'.$fetchUserguide['id'].'">
        <div class="row align-items-center">
          <div class="col-md-12 col-md-right">
           <div class="form-group">
              <div class="col-sm-12">          
                <input type="text" class="form-control text-capitalize" id="feat-name" placeholder="Feature Name" name="featName" value="'.$fetchUserguide['featName'].'" onkeyup="generateLink();">
              </div>
           </div>
           <div class="form-group">
              <div class="row" style="margin: 0;">
                <div class="col-sm-8">          
                  <input type="text" class="form-control" id="feat-link" placeholder="Feature Link" name="featLink" value="'.$fetchUserguide['featLink'].'">
                </div>
                <div class="col-sm-4">          
                  <input type="text" class="form-control" id="last-update" name="lastUpdate" readonly="readonly">
                </div>
              </div>
           </div> 
           <div class="form-group">
              <div class="col-sm-12">
                <textarea class="form-control" id="userguide-content'.$fetchUserguide['id'].'" name="featContent">'.$fetchUserguide['featContent'].'</textarea>
              </div>
           </div>
           <div class="form-group">        
              <div class="col-sm-offset-2 col-sm-12">
                <button type="button" style="margin-bottom: 20px;" class="btn btn-primary float-right save-update" data-save-userguideid="'.$fetchUserguide['id'].'">Save</button>
              </div>
           </div>
        </div>
      </div>
      </form>';
  }

// update record in database
if(!empty($post['action']) && $post['action']=="update") {
	$userguide->setFeatName($post['featName']);
	$userguide->setFeatLink($post['featLink']);
  $userguide->setFeatContent($post['featContent']);
  $userguide->setLastUpdate($post['lastUpdate']);
	$userguide->setUserguideID($post['userguide_id']);
	$status = $userguide->update();
	if(!empty($status)){
		$json['msg'] = 'success';
	} else {
		$json['msg'] = 'failed';
	}
	header('Content-Type: application/json');	
	echo ' <span id="dyn-'.$post['userguide_id'].'">
    <div class="card gedf-card anchor" id="'.$post['featLink'].'">
      
      <div class="card-body">
          <!--- Feature Name -->
          <div class="row">
            <div class="col-md-10">
              <h2 class="text-capitalize text-title">
                '.$post['featName'].'
                <a class="linked-userguide" href="#'.$post['featLink'].'"><i class="fa fa-link" aria-hidden="true"></i></a>
              </h2>
            </div>

            <div class="col-md-2">
              <div class="editable-content">
                 <a href="#show-'.$post['userguide_id'].'"><i class="fa fa-caret-down" aria-hidden="true">Action</i></a>
              </div>
              <div id="show-'.$post['userguide_id'].'" class="action-content">
                <span><i class="fa fa-caret-down" aria-hidden="true">Action</i><b><a href="#">x</a></b></span>
                <button type="submit" class="btn btn-sm btn-primary update-userguide" data-update-userguideid="'.$post['userguide_id'].'">Edit</button>
                <button type="submit" class="btn btn-sm btn-danger delete-userguide" data-delete-userguideid="'.$post['userguide_id'].'">Delete</button>
              </div>
            </div>
          </div>
          
          <!--- Feature Content -->
          <div class="content-feature">
            <div class="card-text">
              <article class="article">
                <div class="text-muted h7 mb-2">
                  '.$post['lastUpdate'].' • <span class="eta"></span>
                </div>
                <hr>
                '.$post['featContent'].'
              </article>
            </div>
          </div>
      </div>                    
    </div>
    </span>
    <script type="text/javascript">
      $(function() {
        $("article").each(function() {
          const _this = $(this);
          _this.readingTime({
            readingTimeTarget: _this.find(".eta"),
            success: function(data) {
              //console.log(data);
            },
            error: function(data) {
              _this.find(".eta").remove();
            }
          });
        });
      });
    </script>

    <script type="text/javascript">
      $(document).ready(function() {
        $("img").attr("data-action", "zoom");
      });
    </script>';
}

// delete record from database
if(!empty($post['action']) && $post['action']=="delete") {
	$userguide->setUserguideID($post['userguide_id']);
	$status = $userguide->delete();
	if(!empty($status)){
		$json['msg'] = 'success';
	} else {
		$json['msg'] = 'failed';
	}
	header('Content-Type: application/json');	
	echo json_encode($json);	
}

?>