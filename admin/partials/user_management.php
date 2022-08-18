<?php
global $wp_roles,$wpdb;
$order = get_option('user_sort','ASC');
$order_by  = get_option('user_sort_by','user_login');
$post_per_table  = get_option('post_per_table','5');
// pagination
$all_users = get_users("orderby=$order_by&order=$order");

$customPagHTML     = "";
$total = count($all_users);
$items_per_page = $post_per_table ;
$page             = isset( $_GET['cpage'] ) ? abs( (int) $_GET['cpage'] ) : 1;
$offset         = ( $page * $items_per_page ) - $items_per_page;
$totalPage         = ceil($total / $items_per_page);
if($totalPage > 1)
		{
			$customPagHTML_count     =  '<div class="quotes_entries_count"><span>Page '.$page.' of '.$totalPage.'</span> </div>';
			$customPagHTML = 
			'<div class="quotes_entries_pager">'
			.paginate_links( array(
			'base' => add_query_arg( 'cpage', '%#%' ),
			'format' => '',
            'prev_text' => '<i class="fas fa-angle-double-left"></i>',
            'next_text' =>'<i class="fas fa-angle-double-right"></i>',
			'total' => $totalPage,
			'current' => $page
			)).
			'</div>'
			;
		}
// EO PAGINATION
$all_users = $wpdb->get_results("SELECT * FROM $wpdb->users ORDER BY $order_by  $order LIMIT $offset, $items_per_page" );
$wp_roles = new WP_Roles();
$available_roles = $wp_roles->get_names();
if( is_user_logged_in() ) {
    $user = wp_get_current_user();
        if(!in_array('administrator',$user->roles)){
            die('you do not have permission');
        }
    } 
?>
<div class="user-management">
    <div class="user-management-header">
        <div class="table-header">
            <div class="title"><h1>User Management</h1></div>
            <div class="right-side">
                <ul class="action-list">
                    <li><i class="fa fa-user-plus" id="add-user" aria-hidden="true"></i>Add Account</li>
                    <li>
                    <i class="fas fa-sort-amount-down-alt"></i>Sort by
                        <select name="sort-user-by" id="sort-user-by">
                            <option value="ID">ID</option>
                            <option value="user_login">Username</option>
                            <option value="user_email">Email</option>
                        </select>
                    </li>
                    <li>
                    <i class="fas fa-sort-amount-down-alt"></i>Order by
                        <select name="sort-order" id="sort-order">
                            <option value="ASC">Ascending</option>
                            <option value="DESC">Descending</option>
                        </select>
                    </li>
                    <li><button class="button" id="sort-users"><i class="fas fa-angle-double-right"></i></button></li>
                    <li>
                    <i class="fas fa-sort-amount-down-alt"></i>
                        <select name="post_per_table" id="post_per_table">
                            <option value="5" <?=$post_per_table == 5 ? 'selected' : '';?>>5</option>
                            <option value="10" <?=$post_per_table == 10 ? 'selected' : '';?>>10</option>
                            <option value="15" <?=$post_per_table == 15 ? 'selected' : '';?>>15</option>
                            <option value="20" <?=$post_per_table == 20 ? 'selected' : '';?>>20</option>
                            <option value="25" <?=$post_per_table == 25 ? 'selected' : '';?>>25</option>
                        </select>
                    </li>
                </ul>
            </div>
        </div>
<table>
  <tr class="theader-user-management">
    <th width="5%">ID</th>
    <th>Username</th>
    <th>User Role</th>
    <th>Email</th>
    <th>Status</th>
    <th>Action</th>
  </tr>
  <?php
  $id = 1;
  foreach ($all_users as $user) {
   ($user->user_status == 0) ? $stat = '<i class="fas fa-circle text-active"></i>Active': $stat = '<i class="fas fa-circle text-inactive"></i>Inactive';
   $user_meta = get_userdata($user->ID);
   $user_roles = $user_meta->roles;
   $output = '';
   $output .= '<tr>';
   $output .= '<td>'.$user->ID.'</td>';
   $output .= '<td>'.$user->user_login.'</td>';
   $output .= '<td>';
   foreach($user_roles as $role){
       $output .= $role;
    }
   $output .= '</td>';
   $output .= '<td>'.$user->user_email.'</td>';
   $output .= '<td>'.$stat.'</td>';
   $output .= '<td><i class="fas fa-edit edit-user" data-id='.$user->ID.' current-role='.$role.' ></i><i class="far fa-trash-alt delete-user" data-id='.$user->ID.'></i></td>';
   $output .= '</tr>';
   echo $output;
   $id++;
  }
  ?>
</table>
<div class="pagination-container">
    <?php echo $customPagHTML_count; ?>
    <?php echo $customPagHTML; ?>
</div>
    </div>
</div>
<!-- Add user modal -->
<div class="user-modal-container">
<div class="add-new-user-modal">
    <div class="modal add-user-modal" style="display:block;">
    <form action="#" method="post" id="add-user-modal">
        <div class="plan-CreateModal-title "><h1 class="user-modal-title">Add new User</h1></div>
            <input type="hidden" name="user-id" id="user-hidden-id" value="">
            <div class="form-group">
                <label id="username-label">Username * </label>
                    <input name="username" required id="username" autocomplete="off"  class="input-field show-tooltip" maxlength="80" type="text" placeholder="Enter Username" value="">
               
            </div>
            <div class="form-group">
                <label>User Email *
                    <input name="email" required autocomplete="off" id="email" class="input-field" maxlength="80" type="email" placeholder="Enter Email" value="">
                </label>
            </div>
            <div class="form-group">
                <label>User Role *
                    <select name="user_role" class="form-field" id="user-role">
                        <?php
                        foreach($available_roles as $user_role_key => $value){
                            echo "<option value='$user_role_key'>$value</option>";
                        }                    ?>
                    </select>
                </label>
            </div>
            <a href="#" class="change-pass-switch" ><p>Change password</p></a>
            <div class="form-group change-password" style="display:none;">
                <label class="validate-password" >Set New Password * </label>
                    <input name="set_new_password" id="set_new_password"  autocomplete="off"  class="input-field" maxlength="80" type="text" placeholder="Set New Password" value="">
               
            </div>
            <div class="form-group " style="display:none;">
                <label>Password *
                    <input name="new_password" id="new_password"  autocomplete="off"  class="input-field" maxlength="80" type="text" placeholder="Type your Password" value="">
                </label>
            </div>
            <div class="close-modal-container">
                <a href="#close-modal" rel="modal:close" class="close-modal cls-user-btn">Close</a>
            </div>
            <!--  -->
            <div class="create-user-button">
                <div class="inner-buttons">
                    <a class="close cls-user-btn ndl-Button ndl-Button--primary ndl-Button--medium" href="#">Close</a>
                    <button type="submit" class="submit-user">Add</button>
                    <button id="update-user" style="display:none;">Update</button>
                </div>
            </div>
    </form>
    </div>
</div>
</div>
<style>
.quotes_entries_count{
    padding:5px;
}
.quotes_entries_count{
    margin-right: 20px;
}
.pagination-container{
    display: flex;
    justify-content: flex-end;
    margin-top: 40px;;
}
.current{
    background: #4caf50 !important;
}
.page-numbers{
    background: #4853d7;
    padding: 10px;
    color: #fff;
}
.delete-user{
    color: red;
    font-size: 1.2em;
    padding-left: 10px;
}
.user-modal-container{
    background: rgba(25,25,50,.5) !important;
    z-index: 99999!important;
}
.disabled{
    color:red;
}
.tool-tip-username{
    background: #0669ac;
    color: #fff;
    padding: 4px;
    width: fit-content;
    position: absolute;
    top: 5%;
    left: 13%;
    transform: translate(50%,50%);
    right: 0;
}
.edit-user{
    color: #28a745;  
    font-size: 1.2em; 
}
.theader-user-management th{
    padding: 15px;
}
.theader-user-management{
    background: #f2f7fb;
   
}
.text-active{
    color:#28a745;
    margin: 8px;
}
.text-inactive{
    margin: 8px;
}
.inner-buttons a{
    text-decoration: none;
    vertical-align: middle;
    line-height: 2.5;
    font-size: 14px;
    font-weight: bold;
}

.create-user-button{
    text-align: center;
    margin-top: 20px;
}
.create-user-button button{
    background: #4655d7;
    border: none;
    color: #fff;
    display: inline-block;
    cursor: pointer;
    vertical-align: top;
    padding: 10px 0;
    border-radius: 4px;
    width: 65px;
    line-height: 1;
    font-weight: 600;
    font-size: 14px;
    margin-left: 10px;

}
.form-group{
    margin-bottom: 15px;
}
.plan-CreateModal-title h1{
    font-size: 16px;
    font-weight: 600;
    line-height: 20px;
}
.form-group input[type="text"],.form-group select,.form-group input[type="email"]{
    width: 100%;
    max-width: 100%;
    min-height: 35px !important;
    padding: 5px 10px;
}
.add-user-modal{
    position: fixed;
    top: -10%;;
    left: 50%;
    right: 0;
    transform: translate(-50%,50%);
}
.user-management-header{
    padding-right:20px;
}
.action-list{
    display:flex;
}
.action-list li{
    padding: 0px 10px;
}
.action-list li i{
    padding: 0px 15px;
    font-size: 1.2rem;
}
.table-header h1{
    font-size: 2.5em;
    color: #0663a6;
}
.table-header{
    display: flex;
    justify-content: space-between;
    align-items: center;
}
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  text-align: left;
  padding: 15px;
  border-bottom: unset!important;
    border-top: unset!important;
    color: rgba(0,0,0,.6509803921568628);
}

tr:nth-child(odd) {
    background: #f2f7fb;
    
}
tbody:nth-last-child(){
border-bottom: 1px solid hsla(0,0%,54.9%,.9333333333333333);
}
</style>