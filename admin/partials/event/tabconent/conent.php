<?php 
  $post = get_post($_GET['id']);
 
      $post_id = $post->ID;
      $task_start_date=  get_post_meta($post_id,'task_start_date',true);
      $task_end_date = get_post_meta($post_id,'task_end_date',true);
      $attachment_id =get_post_meta($post_id,'attachment_id',true);
      $imageids = get_post_meta($attachment_id,'upload_image',true);

      $slice = explode(',',$attachment_id);
      $activepost = get_post($slice[0]);
      $user = wp_get_current_user();
      if(!empty($activepost)){
      
      $getuser = get_userdata($activepost->post_author);

      echo '<div class="wrap-article">';
    ?>
      <div class="ndl-Grid-container">
          <div class="ndl-GridItem ndl-GridItem--alignLeft" data-size="3">
              <button class="ndl-Button ndl-Button--inline ndl-Button--medium primary-content-button" type="button">
                  <span class="nc-icon ndl-Icon ndl-Button-icon">
                      <i class="nc-icon-wrapper">
                          <svg viewBox="0 0 12 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <mask id="path-1-outside-1" maskUnits="userSpaceOnUse" x="0" y="0" width="12" height="19" fill="black">
                                  <rect fill="white" width="12px" height="19px"></rect>
                                  <path fill-rule="evenodd" clip-rule="evenodd" d="M10.6 1H1V9V12.2V17L5.8 13.8L10.6 17V12.2V9V1Z"></path>
                              </mask>
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M10.6 1H1V9V12.2V17L5.8 13.8L10.6 17V12.2V9V1Z" fill="#4ECFD5"></path>
                              <path
                                  d="M1 1V0H0V1H1ZM10.6 1H11.6V0H10.6V1ZM1 17H0V18.8685L1.5547 17.832L1 17ZM5.8 13.8L6.3547 12.9679L5.8 12.5981L5.2453 12.9679L5.8 13.8ZM10.6 17L10.0453 17.832L11.6 18.8685V17H10.6ZM1 2H10.6V0H1V2ZM2 9V1H0V9H2ZM2 12.2V9H0V12.2H2ZM2 17V12.2H0V17H2ZM5.2453 12.9679L0.4453 16.1679L1.5547 17.832L6.3547 14.632L5.2453 12.9679ZM11.1547 16.1679L6.3547 12.9679L5.2453 14.632L10.0453 17.832L11.1547 16.1679ZM9.6 12.2V17H11.6V12.2H9.6ZM9.6 9V12.2H11.6V9H9.6ZM9.6 1V9H11.6V1H9.6Z"
                                  fill="white"
                                  mask="url(#path-1-outside-1)"
                              ></path>
                          </svg>
                      </i>
                  </span>
                  <span class="ndl-Button-label"><p class="ndl-Text ndl-Text--secondary">Primary Article</p></span>
              </button>
          </div>
          <div class="ndl-GridItem ndl-GridItem--alignCenter" data-size="2"></div>
          <div class="ndl-GridItem ndl-GridItem--alignLeft right-data" data-size="3">
              <div class="tsk-ContentActions">
                  <div class="ndl-Dropdown tsk-ContentActions-articleDownload">
                      <button class="download-article ndl-Button ndl-Button--secondaryAlt ndl-Button--medium ndl-Dropdown-button ndl-Button--iconOnly" type="button">
                          <span class="nc-icon ndl-Icon ndl-Button-icon">
                              <i class="nc-icon-wrapper">
                                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16">
                                      <g transform="translate(0, 0)">
                                          <path fill="#444444" d="M8,12c0.3,0,0.5-0.1,0.7-0.3L14.4,6L13,4.6l-4,4V0H7v8.6l-4-4L1.6,6l5.7,5.7C7.5,11.9,7.7,12,8,12z"></path>
                                          <rect data-color="color-2" x="1" y="14" fill="#444444" width="14" height="2"></rect>
                                      </g>
                                  </svg>
                              </i>
                          </span>
                      </button>
                  </div>
                  <button class="ndl-Button ndl-Button--secondaryAlt ndl-Button--medium tsk-ContentActions-comment ndl-Button--iconOnly" type="button">
                      <span class="nc-icon ndl-Icon ndl-Button-icon">
                          <i class="nc-icon-wrapper">
                              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16">
                                  <g transform="translate(0, 0)">
                                      <path
                                          fill="#444444"
                                          d="M13,15H1c-0.8,0-1.3-0.9-0.8-1.6L3,9.7V4c0-1.7,1.3-3,3-3h7c1.7,0,3,1.3,3,3v8C16,13.7,14.7,15,13,15z M3,13 h10c0.6,0,1-0.4,1-1V4c0-0.6-0.4-1-1-1H6C5.4,3,5,3.4,5,4v6c0,0.2-0.1,0.4-0.2,0.6L3,13z"
                                      ></path>
                                      <rect data-color="color-2" x="7" y="5" fill="#444444" width="5" height="2"></rect>
                                      <rect data-color="color-2" x="7" y="9" fill="#444444" width="5" height="2"></rect>
                                  </g>
                              </svg>
                          </i>
                      </span>
                  </button>
                  <button  href="<?php echo site_url();?>/wp-admin/post.php?post=<?php echo $activepost->ID; ?>&action=edit" class="ndl-Button ndl-Button--secondaryAlt ndl-Button--medium tsk-ContentActions-edit ndl-Button--iconOnly edit-article" type="button">
                      <span class="nc-icon ndl-Icon ndl-Button-icon">
                          <i class="nc-icon-wrapper">
                              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16">
                                  <g transform="translate(0, 0)">
                                      <path fill="#444444" d="M1,16h3c0.3,0,0.5-0.1,0.7-0.3l11-11c0.4-0.4,0.4-1,0-1.4l-3-3c-0.4-0.4-1-0.4-1.4,0l-11,11 C0.1,11.5,0,11.7,0,12v3C0,15.6,0.4,16,1,16z M2,12.4l10-10L13.6,4l-10,10H2V12.4z"></path>
                                  </g>
                              </svg>
                          </i>
                      </span>
                  </button>
                 
                  <div class="tsk-ContextMenu tsk-ContextMenu--single">
                      <div class="ndl-Dropdown tsk-ContextMenu-dropdown">
                          <button  class="ndl-Button ndl-Button--secondaryAlt ndl-Button--small ndl-Dropdown-button ndl-Button--iconOnly" type="button">
                              <span class="nc-icon ndl-Icon ndl-Button-icon">
                                  <i class="nc-icon-wrapper">
                                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16">
                                          <g transform="translate(0, 0)">
                                              <circle data-color="color-2" fill="#444444" cx="8" cy="8" r="2"></circle>
                                              <circle fill="#444444" cx="2" cy="8" r="2"></circle>
                                              <circle fill="#444444" cx="14" cy="8" r="2"></circle>
                                          </g>
                                      </svg>
                                  </i>
                              </span>
                          </button>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <header class="ndl-Header ndl-Header--section">
          <h1 class="ndl-HeaderTitle ndl-HeaderTitle--page ndl-HeaderTitle--medium undefined"><?php echo $activepost->post_title;?></h1>
          <p class="ndl-Text ndl-Text--caption ndl-HeaderCaption ndl-HeaderCaption--section"><?php echo $getuser->roles[0]; ?> • By <?php echo $getuser->data->display_name;?></p>
      </header>

      <?php 
      echo '<div id="article-content" class="content-preview-body">';
      
          echo $activepost->post_content;
      echo '</div>';
      echo '<div id="toPdf"></div>';
      echo '<div class="tsk-ContentLabels">';
        echo '<div class="ndl-AccordionTitle">';
          echo '<div id="accordion">';
           

          echo ' <h3>Labels</h3>';
   
          echo '<div class="ndl-Labels-container">';
          
          if($activepost->post_type =='article'){

            $labels = array('target_Audience','content_pillars','content_format','journey_stage','project_stage');
            foreach($labels as $label){
              $data = get_post_meta($activepost->ID,$label);
              if(empty( $data[0])) continue;
              $rep = str_replace("_"," ",$label);
              echo '<span class="ndl-Labels-type">'.ucfirst($rep).'</span>'; 
              
              foreach($data as $datas){
                $items = unserialize($datas);
                foreach($items as $item){
                    echo '<span class="ndl-Labels-item"><div class="ndl-Pill ndl-Pill--medium "><span class="ndl-Pill-title ">'.$item.'</span></div></span>';
                }
              }
  
            }
            
          }
          echo '</div>';

          echo '</div>';
        echo '</div>';
      echo '</div>';
      echo '</div>';
      }else{
        ?>
        <div class="add-article-wrap">
          <?php  if ( in_array( 'administrator', (array) $user->roles ) || in_array( 'client-admin', (array) $user->roles ) ) { ?>
          <button class="add-article content-article ndl-Button ndl-Button--secondaryAlt ndl-Button--medium ndl-Dropdown-button ndl-Button--iconOnly" type="button">
            <span class="nc-icon ndl-Icon ndl-Button-icon">
                <i class="nc-icon-wrapper">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16">
                        <g transform="translate(0, 0)"><path fill="#444444" d="M15,7H9V1c0-0.6-0.4-1-1-1S7,0.4,7,1v6H1C0.4,7,0,7.4,0,8s0.4,1,1,1h6v6c0,0.6,0.4,1,1,1s1-0.4,1-1V9h6 c0.6,0,1-0.4,1-1S15.6,7,15,7z"></path></g>
                    </svg>
                </i>
            </span>
          </button>
          <?php } ?>
          <span class="text" >No Content Found!</span>
        </div>
        
         <?php
      }
       
      //echo $imageurl ;

?> 
<div class="modal-here">
        </div>
<style>
.ui-accordion-header {
    background: transparent !important;
    border: none !important;
  
}
.add-article-wrap {
    text-align: center;
}

.add-article-wrap span.text {
    display: block;
    margin-top: 15px;
    font-size: 20px;
}
.ndl-Pill {
    background-color: #ededf4;
    border-radius: 3px;
    color: #474759;
    display: inline-block;
    font-size: .75rem;
    line-height: 12px;
    padding: 4px 8px;
    margin: 6px 0;
}
.tsk-ContentLabels .ui-accordion .ui-accordion-content.ndl-Labels-container {
    height: auto !important;
}
.ndl-Labels-item, .ndl-Labels-title, .ndl-Labels-type {
    margin-bottom: 4px;
    margin-right: 8px;
    margin-top: 4px;
}
 .ndl-Grid-container .ndl-GridItem--alignLeft {
    float: left;
}

.ndl-Grid-container .ndl-GridItem .primary-content-button {
    display: flex;
    background: transparent;
    border: none;
}

.ndl-Grid-container .ndl-GridItem .primary-content-button span p {
    display: block;
    font-size: 11px !important;
    margin-top: 0;
    margin-left: 7px;
}

.ndl-Grid-container .ndl-GridItem .primary-content-button span svg {
    width: 10px;
}
.ndl-Grid-container {
    display: flex;
}

.ndl-GridItem.ndl-GridItem--alignCenter {
    width: 40%;
}

.ndl-GridItem.ndl-GridItem--alignLeft {
    width: 30%;
}
 
 
.tsk-ContentLabels {
    border: 1px solid #ededf4;
    border-top: none;
    padding: 10px;
}
.ndl-Labels-container span.ndl-Labels-type {
    display: block;
    color: #191932;
    font-size: .75rem;
    text-transform: uppercase;
}
.content-navigation-thumbnails .per-thumbnail.primary.active {
    border: 3px solid #4655d7;
    margin-bottom: 20px;
}
.content-preview-body {
    padding: 0px 0px 10px;
    display: flex;
    flex-direction: column;
}
.content-navigation-thumbnails {display: flex;line-height: 0;}
.content-navigation-thumbnails .per-thumbnail {
    border-radius: 7px;
    width: 37px;
    height: 25px;
    display: inline-block;
    margin-right: 8px;
    border: 3px solid #000000;
    overflow: hidden;
    cursor: pointer;
}
.inner-conent {
    padding: 30px !important;
}
.content-preview-body .wp-die-message, .content-preview-body p {
  font-size: 18px !important;
  line-height: 1.5 !important;
}
.content-preview-body  ul li {
    font-size: 18px;
    line-height: 1.5;
}
.content-preview-body  ul li {
    font-size: 18px;
}
.content-preview-body h2, .content-preview-body h3 {
    font-size: 24px;
}
.right-data .tsk-ContentActions {
    display: flex;
    text-align: right;
    padding-left: 34px;
}
.right-data .tsk-ContentActions button {
    background: transparent;
    border: none;
    margin-right: 10px;
    cursor: pointer;
}
.wrap-article {
    padding: 20px;
    border: solid 1px #e4e4e4;
    overflow:hidden;
    overflow:hidden;
}
.right-data .tsk-ContentActions svg {
    width: 12px;
}
button.add-article {
    width: 40px;
    height: 31px;
    margin-right: 10px;
    border: 1px dashed #4655d7;
    background: transparent;
    border-radius: 8px;
    position:relative;
    cursor: pointer;
}
button.add-article .nc-icon svg path{fill:#4655d7;}
button.add-article .nc-icon {
    color: #4655d7;
    position: absolute;
    top: 50%;
    transform: translate(-50%,-50%);
    left: 50%;
    height:14px;
    width:14px;
}
</style>
<script>
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
     success: function(response) {
            jQuery('.modal-here').html(response);
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
                      jQuery('#add-data').click(function (){    
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
                             if( response== 'success'){
                               location.reload();
                             }
                             //console.log('saved');
                             // 
                             console.log(response);
                           }
                        }); 
                      });  
           });     
                    
     }
  });

});  
</script>