jQuery(document).ready(function( $ ) {
	jQuery('.remove-wf-checklist').on('click',function(){
		$(this).next().remove()
		$(this).remove()
	})
	jQuery('.remove-dynamic-workflow').on('click',function(){
		console.log();
		var wf_container = jQuery(this).attr('data-id');
		jQuery('#'+wf_container).remove()
	})
	//////////////////////////////////////////////////////
	jQuery('body').on( 'click', '.misha-upl', function(e){
		e.preventDefault();
		var container = jQuery('#feature_gallery_container'),
		custom_uploader = wp.media({
			title: 'Insert image',
			library : {
				// uploadedTo : wp.media.view.settings.post.id, // attach to the current post?
				type : 'image'
			},
			button: {
				text: 'Select' // button label text
			},
			multiple: 'add'
		}).on('select', function() { // it also has "open" and "close" events
			var attachment = custom_uploader.state().get('selection').toJSON();
			var name;
			jQuery.each(attachment,function(i,j){
				name = 'image_gallery_'+i;
				jQuery(container).append('<div class="img-gallery-group"><input type="hidden" name="image_gallery[]" value="'+j.id+'"><i class="fas fa-times-circle remove-img-gallery"></i><img src="' + j.url + '" data-id="' + i + '"></div>');
			})
			
		}).open();
	
	});
	jQuery('.remove-img-gallery').on('click',function(){
		console.log(jQuery(this).parent().remove());
	})

	// on remove button click
	jQuery('body').on('click', '.misha-rmv', function(e){
		e.preventDefault();
		var button = jQuery(this);
		button.next().val(''); // emptying the hidden field
		button.hide().prev().html('Upload image');
	});
	//////////////////////////////////////////////////////
	let input_count = jQuery('#checklist-total').val();
	// workflow-checklist
	jQuery('.add-checklist').on('click',function(){
		var output = '';
		var key = jQuery(this).attr('data-key')
		output += `<input type="text" name="checklists${key}[]" placeholder="Checklist Title" class="worflow-inputs-checklist">`;
		var target = 'workflow_checklists'+key;
		jQuery('.'+target).append(output);
		
		input_count++;
		jQuery('#checklist-total').val(input_count)
	})
	let toggle_all = false
	var target_checkbox = jQuery('.attachment-checklist').find('input[type="checkbox"]')
	jQuery(target_checkbox).on('click',function(){

		var target_options = jQuery(this).parent().parent().attr('id');
		var checkboxes = jQuery('#'+target_options).find('input[type="checkbox"]');
		var this_value = jQuery(this).val();

		if(jQuery(this).prop('checked') === true){
			jQuery(this).prop('checked',true)
		}else{
			jQuery(this).prop('checked',false)
		}
		
	
	})
	jQuery('#post_per_table').on('change',function(){
		var post_per_table = jQuery('#post_per_table').val();
		var action = 'update_post_per_table';
		var formData = {post_per_table:post_per_table};
		sorting_table(action,formData);

	})
	// delete email log
	jQuery('.delete-workflow-log').on('click',function(){
		var id = jQuery(this).attr('data-id');
		if(confirm('Are you sure you want to delete this item')){
			jQuery.ajax({
				type : "POST",
				url : ajaxurl,
				data : {action: "delete_workflow_log",id:id},
				success: function(response) {
					alert('Email log deleted Successfuly')
					location.reload()
				}
			 });
		}
		return;
	})
	// reuse function
	function sorting_table(action,formData){
		jQuery.ajax({
			type : "POST",
			url : ajaxurl,
			data : {action: action,formData},
			success: function(response) {
				location.reload()
			}
		 });
	}
	// Sort By
	jQuery('#sort-users').on('click',function(){
		var user_sort_by = jQuery('#sort-user-by').val();
		var user_sort = jQuery('#sort-order').val();
		var action = 'update_sort_order';
		var formData = {user_sort_by:user_sort_by,user_sort:user_sort}
		sorting_table(action,formData);
	})
	// delete
	jQuery('.delete-user').on('click',function(){
		var user_id = jQuery(this).attr('data-id')
		if(confirm('Are you sure to delete the user')){
			delete_user(user_id)
		}
		return;
	})
	function delete_user(user_id){
		jQuery.ajax({
			type : "POST",
			url : ajaxurl,
			data : {action: "delete_user_data",user_id:user_id},
			success: function(response) {
				alert('User deleted Successfuly')
				location.reload()
			}
		 });
	}
	//store updated userdata
	let change_password = false;
	jQuery('#update-user').on('click',function(e){
			// get user inputs
			e.preventDefault()
			var new_username,new_email,new_role,new_password;
			new_username = jQuery('#username').val();
			user_id = jQuery('#user-hidden-id').val();
			new_email = jQuery('#email').val();
			new_role = jQuery('#user-role').val();
			new_password = jQuery('#set_new_password').val();
			//validate password
			if(change_password){
				// password must be atleast 8 characters
				if ( new_password.length < 8 ) {
					jQuery('.validate-password').addClass('disabled');
					return false;
				} else {
					jQuery('.validate-password').removeClass('disabled');
				}
			}
			update_user_data(user_id,new_username,new_email,new_role,new_password);
	})

	jQuery('.change-pass-switch').on('click',function(){
		jQuery('.change-password').show()
		jQuery('.change-pass-switch').hide()
		change_password = true
	})
	//edit user data
	jQuery('.edit-user').on('click',function(){
		jQuery('.add-user-modal').show()
		jQuery('.user-modal-title').text('Update User Data')
		jQuery('.submit-user').text('Update')
		jQuery('.submit-user').hide()
		jQuery('#update-user').show()
		jQuery('#update-user').show()
		jQuery('.user-modal-container').addClass('blocker')
		$("#username").prop('disabled', true)
		$("#username-label").text('Usernames cannot be changed.');
		$("#username-label").addClass('disabled');
		// set select role value
		var current_role = jQuery(this).attr('current-role');
		$("#user-role").val(current_role).change();

		var user_id = jQuery(this).attr('data-id');
		jQuery('.password-input').hide()
		// 
		jQuery.ajax({
			type : "POST",
			url : ajaxurl,
			data : {action: "edit_user_data",user_id:user_id},
			success: function(response) {
			var user_id = response.data.data.ID
			var email = response.data.data.user_email
			var username = response.data.data.user_login
			jQuery('#username').val(username);
			jQuery('#email').val(email);
			jQuery('#user-hidden-id').val(user_id);
			}
		 });
		
	})
	function update_user_data(user_id,new_username,new_email,new_role,new_password){
		jQuery.ajax({
			type : "POST",
			url : ajaxurl,
			data : {action: "update_user_data",user_id:user_id,new_username:new_username,new_email:new_email,new_role:new_role,new_password:new_password},
			success: function(response) {
			console.log(response);
			alert('User updated successfully');
			location.reload();
			}
		 });
	}
	// Add user 
	jQuery('.add-user-modal').hide()
	jQuery('#add-user').on('click',function(){
		jQuery('.add-user-modal').show()
		jQuery('.change-pass-switch').hide()
		jQuery('.change-password').hide()
		jQuery('.password-input').show()
		jQuery('.submit-user').text('Add')
		jQuery('#add-user-modal').find('input').val('');
		jQuery('.user-modal-container').addClass('blocker')
		$("#username").prop('disabled', false);
		$("#username-label").text('Username');
		$("#username-label").removeClass('disabled');
	})
	jQuery('.cls-user-btn').on('click',function(){
		jQuery('.add-user-modal').hide()
		jQuery('.change-password').hide()
		jQuery('.change-pass-switch').show()
		jQuery('.user-modal-container').removeClass('blocker')
	})
	jQuery('#add-user-modal').on('submit',function(e){
		e.preventDefault();
		var username,email,role;
		username = jQuery('#username').val();
		email = jQuery('#email').val();
		role = jQuery('#user-role').val();
		//password can be set through email of user
		// password = jQuery('#new_password').val();

		jQuery.ajax({
			type : "POST",
			url : ajaxurl,
			data : {action: "add_new_user",username:username,email:email,role:role},
			success: function(response) {
			console.log(response);
			alert('user added successfully');
			location.reload();
			}
		 });
	})
	//Edit comment edit-icon
	jQuery('.update-btn').hide()
	
	jQuery('.edit-icon').on('click',function(){
		jQuery('.update-btn').hide()
		var comment = jQuery(this).parents().eq(3);
		var comment_val = jQuery(comment).find('.comment-value')
		var attrs = { };
		jQuery.each(jQuery(comment_val)[0].attributes, function(idx, attr) {
			attrs[attr.nodeName] = attr.nodeValue;
		});

		jQuery(comment).find('.update-btn').show()
		jQuery('#comment-form').hide()


		jQuery(comment_val).replaceWith(function () {
			return jQuery("<textarea />", attrs).append(jQuery(this).contents());
		});
	})
	// call update comment method
	jQuery('.update-btn').on('click',function(){
		var comment_obj = jQuery(this).parents().eq(1);
		var comment = jQuery(comment_obj).find('.comment-value').val();
		var meta_id = jQuery(this).attr('id');
		var user_id = jQuery(this).attr('user-id');
		jQuery.ajax({
			type : "POST",
			url : ajaxurl,
			data : {action: "edit_comment",meta_id:meta_id,user_id:user_id,comment:comment},
			success: function(response) {
		
			location.reload();
			}
		 });
	})
	// call delete comment method
	jQuery('.delete-icon').on('click',function(){
		var meta_id = jQuery(this).attr('id');
		var result = confirm('Are you sure you want to delete the comment');
		if(result){
			jQuery.ajax({
				type : "POST",
				url : ajaxurl,
				data : {action: "delete_comment",meta_id:meta_id},
				success: function(response) {
				location.reload();
				}
			});
		}
	})
	//Update progress
	jQuery('.progress').on('change',function(){
		var progress = jQuery('#progress_value').val();
		var checked = 0;
		var total_checkbox = jQuery('.progress').length;
		var plan_id = jQuery('.progress').attr('data-id');
		var checklist_index = $(this).attr('checklist-number');
		var checklist_position = $(this).attr('checklist-position');
		var meta = checklist_position + '_' + checklist_index;
		var checked_status = $(this).attr('checked');
		if(checked_status == undefined || checked_status == ''){
			checked_status = false
		}else{
			checked_status = true
		}
		
		jQuery('.progress').each(function(i,j){
			if(jQuery(j).is(':checked')){
				checked++;
			}
		})
		var percentage = checked / total_checkbox * 100;
		var total_percentage = percentage.toFixed(2)
		// update progress
		jQuery.ajax({
			type : "POST",
			url : ajaxurl,
			data : {action: "update_progress",percentage:total_percentage,plan_id:plan_id,meta:meta,checked_status:checked_status},
			success: function(response) {
			}
		 });
		
	})
	// add comments
	 jQuery('#submit-comment').on('click',function(e){
	   e.preventDefault();
	   var comment = jQuery('#wf-comments').val()
	   var commentor_id = jQuery('#commentor-id').val()
	   var user_data = jQuery('#commentor-id').attr('user-data');
	   var plan_id = jQuery('#commentor-id').attr('data-plan');
       console.log(commentor_id);
   	console.log(plan_id);

	   // 
	   jQuery.ajax({
		   type : "POST",
		   url : ajaxurl,
		   data : {action: "update_comments",comment:comment,commentor_id:commentor_id,plan_id:plan_id,user_data:user_data},
		   success: function(response) {
		   console.log('success');
			location.reload();
		   }
		});
	 })
   // 
   setTimeout(function () {
     jQuery('div#wpcontent').css('visibility','visible');
   },500);  

	 $( window ).load(function() {
	 	 update_or_delte();
	 $('.user-role').change(function() {
	    var val= jQuery(this).val();
	  
		     jQuery.ajax({
		         type : "GET",
		         url : my_ajax_object.ajax_url,
		         data : {action: "my_user_role", role : val},
		         success: function(response) {
		            $('.form-managment').html(response);

		             update_role();
		         
		         }
		      })

		     

		});

			update_role();
			// setup("my-awesome-dropzone");
		
		 
			

	   });
	 
});



jQuery(document).ready(function($){
	//lib_details();

	//wp_medi_loader();
	//create_folder();
	view_switcher();
	lib_detail_list();
	let search_tag = 'Campaigns'

 jQuery('.search-field .open-drop').click(function () {
    jQuery('#drop-down').css('display','block');
     var availableTags = [
			    //   "All",
			      "Campaigns",
			    //   "Events",
			    //   "Tasks",
			      "Library",
			    //   "Work Requests",
			    //   "Pitch Requests",
			    
			    ];
			  
				jQuery( "#tags" ).autocomplete({
			      source: availableTags,
			      minLength: 0,
				  select : showResult,
			    }).focus(function(){
			        $(this).autocomplete("search", "");
			    });
				function showResult(event, ui){
					$('#selected_tag_value').text(ui.item.value)
					search_tag = ui.item.label
				}
			      jQuery("#tags ").focus();
				  jQuery('.search2 input.ndl-Input-input').css('width','500px');
    			  jQuery('.search2 input.ndl-Input-input').attr('placeholder','Search Campaigns, Events, Tasks, Library');
		});	
//////////////////////////////////////////////////////////////////
function custom_search_tags(e){
	var search_data = $('.search2 input[type="text"]').val()
	if(search_tag === 'Library'){
		ajax_search('library_search',search_data,'library')
	}else if(search_tag === 'Campaigns'){
		ajax_search('library_search',search_data,'campaigns')
	}
}
// dynamic
function ajax_search(action,search_value,section){
	jQuery.ajax({
		type : "POST",
		url : ajaxurl,
		data : {action: action,search_value:search_value,section:section},
		success: function(response) {
			var url = response.data;
			location.replace(url)
		}
	 });
}
jQuery('.cstm_search').click(function () {
	custom_search_tags()
	// console.log('something');
});
jQuery('.ndl-Input-field input[type="text"]').keypress(function (event) {
	var keycode = (event.keyCode ? event.keyCode : event.which);
	if(keycode == '13'){
		custom_search_tags() 
	  }
});

//////////////////////////////////////////////////////////////////
   jQuery("#tags ").on('blur',function(){
		jQuery("#drop-down").hide();
		// jQuery('.search2 input.ndl-Input-input').css('width','232px');
		jQuery('.search2 input.ndl-Input-input').attr('placeholder','');
	});
	jQuery('.search2 input.ndl-Input-input').on('blur',function(){
		jQuery('.search2 input.ndl-Input-input').css('width','232px');
		jQuery(this).attr('placeholder','');
	});

	jQuery('.search2 input.ndl-Input-input').click(function () {
		// jQuery(this).css('width','500px');	
		jQuery(this).attr('placeholder','Search Campaigns, Events, Tasks, Library');
	});

	jQuery(".panel .close-container button").on('click',function(){ 
	    jQuery('.lib-drawer').css('right',-900);
	    jQuery('div#wpbody-content').css({'width':'100%','transition':'1s'}).removeClass('active');
	});

	jQuery("button#wk-button").on('click',function(){  
    	jQuery('button#menu-item-upload').trigger('click');
	});
  
});

function view_switcher() {
	jQuery('.view-switcher span svg').click(function () {

        var data = jQuery(this).attr('data');
           
             jQuery.ajax({
                 type : "GET",
                 url : ajaxurl,
                 data : {action: "lib_view_switch", switch : data},
                 beforeSend: function( response ) {

                    jQuery('body.wp-admin').css('opacity','0.5');
                   
                 },
                 success: function(response) {
                   jQuery('body.wp-admin').css('opacity','1');
	               jQuery('div#wpbody-content').html(response);
		       
		                jQuery('.lib-drawer').css('right',-900);
					    jQuery('div#wpbody-content').css({'width':'100%','transition':'1s'}).removeClass('active');
                    	jQuery(".panel .close-container button").on('click',function(){ 
					    jQuery('.lib-drawer').css('right',-900);
						    jQuery('div#wpbody-content').css({'width':'100%','transition':'1s'}).removeClass('active');
						    				
						});
						update_or_delte();

                 }
              });
    }); 

}

function wp_medi_loader() {
	 
		var wkMedia;
		jQuery('#wk-button').click(function(e) {

			    e.preventDefault();
			    // If the upload object has already been created, reopen the dialog
			    if (wkMedia) {
			      wkMedia.open();
			      return;
			    }
			   
			   		setTimeout(function (){
			   			 jQuery('#menu-item-upload').trigger('click');
			   		},500);

			    // Extend the wp.media object
			    wkMedia = wp.media.frames.file_frame = wp.media({
			      title: 'Upload Content',
			      button: {
			      text: 'Update'
			    }, multiple: true });

			   

			    // When a file is selected, grab the URL and set it as the text field's value
			    wkMedia.on('select', function() {

			      var attachment = wkMedia.state().get('selection').first().toJSON();

			      
			      //jQuery('#wk-media-url').val(attachment.id);
			      var content_format= jQuery('tr#content_format td.acf-input input[type="hidden"]').val();
			      var jurney_stage= jQuery('tr#journey_stage td.acf-input input[type="hidden"]').val();
			      var Project_Stage= jQuery('tr#Project_Stage td.acf-input input[type="hidden"]').val();
			      var Target_Audience= jQuery('tr#Target_Audience td.acf-input input[type="hidden"]').val();
			      
			      

			      			 jQuery.ajax({
						        url : ajaxurl, // Here goes our WordPress AJAX endpoint.
						        type : 'GET',
						        
						        data : {action:'lib_add', 
						        	attachment_id: attachment.id,
						        	content_format:content_format,
						        	jurney_stage:jurney_stage,
						        	Project_Stage:Project_Stage,
						        	Target_Audience:Target_Audience,
						        	width: attachment.width,
						        	height: attachment.height,
						        	authorName: attachment.authorName,
						        	
						        },
						         beforeSend: function( response ) {
						         	console.log(attachment.width);

				                    jQuery('body.wp-admin').css('opacity','0.5');
				                   
				                 },
						        success : function( response ) {
						     	  jQuery('body.wp-admin').css('opacity','1');
						          jQuery('.media-library.grid .wrapper').html(response);
						          jQuery('.media-library.list .wrapper').html(response);
						          jQuery('button.media-modal-close').trigger('click');
						          
						           lib_details();
						           lib_detail_list();
			 
						        },
						        fail : function( err ) {
						            // You can craft something here to handle an error if something goes wrong when doing the AJAX request.
						            alert( "There was an error: " + err );
						        }
						    });	

			   
				 
			    });
			    wkMedia.on('ready', function() {
			    	setTimeout(function () {
			    		jQuery('button#menu-item-upload').trigger('click');
			    	},500);
			    	   

			    });	

			       wp.Uploader.queue.on('reset', function() { 
			   	    	//drop_down_content();
			   	    	 for_lib_script('tr#content_format');
			             for_lib_script('tr#journey_stage');
			             for_lib_script('tr#Project_Stage');
			             for_lib_script('tr#Target_Audience');

			             var attachment2 = wkMedia.state().get('selection').toJSON();

			             	//console.log(attachment2);

			             
			              var attachment = wkMedia.state().get('selection').first().toJSON();
			      			 jQuery.ajax({
						        url : ajaxurl, // Here goes our WordPress AJAX endpoint.
						        type : 'GET',
						        
						        data : {action:'lib_add', 
						        	attachment_id: attachment.id,
						        	 
						        	width: attachment.width,
						        	height: attachment.height,
						        	 
						        	
						        },
						        success : function( response ) {
						     
						         // jQuery('.media-library.grid .wrapper').html(response);
						           lib_details();
						          lib_detail_list();
						          update_or_delte() ;
			 
						        },
						        fail : function( err ) {
						            // You can craft something here to handle an error if something goes wrong when doing the AJAX request.
						            alert( "There was an error: " + err );
						        }
						    });	
			            



					});
				 
					 
			 		setTimeout(function () {
			    		jQuery('button#menu-item-upload').trigger('click');
			    	},500);
			    
			    // Open the upload dialog
			    wkMedia.open();
			  });
 

}

function update_role(){
	jQuery( '#roles-form' ).on( 'submit', function(e) {
			    var form_data = jQuery( this ).serializeArray();

			 e.preventDefault();
			  
			    // Here is the ajax petition.
			    jQuery.ajax({
			        url : my_ajax_object.ajax_url, // Here goes our WordPress AJAX endpoint.
			        type : 'POST',
			        dataType: 'json',
			        data : {action:'update_role', from: form_data},
			        success : function( response ) {
			            // You can craft something here to handle the message return
			     		 
			           
			        },
			        fail : function( err ) {
			            // You can craft something here to handle an error if something goes wrong when doing the AJAX request.
			            alert( "There was an error: " + err );
			        }
			    });

			     
			   
			});
}




/*********************/



function drop_down_content(){
	jQuery('.compat-field-content_format .input-data').click(function () {
    	jQuery('.compat-field-content_format .input-data').css('display','none');
		 	// jQuery('.content-format-list').css('display','block');
		    jQuery('.content-format-list label').click(function () {

		        var label = [];
		        var val2 = [];
		        jQuery('.content-format-list label').each(function () {
		            if( jQuery(this).children('input').is(':checked') ){
		                var test = '<div class="ats"><span class="tags">'+jQuery(this).children('input').parent('label').text()+'<span class="nc-icon ndl-Icon   ndl-RemoveTag-icon "><i class="nc-icon-wrapper"><svg viewBox="0 0 7 7" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="Design-v2" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="Text-Input-2" transform="translate(-920.000000, -1182.000000)" fill="#707070" fill-rule="nonzero"><g id="simple-remove-copy-2" transform="translate(920.000000, 1182.000000)"><path d="M6.85,0.15 C6.65,-0.05 6.35,-0.05 6.15,0.15 L3.5,2.8 L0.85,0.15 C0.65,-0.05 0.35,-0.05 0.15,0.15 C-0.05,0.35 -0.05,0.65 0.15,0.85 L2.8,3.5 L0.15,6.15 C-0.05,6.35 -0.05,6.65 0.15,6.85 C0.25,6.95 0.35,7 0.5,7 C0.65,7 0.75,6.95 0.85,6.85 L3.5,4.2 L6.15,6.85 C6.25,6.95 6.4,7 6.5,7 C6.6,7 6.75,6.95 6.85,6.85 C7.05,6.65 7.05,6.35 6.85,6.15 L4.2,3.5 L6.85,0.85 C7.05,0.65 7.05,0.35 6.85,0.15 Z" id="pill-cross"></path></g></g></g></svg></i></span></span></div>';
		                    label.push(test);
		                var val3 = jQuery(this).children('input').val();

		                  val2.push(val3);
		                  
		            }
		        });
		        jQuery('tr.compat-field-content_format .text').val(val2.join(','));
		       
		        
		        
		        jQuery('.help').html(label.join(''));

		    });
 


			      jQuery('.close-hidden').click(function () {
					jQuery('.content-format-list').css('display','none');
					 if(jQuery('tr.compat-field-content_format .text').val() == ''){
				        	 
				        	jQuery('p.help').html('<input class="input-data">');
				        } 

				});


			});


}



function create_folder(){
	jQuery('.library-button-parents .open-folder').click(function () {
		 
	    jQuery('.lib-drawer').css('right',0);
		jQuery('div#wpbody-content').css({'width':'60%','transition':'1s'}).addClass('active');

		jQuery('.drawer-content .inner-content').html(' ');
		jQuery('.library-preview-top-panel .panel-button').html('<button class="upload-pics ndl-Button ndl-Button--primary ndl-Button--medium    preview-action-button" type="button"><span class="ndl-Button-label">Upload</span></button><button class="move-pics ndl-Button ndl-Button--default ndl-Button--medium    preview-action-button" type="button"><span class="ndl-Button-label">Move</span></button>');
	 
			jQuery.ajax({
			        url : ajaxurl , // Here goes our WordPress AJAX endpoint.
			        type : 'GET',
			        data : {action:'create_folder',name:'New Folder'},
			        success : function( response ) {
			            // You can craft something here to handle the message return
			     		 jQuery('.drawer-content .inner-content').html(response);

			     		 console.log(response);

			     		// jQuery('input#create-folder').focus();


			     		update_or_delte();
			     		update_data_folder ();
			           
			        },
			        fail : function( err ) {
			            // You can craft something here to handle an error if something goes wrong when doing the AJAX request.
			            alert( "There was an error: " + err );
			        }
			    });


	});
}

function update_data_folder () {
	jQuery('.panel-button .upload-pics').click(function (e){
	    var wkMedia;
	         e.preventDefault();
			if (wkMedia) {
				 wkMedia.open();
			     return;
			 }

	     wkMedia = wp.media.frames.file_frame = wp.media({
			title: 'Upload Content',
			button: {
			text: 'Done'}, multiple: true 
	      });


	       wkMedia.on('select', function() {
	           var attachment2 = wkMedia.state().get('selection').toJSON();
	             var data =[];
	             for (var i = 0; i < attachment2.length; i++) {
					  data.push(attachment2[i].id)
				 }
	            var ids = data.join(',');

	            var cat_id = jQuery('.form-data').attr('data');
	            jQuery.ajax({
	                url : ajaxurl, // Here goes our WordPress AJAX endpoint.
	                type : 'GET',		        
	                data : {action:'set_post_cat', ids:ids,cat_id:cat_id },
	                success : function( response ) {

	                   jQuery('.folder-datas').html(response);

	                }
	            });
	    
	       });
	        wp.Uploader.queue.on('reset', function() { 
			   	    	//drop_down_content();
			   	for_lib_script('tr#content_format');
			    for_lib_script('tr#journey_stage');
			    for_lib_script('tr#Project_Stage');
			    for_lib_script('tr#Target_Audience');



			});

	     wkMedia.open();
	});
}



function lib_details(){
	jQuery('.media-library .grid-view-item .grid-view-card-top').click(function(){
	var attach_id=jQuery(this).attr('id');
	var lib_url = jQuery('#'+attach_id+' input#lib-details-').val();

		jQuery('.grid-view-item label.grid-view-checkbox ').css('visibility','hidden');
		jQuery('.grid-view-item label.grid-view-checkbox input.ndl-Checkbox-input').attr('checked',false);
	    jQuery('.lib-drawer').css('right',0);
	    jQuery('div#wpbody-content').css({'width':'60%','transition':'1s'}).addClass('active');
	    jQuery('.'+attach_id+' label.grid-view-checkbox ').css('visibility','visible');
	    jQuery('.'+attach_id+' label.grid-view-checkbox input.ndl-Checkbox-input').attr('checked',true);

	  
	  	var height = jQuery('.lib-drawer ').height();

	  	jQuery('.lib-drawer .inner-content').css({'overflow-y':'scroll','height':(height-100)+'px'});

	  	create_task(attach_id.replace(/[^0-9.]/g, ""));

	  	//console.log('Hello');
	 
	if(jQuery(this).attr('data') == 'taxonomy'){
		jQuery('.library-preview-top-panel .panel-button').html('<button class="upload-pics ndl-Button ndl-Button--primary ndl-Button--medium    preview-action-button" type="button"><span class="ndl-Button-label">Upload</span></button><button class="move-pics ndl-Button ndl-Button--default ndl-Button--medium    preview-action-button" type="button"><span class="ndl-Button-label">Move</span></button>');

		jQuery.ajax({
			        url : ajaxurl , // Here goes our WordPress AJAX endpoint.
			        type : 'GET',
			        data : {action:'create_folder',tax_id:attach_id.replace(/[^0-9.]/g, "")},
			        success : function( response ) {
			            // You can craft something here to handle the message return
			     		 jQuery('.drawer-content .inner-content').html(response);

			 			update_data_folder();
			           
			        },
			        fail : function( err ) {
			            // You can craft something here to handle an error if something goes wrong when doing the AJAX request.
			            alert( "There was an error: " + err );
			        }
			    });
			    update_or_delte();
		

	}else if(jQuery(this).attr('data') == 'article'){
		jQuery('.library-preview-top-panel .panel-button').html('<div class="panel-button"><button class="creat-task ndl-Button ndl-Button--primary ndl-Button--medium    preview-action-button" type="button"><span class="ndl-Button-label">Create Task</span></button></div>');
		jQuery('.drawer-content .inner-content').html('');
		jQuery('.grid-view-item label.grid-view-checkbox ').css('visibility','hidden');
		jQuery('.grid-view-item label.grid-view-checkbox input.ndl-Checkbox-input').attr('checked',false);
	    jQuery('.lib-drawer').css('right',0);
	    jQuery('div#wpbody-content').css({'width':'60%','transition':'1s'}).addClass('active');
	    jQuery('.'+attach_id+' label.grid-view-checkbox ').css('visibility','visible');
	    jQuery('.'+attach_id+' label.grid-view-checkbox input.ndl-Checkbox-input').attr('checked',true);

	  	var height = jQuery('.lib-drawer ').height();

	  	jQuery('.lib-drawer .inner-content').css({'overflow-y':'scroll','height':(height-100)+'px'});
	    
	   		  jQuery.ajax({
			        url : ajaxurl, // Here goes our WordPress AJAX endpoint.
			        type : 'GET',
			        data : {action:'article_details',attach_id:attach_id.replace(/[^0-9.]/g, "")},
			        success : function( response ) {
			            // You can craft something here to handle the message return
			     			jQuery('.drawer-content .inner-content').html(response);	
			     			update_or_delte();		           
			        },
			        fail : function( err ) {
			            // You can craft something here to handle an error if something goes wrong when doing the AJAX request.
			            alert( "There was an error: " + err );
			        }
			    });  

	}else{
		jQuery('.library-preview-top-panel .panel-button').html('<div class="panel-button"><button class="creat-task ndl-Button ndl-Button--primary ndl-Button--medium    preview-action-button" type="button"><span class="ndl-Button-label">Create Task</span></button> </div>');
		
		jQuery('.grid-view-item label.grid-view-checkbox ').css('visibility','hidden');
		jQuery('.grid-view-item label.grid-view-checkbox input.ndl-Checkbox-input').attr('checked',false);
	    jQuery('.lib-drawer').css('right',0);
	    jQuery('div#wpbody-content').css({'width':'60%','transition':'1s'}).addClass('active');
	    jQuery('.'+attach_id+' label.grid-view-checkbox ').css('visibility','visible');
	    jQuery('.'+attach_id+' label.grid-view-checkbox input.ndl-Checkbox-input').attr('checked',true);

	  
	  	var height = jQuery('.lib-drawer ').height();

	  	jQuery('.lib-drawer .inner-content').css({'overflow-y':'scroll','height':(height-100)+'px'});

	   		  jQuery.ajax({
			        url : ajaxurl, // Here goes our WordPress AJAX endpoint.
			        type : 'GET',
			        data : {action:'lib_details',attach_id:attach_id.replace(/[^0-9.]/g, "")},
			        success : function( response ) {
			            // You can craft something here to handle the message return
			     			jQuery('.drawer-content .inner-content').html(response);	
			     			update_or_delte();		           
			        },
			        fail : function( err ) {
			            // You can craft something here to handle an error if something goes wrong when doing the AJAX request.
			            alert( "There was an error: " + err );
			        }
			    });   

	}	

	 
});

	
}

function create_task(attach_id){
	 setTimeout(function() {
		jQuery('.creat-task').click(function (){
		     
	 			jQuery.ajax({
			        url : ajaxurl, // Here goes our WordPress AJAX endpoint.
			        type : 'GET',
			        data : {action:'create_task',attach_id:attach_id},
			        success : function( response ) {
			            // You can craft something here to handle the message return
			     			jQuery('div#create-task-modal').html(response);	

			     			setTimeout(function() {   
							 jQuery("#create-task-modal").modal({
						     	escapeClose: true,
							    clickClose: false,
							    showClose: false,
							    fadeDuration: 200,
						  		fadeDelay: 0.50

						     }); 
					     },100); 

					     jQuery("#form-task").submit(function(e) {
			                 var form = jQuery(this);
			               e.preventDefault();
			               
			                 jQuery.ajax({
			                        type: "POST",
			                        url: ajaxurl, 
			                       // contentType: 'application/x-www-form-urlencoded',
			                        data : { action:'create_task_event', task:form.serializeArray() }, // serializes the form's elements.
			                        success: function(data) {
			                          window.location.assign(""+data+""); 
			                          
			                        }
			                    });
			                    
			                   
			              });	

      
			        },
			        fail : function( err ) {
			            // You can craft something here to handle an error if something goes wrong when doing the AJAX request.
			            alert( "There was an error: " + err );
			        }
			    });  
			     

		});			 	

	 },200);

}

function lib_detail_list(){
		jQuery('table#lib-list-view tbody tr').click(function (){
	     jQuery('table#lib-list-view tbody tr').css('background','transparent');
	     jQuery('table#lib-list-view tbody tr td input.get-details').attr('checked',false).css('visibility','hidden');
	    
	    jQuery(this).css('background','#f5f7fa');  
	    jQuery(this).first('td').find('input').attr('checked',true).css('visibility','visible');     
	    var val = jQuery(this).first('td').find('input').val();
	    jQuery(this).first('td').find('input').css('visibility','visible'); 
        jQuery('.lib-drawer').css('right',0);
	    jQuery('div#wpbody-content').css({'width':'60%','transition':'1s'}).addClass('active');
	    

	  
	  	var height = jQuery('.lib-drawer ').height();

	  	jQuery('.lib-drawer .inner-content').css({'overflow-y':'scroll','height':(height-100)+'px'});
	    
	   		  jQuery.ajax({
			        url : ajaxurl, // Here goes our WordPress AJAX endpoint.
			        type : 'GET',
			        data : {action:'lib_details',attach_id:val},
			        success : function( response ) {
			            // You can craft something here to handle the message return
			     			jQuery('.drawer-content .inner-content').html(response);	
                           // console.log(response);
			        },
			        fail : function( err ) {
			            // You can craft something here to handle an error if something goes wrong when doing the AJAX request.
			            alert( "There was an error: " + err );
			        }
			    });
	    
	   
	});
}

function for_lib_script(id){
    jQuery( id+' td.acf-input ul li label .acf-checkbox-toggle').click(function () { 
    jQuery(id+' td.acf-input ul li label').children('input').attr('checked',true);
    });

    jQuery(id+' td.acf-input ul li label input').on('click',function () {
         var content_format =[];
        jQuery(id+' td.acf-input ul li label').each(function () {

              if( jQuery(this).children('input').is(':checked') ){ 
                if( jQuery(this).children('input').val() != '') {
                 var val = jQuery(this).children('input').val();
                }
             }
                content_format.push(val); 
        });
        var vi = content_format.join('-');
        jQuery(id+' td.acf-input input[type="hidden"]').val(vi);


    });
 
}
  
function update_or_delte() {
	jQuery('.card-actiom button.delete').click(function () {
    var id = jQuery(this).attr('actiondata');
    jQuery('.card-actiom,.list-action').css('visibility','hdden');
    jQuery('.card-actiom').attr('checked',false);
    jQuery('.card-actiom.tax-attachment-'+id).css('visibility','visible');
    jQuery('.card-actiom.tax-attachment-'+id+'  input.ndl-Checkbox-input' ).attr('checked',true);
    jQuery('ul#view-list-'+id).css('visibility','visible'); 
    var type = jQuery('div#tax-attachment-'+id).attr('data');
	 jQuery('ul#view-list-'+id+' li a').click(function (event) {
	            event.preventDefault();
	              var attach_id = jQuery(this).attr('data');
	               var uri = jQuery(this).attr('href');
	                jQuery.ajax({
	              url : ajaxurl , // Here goes our WordPress AJAX endpoint.
	              type : 'GET',
	              data : {action:'update_lib_datails',type:type,idfy:uri,tax_id:attach_id},
	              beforeSend: function( response ) {
	              	jQuery('.view-'+id).css('opacity','.5');
	              },
	              success : function( response ) {
 
	                  jQuery('.view-'+id).hide();
	              },
	              fail : function( err ) {
	                  // You can craft something here to handle an error if something goes wrong when doing the AJAX request.
	                  alert( "There was an error: " + err );
	              }
	          });
	    
	    });   
	    
	});
}