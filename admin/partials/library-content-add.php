<?php

 global $wpdb;
 
 	 $user_id = get_current_user_id();
	 $user = wp_get_current_user();
		if ( !in_array( 'administrator', (array) $user->roles ) ) {
	    //The user has the "author" role
	    	$go = "and post_author=".$user_id."";
		}



	 $Query = "SELECT * FROM `".$wpdb->prefix."posts` where post_type='attachment' ".$go." and post_status='inherit' ORDER BY `ID` DESC";

	 $get_attacment = $wpdb->get_results( $Query );



 

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
 
 if(!empty($get_attacment)){
    				 
    					 
    							foreach($get_attacment as $attachment){

                
                   $explode = explode('/',$attachment->post_mime_type);

    								$date=date_create($attachment->post_modified);
 
                        ?>
                          <div class="grid-view-item" id="attachment-<?php echo $attachment->ID?>">
                            <div class="grid-view-card false cursor-pointer false">
                            <div class="card-actiom">
                              <label class="grid-view-checkbox  ndl-Checkbox ndl-Checkbox--medium"><div class="ndl-Checkbox-container"> <input class="ndl-Checkbox-input" type="checkbox"><span class="ndl-Checkbox-holder"></span></div>
                              </label>
                              <button class="ndl-Button ndl-Button--secondaryAlt ndl-Button--medium    ndl-Dropdown-button ndl-Button--iconOnly" type="button"><span class="nc-icon ndl-Icon   ndl-Button-icon "><i class="nc-icon-wrapper"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16"><g transform="translate(0, 0)"><circle data-color="color-2" fill="#444444" cx="8" cy="8" r="2"></circle><circle fill="#444444" cx="2" cy="8" r="2"></circle><circle fill="#444444" cx="14" cy="8" r="2"></circle></g></svg></i></span></button>
                            </div>

                              <div class="grid-view-card-top">
                               <div class="content-thumbnail grid-cl-v3-article-fill">
                                <span class="thumbnail-container false">
                                <img class="thumbnail thumbnail-image" src="<?php echo $attachment->guid; ?>"></span>
                                </div>
                              </div>

                              <div class="grid-view-card-middle">
                              <?php 
                                if($explode[0] == 'image'){
                                  echo '<div class="rounded-icon-container grid-cl-v3-image-fill"><span class="nc-icon rounded-icon " style="width: 12px; height: 12px;"><i class="nc-icon-wrapper"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16"><g transform="translate(0, 0)"><path fill="#444444" d="M15,16H1c-0.6,0-1-0.4-1-1V1c0-0.6,0.4-1,1-1h14c0.6,0,1,0.4,1,1v14C16,15.6,15.6,16,15,16z M2,14h12V2H2V14 z"></path><path data-color="color-2" fill="#444444" d="M6,4c0.6,0,1,0.4,1,1S6.6,6,6,6S5,5.6,5,5S5.4,4,6,4z"></path><polygon data-color="color-2" fill="#444444" points="3,12 5,8 7,10 10,6 13,12 "></polygon></g></svg></i></span></div>';
                                }else if( $explode[1] == 'vnd.openxmlformats-officedocument.wordprocessingml.document'){
                                  echo '<div class="Microsoft_Word_2013_logo rounded-icon-container grid-cl-v3-word-fill"><span class="nc-icon rounded-icon " style="width: 12px; height: 12px;"><i class="nc-icon-wrapper"><svg viewBox="0 0 16 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="Design-v3" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="Microsoft_Word_2013_logo" fill-rule="nonzero"><path d="M8.32858365,1.0658141e-14 L9.38816283,1.0658141e-14 C9.38816283,0.473089701 9.38816283,0.94440753 9.38816283,1.41749723 C11.2840654,1.42812846 13.1781961,1.39800664 15.0723267,1.42812846 C15.4763134,1.38737542 15.7934784,1.70099668 15.7562691,2.10498339 C15.786391,5.59557032 15.7491817,9.08792913 15.7739879,12.5785161 C15.7562691,12.9364341 15.8094253,13.3333333 15.6021163,13.6504983 C15.3434231,13.834773 15.0085394,13.8117386 14.7073212,13.8259136 C12.9336778,13.8170543 11.1618062,13.820598 9.38816283,13.820598 C9.38816283,14.2936877 9.38816283,14.7650055 9.38816283,15.2380952 L8.28074312,15.2380952 C5.58395464,14.745515 2.88007867,14.2936877 0.177974574,13.820598 C0.176202702,9.68682171 0.177974574,5.5530454 0.177974574,1.42104097 C2.89425364,0.946179402 5.61230458,0.48372093 8.32858365,1.0658141e-14 Z M3.83866117,5.0799557 C3.59059916,6.23875969 3.33544966,7.39756368 3.08561577,8.55636766 C2.92614733,7.42591362 2.71883836,6.30254707 2.53633559,5.17386489 C2.23334556,5.18449612 1.92858365,5.19689922 1.62559362,5.2110742 C1.90023371,6.77386489 2.24574866,8.32248062 2.53987934,9.88172757 C2.88185054,9.9047619 3.22382175,9.92602436 3.56402109,9.94374308 C3.80145187,8.80620155 4.07077635,7.67220377 4.27808532,6.52757475 C4.48893803,7.70586932 4.76357812,8.8717608 4.99923703,10.0447398 C5.3500676,10.0199336 5.79303548,10.1811739 6.08893803,10.027021 C6.5265903,8.32070875 6.87742086,6.58959025 7.27786383,4.87264673 C6.9252614,4.89390919 6.57088709,4.91339978 6.21651278,4.92580288 C6.00211632,6.15370986 5.78063238,7.37984496 5.5804109,8.60952381 C5.3252614,7.41882614 5.08428687,6.22458472 4.84862795,5.02857143 C4.51197236,5.04629014 4.17531677,5.06046512 3.83866117,5.0799557 Z" id="Combined-Shape" fill="#444444"></path><path d="M9.38816283,1.94905869 C11.3372215,1.94905869 13.2862802,1.94905869 15.2353389,1.94905869 C15.2353389,5.72846069 15.2353389,9.50963455 15.2353389,13.2890365 C13.2862802,13.2890365 11.3372215,13.2890365 9.38816283,13.2890365 C9.38816283,12.8159468 9.38816283,12.344629 9.38816283,11.8715393 C10.9243755,11.8715393 12.4588162,11.8715393 13.9950288,11.8715393 C13.9950288,11.6358804 13.9950288,11.3984496 13.9950288,11.1627907 C12.4588162,11.1627907 10.9243755,11.1627907 9.38816283,11.1627907 C9.38816283,10.8668882 9.38816283,10.5727575 9.38816283,10.2768549 C10.9243755,10.2768549 12.4588162,10.2768549 13.9950288,10.2768549 C13.9950288,10.041196 13.9950288,9.80376523 13.9950288,9.56810631 C12.4588162,9.56810631 10.9243755,9.56810631 9.38816283,9.56810631 C9.38816283,9.27220377 9.38816283,8.97807309 9.38816283,8.68217054 C10.9243755,8.68217054 12.4588162,8.68217054 13.9950288,8.68217054 C13.9950288,8.44651163 13.9950288,8.20908084 13.9950288,7.97342193 C12.4588162,7.97342193 10.9243755,7.97342193 9.38816283,7.97342193 C9.38816283,7.67751938 9.38816283,7.3833887 9.38816283,7.08748616 C10.9243755,7.08748616 12.4588162,7.08748616 13.9950288,7.08748616 C13.9950288,6.85182724 13.9950288,6.61439646 13.9950288,6.37873754 C12.4588162,6.37873754 10.9243755,6.37873754 9.38816283,6.37873754 C9.38816283,6.08283499 9.38816283,5.78870432 9.38816283,5.49280177 C10.9243755,5.49280177 12.4588162,5.49280177 13.9950288,5.49280177 C13.9950288,5.25714286 13.9950288,5.01971207 13.9950288,4.78405316 C12.4588162,4.78405316 10.9243755,4.78405316 9.38816283,4.78405316 C9.38816283,4.48815061 9.38816283,4.19401993 9.38816283,3.89811739 C10.9243755,3.89811739 12.4588162,3.89811739 13.9950288,3.89811739 C13.9950288,3.66245847 13.9950288,3.42502769 13.9950288,3.18936877 C12.4588162,3.18936877 10.9243755,3.18936877 9.38816283,3.18936877 C9.38816283,2.7765227 9.38816283,2.36190476 9.38816283,1.94905869 Z" id="path46" fill="#FFFFFF"></path></g></g></svg></i></span></div>';

                                }else if($explode[1] == 'vnd.openxmlformats-officedocument.presentationml.presentation'){
                                   echo '<div class="MS_power_point rounded-icon-container grid-cl-v3-ppt-fill"><span class="nc-icon rounded-icon " style="width: 12px; height: 12px;"><i class="nc-icon-wrapper"><svg viewBox="0 0 16 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="Design-v3" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><path d="M15.069736,2.5307032 L8.91019247,2.5307032 L8.91019247,3.85258284 L13.7134257,3.85258284 L13.7134257,4.4660654 L8.91019247,4.4660654 L8.91019247,5.50311385 L13.7134257,5.50311385 L13.7134257,6.11659641 L8.91019247,6.11659641 L8.91019247,7.82146445 C9.2972103,7.35504242 9.87274905,7.05881799 10.5159882,7.05881799 C11.6814755,7.05881799 12.6262117,8.02996088 12.6262117,9.2278294 L10.5159882,9.2278294 L10.5159882,11.3968408 C9.87274905,11.3968408 9.2972103,11.1006164 8.91019247,10.6341944 L8.91019247,13.0475471 L15.0705887,13.0475471 L15.069736,2.5307032 Z M15.0705887,13.5733893 L8.91019247,13.5733893 L8.91019247,15.2275136 L-5.15143483e-14,13.6385061 L-5.15143483e-14,1.58900747 L8.91019247,2.66453526e-15 L8.91019247,2.00486101 L15.0705887,2.00486101 C15.3527306,2.00486101 15.5821787,2.24070123 15.5821787,2.5307032 L15.5821787,13.0475471 C15.5821787,13.3375491 15.3527306,13.5733893 15.0705887,13.5733893 Z M3.77018807,7.70662051 C4.12565785,7.6785756 4.47285693,7.61030375 4.68874791,7.98908541 C4.85194512,8.27488065 4.83821746,8.79712959 4.64892916,9.01675634 C4.40413334,9.30071113 4.08788546,9.26022128 3.77018807,9.20851346 L3.77018807,7.70662051 Z M3.74512016,5.01781409 L2.85265141,5.01781409 L2.85265141,10.1379395 C3.54116628,10.1379395 4.22618529,10.1578339 4.90864635,10.1245306 C5.0880439,10.1157665 5.2963463,9.978697 5.42876284,9.83812185 C5.935578,9.30027293 5.93566327,8.63026233 5.78423263,7.96200454 C5.64925813,7.36683882 5.27571217,6.94809315 4.68695735,6.80085733 C4.39364575,6.72750235 4.07978528,6.74099896 3.74512016,6.71269112 L3.74512016,5.01781409 Z M10.8428089,11.7036697 L10.8428089,9.53465832 L12.9530324,9.53465832 C12.9530324,10.7325268 12.0082962,11.7036697 10.8428089,11.7036697 Z" id="Combined-Shape" fill="#444444" fill-rule="nonzero" transform="translate(7.791089, 7.613757) scale(-1, 1) rotate(-180.000000) translate(-7.791089, -7.613757) "></path></g></svg></i></span></div>';
                                }else if($explode[1] == 'csv'){
                                   echo '<div class="MS_csv rounded-icon-container grid-cl-v3-ppt-fill"><span class="nc-icon rounded-icon " style="width: 12px; height: 12px;"><i class="nc-icon-wrapper"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16"><g transform="translate(0, 0)"><path fill="#444444" d="M15,15V5l-5-5H2C1.4,0,1,0.4,1,1v14c0,0.6,0.4,1,1,1h12C14.6,16,15,15.6,15,15z M3,2h6v4h4v8H3V2z"></path></g></svg></i></span></div>';
                                }   
                              ?>
                              

                              </div>


                              <div class="grid-view-card-bottom ">
                                <div class="card-title-wrapper">
                                  <p class="ndl-Text ndl-Text--body grid-view-card-title"><?php echo $attachment->post_title; ?></p>
                                </div>
                                <div class="grid-view-card-details">
                                  <p class="ndl-Text ndl-Text--secondary small-text">ORIGINAL ARTICLE&nbsp;• Shared by Marketing Support</p>
                                  <p class="ndl-Text ndl-Text--secondary small-text">Last Modified on <?php echo date_format($date,"D M j, Y"); ?></p>
                                </div>
                              </div>
                           </div>
                           <input type="hidden" id="lib-details-" value="<?php echo  plugin_dir_url( __FILE__ ) . 'modal/library-modal-details.php?att_id='.$attachment->ID; ?>">   
                           </div>
                           


                          <?php
                      


                      }
                      
                    }
    					 ?>