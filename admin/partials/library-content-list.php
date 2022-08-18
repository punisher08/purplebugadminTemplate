<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       wp_puple_bug
 * @since      1.0.0
 *
 * @package    Purple
 * @subpackage Purple/admin/partials
 */

 global $wpdb;
 
  $user_id = get_current_user_id();
   $user = wp_get_current_user();
    
    if ( !in_array( 'administrator', (array) $user->roles ) ) {
      //The user has the "author" role
        $go = "and post_author=".$user_id."";
    }
 

  $items_per_page = 30;
  $page = isset( $_GET['cpage'] ) ? abs( (int) $_GET['cpage'] ) : 1;
  $offset = ( $page * $items_per_page ) - $items_per_page;
 

    if(isset($_GET['s']) && $_GET['s'] != ''){
      $search = "and post_title LIKE '%".$_GET['s']."%' ";
    }else{
       $search = "";
    }

   $total_query = "SELECT * FROM `".$wpdb->prefix."posts` where post_type='attachment' ".$go." and post_status='inherit' ".$search ." ORDER BY `ID` DESC";
   $total = $wpdb->get_var( $total_query );

 
   $Query = "SELECT * FROM `".$wpdb->prefix."posts` where post_type='attachment' ".$go." and post_status='inherit' ".$search ." ORDER BY `ID` DESC LIMIT ".$offset.", ".$items_per_page." ";


   $get_attacment = $wpdb->get_results( $Query );

    
        

     


   


   
 
?>



<!-- This file should primarily consist of HTML with a little bit of PHP. -->


 

<div class="library-LibraryPage">
    			<header class="ndl-Header ndl-Header--page library-LibraryPage-title">
    				 <div class="head-sticky">
                <h1 class="ndl-HeaderTitle ndl-HeaderTitle--page ndl-HeaderTitle--medium undefined">List</h1>

                <div class="header-filter">
                  <div class="header-left">
                    <form action="<?php echo site_url(); ?>/wp-admin/admin.php?page=library" id="search-lib" method="GET">  
                    <div class="form-field serch-field">
                    <input class="ndl-Input-input " name="s" type="text" placeholder="Search Library" value="<?php echo  isset($_GET['s']) && $_GET['s'] != '' ? $_GET['s']:''; ?>">
                      <span class="nc-icon ndl-Icon   ndl-Input-icon nc-click-hover"><i class="nc-icon-wrapper"><svg viewBox="0 0 16 17" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><desc>Created with Sketch.</desc><defs></defs><g id="UI" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="16" transform="translate(-217.000000, -399.000000)" fill="#444444"><path d="M229.7,410.3 C230.6,409.1 231.1,407.7 231.1,406.1 C231.1,402.2 228,399 224.1,399 C220.2,399 217,402.2 217,406.1 C217,410 220.2,413.2 224.1,413.2 C225.7,413.2 227.2,412.7 228.3,411.8 L231.3,414.8 C231.5,415 231.8,415.1 232,415.1 C232.2,415.1 232.5,415 232.7,414.8 C233.1,414.4 233.1,413.8 232.7,413.4 L229.7,410.3 L229.7,410.3 Z M224.1,411.1 C221.3,411.1 219,408.9 219,406.1 C219,403.3 221.3,401 224.1,401 C226.9,401 229.2,403.3 229.2,406.1 C229.2,408.9 226.9,411.1 224.1,411.1 L224.1,411.1 Z" id="Fill-191"></path></g></g></svg></i></span>
                    <input type="hidden" name="page" value="library" type="text">
                    
                  </div>
                    <div class="form-field-submit">
                    <input type="submit" name="search" value="Search">
                    </div>
                  </form>
                     
                     
                  </div>
                  <div class="header-right">
                    <div class="ndl-ViewSwitcher ndl-ViewSwitcher--large view-switcher"><span class="nc-icon ndl-Icon   ndl-ViewSwitcher-icon nc-click-hover"><i class="nc-icon-wrapper"><svg class="active"  data="list" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16"><g transform="translate(0, 0)"><rect x="6" y="1" fill="#444444" width="10" height="2"></rect><rect x="6" y="7" fill="#444444" width="10" height="2"></rect><rect x="6" y="13" fill="#444444" width="10" height="2"></rect><path data-color="color-2" fill="#444444" d="M3,0H1C0.4,0,0,0.4,0,1v2c0,0.6,0.4,1,1,1h2c0.6,0,1-0.4,1-1V1C4,0.4,3.6,0,3,0z"></path><path data-color="color-2" fill="#444444" d="M3,6H1C0.4,6,0,6.4,0,7v2c0,0.6,0.4,1,1,1h2c0.6,0,1-0.4,1-1V7C4,6.4,3.6,6,3,6z"></path><path data-color="color-2" fill="#444444" d="M3,12H1c-0.6,0-1,0.4-1,1v2c0,0.6,0.4,1,1,1h2c0.6,0,1-0.4,1-1v-2C4,12.4,3.6,12,3,12z"></path></g></svg></i></span><span class="nc-icon ndl-Icon   ndl-ViewSwitcher-icon is-active nc-click-hover"><i class="nc-icon-wrapper"><svg data="grid" viewBox="0 0 14 14" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><desc>Created with Sketch.</desc><defs></defs><g id="0522-v1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="Artboard-2" transform="translate(-708.000000, -1212.000000)" fill="#888888"><g id="Group" transform="translate(708.000000, 1212.000000)"><g id="Group-6"><path d="M5.25,0 L0.875,0 C0.35,0 0,0.35 0,0.875 L0,5.25 C0,5.775 0.35,6.125 0.875,6.125 L5.25,6.125 C5.775,6.125 6.125,5.775 6.125,5.25 L6.125,0.875 C6.125,0.35 5.775,0 5.25,0" id="Fill-132"></path><path d="M13.125,0 L8.75,0 C8.225,0 7.875,0.35 7.875,0.875 L7.875,5.25 C7.875,5.775 8.225,6.125 8.75,6.125 L13.125,6.125 C13.65,6.125 14,5.775 14,5.25 L14,0.875 C14,0.35 13.65,0 13.125,0" id="Fill-133"></path><path d="M5.25,7.875 L0.875,7.875 C0.35,7.875 0,8.225 0,8.75 L0,13.125 C0,13.65 0.35,14 0.875,14 L5.25,14 C5.775,14 6.125,13.65 6.125,13.125 L6.125,8.75 C6.125,8.225 5.775,7.875 5.25,7.875" id="Fill-134"></path><path d="M8.75,7.875 C8.225,7.875 7.875,8.225 7.875,8.75 L7.875,13.125 C7.875,13.65 8.225,14 8.75,14 L13.125,14 C13.65,14 14,13.65 14,13.125 L14,8.75 C14,8.225 13.65,7.875 13.125,7.875 L8.75,7.875 Z" id="Fill-135"></path></g></g></g></g></svg></i></span></div>

                      <div class="create-folder display-flex library-button-parents">
                          <!-- <button class="open-folder ndl-Button ndl-Button--default ndl-Button--medium action-panel-button" type="button">
                      <span class="ndl-Button-label">Create Folder</span></button> -->

                      <button url="<?php echo plugin_dir_url( __FILE__ ) . 'library-content.php'; ?>" class="ndl-Button ndl-Button--primary ndl-Button--medium action-panel-button" id="wk-button" a type="button"><span class="ndl-Button-label">Upload</span></button>
                      </div>
                    </div>
                </div>  

             
            </div>
         
            <div class="media-library <?php echo get_option('library_content'); ?>">
            <?php  if(!empty($get_attacment)){ ?>
                      
            <?php if( isset($_GET['s'] ) && $_GET['s'] != '' ) {?>
               <div class="ndl-Breadcrumbs ndl-Breadcrumbs--medium "><div class="ndl-Breadcrumbs-item  "><?php echo count($get_attacment)?> results for "<?php echo isset($_GET['s']) && $_GET['s'] != '' ? $_GET['s']: '';?>"</div></div> 
            <?php } ?>  
              <div class="wrapper">
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
              </div> 
              <?php } else{ ?>

                  <div class="media-library">

                            <div class="ndl-Breadcrumbs ndl-Breadcrumbs--medium "><div class="ndl-Breadcrumbs-item  ">No results for "<?php echo isset($_GET['s']) && $_GET['s'] != '' ? $_GET['s']: '';?>"</div></div> 

                            <div class="new-empty-state ndl-EmptyState"><header class="ndl-Header ndl-Header--section ndl-EmptyState-header"><h1 class="ndl-HeaderTitle ndl-HeaderTitle--section ndl-HeaderTitle--medium undefined">No assets found</h1></header><div class="ndl-EmptyState-subheader "><p class="ndl-Text ndl-Text--secondary ">Have you tried removing filters to find what you are looking for?<br>You can also contact an account admin to upload and share assets with you.</p></div><img class="ndl-EmptyState-illustration" src="https://cdn-app.welcomesoftware.com/static/images/add-files.png?version=2ddf9254db1c0809ff4b4a60caebd1c1" width="375"></div> 
                        </div>
                

              <?php } ?>
           </div>   

    
    			</header>

 
    			
					<div class="lib-drawer">
						<div class="drawer-content">
							<div class="library-preview-top-panel">
								<div class="panel">
                  <div class="panel-button">
                    <button class="ndl-Button ndl-Button--primary ndl-Button--medium    preview-action-button" type="button"><span class="ndl-Button-label">Create Task</span></button>
                  </div>

                  <div class="close-container">
                    <button class="ndl-Button ndl-Button--secondaryAlt ndl-Button--medium    clickable-icon ndl-Button--iconOnly" type="button"><span class="nc-icon ndl-Icon   ndl-Button-icon "><i class="nc-icon-wrapper"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16"><g transform="translate(0, 0)"><path fill="#444444" d="M14.7,1.3c-0.4-0.4-1-0.4-1.4,0L8,6.6L2.7,1.3c-0.4-0.4-1-0.4-1.4,0s-0.4,1,0,1.4L6.6,8l-5.3,5.3 c-0.4,0.4-0.4,1,0,1.4C1.5,14.9,1.7,15,2,15s0.5-0.1,0.7-0.3L8,9.4l5.3,5.3c0.2,0.2,0.5,0.3,0.7,0.3s0.5-0.1,0.7-0.3 c0.4-0.4,0.4-1,0-1.4L9.4,8l5.3-5.3C15.1,2.3,15.1,1.7,14.7,1.3z"></path></g></svg></i></span></button>
                  </div>
                </div>
							</div>
							<div class="inner-content">
								 
							</div>	
						</div>
					</div>
    				
    			</div>
    		</div>


 
 <script>


   lib_detail_list();
   view_switcher();
   wp_medi_loader();
   create_folder();

 </script>
 <style>
 .title-with-image {
    display: flex;
}

.title-with-image p.ndl-Text {
    margin-left: 15px;
}
table#lib-list-view thead tr {
    font-family: proxima-nova-n7,proxima-nova,Helvetica,Arial,sans-serif;
    font-weight: 700;
    font-style: normal;
    background: #ededf4;
    color: #74748b;
    display: table-row;
}

table#lib-list-view tbody tr  {
    display: table-row;
    border-top: 1px solid #ccccdc;
}

.title-with-image img.thumbnail {
    height: 22px;
    margin-top: 12px;
    width: 22px;
    height: 22px;
    border-radius: 3px;
    object-fit: cover;
    border: solid 1px #e8e8e8;
}
table#lib-list-view tbody tr td {
  padding: 0 10px !important;
}
table#lib-list-view thead tr th ,table#lib-list-view tbody tr td {
    border: none !important;
    padding: 10px 10px;
    text-align: left;
    line-height: 1.2;
}
table#lib-list-view input.get-details {
    visibility: hidden;
}

table#lib-list-view tbody tr:hover input.get-details,
table#lib-list-view tbody tr:hover{
    background-color: #f5f7fa;
    cursor: pointer;
    visibility: visible;
}
.notice.notice-info {
    display: none;
}

table#lib-list-view tbody tr td {
    border-top: 1px solid #ccccdc !important;
  
}
.panel-button button {
    background: #4655d7;
    color: #fff;
    border: none;
    border-radius: 4px;
    font-size: 14px;
    padding: 9px 12px;
    cursor: pointer;
}
table#lib-list-view {
    border-collapse: collapse;
}
.panel-button {
    float: left;
    display: flex;
}
.library-preview-top-panel {
    padding: 13px 16px;
    display: flex;
    align-items: center;
    height: 36px;
    top: 0;
    background: #fff;
    box-shadow: 0 1px 3px 0.5px rgb(0 0 0 / 10%);
    z-index: 1;
}
.acf-field-checkbox td.acf-input {
    padding-bottom: 13px;
}

td.acf-input {
    padding-bottom: 10px !important;
}

td.acf-input ul.acf-checkbox-list.acf-hl li {
    margin-right: 15px;
    margin-bottom: 8px;
    width: 130px;
}
p.description {
    position: absolute;
    top: 0;
    font-size: 14px;
    font-weight: bold;
}

ul.acf-checkbox-list.acf-hl {
    width: 100%;
    padding-top: 30px;
    border-bottom: solid 1px #efefef;
    padding-bottom: 15px;
}
#journey_stage ul.acf-checkbox-list li {
    width: 200px;
}
p#alt-text-description,
p.media-types.media-types-required-info,
tr.compat-field-acf-form-data,tr.compat-field-lib_content_type,
tr.compat-field-attachment_category {
    display: none;
}
.attachment-details {
    border-bottom: solid 1px #e6e6e6;
}
td.acf-label {
    display: none;
}
td.acf-input {
    position: relative;
}
 </style>

  		