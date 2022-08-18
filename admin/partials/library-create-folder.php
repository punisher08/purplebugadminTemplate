<?php

/**
 * Provide a admin area view for the plugin
 * This file is used to markup the admin-facing aspects of the plugin.
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php
	global $wpdb;
	$edit = isset($_GET['tax_id']) ? 'display:block':'display:none';
	$edit2 = !isset($_GET['tax_id']) ? 'display:block':'display:none';

	if(isset($_GET['tax_id'])){
		$get = get_term_by('id', $_GET['tax_id'], 'attachment_category');

		$user_id = get_term_meta($_GET['tax_id'],'ppb_folder_author');
		$ppb_folder_date = get_term_meta($_GET['tax_id'],'ppb_folder_date');
		$get_userdata = get_userdata($user_id[0]);

		$user_role = ucfirst($get_userdata->roles[0]);

		 
	}else{

		//$get_userdata = get_userdata( get_current_user_id() );

		//$user_role = ucfirst($get_userdata->roles[0]);
 
 		
	}
	
	$get_userdata2 = get_userdata(get_current_user_id());

	$user_role2 = ucfirst($get_userdata2->roles[0]);

 
 ?>
 <style>
 	p.ndl-InlineEditDisplayMode-text {
    font-family: Hurme Geometric Sans,Helvetica Neue,Arial,sans-serif;
    color: #191932;
    font-size: 20px;
    margin: 0;
    font-weight: 600;
	    line-height: 24px;
	    padding: 5px 25px 5px 5px;
	}

	span.ndl-InlineEditDisplayMode-iconWrapper svg {
	    width: 13px;
	    height: 13px;
	}

	.ndl-InlineEditDisplayMode-wrapper {
	    display: flex;
	}

	span.ndl-InlineEditDisplayMode-iconWrapper {
	    margin: 7px -38px;
	    visibility: hidden;
	    cursor: pointer;
	}

	.ndl-InlineEditDisplayMode-wrapper:hover {}

	.ndl-InlineEditDisplayMode-wrapper:hover  span.ndl-InlineEditDisplayMode-iconWrapper {
	    visibility: visible;
	}

	.ndl-InlineEditDisplayMode-wrapper:hover p {
	    background: #f5f7fa;
	    margin-right: 20px;
	    /* padding: 10px; */
	}
	.library-folder-asset-row {
    display: flex;
    height: 24px;
    margin-bottom: 12px;
	}

	.library-folder-asset-row p.ndl-Text {
	    margin: 0;
	    margin-left: 10px;
	}
	.library-folder-asset-row img {
	    border: 1px solid #ccccdc;
	    border-radius: 3px;
	    height: 24px;
	    width: 24px;
	}
 </style>
 <script>
 jQuery('span.ndl-InlineEditDisplayMode-iconWrapper svg').click(function () {
    jQuery('.click-edit').hide();
    jQuery('.open-fields').show();
    jQuery('input#create-folder').focus();
});
jQuery('.ndl-InlineEditEditMode-cross').click(function () {
     jQuery('.click-edit').show();
    jQuery('.open-fields').hide();
});
jQuery('#create-folder').keyup(function () {
    var val = jQuery(this).val();
    jQuery('p.ndl-InlineEditDisplayMode-text').text(val);

    
});

jQuery('.ndl-InlineEditEditMode-tick').click(function (){
    		jQuery('.click-edit').show();
	   		jQuery('.open-fields').hide();
	   		
	   
	   var cat_val = jQuery('input#create-folder').val();
	        
	     	  jQuery.ajax({
			        url : ajaxurl , // Here goes our WordPress AJAX endpoint.
			        type : 'GET',
			        dataType: "json",
			        data : {action:'update_lib_datails',tax_id:jQuery('.form-data').attr('data'),cat_val:cat_val,idfy:'folder'},
			        success : function( response ) {
			        	jQuery('.view-'+response.tax_id+' .grid-view-card-title').text(response.tax_name);
		
			        },
			        fail : function( err ) {
			            // You can craft something here to handle an error if something goes wrong when doing the AJAX request.
			            alert( "There was an error: " + err );
			        }
			    });
	});
 </script>
 <?php 

	if(!isset($_GET['tax_id'])){
	    
		$terms = get_terms( 'attachment_category', array(
	      'hide_empty' => false,
	  	) );
	  	
	  //	print_r($terms);
 
	  	if(!empty($terms)){
	  		$sum = 0;
	  		foreach($terms as $term){
	  			if(preg_replace('/[0-9]+/', '', $term->name) == 'New Folder') continue;
	  				 $c[] = preg_replace('/[0-9]+/', '', $term->name); 
	  		 	 $sum ++; 
	  		}
	  		$count = count($c);
	  	}

	    $total = $count+1;
		$array = array('taxonomy' => 'attachment_category','cat_name' => $_GET['name'].' '.$total);
		$wpdocs_cat_id = wp_insert_category($array);
		update_term_meta( $wpdocs_cat_id, 'ppb_folder_date', date(' M j, Y'));
		update_term_meta( $wpdocs_cat_id, 'ppb_folder_author', get_current_user_id());

		//echo $wpdocs_cat_id;
 
	} 
	
 
	 //
?>
<div class="form-data" data="<?php echo isset($_GET['tax_id']) ? $_GET['tax_id']:$wpdocs_cat_id; ?> ">
	<div class="search-key form-field">

		<div class="click-edit" style="<?php echo $edit;?>" >
			<div class="ndl-InlineEditDisplayMode-wrapper">
			<p class="ndl-InlineEditDisplayMode-text"><?php echo $get->name; ?></p>
			<span class="ndl-InlineEditDisplayMode-iconWrapper"><span class="nc-icon ndl-Icon   ndl-InlineEditDisplayMode-icon "><i class="nc-icon-wrapper"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16"><g transform="translate(0, 0)"><path fill="#444444" d="M1,16h3c0.3,0,0.5-0.1,0.7-0.3l11-11c0.4-0.4,0.4-1,0-1.4l-3-3c-0.4-0.4-1-0.4-1.4,0l-11,11 C0.1,11.5,0,11.7,0,12v3C0,15.6,0.4,16,1,16z M2,12.4l10-10L13.6,4l-10,10H2V12.4z"></path></g></svg></i></span></span>
			</div>
		</div>
		
 		<div class="open-fields" style="<?php echo $edit2;?>">
		<input id="create-folder" type="folder-name" value="<?php echo $get->name; ?>" name="create-folder" placeholder="New Folder" >

		<div class="ndl-InlineEditEditMode-iconGroupWrapper"><div class="ndl-InlineEditEditMode-iconGroup"><div class="ndl-InlineEditEditMode-iconWrapper ndl-InlineEditEditMode-cross"><span class="nc-icon ndl-Icon   ndl-InlineEditEditMode-icon "><i class="nc-icon-wrapper"><svg viewBox="0 0 10 10" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><desc>Created with Sketch.</desc><g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="inline-edit" transform="translate(-762.000000, -377.000000)" fill="#2E2A26" fill-rule="nonzero"><path d="M767.035534,380.62132 L769.863961,377.792893 C770.254485,377.402369 770.88765,377.402369 771.278175,377.792893 C771.668699,378.183418 771.668699,378.816582 771.278175,379.207107 L768.449747,382.035534 L771.278175,384.863961 C771.668699,385.254485 771.668699,385.88765 771.278175,386.278175 C770.88765,386.668699 770.254485,386.668699 769.863961,386.278175 L767.035534,383.449747 L764.207107,386.278175 C763.816582,386.668699 763.183418,386.668699 762.792893,386.278175 C762.402369,385.88765 762.402369,385.254485 762.792893,384.863961 L765.62132,382.035534 L762.792893,379.207107 C762.402369,378.816582 762.402369,378.183418 762.792893,377.792893 C763.183418,377.402369 763.816582,377.402369 764.207107,377.792893 L767.035534,380.62132 Z" id="Combined-Shape"></path></g></g></svg></i></span></div><div class="ndl-InlineEditEditMode-iconWrapper
                           ndl-InlineEditEditMode-tick"><span class="nc-icon ndl-Icon   ndl-InlineEditEditMode-icon "><i class="nc-icon-wrapper"><svg viewBox="0 0 13 10" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><desc>Created with Sketch.</desc><g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="inline-edit" transform="translate(-737.000000, -376.000000)" fill="#2E2A26" fill-rule="nonzero"><path d="M748.335029,380.292893 C748.725553,379.902369 749.358718,379.902369 749.749242,380.292893 C750.139767,380.683418 750.139767,381.316582 749.749242,381.707107 L746.678175,384.778175 C746.28765,385.168699 745.654485,385.168699 745.263961,384.778175 L738.192893,377.707107 C737.802369,377.316582 737.802369,376.683418 738.192893,376.292893 C738.583418,375.902369 739.216582,375.902369 739.607107,376.292893 L745.971068,382.656854 L748.335029,380.292893 Z" id="Line-5-Copy-4" transform="translate(743.971068, 380.535534) scale(-1, 1) translate(-743.971068, -380.535534) "></path></g></g></svg></i></span></div></div>
           </div>                

          </div>



	<div class="library-asset-date-info"><p class="ndl-Text ndl-Text--secondary text--medium"><span class="asset-date">Updated on <?php echo date(' M j, Y');  ?><input type="hidden" value="<?php echo isset($_GET['tax_id'])? $ppb_folder_date: date(' M j, Y');?>" id="cat-date" name="cat-date"></span></p><p class="ndl-Text ndl-Text--body asset-sidebar-actions"></p></div>
	<div class="library-asset-share-info"><div class="cl-AssetOwner">Owned by &nbsp;<div class="ndl-Avatar ndl-Avatar--small "><div class="ndl-Avatar-wrapper "><img class="ndl-Avatar-image" src="https://images-cdn.welcomesoftware.com/333d2585b39a11ebb73ae1a8baae10e3"></div></div>&nbsp; <?php echo isset($_GET['taxt_id'])? $user_role:$user_role2; ?></div><div class="share-button"><div class="ndl-FormControl ndl-FormControl--medium "><div class="library-asset-permission-dropdown ndl-FormControl-field"><div class="ndl-PermissionsDropdown"><div class="ndl-PermissionsDropdown-buttons "><button class="ndl-Button ndl-Button--secondaryAlt ndl-Button--small    " type="button"><span class="nc-icon ndl-Icon   ndl-Button-icon "><i class="nc-icon-wrapper"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16"><g transform="translate(0, 0)"><path fill="#444444" d="M9,10.836c0-0.604-0.265-1.179-0.738-1.554C7.539,8.708,6.285,8,4.5,8S1.461,8.708,0.738,9.282 C0.265,9.657,0,10.232,0,10.836V12h9V10.836z"></path><circle fill="#444444" cx="4.5" cy="4.5" r="2.5"></circle><circle data-color="color-2" fill="#444444" cx="11.5" cy="4.5" r="2.5"></circle><path data-color="color-2" fill="#444444" d="M15.262,9.282C14.539,8.708,13.285,8,11.5,8c-0.561,0-1.063,0.075-1.519,0.189 C10.625,8.909,11,9.836,11,10.836V12h5v-1.164C16,10.232,15.735,9.657,15.262,9.282z"></path></g></svg></i></span><span class="ndl-Button-label">Share</span></button></div></div></div></div></div></div>
	</div>
	
	<div class="folder-datas">
		<?php  
		if(isset($_GET['tax_id'])){
		    $query = "SELECT object_id FROM `".$wpdb->prefix."term_relationships`  where term_taxonomy_id=".$_GET['tax_id']."";

			$result = $wpdb->get_results($query); 

			if(!empty($result)){
				foreach($result as $results) {
					$post_ids[] = $results->object_id;
				}
					$posts_query = "SELECT * FROM `".$wpdb->prefix."posts` where ID in (".join(',',$post_ids).")";

		        	$posts = $wpdb->get_results($posts_query); 
			}

		

			//print_R($posts);

			if(!empty($posts)){
				foreach($posts as $post){
					?>
					<div class="library-folder-asset-row"><div class="content-thumbnail asset-thumbnail cl-v3-image-fill"><span class="thumbnail-container false"><img class="thumbnail thumbnail-image" src="<?php echo wp_get_attachment_url( $post->ID ); ?>"></span></div><p class="ndl-Text ndl-Text--secondary asset-title"><?php echo $post->post_title;?></p></div>
					<?php 
				}

			}
		}
			


		?>
		

	</div>

	 
</div>

