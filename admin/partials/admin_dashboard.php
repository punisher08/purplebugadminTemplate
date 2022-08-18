<?php
$article_args = array(
    'numberposts'      => -1,
    'category'         => 0,
    'orderby'          => 'date',
    'order'            => 'DESC',
    'include'          => array(),
    'exclude'          => array(),
    'meta_key'         => '',
    'meta_value'       => '',
    'post_type'        => 'article',
    'suppress_filters' => true,
);
$articles = get_posts($article_args);
$total_articles = count($articles);

$plan_args = array(
    'orderby' => 'date',
    'order'   => 'DESC',
    'post_type' => 'event-task',
     'posts_per_page' => -1
    );
$plans = get_posts($plan_args);
$total_plans = count($plans);

$forms_args = array(
    'orderby' => 'date',
    'order'   => 'DESC',
    'post_type' => 'workflowlog',
     'posts_per_page' => -1
    );
$forms = get_posts($forms_args);
$total_forms = count($forms);

$query_img_args = array( 
    'post_type' => 'attachment', 
    'post_mime_type' =>array( 
    'jpg|jpeg|jpe' => 'image/jpeg', 
    'gif' => 'image/gif', 
    'png' => 'image/png', 
    ), 
    'post_status' => 'inherit', 
    'posts_per_page' => -1, 
); 
$query_img = new WP_Query( $query_img_args ); 
$total_media_files = $query_img->post_count; 
$order = get_option('user_sort','ASC');
$order_by  = get_option('user_sort_by','user_login');
$post_per_table  = get_option('post_per_table','5');
   
?>
<div class="custom-dashboard">
    <div class="dashboard-items">
        <div class="dashboard-cards col-4">
            <a href="/wp-admin/edit.php?post_type=article" class="dashboard-page-links">
                <div class="dashboard-card-body">
                    <div class="dashboard-content">
                        <h2><?=$total_articles;?></h2>
                    </div>
                    <div class="item-icon_des">
                        <span class="wp-menu-image dashicons-before dashicons-media-document" aria-hidden="true">No. of Articles</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="dashboard-cards col-4">
            <a href="/wp-admin/admin.php?page=plan" class="dashboard-page-links">
                <div class="dashboard-card-body">
                    <div class="dashboard-content">
                        <h2><?=$total_plans;?></h2>
                    </div>
                    <div class="item-icon_des">
                        <span class="wp-menu-image dashicons-before dashicons-editor-ul" aria-hidden="true">No. of Plans</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="dashboard-cards col-4">
            <a href="/wp-admin/admin.php?page=email-logs" class="dashboard-page-links">
                <div class="dashboard-card-body">
                    <div class="dashboard-content">
                        <h2><?=$total_forms;?></h2>
                    </div>
                    <div class="item-icon_des">
                        <span class="wp-menu-image dashicons-before dashicons-email-alt" aria-hidden="true">No. of Workflow Emails</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="dashboard-cards col-4">
            <a href="/wp-admin/admin.php?page=library" class="dashboard-page-links">
                <div class="dashboard-card-body">
                    <div class="dashboard-content">
                        <h2><?=$total_media_files;?></h2>
                    </div>
                    <div class="item-icon_des">
                        <span class="wp-menu-image dashicons-before dashicons-book-alt" aria-hidden="true">No. of Media files on Library</span>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <!-- Include Calendar -->
    <div class="calendar-dashboard-widget user-management-header">
        <div class="table-header">
            <div class="title"><h1>Recent Activities</h1></div>
            <div class="right-side">
                <ul class="action-list">
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
        <?php
        /////////////////////////////////////////////////////////////
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
        /////////////////////////////////////////////////////////////
            $output = '';
            // $all_users = get_users("orderby=$order_by&order=$order");
            global$wpdb;
            $all_users = $wpdb->get_results("SELECT * FROM $wpdb->users ORDER BY $order_by  $order LIMIT $offset, $items_per_page" );
            foreach($all_users as $user){
                $last_login_date = get_user_meta($user->ID,'last_login_dnt') ? get_user_meta($user->ID,'last_login_dnt'): false ;
                $is_active = get_user_meta($user->ID,'is_current_login');
                ($is_active[0] == 1) ? $stat = '<i class="fas fa-circle text-active"></i>Active': $stat = '<i class="fas fa-circle text-inactive"></i>Inactive';
                if($last_login_date){
                    $time = strtotime(current_time('y-m-d h:i:s')) - strtotime($last_login_date[0]);
                    if($is_active[0] == 1){
                        $t = '';
                    }else{
                        $t = get_time_lapsed($time);
                    }
                }else{
                    $t = 'No records found';
                }
                
                $output .= '<tr>';
                $output .= '<td>'.$user->ID.'</td>';
                $output .= '<td>'.$user->user_login.'</td>';
                $output .= '<td>'.$stat.'</td>';
                $output .= '<td>'.$last_login_date[0].'</td>';
                $output .= '<td>'.$t.'</td>';
                $output .= '</tr>';
            }
        ?>
        <table>
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>Status</th>
                <th>Last login date</th>
                <th></th>
            </tr>
            <?=$output;?>
        </table>
        <div class="pagination-container">
            <?php echo $customPagHTML_count; ?>
            <?php echo $customPagHTML; ?>
        </div>
    </div>
</div>
<?php
function get_time_lapsed($time){
    $time = ($time<1)? 1 : $time;
    $tokens = array (
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    );
    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
    }
}
?>
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
.action-list{
    display:flex;
}
.action-list li{
    padding: 0px 10px;
}
.action-list li i{
    /* padding: 0px 15px; */
    font-size: 1.2rem;
}
.text-inactive{
    margin: 8px;
}
.text-active{
    color:#28a745;
    margin: 8px;
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
    .calendar-dashboard-widget{
        margin-top:50px;
        width:100%;
    }
    .dashboard-page-links{
        text-decoration:none;
    }
    .item-icon_des span{
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 15px;
    }

    span.wp-menu-image:before {
        font-size:2rem !important;
        line-height: 17px;
        margin-right: 20px;
    }
    .dashboard-items{
        display: flex;
        column-gap: 15px;
        margin-top:20px;
    }
    .dashboard-cards{
        border-radius: 1rem!important;
        background: linear-gradient(to bottom right,#679ee2,#0663a6)!important;
    }
    .dashboard-card-body{
        flex: 1 1 auto;
        min-height: 1px;
        padding: 1.25rem;
        color: #fff;
        text-align: center;
    }
    .col-4{
        width:25%;
    }
    .dashboard-card-body h2{
        font-family:inherit;
        color: #fff;
        font-size: 5em;
        margin: 45px;
    }
    .dashboard-content{
        border-bottom: 1px solid #fff;
        text-align: center;
    }

</style>