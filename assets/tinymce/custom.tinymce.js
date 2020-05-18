/*
 **
 ** @author: Encep Suryana
 ** @author URI: http://github.com/encepsuryana
 ** File Name : custom.tinymce.js
 **
 */

 function tinyMCEEditor(id) {
    tinymce.init({
        selector: 'textarea#'+id,
        themes: 'modern',
        width:'100%',
        height: 550,
        content_css: 'assets/tinymce/custom.style.css',
        plugins: [
        "advlist autolink lists link image charmap print",
        "preview anchor searchreplace visualblocks code",
        "fullscreen insertdatetime media table paste"
        ],
        file_picker_callback: function(callback, value, meta) {

                // File type
                if (meta.filetype =="media" || meta.filetype =="image") {

                    // Trigger click on file element
                    jQuery("#fileupload").trigger("click");
                    $("#fileupload").unbind('change');

                    // File selection
                    jQuery("#fileupload").on("change", function() {
                        var file = this.files[0];
                        var reader = new FileReader();
                        
                        // FormData
                        var fd = new FormData();
                        var files = file;
                        fd.append("file",files);
                        fd.append('filetype',meta.filetype);

                        var filename = "";
                        
                        // AJAX
                        jQuery.ajax({
                            url: "upload.php",
                            type: "post",
                            data: fd,
                            contentType: false,
                            processData: false,
                            async: false,
                            success: function(response){
                                filename = response;
                            }
                        });

                        reader.onload = function(e) {
                            callback("Upload/"+filename);
                        };
                        reader.readAsDataURL(file);
                    });
                }
                
            },
            browser_spellcheck : true,
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            branding: false,
            mobile: {
                menubar: true
            }
        });
}

// insert record in database
jQuery(document).ready(function() {
    tinyMCEEditor('userguide-content');   
    jQuery(document).on('click','#save-userguide', function(e) {
        e.preventDefault();
        tinyMCE.triggerSave(true, true);
        jQuery.ajax({
            url: "action.php",
            method: "POST",              
            data:jQuery("form#dynamic-post").serialize(),
            dataType:"html",
            success: function(html) {     
                jQuery("#render-userguide-data").append(html).fadeIn('slow');
                tinyMCE.get('userguide-content').setContent('');
                jQuery('input#feat-name').val('');
                jQuery('input#feat-link').val('');
                //jQuery('input#last-update').val('');
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        }); 
    });

    // update record in database
    jQuery(document).on('click','.update-userguide', function(e) {
        e.preventDefault();
        var userguide_id = jQuery(this).data('update-userguideid');
        var edtor_id = 'userguide-content'+userguide_id;
        //tinyMCE.EditorManager.execCommand('mceFocus', false, edtor_id);
        //tinyMCE.EditorManager.execCommand('mceRemoveEditor', true, edtor_id);
        tinyMCEEditor(edtor_id);
        var action ='fetch_userguide';
        jQuery.ajax({
            url: "action.php",
            method: "POST",              
            data:{action:action, userguide_id:userguide_id},
            dataType:"html",
            success: function(html) {     
                jQuery("#dyn-"+userguide_id).html(html).fadeIn('slow');
                    //tinyMCE.activeEditor.setContent();
                    tinyMCE.EditorManager.execCommand('mceAddEditor', false, edtor_id);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            }); 
    });

    // update record in database
    jQuery(document).on('click','.save-update', function(e) {
        e.preventDefault();
        tinyMCE.triggerSave(true, true);
        var userguide_id = jQuery(this).data('save-userguideid');
        var edtor_id = 'userguide-content'+userguide_id;
        tinyMCE.EditorManager.execCommand('mceFocus', false, edtor_id);
        tinyMCE.EditorManager.execCommand('mceRemoveEditor', true, edtor_id);
        jQuery.ajax({
            url: "action.php",
            method: "POST",              
            data:jQuery("form#dynamic-post-"+userguide_id).serialize(),
            dataType:"html",
            success: function(html) {     
                jQuery("#dyn-"+userguide_id).html(html).fadeIn('slow');
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        }); 
    });


    // update record in database
    jQuery(document).on('click','.delete-userguide', function(e) {
        e.preventDefault();
        var userguide_id = jQuery(this).data('delete-userguideid');
        var action = 'delete';
        jQuery.ajax({
            url: "action.php",
            method: "POST",              
            data:{userguide_id:userguide_id, action:action},
            dataType:"json",
            success: function(json) {     
                jQuery("#dyn-"+userguide_id).empty('').fadeIn('slow');
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        }); 
    });
});