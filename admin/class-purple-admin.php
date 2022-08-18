<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       wp_puple_bug
 * @since      1.0.0
 *
 * @package    Purple
 * @subpackage Purple/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Purple
 * @subpackage Purple/admin
 * @author     John Ricardo Porras <porrasjohnricardo530@gmail.com>
 */
class Purple_Admin {
	 
	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		//$this->$dashboard_listing_stats = 'dashboard_listing_stats';

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Purple_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Purple_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/purple-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name.'jQueyUI_CSS', plugin_dir_url( __FILE__ ) . 'css/jquery-ui.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name.'fontawesome', 'https://use.fontawesome.com/releases/v5.14.0/css/all.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name.'jQury_CSS_modal', plugin_dir_url( __FILE__ ) . 'css/jquery.modal.min.css', array(), $this->version, 'all' );

		wp_enqueue_style( $this->plugin_name.'data_table', plugin_dir_url( __FILE__ ) . 'css/jquery.dataTables.min.css', array(), $this->version, 'all' );

		wp_enqueue_style( $this->plugin_name.'fullcalendar', plugin_dir_url( __FILE__ ) . 'css/main.min.css', array(), $this->version, 'all' );

		wp_enqueue_style( $this->plugin_name.'daterangepicker', plugin_dir_url( __FILE__ ) . 'css/daterangepicker.css', array(), $this->version, 'all' );
		if(get_post_type($_GET['post']) == 'workflow'){
		?>
			<style>
				div#minor-publishing,
				div#edit-slug-box {
				    display: none;
				}
			</style>
			<?php 
		}
		 
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Purple_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Purple_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		// wp_enqueue_script( $this->plugin_name.'jquerymin', plugin_dir_url( __FILE__ ) . 'js/jquery.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/purple-admin.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name.'jQueryUI', plugin_dir_url( __FILE__ ) . 'js/jquery-ui.js', array( 'jquery' ), $this->version, false );

		wp_enqueue_script( $this->plugin_name.'jQuery_modal', plugin_dir_url( __FILE__ ) . 'js/jquery.modal.min.js', array( 'jquery' ), $this->version, false );

		wp_enqueue_script( $this->plugin_name.'data_table', plugin_dir_url( __FILE__ ) . 'js/jquery.dataTables.min.js', array( 'jquery' ), $this->version, false );

		wp_enqueue_script( $this->plugin_name.'fullcalendar', plugin_dir_url( __FILE__ ) . 'js/main.min.js', array( 'jquery' ), $this->version, false );
		
		wp_enqueue_script( $this->plugin_name.'moment', plugin_dir_url( __FILE__ ) . 'js/moment.min.js', array( 'jquery' ), $this->version, false );

		wp_enqueue_script( $this->plugin_name.'daterangepicker', plugin_dir_url( __FILE__ ) . 'js/daterangepicker.min.js', array( 'jquery' ), $this->version, false );


		//wp_enqueue_script( $this->plugin_name.'repeater', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/0.1.7/jquery.repeater.min.js', array( 'jquery' ), $this->version, false );

 

 
		wp_enqueue_media();
	 
		   

	}
	public function my_custom_dashboard_name() {

		if ( $GLOBALS['title'] != 'Dashboard' ){
            return;
        }

        $GLOBALS['title'] =  __( ''); 


	}	
	public function edit_admin_menu_name() {
        global $menu;  
	    global $submenu; 
	    if(!empty($menu)){
	    	foreach($menu as $menus){
	    		$grpup_menu[] = array($menus[0],$menus[2]);
	    	}
	    }
	    update_option('admin_menu_slug',serialize($grpup_menu));  
	 	 $menu[5][6] = 'dashicons-text-page';
	 	 $menu[10][0] = 'Library';
	 	 $menu[10][6] = 'dashicons-book-alt';
	 	$wp_capabilities = get_user_meta( get_current_user_id(), 'wp_capabilities', true );
		$current = array_keys($wp_capabilities);
		if(in_array( $current[0],array('administrator','IT','client-admin'))) {
				remove_menu_page( 'edit-comments.php' ); 
		    	add_menu_page(
        		    'Plan', 
        		    'Plan', 
        		    'manage_options', 
        		    'plan', 
        		    array($this,'my_plan'),'dashicons-editor-ul',8
        		); 
        		add_submenu_page(
        			'plan_',
        			__( 'Edit Plan', 'textdomain' ),
        	        __( 'Edit Plan', 'textdomain' ),
        	        'manage_options',
        		        'view-plan',
        		        array($this,'view_plan'),'dashicons-editor-ul',8
        			);
        		
        		add_submenu_page(
        			'plan',
        			__( 'Campaigns', 'textdomain' ),
        	        __( 'Campaigns', 'textdomain' ),
        	        'manage_options',
        		        'edit-tags.php?taxonomy=campaign&post_type=event-task'
        		       
        			);
        		add_submenu_page(
        			'plan',
        			__( 'Create Workflow', 'textdomain' ),
        	        __( 'Create Workflow', 'textdomain' ),
        	        'manage_options',
        		        'edit.php?post_type=workflow'
        		       
        			);
        			
        		add_menu_page(
            		    'Library', 
            		    'Library', 
            		    'manage_options', 
            		    'library', 
            		    array($this,'my_library'),'dashicons-book-alt',9
            		);
            	add_submenu_page(
            	        'library',
            	        __( 'Folder', 'textdomain' ),
            	        __( 'Folder', 'textdomain' ),
            	        'manage_options',
            	        'edit-tags.php?taxonomy=attachment_category&post_type=attachment'
                	);
		}
		// removed menus on admin and replaced
		$menu[70][0]='View Profile';
		remove_menu_page( 'tools.php' ); 
		remove_menu_page( 'options-general.php' ); 
		remove_menu_page( 'edit.php' ); 
		remove_menu_page( 'upload.php' );
		remove_menu_page( 'index.php' ); 
		remove_menu_page( 'edit-comments.php' );
		remove_menu_page( 'edit.php?post_type=workflowlog' );
		remove_all_actions('admin_notices');
		
    }
	// edit client admin menu
	public function client_admin_menu() {
        global $menu;  
	    global $submenu; 

	    if(!empty($menu)){
	    	foreach($menu as $menus){
	    		$grpup_menu[] = array($menus[0],$menus[2]);
	    	}
	    }
	 	$wp_capabilities = get_user_meta( get_current_user_id(), 'wp_capabilities', true );
		$current = array_keys($wp_capabilities);
		    
		if(in_array( $current[0],array('client-admin'))) {
					$menu[70][0]='View Profile';
					$menu[2];
					remove_menu_page( 'tools.php' ); 
					remove_menu_page( 'options-general.php' ); 
					remove_menu_page( 'edit.php' ); 
					remove_menu_page( 'upload.php' ); 
					remove_menu_page( 'edit.php?post_type=workflowlog' ); 
					remove_menu_page( 'edit.php?post_type=sfba_subscribe_form' ); 
					remove_menu_page( 'index.php' ); 
					remove_menu_page( 'edit-comments.php' ); 
					remove_menu_page( 'edit.php?post_type=acf-field-group' ); 
					remove_menu_page( 'users.php' ); 		

					
		}
    }
	// eo client admin menu
	// custom dashboard page
	public function custom_dashboard_menu() {
        global $menu;  
	    global $submenu; 
	 	$wp_capabilities = get_user_meta( get_current_user_id(), 'wp_capabilities', true );
		$current = array_keys($wp_capabilities);
		    
		if(in_array( $current[0],array('client-admin','administrator','IT'))) {
		    	add_menu_page(
        		    'Dashboard', 
        		    'Dashboard', 
        		    'manage_options', 
        		    'index', 
        		    array($this,'my_custom_dashboard'),
					'dashicons-admin-home',1
        		); 
		}
    }
	// eo custom dashboard
	public function my_custom_dashboard() {

    	include( plugin_dir_path( __FILE__ ) . 'partials/admin_dashboard.php' );
    	
    }
	// custom dashboard page
	public function custom_email_logs() {
        global $menu;  
	    global $submenu; 
	 	$wp_capabilities = get_user_meta( get_current_user_id(), 'wp_capabilities', true );
		$current = array_keys($wp_capabilities);
		    
		if(in_array( $current[0],array('administrator','IT'))) {
		    	add_menu_page(
        		    'Email Logs', 
        		    'Email Logs', 
        		    'manage_options', 
        		    'email-logs', 
        		    array($this,'my_custom_email_logs'),
					'dashicons-email',3
        		); 
		}
    }
	// eo custom dashboard
	public function my_custom_email_logs() {

    	include( plugin_dir_path( __FILE__ ) . 'partials/workkflow-logs.php' );
    	
    }
	// custom user management page
	public function custom_user_management() {
        global $menu;  
	    global $submenu; 
	 	$wp_capabilities = get_user_meta( get_current_user_id(), 'wp_capabilities', true );
		$current = array_keys($wp_capabilities);
		    
		if(in_array( $current[0],array('administrator','IT'))) {
			
		    	add_menu_page(
        		    'Users', 
        		    'Users', 
        		    'manage_options', 
        		    'user-management', 
        		    array($this,'my_custom_user_management'),
					'dashicons-admin-users',2
        		); 
		}
		// Add options for User table
		add_option('user_sort_by','ID');
		add_option('user_sort','ASC');
		add_option('post_per_table','5');
    }
	// eo custom dashboard
	public function my_custom_user_management() {

    	include( plugin_dir_path( __FILE__ ) . 'partials/user_management.php' );
    	
    }

    public function my_plan() {

    	include( plugin_dir_path( __FILE__ ) . 'partials/plan-content.php' );
    	
    }
    public function my_library() {


       $option = get_option('library_content');

			if($option=='grid'){
				include( plugin_dir_path( __FILE__ ) . 'partials/library-content.php' );
			}else{
				
				include( plugin_dir_path( __FILE__ ) . 'partials/library-content-list.php' );
			}
			 if(isset($_GET['s']) && $_GET['s'] != ''){
		      $search = "and post_title LIKE '%".$_GET['s']."%' ";
		    }
      				 $items_per_page = 30;
				  $page = isset( $_GET['cpage'] ) ? abs( (int) $_GET['cpage'] ) : 1;
				  $offset = ( $page * $items_per_page ) - $items_per_page;
				 

				   $total_query = "SELECT * FROM `".$wpdb->prefix."posts` where post_type='attachment' ".$go." and post_status='inherit' ".$search ." ORDER BY `ID` DESC";
				  // $total = $wpdb->get_var( $total_query );
				   $total = $wpdb->get_results( $total_query );;
				  // echo $total_query;
				   
				    

						 echo '<div class="pagination-li">';
		             
			               echo paginate_links( array(
			                        'base' => add_query_arg( 'cpage', '%#%' ),
			                        'format' => '',
			                        'prev_text' => __('Prev'),
			                        'next_text' => __('Next'),
			                        'total' => ceil( count($total) / $items_per_page),
			                        'current' => $page
			                    ));
		           
		       			  echo '</div>';
 
      	
    }
    

    public function my_user_role() {

    

    	global $wpdb;

    	$users = array();
    	$custom_role = get_option('custom_roles');
    	if(!empty($custom_role)){
    		//unset($users[0]);
    		 
    		foreach($custom_role as $custom_roles){
    			$roles[] = '<option value="'.$custom_roles['capabilities'].'">'.$custom_roles['capabilities'].'</option>';
    		}
    	}

    ;

    	$admin_menu_slug = get_option('admin_menu_slug');

    	$updated = get_option('custom_roles');
    	
    	$d_val = array();
    	foreach($updated as $result){
    		if($result['capabilities'] == 'Subscriber' ){
    			  if(!empty($result[0])){
					foreach($result[0] as $key => $value){
						$d_val[] = $value; 
					}    			  	
    			  }

    		}
    	}
    	
     
    	$data = $_REQUEST;
    	

    	//defalut =
    	$dcheck = array();
    	if(!empty($data['capabilities'])){
    		
    		foreach($data['capabilities'] as $key =>$val){
    			$dcheck[] =$key  ;
    		}
    	}

    		//echo plugin_dir_url( __FILE__ ).'images/';
    	?>

    		<div class="wrap" id="user-role">
    		<h1 class="wp-heading-inline">User Roles</h1>
    			<div class="success"></div>
    			<hr class="wp-header-end">
	    		<div class="role-header">
		    		<div class="form-group">
		    			<label>Select Role to Update</label>
		    				<select class="user-role form-field" name="user" id="user">
		    					<?php echo join('',$roles); ?>
		    				</select>
		    			
		    		</div>

	    		</div>
    			<div class="admin-inner">
    				<div class="form-managment">
	    			<form href="" method="POST" id="roles-form">
	    				<ul>
	    					<?php
	    						$index = 0; 
	    						foreach(unserialize($admin_menu_slug) as $admin_menu_slugs){
	    							if($admin_menu_slugs[0] == '' || $admin_menu_slugs[0] == 'Dashboard') continue;
	    							echo '<li class="form-group">';
	    							$checked = (in_array($admin_menu_slugs[1],$d_val)  )? 'checked':'';


	    									echo '<label>'.preg_replace('/[0-9]+/', '', $admin_menu_slugs[0]).'<input type="checkbox" name="capabilities['.$index.']" '.$checked.'  value="'.$admin_menu_slugs[1].'">'.'</label>';
	    							echo '</li>';
	    							$index++;
	    						}
	    					
	    					 ?>
		    			 
	    				</ul>
	    				<input type="hidden" name="rolers[role]" value="Subscriber" >	
	    				<div class="form-group submit"> <input type="submit" class="ui-button ui-corner-all ui-widget wp-core-ui button-primary" name="submit-role" value="Update Role"></div>
	    			</form>  
	    			</div>
	    			<div class="new-role">		
					    <form action="" method="POST">
					    <fieldset>
					     
					      <input type="text" placeholder="Role Name" name="role_name" id="role_name" value="" class="text ui-widget-content ui-corner-all">
					    </fieldset>
					    <div class="form-group">
		    			<div class="add-role"><input class="ui-button ui-corner-all ui-widget wp-core-ui button-primary" name="new-role" type="submit" id="add-role" value="Add New Role"></div>
		    		</div>
					  </form>
    				</div>	
    			</div>
    			
    			</div>
    		</div>


    	<?php

    	if($_POST['new-role']){
    		$new_role = array(array('capabilities'=>$_POST['role_name'],array()));
    		 
    		$mereging = array_merge($updated,$new_role);

    		update_option('custom_roles',$mereging);
    		 
    	 
    	}


    	 
    		

    } 

    public function ajax_user_role () {

    	
    	global $wpdb;

    	$users = array();
    	 
    	$admin_menu_slug = get_option('admin_menu_slug');

    	$updated = get_option('custom_roles');
    	

    	foreach($updated as $result){
    		if($result['capabilities'] == $_GET['role'] ){
    			  if(!empty($result[0])){
					foreach($result[0] as $key => $value){
						$d_val[] = $value; 
					}    			  	
    			  }

    		}
    	}
    	
     
    	$data = $_REQUEST;

    	//defalut =
    	$dcheck = array();
    	if(!empty($data['capabilities'])){
    		
    		foreach($data['capabilities'] as $key =>$val){
    			$dcheck[] =$key  ;
    		}
    	}


    	?>
    		<form href="" method="POST" id="roles-form">
	    				<ul>
	    					<?php
	    						$index = 0; 
	    						foreach(unserialize($admin_menu_slug) as $admin_menu_slugs){
	    							if($admin_menu_slugs[0] == '' || $admin_menu_slugs[0] == 'Dashboard') continue;
	    							echo '<li class="form-group">';
	    							$checked = (in_array($admin_menu_slugs[1],$d_val)  )? 'checked':'s';


	    									echo '<label>'.preg_replace('/[0-9]+/', '', $admin_menu_slugs[0]).'<input type="checkbox" name="capabilities['.$index.']" '.$checked.'  value="'.$admin_menu_slugs[1].'">'.'</label>';
	    							echo '</li>';
	    							$index++;
	    						}
	    					
	    					 ?>
		    			 
	    				</ul>
	    				<input type="hidden" name="rolers[role]" value="<?php echo $_GET['role'];?>" >	
	    				<div class="form-group submit"> <input type="submit" class="ui-button ui-corner-all ui-widget wp-core-ui button-primary" name="submit-role" value="Update Role"></div>
	    	</form> 

    	<?php 

    	
    	die();
    }
    public function create_task(){
    	include( plugin_dir_path( __FILE__ ) . 'partials/modal/library-create-task.php' );
    	die();
    }
    public function create_task_event(){
    	 
    	 $task = $_POST['task'];
    	 // john
    	 $my_post = array(
		    'post_title'    => $task[0]['value'],
		    'post_status'    => 'publish',
		    'post_author'   => get_current_user_id(),
		    'post_type'     => 'event-task'
		  
		);
		$post_id = wp_insert_post($my_post);
		unset($task[0]);
		if(!empty($task)){
			foreach($task as $tasks){
			 
				update_post_meta($post_id,$tasks['name'],$tasks['value']);
			}
		}

		 echo "".get_site_url()."/wp-admin/admin.php?page=view-plan&id=".$post_id."#content";

    	die();
    }
    public function view_plan(){
     
    	if(isset($_GET['id'])){

    		include( plugin_dir_path( __FILE__ ) . 'partials/event/edit-event.php' );
    		
    	}


    }

    public function ajax_update_role (){
    	
    	$data = array();
    	if(!empty($_POST['from'])){
    		$index = 0;
    		foreach($_POST['from'] as $form){
    			if($index == count($_POST['from'])-1) continue;
    			$outputString = $form['value'];  
    			$data[] =$outputString; 

    			$index++;
    		}
    		$arr= count($_POST['from'])-1;
    		$capabilities = $_POST['from'][$arr];
    		
    	}


			if(!empty($data)) { 
		    	$replace =  array_replace($data);

		    	$arrays = get_option('custom_roles');

				    $index =0;	
				    foreach($arrays as $array){
				    	if($array['capabilities'] == $capabilities['value']){
				    		
				    	 

				    		$update = array(
				    				'capabilities'=> $array['capabilities'],
				    				$replace
					    		);
					    	$arrays[$index] = array_replace($update);	

				    	}
				    	
				      $index++;	
				    }

				//update_option('custom_roles',$arrays);
			 

				echo 'Succesfully Update';
			}

    	

    	die();
    }

       
    public function remove_dashboard_widgets (){
      remove_meta_box( 'dashboard_quick_press',   'dashboard', 'side' );      //Quick Press widget
      remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );      //Recent Drafts
      remove_meta_box( 'dashboard_primary',       'dashboard', 'side' );      //WordPress.com Blog
     // remove_meta_box( 'dashboard_secondary',     'dashboard', 'side' );      //Other WordPress News
     // remove_meta_box( 'dashboard_incoming_links','dashboard', 'normal' );    //Incoming Links
      remove_meta_box( 'dashboard_plugins',       'dashboard', 'normal' );    //Plugins

    }
   

   
    public function add_dashboard_widgets() {
       if (!current_user_can('manage_options')) {
         return;
       }
	  	wp_add_dashboard_widget( 'wptutsplus_dashboard_listing_analytic', 'Recently Published Plan',array($this,'dashboard_listing_stats'));
		//wp_add_dashboard_widget( 'wptutsplus_dashboard_links', 'Useful Links', 'wptutsplus_add_links_widget' );

 
	}

   public function dashboard_listing_stats(){
		
	   ?>
	       <table>
	           <thead>
	               <th>Title</th>
	               <th>Step</th>
	               <th>End/Due Date</th>
	           </thead>
	           <tbody>
	              
	                   <?php 
	                          // WP_Query arguments
                            $args = array(
                            	'post_type' => 'event-task',
                            	'post_status'            => array( 'publish' ),
                                'posts_per_page'         => 9
                            );
                            
                            // The Query
                            $query = new WP_Query( $args );
                            
                            // The Loop
                            if ( $query->have_posts() ) {
                            	while ( $query->have_posts() ) {
                            		$query->the_post();
                            		// do something
                                      $Workflow = get_post_meta(get_the_ID(),'workflow_id',true);
                                        $work_data = get_post($Workflow);
                                        $type = get_post_meta(get_the_ID(),'type',true);
                                        
                                         $stats  = $type == 'TASK' ? 'TSK':'EVT';

                                          $TSK = $stats.'-'.get_the_ID();
                 
                                        $Campaign = get_post_meta(get_the_ID(),'workflow_id',true)!='' ? get_post_meta(get_the_ID(),'workflow_id',true):'';
                                        
                                        $total_workflow = (get_field('create_workflow',$Campaign,true)!='')?  count(get_field('create_workflow',$Campaign,true)):'1';
         
                                        $approve_1 =  get_post_meta(get_the_ID(),'approve_'.$total_workflow,true);
                                         
                                        $laststep_due = get_post_meta(get_the_ID(),'Qarticle_due_date_'.$total_workflow,true) != '' ? get_post_meta(get_the_ID(),'Qarticle_due_date_'.$total_workflow,true):null;
                                        
                             
                                        $role_id = get_post_meta(get_the_ID(),'Qarticle_role_1',true); 
                                        
                                        $full_name = get_user_meta($role_id,'first_name',true).' '.get_user_meta($role_id,'last_name',true);
          
                                        $words = explode(' ', $full_name );
                                        $acronym = strtoupper(substr($words[0], 0, 1) . substr(end($words), 0, 1));
                                        
                                        
                                        
                                        $categories = get_the_terms( get_the_ID(), 'campaign' );
                                        
                                        if( strtotime( get_post_meta(get_the_ID(),'task_end_date',true)) < strtotime('now')  && $approve_1 == false ) { 
                                            $late = '<span class="dashicons dashicons-warning" style="color: #f00;font-size: 15px; margin-top: 2px;"></span>';
                                        }else{
                                             $late = '&nbsp;&nbsp;&nbsp;&nbsp;';
                                        }
                                        
                                        $avatar = ($acronym !='')? $acronym:'A';
                                        
                               
                            		echo '<tr>';
                            		echo '<td><span>'.$TSK.' '.$categories[0]->name.'</span><a href="'.get_site_url().'/wp-admin/admin.php?page=view-plan&id='.get_the_ID().'#content">'.get_the_title().'</a></td>';
                            		echo '<td><span class="avatar-acronym">'.$avatar.'</span><a href="'.get_site_url().'/wp-admin/admin.php?page=view-plan&id='.get_the_ID().'#content"> <span>1 of '.count(get_field('create_workflow',$work_data->ID)).' </span>'. $work_data->post_title .'</a></td>';
                            		echo '<td><a href="'.get_site_url().'/wp-admin/admin.php?page=view-plan&id='.get_the_ID().'#content">'.$late.' '.date("M j, Y", strtotime( get_post_meta(get_the_ID(),'task_end_date',true))).'</a></td>';
                            		echo '</tr>';
                            	}
                            } else {
                            	// no posts found
                            }
                            
                            // Restore original Post Data
                            wp_reset_postdata();
	                   ?>
	               
	           </tbody>
	           
	       </table>
	       <style>
	       span.avatar-acronym {
                background: #c5c5c5;
                color: #fff;
                width: 20px;
                display: block;
                float: left;
                height:18px;
                text-align: center;
                padding: 5px;
                border-radius: 50%;
                margin-right: 10px;
            }
            table {
              font-family: arial, sans-serif;
              border-collapse: collapse;
              width: 100%;
            }
            tbody tr:hover {
                background: #e8e8e8;
                cursor: pointer;
            }
            td, th {
              text-align: left;
              padding: 8px;
            }
            tbody tr td:first-child span {
                display: block;
                margin-bottom: 5px;
            }
            tbody tr {
                border-top: solid #dddddd;
            }
            tbody tr td a {
                color: #000;
                text-decoration: none;
            }
            </style>
	   <?php 
	

	}
	 
	 public function my_custom_admin_head() {

	 	
	 	$wp_user_roles = get_option('wp_user_roles');
	 
	 		 
		     // Check if Welcome Panel is being displayed
		    update_user_meta( get_current_user_id(), 'show_welcome_panel', true );

		    $option = get_user_meta( get_current_user_id(), 'show_welcome_panel', true );
		    $user = get_userdata(get_current_user_id());
		    $today = date("D M j, Y");
		    if( !$option )
		        return;
		    ?>
		    <div class="custom-admin-head" style="display:none;">
		    	<div class="avatar-meta">
		    		 <img src="<?php echo esc_url( get_avatar_url( $user->ID,['size' => '80']) ); ?>" />
		    	</div>
		    	<div class="avatar-info">
		    		<span class="info-date"><?php echo $today ;?></span>
		    		<h2>Hello, <?php print(ucfirst($user->user_nicename)); ?></h2>
		    	</div>


		    </div>
		    <style type="text/css">
		        /*
		         * Hide the Welcome Panel and the "dismiss" message at the bottom
		         */ 
		        #welcome-panel {opacity:0.01;} 
		        p.welcome-panel-dismiss {display:none}
		    </style>

		   	
		    <script type="text/javascript">
		    jQuery(document).ready( function($) 
		    {
		  		$('#welcome-panel').html('');
		       
		       
		        $('.custom-admin-head').prependTo('.wrap');
		        
		        /*
		         * Everything modified, fade in the whole Div
		         * The fade in effect can be removed deleting this and the CSS opacity property
		         */
		        $('#welcome-panel,.custom-admin-head').delay(300).fadeTo('slow',1);
		    });     
		    </script>
		  
		    <?php

		    
		    
	 }
	 public function ppb_init() {
	 	$wp_capabilities = get_user_meta( get_current_user_id(), 'wp_capabilities', true );
		   
		    $current = array_keys($wp_capabilities);
		    if($current[0]!='administrator'){

		    	?>
		    		<style>
		    			select#role option[value="client-admin"],
						select#user_role_copy_from  option[value="client-admin"],
						select#user_role option[value="client-admin"] {
						    display: none !important;
						}
		    		</style>

		    	<?php 
		    	
		    }
		    if(isset($_GET['return'])){
			   ?>
			   	<style>
			   	.load-more-wrapper, .attachments-browser .media-toolbar, button#menu-item-browse {
					display: block !important;
				}
				.media-frame-content .attachments-wrapper li.attachment {
					display: block !important;
				}
			   	</style>
			   <?php 
		   }
	 	
	 }

	 public function ure_show_additional_capabilities_section($show) {
			   
		 $show = false;
		 return $show;
	}
	public function admin_top_bar(){
		echo 'Hello World';
		 include( plugin_dir_path( __FILE__ ) . 'partials/admin-top-bar.php' );
		 if(isset($_GET['return'])){
			   ?>
			   	<style>
			   	.load-more-wrapper, .attachments-browser .media-toolbar, button#menu-item-browse {
					display: block !important;
				}
				.media-frame-content .attachments-wrapper li.attachment {
					display: block !important;
				}
			   	</style>
			   <?php 
		   }
	}
	public function lib_details(){
		 include( plugin_dir_path( __FILE__ ) . 'partials/modal/library-modal-details.php' );
		die();

	}
	public function article_details(){
		 include( plugin_dir_path( __FILE__ ) . 'partials/modal/article-modal-details.php' );
		die();

	}
	public function lib_add(){

		$option = get_option('library_content');

		if($option  == 'grid'){
			include( plugin_dir_path( __FILE__ ) . 'partials/library-content-add.php' );
		}else{
			include( plugin_dir_path( __FILE__ ) . 'partials/library-content-list-add.php' );
		}

		
		die();
		  
	}

	public function upload_media(){
			print_r($_FILES);
		die();
	}

	public function be_attachment_field_credit( $form_fields, $post ) {
    $form_fields['content_format'] = array(
        'label' => 'Content Format',
        'input' => 'text',
        'value' => get_post_meta( $post->ID, 'content_format', true ),
        'helps' => '<input class="input-data" > <ul style="display:none;" class="content-format-list"><li><label><input type="checkbox" value="article">Article</label></li><li><label><input type="checkbox" value="infographic">Infographic</label></li><li><label><input type="checkbox" value="listicle">Listicle</label></li><li><label><input type="checkbox" value="quiz">Quiz</label></li><li><label><input type="checkbox" value="survey">Survey</label></li><li><label><input type="checkbox" value="video">Video</label></li><li><label><input type="checkbox" value="webinar">Webinar</label></li><li><input type="button" value="Done" class="close-hidden"></li></ul>',
    );
 
 
	    //return $form_fields;
	}
	  // Save custom checkbox attachment field
	public function save_custom_checkbox_attachment_field($post, $attachment) {  

		print_r($attachment);
	     
       		// update_post_meta( $post['ID'], 'be_photographer_name', $attachment['acf-field_611d11280c7ce'] );
	    return $post;  
	}

	public function lib_view_switch(){

		 

		update_option('library_content',$_GET['switch']);

		$option = get_option('library_content');

			if($option=='grid'){

				include( plugin_dir_path( __FILE__ ) . 'partials/library-content.php' );
				//echo  'sadsad'.plugins_url( 'partials/library-content.php', __FILE__ );
			 
				
			}else{
				include( plugin_dir_path( __FILE__ ) . 'partials/library-content-list.php' );
				 
			}



		die();
		
	}
	
	public function my_user_row_actions( $actions, $user_object ) {
	    // Remove the Edit action.
	    unset( $actions['view'] );

	    return $actions;
	}

	public function create_folder() {
		include( plugin_dir_path( __FILE__ ) . 'partials/library-create-folder.php' );
		die();
	}

	public function update_lib_datails() {

		global $wpdb;


		if($_GET['idfy'] == 'folder'){

				$wpdb->query( 
				    $wpdb->prepare( 
				        "UPDATE `".$wpdb->prefix."terms` SET `name` = '".$_GET['cat_val']."' WHERE `wp_terms`.`term_id` = ".$_GET['tax_id']." ;"
				    )
				);
				$wpdb->query( 
				    $wpdb->prepare( 
				        "UPDATE `".$wpdb->prefix."terms` SET `slug` = '".str_replace(' ', '-', strtolower($_GET['cat_val']))."' WHERE `wp_terms`.`term_id` = ".$_GET['tax_id']." ;"
				    )
				);

				update_term_meta( $_GET['tax_id'], 'ppb_folder_date', date(' M j, Y'));

				echo  json_encode(array('tax_id'=>$_GET['tax_id'],'tax_name'=>$_GET['cat_val']));

				 
		}
		if($_GET['idfy'] == 'delete' && $_GET['type'] == 'taxonomy'){
			return wp_delete_term($_GET['tax_id'],'attachment_category');
		}elseif($_GET['idfy'] == 'delete'){
			return wp_delete_attachment($_GET['tax_id'],true);
		}
		
		if($_GET['idfy'] == 'article-title' && $_GET['title'] !='' ){
		 
			$my_post = array(
			      'ID'           => $_GET['id'],
			      'post_title'   => $_GET['title'],
			      
			  );
			 
			// Update the post into the database
			  wp_update_post( $my_post );
		}	

		die();
		
	}

	public function set_post_cat() {

		$posr_ids = explode(',',$_GET['ids']);
		global $wpdb;
		foreach($posr_ids as $posr_id){
			//echo $posr_id;
			//wp_set_post_terms( $posr_id, array($_GET['cat_id']), 'attachment_category',false );
			
			$table = $wpdb->prefix.'term_relationships';
			$data = array('object_id' => $posr_id, 'term_taxonomy_id' => $_GET['cat_id'], 'term_order' => 0);
			$format = array('%s','%d');
			$wpdb->insert($table,$data,$format);
			//$my_id = $wpdb->insert_id;
			//wp_set_post_categories( 319,  );
			//wp_set_post_categories( intval($posr_id),array( intval($_GET['cat_id']) ) );
		}
  		 

  		$sql = "SELECT count(*) total  FROM `".$wpdb->prefix."term_relationships` where term_taxonomy_id=".$_GET['cat_id']." " ;
		$result = $wpdb->get_results($sql); 

		$wpdb->query("UPDATE `wp_term_taxonomy` SET `count` = '".$result[0]->total."' WHERE `wp_term_taxonomy`.`term_taxonomy_id` = ".$_GET['cat_id']."");

		?>
		<?php  
			$query2 = "SELECT object_id FROM `".$wpdb->prefix."term_relationships`  where term_taxonomy_id=".$_GET['cat_id']."";

			$result2 = $wpdb->get_results($query2); 

			if(!empty($result2)){
				foreach($result2 as $results) {
					$post_ids[] = $results->object_id;
				}
			}

			$posts_query = "SELECT * FROM `".$wpdb->prefix."posts` where ID in (".join(',',$post_ids).")";

			$posts = $wpdb->get_results($posts_query); 

			//print_R($posts);

			if(!empty($posts)){
				foreach($posts as $post){
					?>
					<div class="library-folder-asset-row"><div class="content-thumbnail asset-thumbnail cl-v3-image-fill"><span class="thumbnail-container false"><img class="thumbnail thumbnail-image" src="<?php echo wp_get_attachment_url( $post->ID ); ?>"></span></div><p class="ndl-Text ndl-Text--secondary asset-title"><?php echo $post->post_title;?></p></div>
					<?php 
				}

			}


		?>
		<?php
		
			
		die();
	}


    public function my_delete(){
        
       
        if(isset($_GET['task_d']) && $_GET['task_d'] !='' ){
            $slice = explode(',',$_GET['task_d']);
            foreach( $slice as  $val){
              wp_delete_post( $val,true);  
            }
             
            echo 'success';
             
        }else{
            echo 'Check the item before you click!';
        }
        
        die();
        
    }
	public function ppb_creation(){
		$event = end($_POST);
		if(!empty($event)){
			echo $event[0]['value'];
			//unset(end($_POST));
				//print_r($event);
			 
			$type= end($event)['value'];
		
			$my_post = array(
			    'post_title'    =>$event[0]['value'],
			    'post_status'    => 'publish',
			    'post_author'   => get_current_user_id(),
			    'post_type'     => 'event-task'
			  
			);

			$post_id = wp_insert_post($my_post);
			wp_set_post_terms( $post_id, array( $event[1]['value'] ), 'campaign', true );
			unset($event[0]);
			//unset($event[1]);
			foreach($event as $events){
				 
				update_post_meta($post_id,$events['name'],$events['value']);
			}

	 		

		}

		if(isset($_GET['ID'])){
			
			
			$list = explode('-',$_GET['checklist']);
				$key = 'checklist_marks_'.$_GET['flow_id'].'';
			
				if(isset($_GET['checklist']) && $_GET['checklist']!=''){
				
					
					update_post_meta($_GET['ID'],$key,$list);
					$check = get_post_meta($_GET['ID'],$key,true);
					
				}else{
					if(empty(array_filter($list))){
						update_post_meta($_GET['ID'],$key,'');
					}
				}
	 
			 
		}
		if($_GET['act'] == 'undo'){
			if(isset($_GET['approveId'])){
				$keyAp = 'approve_'.$_GET['flow_id'].'';
				$updated = 'publish_date_'.$_GET['flow_id'].'';
				update_post_meta($_GET['approveId'],$updated,'');
				update_post_meta($_GET['approveId'],$keyAp,0);
				echo 'Undo';
			}	
		}else{
			if(isset($_GET['approveId'])){
				$keyAp = 'approve_'.$_GET['flow_id'].'';
				$updated = 'publish_date_'.$_GET['flow_id'].'';
				update_post_meta($_GET['approveId'],$updated,date("M d,Y"));
				update_post_meta($_GET['approveId'],$keyAp,true);
				echo 'Success';
			}
		}

		if(isset($_GET['assgn_post'])){
			$slice = explode(',',$_GET['assgn_post']); 
			$array_unique = array_unique($slice);
			$j = join(',',$array_unique);
			update_post_meta($_GET['task_id'],'attachment_id',$j);

			echo 'success';
		}


	 

		die();


	}

	public function get_workflow(){
		global $wp_roles,$wpdb;
		$roles = $wp_roles->roles; 
		$current_user = wp_get_current_user();
 		$user_Q = "SELECT ID,un_meta.meta_value as first_name,un_meta2.meta_value as last_name,user_nicename as user_nicename  FROM `".$wpdb->prefix."users` as users 
		left join ".$wpdb->prefix."usermeta as un_meta on( users.id=un_meta.user_id ) and (un_meta.meta_key='first_name')
		left join ".$wpdb->prefix."usermeta as un_meta2 on( users.id=un_meta2.user_id ) and (un_meta2.meta_key='last_name')";
		$users = $wpdb->get_results( $user_Q );
		if(!empty($users)){
			foreach($users as $user){
			    $fullname = $user->first_name.' '.$user->last_name;
				$w_use[] = array($user->ID,$user->user_nicename);
			}
		}
		$query = get_post( $_GET['workflow'] );
		$total_created_workflows = get_post_meta($query->ID,'created_workflows')[0];
		// titles
		$workflow_titles = get_post_meta($query->ID,'workflow_titles')[0];
		$workflow_titles = unserialize($workflow_titles);
		// Descritpions
		$workflow_descriptions = get_post_meta($query->ID,'workflow_descriptions')[0];
		$workflow_descriptions = unserialize($workflow_descriptions);
		// List workflows
		

        
		
		// for($workflow_counter = 0; $workflow_counter < $total_created_workflows; $workflow_counter++){
		foreach($workflow_titles as $key => $workflow_title){
		// wp_send_json_success($total_created_workflows);
		// die();
			// if( have_rows('create_workflow', $query->ID) ){
				$key = $key+1;
				// while( have_rows('create_workflow', $query->ID) ) { the_row();
					
					?>
					<div class="tsk-WorkflowForm-step ">
					   <p class="ndl-Text ndl-Text--body tsk-WorkflowForm-count"><?php echo $key;?></p>
					   <div class="tsk-WorkflowForm-assignee">
					      <div class="tsk-WorkflowForm-substep">
					         <div class="ndl-AvatarPicker ndl-AvatarPicker--medium tsk-WorkflowForm-selector">
					            <div class="ndl-Dropdown  ndl-AvatarPicker-assigneeDropdown">
					               <div class="ndl-AvatarPickerToggle ndl-AvatarPickerToggle--medium">
					                  <div class="ndl-AvatarPickerToggle-button">
					                     <div class="ndl-AvatarPickerToggle-placeholder">
					                        <span data="<?php echo $key; ?>" class="nc-icon ndl-Icon   ndl-AvatarPickerToggle-placeholderIcon ">
					                           <i class="nc-icon-wrapper">
					                              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16">
					                                 <g transform="translate(0, 0)">
					                                    <path fill="#444444" d="M15,7H9V1c0-0.6-0.4-1-1-1S7,0.4,7,1v6H1C0.4,7,0,7.4,0,8s0.4,1,1,1h6v6c0,0.6,0.4,1,1,1s1-0.4,1-1V9h6 c0.6,0,1-0.4,1-1S15.6,7,15,7z"></path>
					                                 </g>
					                              </svg>
					                           </i>
					                        </span>
					                     </div>
					                  </div>
					               </div>
					            </div>
					            <div class="assign-role assign-<?php echo $key; ?>" style="display:none;">
					               <select name="assign" class="assign-<?php echo $key;?>" >
					                 <option value="<?php echo $current_user->data->ID; ?>"><?php echo $current_user->roles[0]; ?></option>
					                  <?php 
					          			  unset($w_use[0]);
					          			  
					                      foreach($w_use as $value){
					                     		echo '<option value="'.$value[0].'">'.ucfirst($value[1]).'</option>';
					                      } 
					                     ?>
					               </select>
					               
					            </div>
					         </div>
					         <div class="tsk-WorkflowForm-meta">
					            <header class="ndl-Header ndl-Header--subsection tsk-WorkflowForm-label">
									<?php 
								
									?>
					               <h1 class="ndl-HeaderTitle ndl-HeaderTitle--subsection ndl-HeaderTitle--medium undefined"><?php echo $workflow_title;?></h1>
					            </header>
					            <p class="ndl-Text role-<?php echo $key; ?> ndl-Text--secondary tsk-WorkflowForm-target">Unassigned</p>
					         </div>
					      </div>
					   </div>
					   <div data="<?php echo $key; ?>" class="tsk-WorkflowForm-dueDate dueDate-<?php echo $key; ?>">
					      <div class="--formattedValue">
					         <button class="ndl-Button ndl-Button--inline ndl-Button--small " data="<?php echo $key; ?>" type="button"><span class="ndl-Button-label">Assign Due Date</span></button> 
					         <div class="datepicker-<?php echo $key; ?>"></div>
					         <input type="hidden" name="Qarticle_role_<?php echo $key; ?>" id="Qarticle_role_<?php echo $key; ?>" > <input name="Qarticle_due_date_<?php echo $index; ?>" type="hidden" id="Qarticle_due_date_<?php echo $index; ?>" >
					      </div>
					   </div>
					</div>
					<?php 
					$index++;
				}
	}
	public function get_cal_range(){
			//echo 'Hello World';
			//echo plugin_dir_path( __FILE__ );
			include( plugin_dir_path( __FILE__ ) . 'partials/plan-template/calendar-content-range.php' );
		die();
	}

	public function modal_action() {
	 	if($_GET['act'] == 'thumb'){
	 	 
	 		include( plugin_dir_path( __FILE__ ) . 'partials/event/modal/update-conten.php');
	 	}else{
			include( plugin_dir_path( __FILE__ ) . 'partials/event/modal/add-content.php' );
		}
		die();
	}
	// add comment to the workflow
	public function update_comments(){
		$plan_id = $_POST['plan_id'];
		$commentor_id = $_POST['commentor_id'];
		$comment = $_POST['comment'];
		$user_data = $_POST['user_data'];
		$data = [$user_data => $comment];
		add_post_meta($plan_id,'comments',serialize($data));
		return 'success';
	}

	public function create_workflow_email_logs(){
		

	}
	public function update_progress(){
		$percentage = $_POST['percentage'];
		$plan_id = $_POST['plan_id'];
		// $checklist_index = $_POST['checklist_index'];
		// $checklist_position = $_POST['checklist_position'];
		$meta = $_POST['meta'];
		$checked_status = $_POST['checked_status'];
		// get_post_meta($plan_id,'checklist_index')
		if($checked_status == 'true'){
			update_post_meta($plan_id,$meta,0);
		}else{
			update_post_meta($plan_id,$meta,1);
		}
		update_post_meta($plan_id,'total_percentage',$percentage);
		wp_send_json_success('success');
	}
	
	public function edit_comment(){
		include_once("wp-config.php");
		include_once("wp-includes/wp-db.php");

		global $wpdb;
		$meta_id = $_POST['meta_id'];
		$user_data = $_POST['user_id'];
		$comment = $_POST['comment'];
		$data = [$user_data => $comment];
		$meta_val = serialize($data);

		$result = $wpdb->update( $wpdb->postmeta, array( 'meta_key' => 'comments', 'meta_value' => serialize($meta_val) ), array( 'meta_id' => $meta_id ) );

		if($result){
			echo json_encode('success');
		}else{
			echo json_encode('failed');
		}
	}
	public function delete_comment(){
		include_once("wp-config.php");
		include_once("wp-includes/wp-db.php");

		global $wpdb;
		$meta_id = $_POST['meta_id'];

		$result = $wpdb->delete( $wpdb->postmeta, array( 'meta_id' => $meta_id ) );

		if($result){
			echo json_encode('success');
		}else{
			echo json_encode('failed');
		}
	}
	// register new users
	public function add_new_user(){
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$role = $_POST['role'];

		$user_id = register_new_user( $username, $email );
		$user = new WP_User( $user_id  );
		if($role == 'client-admin') $user->remove_role( 'subscriber' );
		$user->set_role( $role );
		echo json_encode($user_id);
	
	}
	// Edit user data
	public function edit_user_data(){
		$user_id = $_POST['user_id'];
		$user_data = new WP_User($user_id  );
		wp_send_json_success($user_data);
	}

	// Update User data
	public function update_user_data(){
		global $wpbd;
		$user_id = (int)$_POST['user_id'];
		$new_username = $_POST['new_username'];
		$new_email = $_POST['new_email'];
		$new_role = $_POST['new_role'];
		$new_password = $_POST['new_password'];

		$result = wp_update_user( array(
			'ID' => $user_id,
			'user_email' => $new_email
	   	) );
		if($new_password != false){
			wp_set_password($new_password,$user_id);
		}
		$id = new WP_User($user_id);
		$id->set_role($new_role );
		wp_send_json_success('success');
	}
		// delete user data
		public function delete_user_data(){
			$user_id = $_POST['user_id'];
			wp_delete_user($user_id);
			wp_send_json_success('User deleted Successfuly');
		}
		// Sort  user table data
		public function update_sort_order(){
			$data = $_POST['formData'];
			foreach ($data as $key => $value) {
				update_option($key,$value);
			}
			wp_send_json_success('success');
		}
		// delete workflow log
		public function delete_workflow_log(){
			$id = $_POST['id'];
			wp_delete_post($id );
			wp_send_json_success($id);
			
		}
		// Sort  user table data
		public function update_post_per_table(){
			$data = $_POST['formData'];
			foreach ($data as $key => $value) {
				update_option($key,$value);
			}
			wp_send_json_success('success');
		}
		public function update_created_workflow_count(){
			$post_id = $_POST['workflow_id'];
			// $workflow_count = $_POST['workflow_count'];
			// update_post_meta($post_id,'created_workflows',$workflow_count);
			wp_send_json_success($workflow_count);
		}
		// 
		public function library_search(){
			$search_value = $_POST['search_value'];
			$section = $_POST['section'];
			if($section == 'library'){
				$url = site_url()."/wp-admin/admin.php?s=$search_value&page=library";
			}else if( $section == 'campaigns'){
				$url = site_url()."/wp-admin/edit-tags.php?taxonomy=campaign&post_type=event-task&s=$search_value";
			}
			wp_send_json_success($url);
		}
		
		
		
}

 
  
   