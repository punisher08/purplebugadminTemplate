
<?php
	$user = wp_get_current_user();

 ?>
<div class="admin-top-head">
		    	<div class="admin-header left">
		    		<div class="org-logo">
				      <a class="logo" ui-sref="marketing_cloud.home" style="background: !important" href="	
<?php echo get_site_url(); ?>">
				          <img class="avatar" src="<?php echo get_site_icon_url(); ?>" width="32" height="32">
				          
				         </a>
				    </div>
				    <div class="user-name">
				    	<a class="logo" ui-sref="marketing_cloud.home" style="background: !important" href="	
<?php echo get_site_url(); ?>/wp-admin/index.php">
				    		<span class="ppb-name"><?php echo $user->data->display_name;?></span>
				    	</a>	
				    </div>
				    <div class="search-field">
				    	<button  class="open-drop ndl-Button ndl-Button--default ndl-Button--medium    ndl-Dropdown-button" type="button"><span class="ndl-Button-label" id="selected_tag_value">Campaigns</span><span class="nc-icon ndl-Icon   ndl-Button-chevron "><i class="nc-icon-wrapper"><svg class="nc-icon glyph" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16"><g transform="translate(0, 0)"><polygon fill="#444444" points="8,12.6 0.3,4.9 1.7,3.4 8,9.7 14.3,3.4 15.7,4.9 "></polygon></g></svg></i></span></button>
				    	<div id="drop-down"  class="ui-widget" style="display:none">
						  <div class="search-field-drop">
						  <input id="tags" placeholder="Search...">
						  
						  <span class="nc-icon ndl-Icon   ndl-Dropdown-searchIcon "><i class="nc-icon-wrapper"><svg viewBox="0 0 16 17" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><desc>Created with Sketch.</desc><defs></defs><g id="UI" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="16" transform="translate(-217.000000, -399.000000)" fill="#444444"><path d="M229.7,410.3 C230.6,409.1 231.1,407.7 231.1,406.1 C231.1,402.2 228,399 224.1,399 C220.2,399 217,402.2 217,406.1 C217,410 220.2,413.2 224.1,413.2 C225.7,413.2 227.2,412.7 228.3,411.8 L231.3,414.8 C231.5,415 231.8,415.1 232,415.1 C232.2,415.1 232.5,415 232.7,414.8 C233.1,414.4 233.1,413.8 232.7,413.4 L229.7,410.3 L229.7,410.3 Z M224.1,411.1 C221.3,411.1 219,408.9 219,406.1 C219,403.3 221.3,401 224.1,401 C226.9,401 229.2,403.3 229.2,406.1 C229.2,408.9 226.9,411.1 224.1,411.1 L224.1,411.1 Z" id="Fill-191"></path></g></g></svg></i></span>
						  </div>
						</div>

				    </div>
				    <div class="search2">
				    	<span class="ndl-Input-field     "><input class="ndl-Input-input " maxlength="145" type="text" placeholder="" value=""><span class="nc-icon ndl-Icon   ndl-Input-icon nc-click-hover cstm_search"><i class="nc-icon-wrapper"><svg viewBox="0 0 16 17" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><desc>Created with Sketch.</desc><defs></defs><g id="UI" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="16" transform="translate(-217.000000, -399.000000)" fill="#444444"><path d="M229.7,410.3 C230.6,409.1 231.1,407.7 231.1,406.1 C231.1,402.2 228,399 224.1,399 C220.2,399 217,402.2 217,406.1 C217,410 220.2,413.2 224.1,413.2 C225.7,413.2 227.2,412.7 228.3,411.8 L231.3,414.8 C231.5,415 231.8,415.1 232,415.1 C232.2,415.1 232.5,415 232.7,414.8 C233.1,414.4 233.1,413.8 232.7,413.4 L229.7,410.3 L229.7,410.3 Z M224.1,411.1 C221.3,411.1 219,408.9 219,406.1 C219,403.3 221.3,401 224.1,401 C226.9,401 229.2,403.3 229.2,406.1 C229.2,408.9 226.9,411.1 224.1,411.1 L224.1,411.1 Z" id="Fill-191"></path></g></g></svg></i></span></span>
				    </div>
		    	</div>
		    	<div class="admin-header right">
		    		<div class="right-most">
		    			
		    			<button class="dropdown-toggle small button-create-new" aria-haspopup="true" aria-expanded="false">
				            <span class="nc-icon ng-isolate-scope" ng-style="iconStyle" name="plus-new">
							<!-- ngIf: svg --><i class="nc-icon-wrapper ng-binding ng-scope" ng-if="svg" ng-bind-html="svg"><svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15.84 15.84"><defs></defs><path fill="#444" d="M13.17,7.28H8.56V2.67a.64.64,0,0,0-1.28,0V7.28H2.67a.64.64,0,1,0,0,1.28H7.28v4.61a.64.64,0,0,0,1.28,0V8.56h4.61a.64.64,0,1,0,0-1.28Z"></path></svg></i><!-- end ngIf: svg -->
							</span>
							<ul class="list-nav-action" style="display:none">
							  <!-- ngIf: ::currentUser.can('create', 'campaign') -->
                                    <li class="dropdown-item ng-scope" ng-if="::currentUser.can('create', 'campaign')" ui-sref="marketing_cloud.create_new({objectType: 'campaign'})" href="/cloud/new/campaign">
                                        <a href="/wp-admin/edit-tags.php?taxonomy=campaign&post_type=event-task" class="dropdown-link">
                                           <span class="dashicons dashicons-megaphone"></span>
                                            <span class="dropdown-text">Campaign</span>
                                        </a>
                                    </li>
                                    <!-- end ngIf: ::currentUser.can('create', 'campaign') -->
                                    <!-- ngIf: ::currentUser.can('create', 'event') -->
                                    <li class="dropdown-item ng-scope" ng-if="::currentUser.can('create', 'event')" ui-sref="marketing_cloud.create_new({objectType: 'event'})" ng-click="sendClickAnalyticsForDropdownItemUsage({'item': 'Event'})" href="/cloud/new/event">
                                        <a href="/wp-admin/admin.php?page=plan&view=calendar" class="dropdown-link">
                                           <span class="dashicons dashicons-calendar"></span>
                                            <span class="dropdown-text">Event</span>
                                        </a>
                                    </li>
                                    <!-- end ngIf: ::currentUser.can('create', 'event') -->
                                    <!-- ngIf: ::currentUser.can('create', 'pitchRequest') -->
                            
                                    <!-- end ngIf: ::currentUser.can('create', 'pitchRequest') -->
                                    <!-- ngIf: ::currentUser.can('create', 'task') -->
                                    <li class="dropdown-item ng-scope" ng-if="::currentUser.can('create', 'task')" ui-sref="marketing_cloud.create_new({objectType: 'task'})" href="/cloud/new/task">
                                        <a href="/wp-admin/admin.php?page=plan&view=calendar" class="dropdown-link">
                                            <span class="dashicons dashicons-editor-ul"></span> 
                                            <span class="dropdown-text">Task</span>
                                        </a>
                                    </li>
                                   
                                    <!-- end ngIf: ::currentUser.can('create', 'workRequests') -->
							</ul>
				        </button>
				        <ul class="icon-on-top">
							  <li class="action-item notifications ng-scope" id="notepad" ng-if="::currentUser.canAccessFeature('ideaLab')">
						        <a href="javascript:;" class="action-link notification-link" ng-click="toggleTray('notepad'); $event.stopPropagation()" ng-class="{'active': showTray &amp;&amp; trayContent === 'notepad'}">
									          <div class="new-nav-icon" tooltip="Notepad" tooltip-placement="bottom"><!--?xml version="1.0" encoding="UTF-8"?-->
									<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15.84 15.84">
									  <defs></defs>
									  <path fill="#444" d="M13,2.3H4.14a.56.56,0,0,0-.59.53v1.9H2.93A.64.64,0,1,0,2.93,6h.62V7.28H2.93a.64.64,0,1,0,0,1.28h.62V9.83H2.93a.64.64,0,0,0,0,1.28h.62V13a.56.56,0,0,0,.59.54H13a.56.56,0,0,0,.59-.54V2.83A.56.56,0,0,0,13,2.3ZM9.09,9.83H6.24a.64.64,0,0,1,0-1.27H9.09a.64.64,0,0,1,0,1.27Zm1.62-2.55H6.24A.64.64,0,1,1,6.23,6h4.48a.64.64,0,0,1,0,1.27Z"></path>
									</svg>
									</div>
						        </a>
						      </li>
						      <li class="action-item notifications single" id="notifications" ng-class="notificationBasket.getNotificationCountDigits()" style="">
						        <a href="javascript:;" class="action-link notification-link" ng-click="toggleTray('notification'); $event.stopPropagation()" ng-class="{'active': showTray &amp;&amp; trayContent === 'notification'}">
						          <span class="notification-badge unread ng-binding" ng-show="notificationBasket.unreadNotifications().length" ng-bind="notificationBasket.unreadNotifications().length" style="">2</span>
						          <div class="icon" tooltip="Notifications" tooltip-placement="bottom">
						            <!--?xml version="1.0" encoding="UTF-8"?-->
						            <svg width="16px" height="16px" viewBox="0 0 16 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
						                <!-- Generator: Sketch 44.1 (41455) - http://www.bohemiancoding.com/sketch -->
						                <desc>Created with Sketch.</desc>
						                <defs></defs>
						                <g id="UI" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						                    <g id="16" transform="translate(-361.000000, -783.000000)" fill="#444444">
						                        <path d="M376,794 C376.6,794 377,794.4 377,795 C377,795.6 376.6,796 376,796 L362,796 C361.4,796 361,795.6 361,795 C361,794.4 361.4,794 362,794 L362.5,794 C363.2,793.3 364,792.3 364,791 L364,788 C364,785.2 366.2,783 369,783 C371.8,783 374,785.2 374,788 L374,791 C374,792.3 374.8,793.3 375.5,794 L376,794 Z M371,797 C371,798.1 370.1,799 369,799 C367.9,799 367,798.1 367,797 L371,797 Z" id="Fill-312"></path>
						                    </g>
						                </g>
						            </svg>
						          </div>
						        </a>
						      </li>
						      <li class="action-item notifications" id="task-tray">
						        <a href="javascript:;" class="action-link notification-link" ng-click="toggleTray('task'); $event.stopPropagation()" ng-class="{'active': showTray &amp;&amp; trayContent === 'task'}">
						          <span class="notification-badge ng-binding overdue" ng-show="userTaskBasket.tasks.length" ng-class="{'overdue': userHasOverdueTasks()}" ng-bind="userTaskBasket.tasks.length" style="">2</span>
						          <div class="icon" tooltip="Tasks" tooltip-placement="bottom">
						            <!--?xml version="1.0" encoding="UTF-8"?-->
						            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 16 16">
						              <g transform="translate(0, 0)">
						                <path data-color="color-2" fill="#444444" d="M6.3,11.7l-2-2c-0.4-0.4-0.4-1,0-1.4s1-0.4,1.4,0L7,9.6l3.3-3.3c0.4-0.4,1-0.4,1.4,0
						                  s0.4,1,0,1.4l-4,4C7.3,12.1,6.8,12.2,6.3,11.7z">
						                </path>
						                <path fill="#444444" d="M15,1h-3v2h2v11H2V3h2V1H1C0.4,1,0,1.4,0,2v13c0,0.6,0.4,1,1,1h14c0.6,0,1-0.4,1-1V2C16,1.4,15.6,1,15,1z">
						                </path>
						                <rect data-color="color-2" x="5" fill="#444444" width="6" height="4">
						                </rect>
						              </g>
						            </svg>
						          </div>
						        </a>
						      </li>
						      <li class="action-item help" id="help">
						        <nc-global-help-icon on-select-handler="onSelectSupportOptionHandler" class="ng-isolate-scope"><div class="ndl-Dropdown  help-dropdown"><button class="ndl-Button ndl-Button--secondaryAlt ndl-Button--large    help-dropdown-btn ndl-Button--iconOnly" type="button"><span class="nc-icon ndl-Icon   ndl-Button-icon "><i class="nc-icon-wrapper"><svg viewBox="0 0 16 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><desc>Created with Sketch.</desc><defs></defs><g id="UI" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="16" transform="translate(-505.000000, -351.000000)" fill="#444444"><path d="M513,351 C508.6,351 505,354.6 505,359 C505,363.4 508.6,367 513,367 C517.4,367 521,363.4 521,359 C521,354.6 517.4,351 513,351 L513,351 Z M513,364 C512.4,364 512,363.6 512,363 C512,362.4 512.4,362 513,362 C513.6,362 514,362.4 514,363 C514,363.6 513.6,364 513,364 L513,364 Z M514.5,359.4 C514,359.7 514,359.8 514,360 L514,361 L512,361 L512,360 C512,358.7 512.8,358.1 513.4,357.7 C513.9,357.4 514,357.3 514,357 C514,356.4 513.6,356 513,356 C512.6,356 512.3,356.2 512.1,356.5 L511.6,357.4 L509.9,356.4 L510.4,355.5 C510.9,354.6 511.9,354 513,354 C514.7,354 516,355.3 516,357 C516,358.4 515.1,359 514.5,359.4 L514.5,359.4 Z" id="Fill-185"></path></g></g></svg></i></span><span class="nc-icon ndl-Icon   ndl-Button-chevron "><i class="nc-icon-wrapper"><svg class="nc-icon glyph" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16"><g transform="translate(0, 0)"><polygon fill="#444444" points="8,12.6 0.3,4.9 1.7,3.4 8,9.7 14.3,3.4 15.7,4.9 "></polygon></g></svg></i></span></button></div></nc-global-help-icon>
						      </li>
						      

				        </ul>


		    			<ul>
		    				<li class="action-item account-menu" id="account-menu">
					        <div class="dropdown open" style="">
					          <a href="javascript:;" class="action-link dropdown-toggle account-menu-link" aria-haspopup="true" aria-expanded="true">
					            <div class="new-user-avatar nc-user-avatar ng-isolate-scope" user="currentUser">
				                 <?php 
    				            $user = wp_get_current_user();
    				            
    				            $userdata = get_userdata($user->ID);
    				      
     
                                if ( $user ) :
                                    ?>
                                    <img src="<?php echo esc_url( get_avatar_url( $user->ID, ['size' => '35'] ) ); ?>" />
                            <?php endif; ?>
					</div>
					            <span class="nc-icon ng-isolate-scope" ng-style="iconStyle" name="chevron-down" size="12" style="width: 12px; height: 12px;">
					<!-- ngIf: svg --><i class="nc-icon-wrapper ng-binding ng-scope" ng-if="svg" ng-bind-html="svg"><svg class="nc-icon glyph" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16"><g transform="translate(0, 0)"><polygon fill="#444444" points="8,12.6 0.3,4.9 1.7,3.4 8,9.7 14.3,3.4 15.7,4.9 "></polygon></g></svg></i><!-- end ngIf: svg -->
					</span>
					          </a>
					          <div class="dropdown-menu">
					            <ul class="dropdown-ul">

					              <!-- ngRepeat: section in settingsSections | orderBy: 'sortOrder' track by section.name --><li class="dropdown-item ng-scope" ng-repeat="section in settingsSections | orderBy: 'sortOrder' track by section.name">
					                <a class="dropdown-link" ui-sref="marketing_cloud.settings.user" href="<?php echo get_site_url(); ?>/wp-admin/user-edit.php?user_id=<?php echo $user->ID;?>&wp_http_referer=%2Fwp-admin%2Fusers.php">
					                  <span class="icon nc-icon ng-isolate-scope" ng-style="iconStyle" name="user">
					<!-- ngIf: svg --><i class="nc-icon-wrapper ng-binding ng-scope" ng-if="svg" ng-bind-html="svg"><svg viewBox="0 0 14 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><desc>Created with Sketch.</desc><defs></defs><g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="Settings---Organaization-2-Copy-9" transform="translate(-87.000000, -82.000000)" fill="#676767"><g id="Group" transform="translate(76.000000, 80.000000)"><path d="M18,11 C15.8,11 14,9.2 14,7 L14,6 C14,3.8 15.8,2 18,2 C20.2,2 22,3.8 22,6 L22,7 C22,9.2 20.2,11 18,11 Z M20,13 C22.8,13 25,15.2 25,18 L11,18 C11,15.2 13.2,13 16,13 L20,13 Z" id="Fill-14"></path></g></g></g></svg></i><!-- end ngIf: svg -->
					</span>
					                  <span class="dropdown-text ng-binding" ng-bind="section.label"><?php echo $userdata->data->user_nicename; ?> (<?php echo $userdata->roles[0]; ?>)</span>
					                </a>
					              </li><!-- end ngRepeat: section in settingsSections | orderBy: 'sortOrder' track by section.name -->
					              <li class="dropdown-item logout">
					                <a href="<?php echo wp_logout_url();?>" class="dropdown-link" >
					                  <i class="icon icon-power-small"></i>
					                  <span class="dropdown-text">Logout</span>
					                </a>
					              </li>
					            </ul>
					          </div>
					        </div>
					      </li>
		    			</ul>
		    		</div>
		    	</div>
		    </div>
		<script>
		  jQuery('button.dropdown-toggle.small.button-create-new').click(function () {
             jQuery('ul.list-nav-action').toggleClass('active');
             jQuery('ul.list-nav-action.active').show();
           
        
        });
        
         jQuery('div#wpbody').click(function () {
               jQuery('ul.list-nav-action').hide();
        
            });  
		    
		</script>   
		<style>
		    .new-user-avatar img {
                border-radius: 50%;
                margin-right: 10px;
                margin-top: 5px;
            }
		</style>
		    