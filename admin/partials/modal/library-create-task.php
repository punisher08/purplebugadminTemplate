 <?php 
	$post = get_post($_GET['attach_id']);

	$user = get_userdata($post->post_author);
 
	if($post->post_type=='attachment'){
		$image_url =$post->guid ;
		$slice = explode('/',$post->post_mime_type);
		$lib_type = $slice[0];
	}else if($post->post_type=='article'){

		$atts_url = get_post_meta($post->ID,'upload_image',true);
		$image_url = wp_get_attachment_url($atts_url[0]);
		$lib_type = $post->post_type;

	}
  $workflowargs = array(
        'numberposts'      => -1,
        'orderby'          => 'date',
        'order'            => 'DESC',
        'post_status'      => 'publish',
        'post_type'        => 'workflow',
 
    );

    $workflows = get_posts( $workflowargs );

    if(!empty($workflows)){
        foreach($workflows as $workflow){
            $w_titlr[] = $workflow->post_title;
        }
    }
?>
 <header class="ndl-Header ndl-Header--page cn-createNewPage-title"><h1 class="ndl-HeaderTitle ndl-HeaderTitle--page ndl-HeaderTitle--medium undefined">Create New Task</h1></header>
    <form id="form-task" action="" method="POST">
    <div class="form-task">
    	   <div class="form-group">
	    	  <input name="task-title" id="task-title" class="input-field" maxlength="80" type="text" placeholder="Enter task title here" value="">
	    	  <p class="ndl-Text ndl-Text--secondary ndl-Input-charCount ndl-CharacterCount ">0/80</p>
	    	</div>
	    	<div class="attachment-details">
	    	   <table>
	    	   	<thead class="tsk-cp-table table">
	    	   		<tr class="table-heading">
	    	   			<th class="table-cell"></th>
	    	   			<th class="table-cell">Title</th>
	    	   			<th class="table-cell">Type</th>
	    	   			<th class="table-cell">Source</th>
	    	   		</tr>
	    	   	</thead>
	    	   	<tbody>
	    	   	    <tr class="table-row image">
		    	   	    <td class="table-cell">
		    	   	    <img src="<?php echo $image_url;?>" alt="long banner thing.JPG" width="100px" height="75px"></td>
		    	   	    <td class="table-cell">
		    	   	    	<div><p class="ndl-Text ndl-Text--body content-title"><?php echo $post->post_title;?></p></div>
		    	   	    </td>
		    	   	    <td class="table-cell file-type"><p class="ndl-Text ndl-Text--body "><?php echo $lib_type;?></p>
		    	   	    </td>
		    	   	    <td class="table-cell"><p class="ndl-Text ndl-Text--body "><?php echo $user->data->user_nicename;?></p></td>
	    	   	    </tr>
	    	   </tbody>
	    	   </table>
	    	</div>
	    	<div class="form-group">
	    		<label> Campaign *
		          <select name="Campaign" class="form-field" id="campaign">
		            <?php 
		            $terms = get_terms( 'campaign', array(
		             'hide_empty' => false, ) );
		             if(!empty($terms)){
		              
		                foreach($terms as $term){
		                  
		                  echo '<option value="'.$term->term_id.'">'.$term->name.'</option>';

		                }
		             }else{
		                  echo '<option val="">Create your campaign</option>';
		              }
		          ?>
		          </select>
		          
		          </label>
	    	</div>
	    	<div class="form-group date-picker">
	    		<div class="form-field right">
	    		<label> Task Start Date *
	    			<input id="start-date" name="task_start_date" type="date" placeholder="" class="input-field ndl-DatePicker-input" value="">
		    		</label>
		    	</div>
		    	<div class="form-field left">
		    		<label> Task End Date *
		    			<input id="end-date" name="task_end_date" type="date" placeholder="" class="input-field ndl-DatePicker-input" value="">
		    		</label>
		    	</div>

	    	</div>
	    	<div class="form-group">
	    		<div class="ui-widget" style="z-index:9999">
              <label>Workfow
              <select class="input-field" id="combobox" readonly>
                <option value>Select one...</option>
                 <?php 
                    if(!empty($workflows)){
                        foreach($workflows as $workflow){
                            echo '<option value="'. $workflow->ID.'">'. $workflow->post_title.'</option>';
                        }
                    }
                 ?>
              </select>
              
               <input  id="workflow_id" name="workflow_id" type="hidden" placeholder="" class="input-field" value="" />
              </label>
            </div>
	    		<div class="workflow_roles">
	    		</div>
	    	</div>

	   <div class="create-task-button">
	 	<input type="hidden" name="attachment_id" id="attachment_id"  value="<?php echo $post->ID;?>">
	 	<div class="inner-buttons">
		  <a class="close ndl-Button ndl-Button--primary ndl-Button--medium" href="#" rel="modal:close">Close</a>
		  <button class="ndl-Button ndl-Button--primary ndl-Button--medium submit-task">Create</button>
		</div>  
	  </div>  	
	  </form>  	
 
    </div>	
 

<script>
jQuery.widget( "custom.combobox", {
                              _create: function() {
                                this.wrapper = jQuery( "<span>" )
                                  .addClass( "custom-combobox" )
                                  .insertAfter( this.element );
                         
                                this.element.hide();
                                this._createAutocomplete();
                                this._createShowAllButton();
                              },
                         
                              _createAutocomplete: function() {
                                var selected = this.element.children( ":selected" ),
                                  value = selected.val() ? selected.text() : "";

                               
                                this.input = jQuery( "<input name='workflow'>" )
                                  .appendTo( this.wrapper )
                                  .val( value )
                                  .attr( "title", "" )
                                  .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
                                  .autocomplete({
                                    delay: 0,
                                    minLength: 0,
                                    source: jQuery.proxy( this, "_source" )
                                  })
                                  .tooltip({
                                    classes: {
                                      "ui-tooltip": "ui-state-highlight"
                                    }
                                  });
                         
                                this._on( this.input, {
                                  autocompleteselect: function( event, ui ) {
                                    ui.item.option.selected = true;
                                    this._trigger( "select", event, {
                                      item: ui.item.option
                                    });

                                      
                                        //log( "Selected: " + ui.item.value + " aka " + ui.item.id );
                                         jQuery('#workflow_id').val(ui.item.option.outerHTML.replace(/[^0-9.]/g, ""));
                                          jQuery.ajax({
                                            url : ajaxurl, // Here goes our WordPress AJAX endpoint.
                                            type : 'GET',
                                            
                                            data : {action:'get_workflow',workflow: ui.item.option.outerHTML.replace(/[^0-9.]/g, "")
                                             
                                            },
                                            success : function( response ) {
                                              jQuery('.workflow_roles').html(response);

                                                jQuery('.ndl-AvatarPicker span.nc-icon').click(function(){

                                                   var data = jQuery(this).attr('data');
                                                    //alert('Hello World');
                                                    jQuery('.assign-'+data).show();
                                                    jQuery('.assign-role'+' .assign-'+data ).change(function() {

                                                     var selectedVal = jQuery(".assign-role .assign-"+data+" option").filter(":selected").val();
                                                     var selectedtext = jQuery(".assign-role .assign-"+data+" option").filter(":selected").text();
                                                     
                                                       
                                                       jQuery('.assign-role').hide();
                                                       jQuery('.role-'+data).text(selectedtext); 
                                                       jQuery('#Qarticle_role_'+data).val(selectedVal);

                                                        
                                                    });

                                                });

                                                jQuery('.tsk-WorkflowForm-dueDate button.ndl-Button').click(function(){
                                                          var data = jQuery(this).attr('data');
                                                          jQuery(this).hide();
                                                          jQuery('.datepicker-'+data).show();
                                                            jQuery('.datepicker-'+data).datepicker({
                                                               option: true,
                                                               dateFormat: 'M d, yy' ,
                                                                onSelect: function (dateText, inst) {
                                                                    
                                                                    var date = jQuery(this).val();
                                                                
                                                                    jQuery('#Qarticle_due_date_'+data).val(date);
                                                                    jQuery('.datepicker-'+data).hide();
                                                                    
                                                                    jQuery('.dueDate-'+data+' .ndl-Button--inline').show();
                                                                    jQuery('.dueDate-'+data+' .ndl-Button--inline span.ndl-Button-label').text('Due on '+date);
                                                                    
                                                                   // 
                                                                   // jQuery('.dueDate-'+data+' button.ndl-Button').show();
                                                                    //jQuery('.dueDate-'+data+' .hasDatepicker').hide();
                                                                    //jQuery('#Qarticle_due_date_'+data).val(date);
                                                                     
                                                                }
                                                            });
                                                        });

                                            } 
                                          }); 

                                    
                                    
                                  },
                         
                                  autocompletechange: "_removeIfInvalid"
                                });
                              },
                         
                              _createShowAllButton: function() {
                                var input = this.input,
                                  wasOpen = false;
                         
                               jQuery( "<a>" )
                                  .attr( "tabIndex", -1 )
                                  .attr( "title", "Show All Items" )
                                  .tooltip()
                                  .appendTo( this.wrapper )
                                  .button({
                                    icons: {
                                      primary: "ui-icon-triangle-1-s"
                                    },
                                    text: false
                                  })
                                  .removeClass( "ui-corner-all" )
                                  .addClass( "custom-combobox-toggle ui-corner-right" )
                                  .on( "mousedown", function() {
                                    wasOpen = input.autocomplete( "widget" ).is( ":visible" );
                                  })
                                  .on( "click", function() {
                                    input.trigger( "focus" );
                         
                                    // Close if already visible
                                    if ( wasOpen ) {
                                      return;
                                    }
                         
                                    // Pass empty string as value to search for, displaying all results
                                    input.autocomplete( "search", "" );
                                  });
                              },
                         
                              _source: function( request, response ) {
                                var matcher = new RegExp( jQuery.ui.autocomplete.escapeRegex(request.term), "i" );
                                response( this.element.children( "option" ).map(function() {
                                  var text = jQuery( this ).text();
                                  if ( this.value && ( !request.term || matcher.test(text) ) )
                                    return {
                                      label: text,
                                      value: text,
                                      option: this
                                    };
                                }) );
                              },
                             
                              _removeIfInvalid: function( event, ui ) {
                         
                                // Selected an item, nothing to do
                                if ( ui.item ) {
                                  return;
                                }
                         
                                // Search for a match (case-insensitive)
                                var value = this.input.val(),
                                  valueLowerCase = value.toLowerCase(),
                                  valid = false;
                                this.element.children( "option" ).each(function() {
                                  if ( jQuery( this ).text().toLowerCase() === valueLowerCase ) {
                                    this.selected = valid = true;
                                    return false;
                                  }
                                });
                         
                                // Found a match, nothing to do
                                if ( valid ) {
                                  return;
                                }
                         
                                // Remove invalid value
                                this.input
                                  .val( "" )
                                  .attr( "title", value + " didn't match any item" )
                                  .tooltip( "open" );
                                this.element.val( "" );
                                this._delay(function() {
                                  this.input.tooltip( "close" ).attr( "title", "" );
                                }, 2500 );
                                this.input.autocomplete( "instance" ).term = "";
                              },
                         
                              _destroy: function() {
                                this.wrapper.remove();
                                this.element.show();
                              }
                            });
                         
                            jQuery( "#combobox" ).combobox();
                         
 

var availableTags = [
                  "Quick Article Post",
                  "Quick Share",
                  "Ad Unit (In Prpgress)",
                  "Articles With Gated Content",
                  "Content Work Flow",
                  "Creatives",
                  "Holcim - Content Ideation",
                  "LeapOut - Content Ideation",
                  "On-page Gated Content",
                  "Product Workflow",
                  "Social Workflow"
                ];
            

                jQuery( "#Workflow" ).autocomplete({
                  source: availableTags,
                   minLength: 0,
                  select: function( event, ui ) {
                    //log( "Selected: " + ui.item.value + " aka " + ui.item.id );
                      jQuery.ajax({
                        url : ajaxurl, // Here goes our WordPress AJAX endpoint.
                        type : 'GET',
                        
                        data : {action:'get_workflow',workflow: ui.item.value
                         
                        },
                        success : function( response ) {
                          jQuery('.workflow_roles').html(response);

                            jQuery('.ndl-AvatarPicker span.nc-icon').click(function(){

                               var data = jQuery(this).attr('data');
                                //alert('Hello World');
                                jQuery('.assign-'+data).show();
                                jQuery('.assign-role').change(function() {
                                 var selectedVal = jQuery(".assign-role option:selected").val();
                                 var selectedtext = jQuery(".assign-role option:selected").text();
                                   
                                    jQuery('.tsk-WorkflowForm-target').text(selectedtext);
                                    jQuery('.assign-role').hide();
                                    
                                    jQuery('#Qarticle_role_'+data).val(selectedVal);

                                    
                                });

                            });

                            jQuery('.tsk-WorkflowForm-dueDate button.ndl-Button').click(function(){
                                      var data = jQuery(this).attr('data');
                                      jQuery(this).hide();
                                      jQuery('.datepicker').show();
                                        jQuery('.datepicker').datepicker({
                                           option: true,
                                           dateFormat: 'M d, yy' ,
                                            onSelect: function (dateText, inst) {
                                                
                                                var date = jQuery(this).val();
                                                jQuery('.tsk-WorkflowForm-dueDate button.ndl-Button span.ndl-Button-label').text('Due on '+date);
                                                jQuery('.tsk-WorkflowForm-dueDate button.ndl-Button').show();
                                                jQuery('.tsk-WorkflowForm-dueDate .hasDatepicker').hide();
                                                jQuery('#Qarticle_due_date_'+data).val(date);
                                                 
                                            }
                                        });
                                    });

                        } 
                      }); 
                  }
                }).focus(function(){
                    jQuery(this).autocomplete("search", "");
                });
</script>  
<style>
/*Modal*/
.ui-widget {
    z-index: 999999;
}
.datepicker {
    position: absolute;
}
.tsk-WorkflowForm-step {
    align-items: center;
    border: 1px solid #ccccdc;
    margin: 15px 0;
    display: flex;
    padding: 0 12px;
    border-radius: 4px;
    position: relative;
}
.tsk-WorkflowForm-container .tsk-WorkflowForm-selector {
    margin-right: 16px;
}
span.custom-combobox {
    position: relative;
}

span.custom-combobox a.ui-button {
    position: absolute;
    top: -12px;
    right: 0;
    height: 39px;
    width: 37px;
    background: transparent;
    border: none;
}
.ndl-AvatarPicker {
    align-items: center;
    width: 100px;
    text-align: center;
}
.assign-role {
    position: absolute;
    left: -243px;
    background: #fff;
    padding: 10px;
    width: 240px;
    border: 1px solid #ccccdc;
    border-radius: 4px;
}
.tsk-WorkflowForm-step .tsk-WorkflowForm-substep {
    align-items: center;
    display: flex;
}
.tsk-WorkflowForm-dueDate {
    width: 165px;
}

.tsk-WorkflowForm-dueDate button.ndl-Button {
    background: transparent;
    border: none;
    color: #4655d7;
    font-weight: bold;
    padding: 0;
    font-size: 12px;
}
.ndl-AvatarPicker span.nc-icon svg {
    width: 10px;
    /* fill: #4655d7 !important; */
    /* color: #4655d7; */
}
.ndl-AvatarPicker span.nc-icon {
    width: 10px;
    border: dashed 1px #4655d7;
    line-height: 0;
    padding: 9px;
    border-radius: 50%;
    height: 9px;
    display: inline-block;
}

.ndl-AvatarPicker span.nc-icon svg g path {
    fill: #4655d7 !important;
    color: #4655d7;
}

.ndl-HeaderTitle--medium {
    font-size: 16px;
    font-weight: 600;
    line-height: 20px;
    /* margin-bottom: 0; */
}
.tsk-WorkflowForm-assignee {
    width: 90%;
}
.hasDatepicker .ui-datepicker {
    position: absolute;
}
input#config-demo {
    border: none;
    background: none;
    color: #191932;
    cursor: pointer;
    display: inline-flex;
    font-size: 14px;
    font-weight: 600;
    white-space: nowrap;
    width: 215px;
    text-align:center;
}
.ui-widget.ui-widget-content {
    border: 1px solid #c5c5c5;
}
span.custom-combobox .custom-combobox-input {
    width: 100%;
    height: 36px;
    background: transparent;
    padding: 10px;
    padding-right: 20px;
}
span.custom-combobox a.ui-button {
    position: absolute;
    top: 0px;
    right: 0;
    height: 39px;
    width: 37px;
    background: transparent;
    border: none;
}
.form-task .form-group .input-field {
    width: 100%;
}

#create-task-modal header.ndl-Header h1 {
    text-align: center;
    margin-bottom: 30px;
}
.jquery-modal.blocker.current {
    background: #fff !important;
}
 
.attachment-details table {
    width: 100%;
    border-collapse: collapse;
}
.attachment-details tbody tr.table-row tr, .attachment-details tbody tr.table-row td{
       padding: 12px;
    line-height: 20px;
    font-size: 14px;
    color: #79798f;
    font-weight: 600;
    border-bottom: solid 2px #74748b;
}
.attachment-details table thead.tsk-cp-table tr, .attachment-details table thead.tsk-cp-table tr th {
    background: #ededf4;
    padding: 12px;
    line-height: 20px;
    font-size: 14px;
    color: #79798f;
    font-weight: 600;
    border-bottom: solid 2px #74748b;
 
}
.ndl-Labels-container {
    margin-bottom: 20px;
}
.bd-example-modal-lg {max-width: 700px;width: 100%;box-shadow: none !important; vertical-align: baseline;}

.form-task .form-group {
    margin-top: 15px;
}
.form-task .form-group .form-field,.form-task .form-group label {
    width: 100% !important;
    display: block;
    max-width: 100%;
    display: grid;
}

.form-task .form-group.date-picker {
    display: flex;
}
.form-task .form-group.date-picker .form-field {padding-right: 35px;}

.form-task .form-group.date-picker .form-field input {
    padding: 6px;
    border-radius: 3px;
    border: solid 1px #a2a2a2;
}
.form-task .form-group.date-picker .form-field:last-child {
    padding: 0;
}
.create-task-button {
    position: fixed;
    width: 100%;
    left: 0;
    bottom: 0;
    background: #fff;
    border-top: 1px solid #d2d2d2;
    padding: 16px 0;
    text-align:center;
}
.create-task-button .submit-task {
    background: #4655d7;
    border: none;
    color: #fff;
    display: inline-block;
    vertical-align: top;
    padding: 10px 0;
    border-radius: 4px;
    width: 65px;
    line-height: 1;
    font-weight: 600;
    font-size: 14px;
    margin-left: 10px;
}
.create-task-button .close {
    text-decoration: none;
 
    vertical-align: middle;
    line-height: 2.5;
    font-size: 14px;
    font-weight: bold;
}
</style>  