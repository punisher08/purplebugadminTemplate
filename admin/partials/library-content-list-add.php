<?php

 global $wpdb;
 
 	 $user_id = get_current_user_id();
	 $user = wp_get_current_user();
		if ( !in_array( 'administrator', (array) $user->roles ) ) {
	    //The user has the "author" role
	    	$go = "and post_author=".$user_id."";
		}
	 $Query = "SELECT * FROM `".$wpdb->prefix."posts` where post_type='attachment' ".$go." and post_status='inherit' ".$search ." ORDER BY `ID` DESC LIMIT ".$offset.", ".$items_per_page." ";
	 $get_attacments = $wpdb->get_results( $Query );
     




 

	  update_post_meta($_GET['attachment_id'],'jurney_stage2',strings_field($_GET['jurney_stage']));
	  update_post_meta($_GET['attachment_id'],'content_format2',strings_field($_GET['content_format']));
	  update_post_meta($_GET['attachment_id'],'Project_Stage2',strings_field($_GET['Project_Stage']));
	  update_post_meta($_GET['attachment_id'],'Target_Audience2',strings_field($_GET['Target_Audience']));

	  update_post_meta($_GET['attachment_id'],'lib_width',$_GET['width']);
	  update_post_meta($_GET['attachment_id'],'lib_height',$_GET['height']);
	  update_post_meta($_GET['attachment_id'],'authorName',$_GET['authorName']);
	 

function strings_field ($string) {
	$form_explode = array_filter(explode('-',$string));
	foreach($form_explode as $form_exploded){
		if($form_exploded =='on') continue;
		$c_format[] = $form_exploded;
	}
	
	$serial = serialize($c_format);
	return $serial;
}
 
 if(!empty($get_attacment)){?>
    
   
                <table id="lib-list-view" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th><input class="check-all" type="checkbox" id="checkk-all" ></th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Owner</th>
                            <th>Last Modified</th>
                             
                        </tr>
                    </thead>
                    <tbody>
                         <?php
                          

                              foreach($get_attacment as $attachment){
                                $split = explode("/",$attachment->post_mime_type);

                                $date=date_create($attachment->post_modified);
                                echo '<tr>';
                                    echo '<td><input class="get-details" type="checkbox" value="'.$attachment->ID.'"></td>';
                                    echo '<td><div class="title-with-image"><img class="thumbnail" width="22px" thumbnail-image" src="'.$attachment->guid.'"> <p class="ndl-Text ndl-Text--body list-view-title">'.$attachment->post_title.'<span class="overflow-pivot"></span></p> </div></td>';
                                    echo '<td>'.$split[0].'</td>';
                                    echo '<td style="text-align: center;"><img class="avatar-image" src="https://images-cdn.welcomesoftware.com/333d2585b39a11ebb73ae1a8baae10e3" width="22px"></td>';
                                    echo '<td>'.date_format($date,"D M j, Y").'</td>';
                                echo '</tr>';
                               }
                            
                         
                          ?>
                   </tbody>
                </table> 					 
    							 
                      
<?php } ?>