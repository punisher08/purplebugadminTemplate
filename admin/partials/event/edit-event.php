<!--script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script-->
<script>
function new_update (){
  jQuery(document).ready( function($) {
    $( "#accordion" ).accordion();
  } );
  jQuery('.edit-article').click(function (){
     var url = jQuery(this).attr('href');
      window.open(url, '_blank');

  });
jQuery('.content-article').click(function (){
    var slectd_val = jQuery('#selected-post').val();
 
     if(slectd_val != undefined){
        var myArr = slectd_val.split(",");
     }
 
    jQuery.ajax({
     type : "GET",
     url : ajaxurl,
     data : {action: "modal_action",addContent:'article'},
     beforeSend: function(){
         jQuery("#loading").show();
         
         console.log('Hello World show');
     },
     success: function(response) {
            jQuery('.modal-here').html(response);
            jQuery("#loading").hide();
            console.log('Hello World hide');
                jQuery("#add-article").modal({
                      escapeClose: true,
                      clickClose: true,
                      showClose: true
                });
               if(slectd_val != undefined){   
                for (let i = 0; i < myArr.length; i++) {
                  jQuery('.card-actiom.tax-attachment-'+myArr[i]+'').css('visibility','visible');
                  jQuery('.card-actiom.tax-attachment-'+myArr[i]+' input.ndl-Checkbox-input').attr('checked',true);
                  jQuery('.view-'+myArr[i]).addClass('active');
                } 
               }  
              
               jQuery('.grid-view-item').click(function () {
                var data = jQuery(this).attr('data');
                    jQuery(this).toggleClass('active');
                     
                    jQuery('.card-actiom.tax-attachment-'+data).css('visibility','hidden');
                    jQuery('.card-actiom.tax-attachment-'+data+' .ndl-Checkbox-input').attr('checked',false);

                    jQuery('.active .card-actiom.tax-attachment-'+data).css('visibility','visible');
                    jQuery('.active .card-actiom.tax-attachment-'+data+' .ndl-Checkbox-input').attr('checked',true);
                    var gids = new Array();
                       jQuery('.active .ndl-Checkbox-input').each(function () {
                            var ids = jQuery(this).val();
                              gids.push(ids);
                        });
                        jQuery('.add-data').click(function (){    
                           var checked = new Array()
                        jQuery('.ndl-Checkbox-input').each(function (){
                           
                            if(jQuery(this).is(':checked')){
                              checked.push(jQuery(this).val());   
                            }
                            
                        });    
                        var j = checked.join(',');
                            
                                  jQuery.ajax({
                                   type : "GET",
                                   url : ajaxurl,
                                   data : {action: "ppb_creation",assgn_post:j,task_id:jQuery('#task_id').val()},
                                   success: function(response) {
                                     
                                     jQuery('.fotter-button .close').trigger('click');
                                     
                                     //console.log('saved');
                                      location.reload();
                                    // console.log( j);
                                   }
                                });                
                        });         
                     
           });     
                    
     }
  });

});  
}

 jQuery( function($) {
  $('.per-thumbnail.primary').click(function (){
    jQuery('.per-thumbnail.primary').removeClass('active');  
    jQuery(this).addClass('active');
    var post_id = jQuery(this).attr('data');
    jQuery.ajax({
         type : "GET",
         url : ajaxurl,
         data : {action: "modal_action",act:'thumb',post_ids:post_id},
        beforeSend: function(){
             jQuery("#loading").show();
             console.log('Hello World show');
         },
         success: function(response) {
              jQuery("#loading").hide();
              console.log('Hello World show');
            jQuery('.the-content-article').html(response);
            new_update();
         } 
    });
});
    $( ".tabs,.content-tab-pane" ).tabs();
     jQuery('.view-detail').click(function(){
       
        var data_id = jQuery(this).attr('data');
        // console.log(data_id);
        if(data_id == 0) return false;
        jQuery(this).toggleClass('active');
        jQuery('.steps-'+data_id).addClass('open');
            
            if(jQuery(this).hasClass('active')){
                jQuery(this).text('Hide Details');
                 jQuery('.steps-'+data_id+' .checklis').show(); 
                    // console.log(data_id);  
            }else{
                 jQuery(this).text('View Details');
                 jQuery('.steps-'+data_id).removeClass('open');
                  jQuery('.steps-'+data_id+' .checklis').hide();
            }


            jQuery('ul.checklist-data-'+data_id+' li').click(function (){
                var val = jQuery(this).find('input').val();
                  
                  if(jQuery(this).find('input').prop("checked") == true){
                    jQuery(this).find('input').attr('checked',false);
                  }else if(jQuery(this).find('input').prop("checked") == false){
                     jQuery(this).find('input').attr('checked',true);
                  }
                var arr = new Array();
                jQuery('ul.checklist-data-'+data_id+' li input:checked').each(function(){
                       arr.push(jQuery(this).val());     
                            
                 });
                    jQuery.ajax({
                        type: "GET",
                        url: ajaxurl, 
                        data : { action:'ppb_creation',ID:<?php echo $_GET['id']?>,checklist:arr.join('-'),flow_id:data_id }, // serializes the form's elements.
                        success: function(data) {
                            // console.log(data);                 
                        }
                    });
            });

            jQuery('.button-act-'+data_id).click(function() {

              var act = jQuery(this).attr('act');
               
              jQuery.ajax({
                   type: "GET",
                   url: ajaxurl, 
                   data : { action:'ppb_creation',approveId:<?php echo $_GET['id']?>,status,flow_id:data_id,act:act}, // serializes the form's elements.
                   success: function(data) {
                    jQuery(this).attr('disabled',true);
                      if(data=='Success'){
                        jQuery('.steps-'+data_id+' ul.checklist-data-'+data_id+' input').attr('disabled',true);
                        jQuery('.steps-'+data_id+' .ndl-Avatar-wrapper').html('<img src="https://img.icons8.com/officel/80/000000/checked--v1.png"/>');
                        location.reload();
                        
                      }else if(data=='Undo'){
                          location.reload();
                      }else{
                         jQuery('.steps-'+data_id+' ul.checklist-data-'+data_id+' input').attr('disabled',false);
                         jQuery('.button-act-'+data_id).attr('disabled',false);
                      }               
                   }
              });    

          });
    
    });  
    
    
  } );
  jQuery('.download-article ').click(function () {
    var title = jQuery('.ndl-HeaderTitle ').text();
    var doc = new jsPDF();
    var elementHTML = jQuery('#article-content').html();
    var specialElementHandlers = {
        '#toPdf': function (element, renderer) {
            return true;
        }
    };
     doc.fromHTML(elementHTML, 15, 15, {
        'width': 170,
        'elementHandlers': specialElementHandlers
    });
      doc.save(title+'.pdf');

  });

</script>
 

<?php 
global $wp_roles;
$roles = $wp_roles->roles; 
$current_user = wp_get_current_user();
$post = get_post($_GET['id']);
$Workflow = get_post_meta($_GET['id'],'workflow_id');
$work_data = get_post($Workflow[0]);								
$post = get_post($_GET['id']);
 
$post_id = $post->ID;
$attachment_id =get_post_meta($post_id,'attachment_id',true);
$slice = explode(',',$attachment_id);
$activepost = get_post($slice[0]);
  echo '<div id="loading"><div class="sticky"></div> <img class="load-image" src="'.esc_url( plugins_url( "/images/f", __FILE__ )).'"></div>';
?> 

<p>TSK-<?php echo $_GET['id'];?></p>
<p class="ndl-Text ndl-Text--body ndl-InlineEditDisplayMode-text"><?php echo $post->post_title; ?></p>
<?php
$plan_id = $_GET['id'];
$type = get_post_meta($plan_id,'type');
// if($type[0] == 'EVENT'){
//  echo '<pre>';
//  print_r($type);
//  echo '</pre>';
//  die();
// }

?>
<div class="view-plan"> 
<div class="tabs">
  <ul>
    <!-- <li><a href="#brief">Brief</a></li> -->
    <li><a href="#content">Content</a></li>
    <!-- <li><a href="#publish">Publishing</a></li> -->
    <!-- <li><a href="#history">History</a></li> -->
  </ul>
  <!-- <div id="brief">
    <header class="ndl-Header ndl-Header--section wr-BriefEmptyState-headerContainer"><h1 class="ndl-HeaderTitle ndl-HeaderTitle--section ndl-HeaderTitle--medium undefined">Add a Creative Brief</h1><p class="ndl-Text ndl-Text--body ndl-HeaderSubHeading ndl-HeaderSubHeading--section undefined">Build your task strategy here, i.e. Key objectives, Audiences, Pillars.</p></header>
    <div class="wr-BriefEmptyState-box"><div class="ndl-Dropdown btn dropdown"><button class="ndl-Button ndl-Button--default ndl-Button--medium    ndl-Dropdown-button" type="button"><span class="ndl-Button-label">Select Brief</span></button></div><span class="wr-BriefEmptyState-separator">or</span><button class="btn ndl-Button ndl-Button--default ndl-Button--medium    " type="button"><span class="ndl-Button-label">Write Brief</span></button></div>
  </div> -->
  <div id="content">
  	<div class="inner-conent">
       <div class="content-navigation-thumbnails"> 
     	 <?php 
       $user = wp_get_current_user();

		if( $activepost != ''){   
        if ( in_array( 'administrator', (array) $user->roles ) || in_array( 'client-admin', (array) $user->roles ) ) {
            ?>
            <div class="ndl-Dropdown add-content">
                <button class="add-article content-article ndl-Button ndl-Button--secondaryAlt ndl-Button--medium ndl-Dropdown-button ndl-Button--iconOnly" type="button">
                    <span class="nc-icon ndl-Icon ndl-Button-icon">
                        <i class="nc-icon-wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16">
                                <g transform="translate(0, 0)"><path fill="#444444" d="M15,7H9V1c0-0.6-0.4-1-1-1S7,0.4,7,1v6H1C0.4,7,0,7.4,0,8s0.4,1,1,1h6v6c0,0.6,0.4,1,1,1s1-0.4,1-1V9h6 c0.6,0,1-0.4,1-1S15.6,7,15,7z"></path></g>
                            </svg>
                        </i>
                    </span>
                </button>
            </div>
        <?php  } } ?>    
            <?php 
            $index = 0;
             echo '<input type="hidden" value="'.$_GET['id'].'" id="task_id">';
             echo '<input type="hidden" value="'.$attachment_id.'" id="selected-post">';
         
         if(!empty(array_filter($slice)) ){
              foreach($slice as $slices){
                $active = $index ==0 ?'active':'';
                $attachment = get_post($slices);
                $imageids = get_post_thumbnail_id($attachment->ID);
                $imageurl = wp_get_attachment_url($imageids); ?>
                <div data="<?php echo $attachment->ID;?>" class="per-thumbnail primary <?php echo $active;?> grid-cl-v3-article-fill"><img width="40" height="30"  class="thumbnail-image" src="<?php echo $imageurl;?>"></div>
                <?php 
                $index++;
              }
         } ?>
         </div>
      <div class="the-content-article">
        <?php   
        include( plugin_dir_path( __FILE__ ) . 'tabconent/conent.php' ); 
        ?>
       </div>
    </div>
  </div>
  <!-- <div id="publish">
  <h2>Checkbox nested in label</h2>
  </div> -->
  <!-- <div id="history">
    <p>History section</p>
  </div> -->
</div>
<div class="right-pane">

  <!-- < ?php
     if( have_rows('create_workflow') ){
          $progess = 0;
          $approved=array();
          $index = 1;
          $index2 = 0;
          
          while( have_rows('create_workflow', $work_data->ID) ) { the_row();
              $approved[]= get_post_meta($_GET['id'],'approve_'.$index,true) !='' ? intval(get_post_meta($_GET['id'],'approve_'.$index,true)):0;
              $index++;
           }
           $total_approved = array_sum($approved);
           $total_workflow =  count(get_field('create_workflow', $work_data->ID));

         if($total_approved != 0){
           if(intval($total_approved)==$total_workflow){
              $total = '100';
           }else{
              $cal = $total_approved/$total_workflow;
              $total = $cal*100;
           }
         }        
     }       
   ?> -->
  <div class="head-progress">
        <?php
          $end = get_post_meta($_GET['id'],'task_end_date',true);
          $list = get_post_meta($_GET['id'],'checklist_marks_1',true);
           
          if($list !=''){
            $total_ = $total;
          }else{
            $total_ = 0;
          }
          $publish = get_post_meta($_GET['id'],'publish_date_'.$total_workflow,true);
          if($publish !='' && $total_ == 100){
            echo '<span class="ndl-Badge ndl-Badge--success  workflow-state-wrapper">Completed</span>';
          }elseif(strtotime($publish) >= strtotime('now') ){
            echo '<span class="ndl-Badge ndl-Badge--error  workflow-state-wrapper" style="backgroud:red;color:#fff;">Overdue</span>'; 
          }else{
            echo '<span class="ndl-Badge ndl-Badge--progress  workflow-state-wrapper">Progress</span>';
          }  
          
          if($publish !='' && $total_ == 100){
            echo '<span class="Completed -date date"><strong>Completed on: </strong>'.date("M d", strtotime($publish)).'</span>';
          }elseif(strtotime($publish) >= strtotime('now') ){
               echo '<span class="due-date date"><strong>Due date: </strong>'.date("M d,Y", strtotime($end)).'</span>';
          }else{ 
            echo '<span class="due-date date"><strong>Due date: </strong>'.date("M d,Y", strtotime($end)).'</span>';
          }
           
         ?>
        <progress id="file" value="<?php echo $total_;?>" max="100"> <?php echo $total_;?>% </progress>
        <?php 
          $start = get_post_meta($_GET['id'],'task_start_date',true);
          echo '<span class="start-date date"><strong>Start date: </strong>'.date("M d,Y", strtotime($start)).'</span>'; 
        ?>
  </div>
	<div class="content-tab-pane">
      <ul>
        <li><a href="#Workflow">Workflow</a></li>
        <li><a href="#Comment">Comment</a></li>
       
      </ul>
      
      <div id="Workflow">
      <div class="workflow-header"><header class="ndl-Header ndl-Header--subsection header-title "><h1 class="ndl-HeaderTitle ndl-HeaderTitle--subsection ndl-HeaderTitle--medium undefined">Content Workflow</h1></header> </div>

        <?php 

        // $total_created_workflows = get_post_meta($work_data->ID,'created_workflows')[0];

        $created_workflow_count = get_post_meta($work_data->ID,'created_workflows')[0];
        $created_workflow_count = ($created_workflow_count == 0) ? 0: $created_workflow_count;
        // titles
        $workflow_titles = get_post_meta($work_data->ID,'workflow_titles')[0];
        $workflow_titles = unserialize($workflow_titles);
        // Descritpions
        $workflow_descriptions = get_post_meta($work_data->ID,'workflow_descriptions')[0];
        $workflow_descriptions = unserialize($workflow_descriptions);

        // for($workflow_counter = 0; $workflow_counter <= $total_created_workflows; $workflow_counter++){
          $index = 1;
        foreach($workflow_titles as $key => $workflow_title){
          $checklist_name = 'checklists'.$key;
          $db_checklists = unserialize(get_post_meta($work_data->ID,$checklist_name)[0]);
          // $index = 1;
          $role = get_post_meta( $_GET['id'],'Qarticle_role_'.$index.'',true);
          $current_user=get_current_user_id();
          $user_data = wp_get_current_user();
          if($current_user == $role){
              $data_id= $index;
          }else if( $user_data->roles[0] =='administrator' || $user_data->roles[0]  == 'client-admin'){
              $data_id= $index;
          }else{
              $data_id= 0;
          }
          $full_name = get_user_meta($role,'first_name',true).' '.get_user_meta($role,'last_name',true);
          $words = explode(' ', $full_name );
          $acronym = strtoupper(substr($words[0], 0, 1) . substr(end($words), 0, 1));
          $approve = (get_post_meta($_GET['id'],'approve_'.$index.'',true) == 1)? 'disabled':'';
          $approve_avatr = (get_post_meta($_GET['id'],'approve_'.$index.'',true) == 1)? '<img src="https://img.icons8.com/officel/80/000000/checked--v1.png"/>':'<span class="avatar-acronym">'.$acronym.'</span>';
          $approve_btn_text = (get_post_meta($_GET['id'],'approve_'.$index.'',true) == 1)? 'Approved':'Approve';
          //Notify User for the Updates
          $assigned_email = get_userdata($role);
          $email = $assigned_email->data->user_email;
                  if( get_post_meta($_GET['id'],'approve_'.$index.'',true) == 1){
                        $wf = $workflow_title;
                          $wf_slug = str_replace(' ', '_', $wf);
                          $from = 'noreply@studioid.com';
                          $to = $email;
                          $subject = $wf." Workflow Updates";
                          $headers = "From: ".$from. "\r\n" ."Reply-To: " . $email . "\r\n";
                          $message .= '<p>Your Task has been updated!</p>';
                          $message .= 'Visit our page '.get_bloginfo( 'url' ).'';
            
                          $email_status = get_post_meta($_GET['id'],$wf_slug );
                          if($email_status == ''|| $email_status == null){
                            $sent = wp_mail($to, $subject,strip_tags($message), $headers);
                            if($sent){
                              update_post_meta($_GET['id'],$wf_slug ,1);
                              //  create logs
                              $post_data =[
                                  'post_title' => 'Workflow Update',
                                  'post_status' => 'publish',
                                  'post_type' => 'workflowlog'
                              ];
                              $Workflow_post_id = wp_insert_post($post_data);
                              update_post_meta($Workflow_post_id,'employee_name',$email);
                            }
                          }
                        }
          //EO Notify user
          $get_current_db_checklists = get_post_meta($work_data->ID,'workflow_checklists');
          $total_checklists = unserialize($get_current_db_checklists[0]);
          echo '<div class="step-header steps-'.$index.'">';
            echo '<div class="step-index">'.$index.'</div>';
            echo '<div class="ndl-Avatar-wrapper ">'.$approve_avatr.'</div>';
            echo '<div class="step-detail">';
              echo '<div class="header-top"><header class="ndl-Header ndl-Header--subsection step-title"><h1 class="ndl-HeaderTitle ndl-HeaderTitle--subsection ndl-HeaderTitle--medium undefined">'.$workflow_title.'</h1></header><a class="view-detail" data="'.$data_id.'" >View Details</a></div>';
              echo '<div class="assignee">'.$full_name.'</div>';
              echo '<div class="tsk-DueDatePicker"><div class="due-date"><span>Step due&nbsp;</span><span class="date">'.get_post_meta( $_GET['id'],'Qarticle_due_date_'.$index.'',true).'</span></div></div>';
          // loop here
          $plan_id = $_GET['id'];
          echo '<div class="checklis" style="display:none;">';
          echo '<ul class="checklist-data-'.$index.'">';
          $checklist_index = 0;
          if(!empty($db_checklists)):
            foreach($db_checklists as $checklist){
              if(get_post_meta($_GET['id'],'approve_'.$index.'',true) == 1){
                $is = 'checked';
                $mark = 'data-checked';
              }else{
                (get_post_meta($plan_id,$index.'_'.$checklist_index)[0] == 1) ? $is = 'checked' : $is = '';
              }
                echo '<li><input data-id="'.$plan_id.'"  '.$approve.' '.$is.' type="checkbox" value="'.$checklist.'" class="progress" checklist-number="'.$checklist_index.'" checklist-position="'.$index.'">'.$checklist.'</li>';  
                $checklist_index ++;
              }
          endif;
          echo '</ul>';
          echo '<div class="workflowdetails">'.$workflow_descriptions[$key].'</div>';
          echo '<div class="list-button"><button act="undo" id="Undo" class="button button-act-'.$data_id.'" >Undo</button><button value="Approved" act="approve" id="Approved" '.$approve.' class="button button-act-'.$data_id.'">'.$approve_btn_text.'</button></div></div>';
          echo '</div>'; 
          echo '</div>'; 
          $index++;
         }//EO created workflow loop
?> 
      </div>
      <!-- Comment Section -->
      <div id="Comment">
        <div class="inner-conent">
          <?php
              $plan_id = $_GET['id'];
              $user_data = get_userdata($current_user);
              $user_email = $user_data->data->user_email;
              $display_name = $user_data->data->display_name;
              global $wpdb;
              $queries = $wpdb->get_results("SELECT * FROM $wpdb->postmeta WHERE `post_id` = $plan_id AND `meta_key` = 'comments' ORDER BY `meta_id`");
              foreach($queries as $query){
                $data =$query->meta_value;
                $comments = unserialize(unserialize($data ));
                foreach($comments as $key => $value){
                  $user_avatar = get_avatar($key);
                  $usr_data = get_userdata($key);
                  if($key != $current_user){
                    echo '<div class="comments-reverse"><p class="user-mail">'.$user_avatar.' </p>';
                    echo '<p class="user-comment" style="background: #bdbdbd6e;"><span class="usr_email">'.$usr_data->data->user_email.'</span><br>'.$value.'</p>';
                    echo '</div>';
                    }
                    else{
                    echo '<div class="comments"><p class="user-mail">'.$user_avatar.' </p>';
                    // echo '<p class="user-comment"><span class="usr_email">'.$usr_data->data->user_email.'</span><br>'.$value.'</p>';
                    echo '<div class="user-comment"><span class="usr_email">'.$usr_data->data->user_email.'</span>
                    <span>
                      <i class="nc-icon-wrapper edit-icon-wrapper">
                        <svg class="edit-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16"><g transform="translate(0, 0)"><path fill="#444444" d="M1,16h3c0.3,0,0.5-0.1,0.7-0.3l11-11c0.4-0.4,0.4-1,0-1.4l-3-3c-0.4-0.4-1-0.4-1.4,0l-11,11 C0.1,11.5,0,11.7,0,12v3C0,15.6,0.4,16,1,16z M2,12.4l10-10L13.6,4l-10,10H2V12.4z"></path></g></svg>
                      </i>
                    </span>
                    <span>
                      <svg fill="#000000" xmlns="http://www.w3.org/2000/svg"  class="delete-icon" id="'.$query->meta_id.'" viewBox="0 0 16 16" width="16px" height="16px"><path d="M 6.496094 1 C 5.675781 1 5 1.675781 5 2.496094 L 5 3 L 2 3 L 2 4 L 3 4 L 3 12.5 C 3 13.328125 3.671875 14 4.5 14 L 10.5 14 C 11.328125 14 12 13.328125 12 12.5 L 12 4 L 13 4 L 13 3 L 10 3 L 10 2.496094 C 10 1.675781 9.324219 1 8.503906 1 Z M 6.496094 2 L 8.503906 2 C 8.785156 2 9 2.214844 9 2.496094 L 9 3 L 6 3 L 6 2.496094 C 6 2.214844 6.214844 2 6.496094 2 Z M 5 5 L 6 5 L 6 12 L 5 12 Z M 7 5 L 8 5 L 8 12 L 7 12 Z M 9 5 L 10 5 L 10 12 L 9 12 Z"/></svg>
                    </span>
                    <br><span class="comment-value wf-comments" cols="30" rows="5"  >'.$value.'</span><br><button  user-id="'.$key.'" id="'.$query->meta_id.'" class="update-btn">Update</button></div>';
                    echo '</div>';
                    }
                }

              }
          ?>
            <form action="" method="post" id="comment-form">
            <input type="hidden" value="<?php echo $current_user; ?>" name="commentor-id" id="commentor-id" data-plan="<?php  echo $plan_id;?>" user-data="<?php echo $current_user; ?>">
           <textarea name="wf-comments" class="wf-comments"  id="wf-comments" cols="30" rows="5"></textarea>
           <button class="comment-btn" id="submit-comment">submit</button>
          </form>
        </div>
      </div>
    </div>
</div>
</div>
<style>
.right-pane span.ndl-Badge {
    position: absolute;
    top: -32px;
    left: -59px;
    text-transform: uppercase;
    font-size: 10px;
    font-weight: 600;
    background: #f5f7fa;
    border-radius: 4px;
    padding: 3px 8px;
}

.right-pane .ndl-Badge--success {
    background: #07bb00 !important;
    color: #fff;
}
span.Completed.-date.date {
    font-size: 11px;
    float: right;
    font-weight: 600;
}
/* IE10 */
progress {
    color: blue;
    border: none;
    width: 300pt;
    height: 8px;
}

/* Firefox */
progress::-moz-progress-bar {
    background: #07bb00;
    border:none;
    width: 300pt;
    height: 8px;
}

/* Chrome */
progress::-webkit-progress-value {
    background: #07bb00;
    border: none;
    width: 300pt;
    height: 8px;
}

/* Polyfill */
progress[aria-valuenow]:before {
    background: #039619;
    border: none;
    width: 300pt;
    height: 5px;
}

progress {
    -webkit-appearance: none;
    appearance: none;
}

progress::-webkit-progress-bar {
    background-color: whitesmoke;
}

progress[value] {
    -webkit-appearance: none;
    appearance: none;
}

progress[value]::-webkit-progress-value {
    border-radius: 4px;
    background-size: 35px 20px, 100% 100%, 100% 100%;
}
span.start-date.date {
    font-size: 10px;
    font-weight: bold;
}
span.due-date.date {
    float: right;
    font-size: 10px;
    color: #f00000;
}
.head-progress {
    background: #fff;
    padding-bottom: 25px;
}
.head-progress progress#file {
    width: 100%;
}
.ndl-Avatar-wrapper span.avatar-acronym {
    display: block;
    width: 35px;
    text-align: center;
    height: 35px;
    background: #b6b6b6;
    color: #fff;
    border-radius: 50%;
    font-size: 17px;
    line-height: 2;
    margin-right: 12px;
}
.view-plan {
    display: flex;
}
.list-button {
    text-align: right;
    margin-top: 20px;
}

.list-button .button {
    font-size: 12px;
    display: inline-block;
    vertical-align: top;
    font-weight: bold;
    padding: 0px 11px;
    color: #fff;
    border: none;
    margin-left: 10px;
    background: transparent;
}

.list-button button#Undo {
    color: #4655d7;
}

.list-button 
 button#Approved {
    background: #4655d7;
}
.assignee {
    text-transform: capitalize;
    margin: 4px 0px;
}
a.view-detail {
    margin-left: 5px;
    float: right;
    font-size: 12px;
    color: #313cb1;
    width: 29%;
    cursor: pointer;
    font-weight:600;
}

.header-top header.ndl-Header.ndl-Header--subsection.step-title {
    width: 67%;
    float: left;
    overflow: hidden;
}
.step-detail {
    width: 100%;
}
.step-detail {
    width: 100%;
}
.header-top {
  display: flex;
  overflow: hidden;
}
.step-header.open {
    background: #fcfdff;
}

.step-header {
    display: flex;
    padding: 0 20px;
    padding-bottom: 24px;
    padding-top: 20px;
}
.step-header .step-index {
    font-size: 15px;
    margin-right: 5px;
    padding-top: 6px;
}

.step-header .ndl-Avatar-wrapper img {
    width: 35px;
    border-radius: 50%;
    margin-right: 10px;
}
h1.ndl-HeaderTitle.ndl-HeaderTitle--subsection.ndl-HeaderTitle--medium.undefined {
    font-size: 16px;
    font-weight: 600;
    line-height: 20px;
    margin:0;
}
.step-header:hover {
    background: #fcfdff;
}
div#Workflow {
    padding: inherit;
}

.workflow-header {
    padding:20px;
}

/*-----------*/
ul.ui-tabs-nav {
    border: none;
    background: none;
    /* border-bottom: solid 1px #9694b3; */
    /* position: absolute; */
    margin-bottom: -4px !important;
}
ul.ui-tabs-nav li.ui-tabs-tab a {
    box-shadow:none !important;
}
.tabs {
    border: none !important;
}
.tabs {
    border: none;
    position: relative;
    width: 65%;
    float: left;
}
.is-style-rounded img {
    border-radius: 45%;
}
ul.ui-tabs-nav li.ui-tabs-tab {
    background: none;
    border: none;
    color:#74748b;
    font-size: 16px;
    line-height: 20px;
    margin-bottom: -1px;
    padding: 8px 12px;
    text-align: center;
    padding-bottom: 17px;
}
.fc-daygrid-event-harness {
    border-left: solid 4px #dc0404;
}
.right-pane ul.ui-tabs-nav {
    padding: 0;
    background: #fff;
    border-bottom: solid 1px #cbcbcb;
}
.tsk-ContentLabels .ui-accordion-header {    color: #191932 !important;}
.tsk-ContentLabels .ui-accordion .ui-accordion-content.ndl-Labels-container{
    padding: 0 12px !important;
    border: none !important;
        margin-top: 10px;
}
div#brief {
    text-align: center;
}
div#brief .wr-BriefEmptyState-box .btn {
    display: inline-block;
}
button.ndl-Button.ndl-Button--default.ndl-Button--medium.ndl-Dropdown-button {}

div#brief  button {
    background: transparent;
    border: solid 1px #bdbdbd;
    border-radius: 4px;
    /* width: 97px; */
    display: flex;
    padding: 7px 14px;
    margin: 10px;
    color: #4655d7;
    font-weight: bold;
}
ul.ui-tabs-nav li.ui-tabs-tab.ui-tabs-active.ui-state-active {
    border: solid 1px!important;
    border-bottom: none !important;
    /* color: #000 !important; */
    background: #fff;
    height: 31px;
    border-color: #ccccdc #ccccdc transparent !important;
}
ul.ui-tabs-nav li.ui-tabs-tab a{
    padding:0 !important;.
}
ul.ui-tabs-nav li.ui-tabs-tab.ui-tabs-active.ui-state-active a {
    color: #191932;
    
}
.ui-tabs-panel {
    border-top: solid 1px !important;
    border-color: #ccccdc #ccccdc transparent !important;
}
.right-pane {
    float: left;
    width: 30%;
    min-height: 228px;
    background: #f5f7fa;
    margin: 16px;
    position: relative;
}

.right-pane .content-tab-pane {
    padding: 0;
    background: none;
    border: none;
}
.right-pane .content-tab-pane .ui-widget-content,
.right-pane .content-tab-pane  ul.ui-tabs-nav li.ui-tabs-tab {
    border: none !important;
}
.right-pane .content-tab-pane ul.ui-tabs-nav li.ui-tabs-tab.ui-state-active  a{
    border-bottom: solid 2px !important;
    border-color: #4655d7 !important;
    color: #191932;
    cursor: default;
    font-weight: 600;
}
.right-pane .content-tab-pane ul.ui-tabs-nav li.ui-tabs-tab a {
    font-size: 14px;
    line-height: 20px;
    margin-right: 25px;
    padding-bottom: 5px !important;
}

.right-pane .content-tab-pane ul.ui-tabs-nav li.ui-tabs-tab {
    height: auto !important;
    padding: 0;
    margin:0 !important;
}
div#loading {
    position: fixed;
    text-align: center;
    top: 0;
    background: #f4f4f426;
    width: 100%;
    height: 100%;
    z-index: 99;
    left: 0;
    display:none;
}

div#loading img.load-image {
    position: absolute;
    top: 50%;
}
.wrap-article {
    padding: 20px;
    border: solid 1px #e4e4e4;
    overflow:hidden;
}
</style>

