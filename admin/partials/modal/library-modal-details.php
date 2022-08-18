<?php 
	global $wpdb;

	$attach_id = $_GET['attach_id'];

	$attached_query = 'SELECT * FROM `'.$wpdb->prefix.'posts` where post_type="attachment" and ID='.$attach_id.'';
 

	 $get_attacment = $wpdb->get_results( $attached_query );

	 $date=date_create($get_attacment[0]->post_modified);
 
 	 $guid = explode('_wpnonce=',wp_nonce_url($get_attacment[0]->guid, 'action' ));

 	 $content_format = unserialize(get_post_meta($get_attacment[0]->ID,'content_format2',true));

 	 $journey_stage = unserialize(get_post_meta($get_attacment[0]->ID,'jurney_stage2',true)); 

 	 $project_page = unserialize(get_post_meta($get_attacment[0]->ID,'Project_Stage2',true)); 

 	 $Target_Audience2 = unserialize(get_post_meta($get_attacment[0]->ID,'Target_Audience2',true)); 

 	 $content_pillar = unserialize(get_post_meta($get_attacment[0]->ID,'content_pillar2',true)); 

 	 $user_ = get_userdata( $get_attacment[0]->post_author );

 	  

 	 if($content_format == '' && $journey_stage =='' && $project_page =='' && $Target_Audience2 =='' && $Target_Audience2 =='' ){
 	 	$add_format = '<div class="asset-labels"><div class="asset-labels-actions"></div><button class="ndl-Button ndl-Button--inline ndl-Button--medium    " type="button"><span class="ndl-Button-label">Add Labels</span></button><p class="ndl-Text ndl-Text--secondary empty-label-message">to search, filter, and analyze performance of your content</p></div>';
 	 }
 
 	// print_r($project_pages);
     //Project Stage
 
?>
<div class="library-preview-bottom-panel" data="<?php echo $get_attacment[0]->ID;?>">
	<div class="library-asset-top-panel">
		<p class="ndl-Text ndl-Text--secondary text--medium library-asset-type-info">original image</p>
	</div>
	<div class="library-asset-title">
		<button class="ndl-Button ndl-Button--secondaryAlt ndl-Button--medium    library-star-button  ndl-Button--iconOnly" type="button"><span class="nc-icon ndl-Icon   ndl-Button-icon "><i class="nc-icon-wrapper"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16"><g transform="translate(0, 0)"><path fill="#444444" d="M11.86,15.542L8,13.513l-3.86,2.029c-0.727,0.387-1.592-0.235-1.451-1.054l0.737-4.299L0.302,7.145 c-0.594-0.58-0.263-1.587,0.555-1.706l4.316-0.627L7.104,0.9c0.336-0.683,1.457-0.683,1.793,0l1.931,3.911l4.316,0.627 c0.818,0.119,1.148,1.126,0.555,1.706l-3.124,3.045l0.737,4.299C13.453,15.311,12.586,15.924,11.86,15.542z M8.466,11.498 l2.532,1.331l-0.483-2.82c-0.056-0.324,0.052-0.655,0.287-0.885l2.049-1.998L10.02,6.715C9.693,6.668,9.412,6.463,9.267,6.168 L8,3.602L6.733,6.168c-0.146,0.295-0.427,0.5-0.753,0.547L3.149,7.126l2.049,1.998c0.235,0.229,0.343,0.561,0.287,0.885 l-0.483,2.82l2.532-1.331C7.826,11.344,8.174,11.344,8.466,11.498z"></path></g></svg></i></span>
		</button>
		<div class="ndl-InlineEditDisplayMode-wrapper">
			<div class="show-event">
				<p class="ndl-Text ndl-Text--body ndl-InlineEditDisplayMode-text "><?php echo get_the_title($attach_id); ?></p>
				<span style="visibility:hidden;" data="article-title" class="edit ndl-InlineEditDisplayMode-iconWrapper"><span class="nc-icon ndl-Icon   ndl-InlineEditDisplayMode-icon "><i class="nc-icon-wrapper"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16"><g transform="translate(0, 0)"><path fill="#444444" d="M1,16h3c0.3,0,0.5-0.1,0.7-0.3l11-11c0.4-0.4,0.4-1,0-1.4l-3-3c-0.4-0.4-1-0.4-1.4,0l-11,11 C0.1,11.5,0,11.7,0,12v3C0,15.6,0.4,16,1,16z M2,12.4l10-10L13.6,4l-10,10H2V12.4z"></path></g></svg></i></span></span>
			</div>
			<div class="edit-event">
				<input type="text" name="title" id="article_title" value="<?php echo get_the_title($attach_id); ?>">
				<div class="ndl-InlineEditEditMode-iconGroupWrapper"><div class="ndl-InlineEditEditMode-iconGroup"><div class="ndl-InlineEditEditMode-iconWrapper ndl-InlineEditEditMode-cross"><span class="nc-icon ndl-Icon   ndl-InlineEditEditMode-icon "><i class="nc-icon-wrapper"><svg viewBox="0 0 10 10" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><desc>Created with Sketch.</desc><g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="inline-edit" transform="translate(-762.000000, -377.000000)" fill="#2E2A26" fill-rule="nonzero"><path d="M767.035534,380.62132 L769.863961,377.792893 C770.254485,377.402369 770.88765,377.402369 771.278175,377.792893 C771.668699,378.183418 771.668699,378.816582 771.278175,379.207107 L768.449747,382.035534 L771.278175,384.863961 C771.668699,385.254485 771.668699,385.88765 771.278175,386.278175 C770.88765,386.668699 770.254485,386.668699 769.863961,386.278175 L767.035534,383.449747 L764.207107,386.278175 C763.816582,386.668699 763.183418,386.668699 762.792893,386.278175 C762.402369,385.88765 762.402369,385.254485 762.792893,384.863961 L765.62132,382.035534 L762.792893,379.207107 C762.402369,378.816582 762.402369,378.183418 762.792893,377.792893 C763.183418,377.402369 763.816582,377.402369 764.207107,377.792893 L767.035534,380.62132 Z" id="Combined-Shape"></path></g></g></svg></i></span></div><div class="ndl-InlineEditEditMode-iconWrapper
                           ndl-InlineEditEditMode-tick"><span class="nc-icon ndl-Icon   ndl-InlineEditEditMode-icon "><i class="nc-icon-wrapper"><svg viewBox="0 0 13 10" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><desc>Created with Sketch.</desc><g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="inline-edit" transform="translate(-737.000000, -376.000000)" fill="#2E2A26" fill-rule="nonzero"><path d="M748.335029,380.292893 C748.725553,379.902369 749.358718,379.902369 749.749242,380.292893 C750.139767,380.683418 750.139767,381.316582 749.749242,381.707107 L746.678175,384.778175 C746.28765,385.168699 745.654485,385.168699 745.263961,384.778175 L738.192893,377.707107 C737.802369,377.316582 737.802369,376.683418 738.192893,376.292893 C738.583418,375.902369 739.216582,375.902369 739.607107,376.292893 L745.971068,382.656854 L748.335029,380.292893 Z" id="Line-5-Copy-4" transform="translate(743.971068, 380.535534) scale(-1, 1) translate(-743.971068, -380.535534) "></path></g></g></svg></i></span></div></div>
           </div>
			</div>
		</div>
	</div>
	<div class="library-asset-date-info"><p class="ndl-Text ndl-Text--secondary text--medium"><span class="asset-date">Updated on <?php echo date_format($date,"D M j, Y"); ?></span></p><p class="ndl-Text ndl-Text--body asset-sidebar-actions"><button class="ndl-Button ndl-Button--secondary ndl-Button--small    " type="button"><span class="nc-icon ndl-Icon   ndl-Button-icon "><i class="nc-icon-wrapper"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 15.84 15.84"><path fill="#444" d="M15.64,3.35a.24.24,0,0,0-.23-.07l-3.82.54a.28.28,0,0,0-.22.19.27.27,0,0,0,.07.28l1.14,1.13h0L8.38,9.63,5.26,6.53l-4.95,5a.64.64,0,0,0,.45,1.09.67.67,0,0,0,.45-.19L5.27,8.33l3.12,3.1,5.09-5.11,1.23,1.24a.27.27,0,0,0,.19.08l.09,0a.25.25,0,0,0,.18-.22l.55-3.82A.29.29,0,0,0,15.64,3.35Z"></path></svg></i></span><span class="ndl-Button-label">Analytics</span></button></p></div>

	<div class="library-asset-share-info"><div class="cl-AssetOwner">Owned by &nbsp;<div class="ndl-Avatar ndl-Avatar--small "><div class="ndl-Avatar-wrapper "><img class="ndl-Avatar-image" src="https://images-cdn.welcomesoftware.com/333d2585b39a11ebb73ae1a8baae10e3"></div></div>&nbsp; <?php echo ucfirst($user_->roles[0]); ?></div><div class="share-button"><div class="ndl-FormControl ndl-FormControl--medium "><div class="library-asset-permission-dropdown ndl-FormControl-field"><div class="ndl-PermissionsDropdown"><div class="ndl-PermissionsDropdown-buttons "><button class="ndl-Button ndl-Button--secondaryAlt ndl-Button--small    " type="button"><span class="nc-icon ndl-Icon   ndl-Button-icon "><i class="nc-icon-wrapper"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16"><g transform="translate(0, 0)"><path fill="#444444" d="M9,10.836c0-0.604-0.265-1.179-0.738-1.554C7.539,8.708,6.285,8,4.5,8S1.461,8.708,0.738,9.282 C0.265,9.657,0,10.232,0,10.836V12h9V10.836z"></path><circle fill="#444444" cx="4.5" cy="4.5" r="2.5"></circle><circle data-color="color-2" fill="#444444" cx="11.5" cy="4.5" r="2.5"></circle><path data-color="color-2" fill="#444444" d="M15.262,9.282C14.539,8.708,13.285,8,11.5,8c-0.561,0-1.063,0.075-1.519,0.189 C10.625,8.909,11,9.836,11,10.836V12h5v-1.164C16,10.232,15.735,9.657,15.262,9.282z"></path></g></svg></i></span><span class="ndl-Button-label">Share</span></button></div></div></div></div></div></div>

	<div class="library-asset-body-panel">
		<div class="library-image">
		<?php  
			echo wp_get_attachment_image($attach_id,'full');
		?>
		</div>
		
		<div class="media-description truncated">
			<?php echo $get_attacment[0]->post_content; ?>
		 </div>

		 <div id="accordion">
			  <h3>Image Information</h3>
			  <div class="image-info">
			   	<table>
			   		<tr><td>GUID</td><td><?php echo $guid[1]; ?></td></tr>
			   		<tr><td>Source</td><td><?php echo ucfirst($user_->user_nicename); ?> </td></tr>
			   		<tr><td>Public Link</td><td><input type="text" value="<?php echo get_the_permalink($get_attacment[0]->ID); ?>"></td></tr>
			   		<tr><td>Image Size</td><td class="image-size"></td></tr>
			   	</table>
			  </div>
			  <h3>Label</h3>
			  <div class="labels">
					<?php  if(!empty($content_format)){ ?>
					<div class="content_format ndl-Labels-container">
					   <span class="ndl-Labels-type">content format</span>
					   <span class="ndl-Labels-item ndl-Labels-itemLast">
					   	  <?php 
						   	  	foreach($content_format as $content_formats) {
						   	  		?>
						   	  			<div class="ndl-Pill ndl-Pill--medium ">
									   		<span class="ndl-Pill-title "><?php echo $content_formats;?></span>
									   </div>
						   	  		<?php 
						   	  	}
					   	  ?>
						   
					   </span>
				   </div>
				   <?php } ?>
				   <?php  if(!empty($project_page)){ ?>
				   <div class="content_format ndl-Labels-container">
					   <span class="ndl-Labels-type">Project Stage</span>
					   <span class="ndl-Labels-item ndl-Labels-itemLast">
					   	  <?php 
						   	  	foreach($project_page as $project_pages) {
						   	  		?>
						   	  			<div class="ndl-Pill ndl-Pill--medium ">
									   		<span class="ndl-Pill-title "><?php echo $project_pages;?></span>
									   </div>
						   	  		<?php 
						   	  	}
					   	  ?>
						   
					   </span>
				   </div>
				   <?php } ?>
				   <?php  if(!empty($content_pillar)){ ?>
				   <div class="content_format ndl-Labels-container">
					   <span class="ndl-Labels-type">CONTENT PILLAR</span>
					   <span class="ndl-Labels-item ndl-Labels-itemLast">
					   	  <?php 
						   	  	foreach($content_pillar as $content_pillars) {
						   	  		?>
						   	  			<div class="ndl-Pill ndl-Pill--medium ">
									   		<span class="ndl-Pill-title "><?php echo $content_pillar;?></span>
									   </div>
						   	  		<?php 
						   	  	}
					   	  ?>
						   
					   </span>
				   </div>
				    <?php } ?>
				    <?php  if(!empty($journey_stage)){ ?>
				   <div class="content_format ndl-Labels-container">
					   <span class="ndl-Labels-type">Journey Stage</span>
					   <span class="ndl-Labels-item ndl-Labels-itemLast">
					   	  <?php  
						   	  	foreach($journey_stage as $journey_stages) {
						   	  		?>
						   	  			<div class="ndl-Pill ndl-Pill--medium ">
									   		<span class="ndl-Pill-title "><?php echo $journey_stages;?></span>
									   </div>
						   	  		<?php 
						   	  	}

					   	  ?>
						   
					   </span>
				   </div>
				   <?php } ?> 
				   <?php  if(!empty($content_pillar)){ ?>
				   <div class="content_format ndl-Labels-container">
					   <span class="ndl-Labels-type">CONTENT PILLAR</span>
					   <span class="ndl-Labels-item ndl-Labels-itemLast">
					   	  <?php 
						   	  	foreach($content_pillar as $content_pillars) {
						   	  		?>
						   	  			<div class="ndl-Pill ndl-Pill--medium ">
									   		<span class="ndl-Pill-title "><?php echo $content_pillar;?></span>
									   </div>
						   	  		<?php 
						   	  	}
					   	  ?>
						   
					   </span>
				   </div>
				    <?php } ?>
				    <?php  if(!empty($journey_stage)){ ?>
				   <div class="content_format ndl-Labels-container">
					   <span class="ndl-Labels-type">Journey Stage</span>
					   <span class="ndl-Labels-item ndl-Labels-itemLast">
					   	  <?php  
						   	  	foreach($journey_stage as $journey_stages) {
						   	  		?>
						   	  			<div class="ndl-Pill ndl-Pill--medium ">
									   		<span class="ndl-Pill-title "><?php echo $journey_stages;?></span>
									   </div>
						   	  		<?php 
						   	  	}

					   	  ?>
						   
					   </span>
				   </div>
				   <?php } ?>

				   
				   <?php echo $add_format ;?>
				   
			  </div>
			  <h3>Usage</h3>
			  <div>
			     
			  </div>
			   
			</div>
	</div>

</div>



<style>

.library-image img {
    width: 100%;
    height:auto;
}
span.ndl-Labels-type {
    color: #191932;
    font-size: .75rem;
    display: block;
    text-transform: uppercase;
    margin-bottom: 5px;
}

.ndl-Pill.ndl-Pill--medium {
    background-color: #ededf4;
    border-radius: 3px;
    color: #474759;
    display: inline-block;
    font-size: .75rem;
    line-height: 12px;
    margin-bottom: 4px;
    padding: 4px 8px;
}
.library-asset-type-info.text--medium {
    font-size: 12px;
    margin:0;
}
.ui-accordion-content {
    min-height: 85px !important;
    height: auto !important;
}
.image-info  table {
    width: 100%;
}
.image-info  table tr td {
	padding-bottom:15px;
}
.image-info  table tr td {
	color: #191932;
}
.image-info  table tr td:first-child {
    width: 130px;
    font-family: proxima-nova,Helvetica,Arial,sans-serif;
    font-size: 14px;
    font-weight: 400;
    line-height: 20px;
    color: #74748b !important;
    margin: 0 0 8px;
}
.ui-accordion-header {
    background: none !important;
    color: #191932 !important;
    font-weight: bold !important;
    border: none !important;
    padding: 0 !important;
    padding: 8px 0 !important;
    padding-left:0 !important;
    border-top: solid 1px #ededf4 !important;
    font-size:14px;
}
.ui-accordion-content {
    padding: 0 !important;
    border: none !important;
}
.ndl-InlineEditDisplayMode-wrapper {display: flex; position:relative; width:100%;}
.edit-event {
    display: none;
}
.ndl-InlineEditDisplayMode-wrapper:hover .show-event .ndl-InlineEditDisplayMode-iconWrapper {
    visibility: visible !important;
    top: 0;
}
.show-event .ndl-InlineEditDisplayMode-iconWrapper svg {
    width: 15px;
    fill: #6f8096;
}
.ndl-InlineEditDisplayMode-wrapper .show-event .ndl-InlineEditDisplayMode-iconWrapper {
    position: absolute;
    right: 1px;
    top: -11px !important;
    cursor: pointer
}
.edit-event {
    width: 100%;
}

input#article_title {
    width: 100%;
    border: none;
    border-bottom: solid 1px #4655d7;
    border-radius: 0;
}


</style>
<script>

jQuery( function() {
	var height = jQuery('.library-image img').attr('height');
	var width = jQuery('.library-image img').attr('width');
	jQuery('td.image-size').html(width+' X '+height);
    jQuery( "#accordion" ).accordion({ autoHeight: true });
} );
jQuery('.edit').click(function (){
    var data = jQuery(this).attr('data');
    jQuery('.show-event').hide();
    jQuery('.edit-event').show();
    switch(data){
        case 'article-title':
          var uri = data;
		     console.log(data);
		 	jQuery('.ndl-InlineEditEditMode-icon').click(function() {
		 		 var id = jQuery('.library-preview-bottom-panel').attr('data');
		 		 var title = jQuery('input#article_title').val();  
			    jQuery.ajax({
				   url : ajaxurl , // Here goes our WordPress AJAX endpoint.
				   type : 'GET',
				   data : {action:'update_lib_datails',idfy:uri,id:id,title:title},
				   beforeSend: function( response ) {
				   },
				  success : function( response ) {
			          //jQuery('.view-'+id).hide();
			            jQuery('.view-'+id+' .grid-view-card-title,.ndl-InlineEditDisplayMode-text').text(title);
			            console.log('.view-'+id+' .grid-view-card-title');
			            jQuery('.show-event').show();
    					jQuery('.edit-event').hide();
				 },
				  fail : function( err ) {
				     alert( "There was an error: " + err );
				 }
				});	

 			});
 	  break;

     }

	    
	});
</script>