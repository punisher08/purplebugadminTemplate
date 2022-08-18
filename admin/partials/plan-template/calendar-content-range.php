<input type="text" id="config-demo" class="form-control">
<div id='calendar' style="opacity:0"></div>

<style>

td.fc-daygrid-day {
    max-height: 100px;
    position: relative;
}
.fc .fc-daygrid-event-harness-abs,
.fc .fc-daygrid-body-balanced .fc-daygrid-day-events {
    position: inherit !important;
    visibility:visible !important;
}
.fc-daygrid-day-events .fc-event-main img.feature-image {
    max-height: 92px;
}
#calendar {
    max-width: 1100px;
    margin: 20px auto;
    margin-top: 20px;
    margin-right: auto;
    margin-bottom: 20px;
    margin-left: auto;
}
.fc .fc-daygrid-event-harness {
    margin-bottom: 20px !important;
}
.fc-header-toolbar.fc-toolbar.fc-toolbar-ltr {
    display: none;
}
.fc-event-resizable span.title {
    clear: both;
    font-weight: bold;
    padding: 0 7px;
    margin-top: 5px;
    color: #636060;
    text-transform: capitalize;
    display: block;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.fc-event-title.fc-sticky {
    color: #000;
    font-weight: bold;
    text-align: center;
    display: block;
    border: solid 1px #c1c1c1;
    border-radius: 4px;
}
.fc-daygrid-event-harness, a.fc-daygrid-event {
    padding: 0 !important;
    margin: 0 !important;
}
a.fc-daygrid-event {
    background: transparent;
    border: transparent;
    padding: 4px;
}
.medias {
    float: left;
    width: 100%;
    padding: 0 7px;
    color: #74748b;
}
button.add-new {
    width: 100%;
    height: 48px;
    background: none;
    border: 1px dashed #ccccdc !important;
    padding: 10px;
    cursor: pointer;
}
.fc .fc-daygrid-day-frame {
    min-height: auto !important;
}
.new-container{
    width: 100%;
}
.medias span.media {
    display: block;
    font-weight: bold;
}
.medias span.media .time {
    /* display: flex; */
    margin-right: 8px;
    font-style: normal;
    font-weight: 500;
}
 
.new-container ul.ndl-Dropdown-menuItems {
    margin: -13px auto;
    text-align: center;
    max-height: 250px;
    background: #fff !important;
    overflow: auto;
    width: 74px;
    border: solid 1px #c1c1c1;
    border-radius: 4px;
    position: absolute;
    right: 40px;
    z-index: 99;
}

.new-container ul.ndl-Dropdown-menuItems li {
    margin: 0;
    color: #191932;
    padding: 8px 12px;
    cursor: pointer;
}

.new-container ul.ndl-Dropdown-menuItems li:hover {
    background-color: #f5f7fa;
}
 
.form-group{
    margin-bottom:15px;
}
 .form-group textarea,
 .form-group select, .form-group .input-field {
    width: 100%;
    max-width: 100%;
    min-height: 35px !important;
    padding: 5px 10px;
}

div#create-task .create-task-button {
    text-align: center;
    margin-top: 20px;
}
.create-task-button {
    text-align: center;
}
.create-task-button .submit-task {
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

.create-task-button .close {
    text-decoration: none;
    vertical-align: middle;
    line-height: 2.5;
    font-size: 14px;
    font-weight: bold;
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
}
.tsk-WorkflowForm-container .tsk-WorkflowForm-selector {
    margin-right: 16px;
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


</style>
<?php 
  $args = array(
        'numberposts'      => -1,
        'orderby'          => 'date',
        'order'            => 'DESC',
        'post_type'        => 'event-task',
        'post_status'    => 'publish'
    );

  $posts = get_posts($args); 
  if(!empty($posts)){
    $push = array();
    foreach($posts as $post){
      $post_id = $post->ID;
      $task_start_date=  get_post_meta($post_id,'task_start_date',true);
      $task_end_date = get_post_meta($post_id,'task_end_date',true);
      $attachment_id =get_post_meta($post_id,'attachment_id',true);
      //echo $attachment_id;
      //$feat_image_url = ;

      $imageids = get_post_meta($attachment_id,'upload_image',true);

      $imageurl = wp_get_attachment_url($imageids[0]);

      $push[]= array( 
          'title' => (get_the_title($attachment_id)!='')?get_the_title($attachment_id):$post->post_title,
          'start'=>$task_start_date,
          'end'=>$task_start_date,
          'imageUrl'=>$imageurl,
          'id' =>$post_id
          
          //'imageUrl'=> 

        );
      
    }

    
  }
 

   $url = get_site_url().'/wp-admin/admin.php?page=view-plan&id=';
 
?>
<script class="calendar">
var date = new Date();
var minus30 = date.setDate(date.getDate() +30); // add 30 days 
var plus30 = date.setDate(date.getDate() ); // add 30 days 
calendar_v(<?php echo $_GET['start']?>,<?php echo $_GET['end']?>,);
jQuery('#config-demo').daterangepicker({
    "timePicker": true,
    locale: {
            format: 'MMM D, Y'
        },
    ranges: {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    "alwaysShowCalendars": true,
    "startDate": plus30,
    "endDate": date,
    "drops": "auto"
}, function(start, end, label) {
//  console.log(start);
  console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
        jQuery.ajax({
            type: "GET",
            url: ajaxurl, 
            data : { action:'get_cal_range', start:start.format('YYYY-MM-DD'),end:end.format('YYYY-MM-DD') }, // serializes the form's elements.
            success: function(data) {
                jQuery('.result').html(data);
            }
        });
   // calendar_v(start.format('YYYY-MM-DD'),end.format('YYYY-MM-DD'));

});

function calendar_v(start,end){

  document.addEventListener('DOMContentLoaded', function() {
    var cal_url = '<?php echo $url;?>';

    var d = new Date();

    var month = d.getMonth()+1;
    var day = d.getDate();

    var output = d.getFullYear() + '-' +
        ((''+month).length<2 ? '0' : '') + month + '-' +
        ((''+day).length<2 ? '0' : '') + day;
  
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
  
      headerToolbar: {
        left: '',
        center: 'title',
         right: 'dayGridMonth'
      },
      //defaultView: 'basicWeek',
       // defaultView: 'dayGridMonth',
         validRange: {
          start: start,
          end: end
        },
      selectable: true,
      selectHelper: false,
      editable: true,
      eventClick: function(info) {
         window.location.assign(cal_url+info.event._def.publicId+'#content'); 
      },
      dateClick: function (arg){
      jQuery('.new-container').remove();

      jQuery( arg.dayEl ).append('<div class="new-container"><button class="add-new ndl-Button ndl-Button--inline ndl-Button--medium    ndl-Dropdown-button" type="button"><span class="ndl-Button-label">+ Add New</span></button><ul class="ndl-Dropdown-menuItems is-scrollable"><li class="create-task"><div class="ndl-Dropdown-option     ndl-Option  " role="menuitem"><span class="ndl-Option-label ">Task</span></div></li><li class="new-event"><div class="ndl-Dropdown-option     ndl-Option  " role="menuitem"><span class="ndl-Option-label ">Event</span></div></li></ul></div>');

      
//
        setTimeout(function (){
           jQuery('li.create-task').click(function(){
            jQuery('#task_start_date').val(arg.dateStr);

            jQuery("#creat-task-form").submit(function(e) {
                 var form = jQuery(this);
               e.preventDefault();
               
                 jQuery.ajax({
                        type: "POST",
                        url: ajaxurl, 
                       // contentType: 'application/x-www-form-urlencoded',
                        data : { action:'ppb_creation', task:form.serializeArray() }, // serializes the form's elements.
                        success: function(data) {

                          jQuery( arg.dayEl ).append('<div class="fc-daygrid-event-harness" style="margin-top: 0px;"><a class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-past"><div class="fc-event-main"><div class="fc-event-main-frame"><div class="fc-event-title-container"><div class="fc-event-title fc-sticky">'+data+'</div></div></div></div><div class="fc-event-resizer fc-event-resizer-end"></div></a></div>');
                            jQuery('.new-container').remove();
                            jQuery('a.close-modal').trigger('click');
                        }
                    });
              });
           
               jQuery("#create-task").modal({
                escapeClose: true,
                clickClose: true,
                showClose: true
              });

            jQuery( ".date" ).datepicker({dateFormat : 'dd-mm-yy',
        setDate: arg.dateStr });
           
              
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
                          console.log(response);
                          return
                          // jQuery('.workflow_roles').html(response);

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


          });
          jQuery('li.new-event').click(function(){
              console.log(arg.dateStr);
              jQuery('#task_start_date-event').val(arg.dateStr);
              jQuery("#create-event-form").submit(function(e) {
                 var form = jQuery(this);
               e.preventDefault();
               
                 jQuery.ajax({
                        type: "POST",
                        url: ajaxurl, 
                       // contentType: 'application/x-www-form-urlencoded',
                        data : { action:'ppb_creation', task:form.serializeArray() }, // serializes the form's elements.
                        success: function(data) {
                             jQuery( arg.dayEl ).append('<div class="fc-daygrid-event-harness" style="margin-top: 0px;"><a class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-past"><div class="fc-event-main"><div class="fc-event-main-frame"><div class="fc-event-title-container"><div class="fc-event-title fc-sticky">'+data+'</div></div></div></div><div class="fc-event-resizer fc-event-resizer-end"></div></a></div>');
                            jQuery('.new-container').remove();
                            jQuery('a.close-modal').trigger('click');
                        }
                    });
              });

               jQuery("#create-event").modal({
                escapeClose: true,
                clickClose: true,
                showClose: true
              });
              jQuery( ".date" ).datepicker({minDate: 0,dateFormat : 'dd-mm-yy',
                defaultDate: new Date(arg.dateStr) });

          });
        },500);



            
         
      },
    editable: true,
    eventDrop: function(event,dayDelta,minuteDelta,allDay,revertFunc) {

        alert(
            event.title + " was moved " +
            dayDelta + " days and " +
            minuteDelta + " minutes."
        );

        if (allDay) {
            alert("Event is now all-day");
        }else{
            alert("Event has a time-of-day");
        }

        if (!confirm("Are you sure about this change?")) {
            revertFunc();
        }

    },
      eventContent: function (arg, createElement) {
   
          var innerHtml;
             //Check if event has image
          if (arg.event._def.extendedProps.imageUrl) {

            var data = arg.event._def.extendedProps;
            
           // Store custom html code in variable
           innerHtml = "<img class='feature-image' style='width:100%;' src='"+data.imageUrl+"'><span class='title'>"+arg.event._def.title+'</span><div class="medias"><span class="media wordPress"><i class="time">05:00 PM</i><img src="'+plugin_url+'/purple/admin/partials/images/wordpress.png" width="12" height="12"></span><span class="media facebook"><i class="time">05:00 PM</i><img src="'+plugin_url+'/purple/admin/partials/images/facebook.png" width="12" height="12"></span><span class="media linkedin"><i class="time">05:00 PM</i><img src="'+plugin_url+'/purple/admin/partials/images/linkedin.png" width="12" height="12"></span></div>';

           //Event with rendering html
           return createElement = { html: '<div>'+innerHtml+'</div>' }
        }
          
      },
      events: <?php echo json_encode($push);?>,

       

    });

  
    calendar.render();
  });

}

  jQuery(document).ready(function () {
     jQuery('.fc-dayGridWeek-button').trigger('click');
     jQuery('#calendar').css('opacity','1');

  });

</script>

<div id="create-task" class="modal">
  <form id="creat-task-form" method="POST">
    <header class="ndl-Header ndl-Header--section ndl-Modal-header"><h1 class="ndl-HeaderTitle ndl-HeaderTitle--section ndl-HeaderTitle--medium undefined"><div class="plan-CreateModal-title">Create New Task</div></h1></header>
    <div class="form-group">
      <input name="task-title" id="task-title" class="input-field" maxlength="80" type="text" placeholder="Enter task title here" value="">
      <p class="ndl-Text ndl-Text--secondary ndl-Input-charCount ndl-CharacterCount ">0/80</p>
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
    <div class="form-group">
          <label> Workflow
            <input class="input-field" name="Workflow" placeholder="Select a workflow" id="Workflow" id="Workflow">
          </label>

       <div class="workflow_roles">
       </div>   
    </div>     
   <div class="form-group">
      <label> Task Due Date *
        <input id="task-due-date" name="task_end_date" type="text" placeholder="" class="date input-field ndl-DatePicker-input" value="">
        <input id="task_start_date" name="task_start_date" type="hidden" placeholder="" class="date input-field ndl-DatePicker-input" value="">
      </label>
   </div>
  

   <div class="create-task-button">
    <div class="inner-buttons">
      <input type="hidden" name="type" value="TASK" >
      <a class="close ndl-Button ndl-Button--primary ndl-Button--medium" href="#" rel="modal:close">Close</a>
      <button class="ndl-Button ndl-Button--primary ndl-Button--medium submit-task">Create</button>
    </div>  
    </div> 
    </form> 
</div>




<div id="create-event" class="modal">
<form id="create-event-form" method="POST">
<header class="ndl-Header ndl-Header--section ndl-Modal-header"><h1 class="ndl-HeaderTitle ndl-HeaderTitle--section ndl-HeaderTitle--medium undefined"><div class="plan-CreateModal-title">Create New Event</div></h1></header>
<div class="form-group">
          <input name="task-title" id="task-title" class="input-field" maxlength="80" type="text" placeholder="Add Event Name" value="">
          <p class="ndl-Text ndl-Text--secondary ndl-Input-charCount ndl-CharacterCount ">0/80</p>
    </div>
        <div class="form-group">
          <label> Event Description *
              <div name="event-secription" class="ndl-TextArea   ndl-TextArea--isResizeable ndl-FormControl-field"><textarea class="ndl-TextArea-field" maxlength="250" placeholder="Add details about your event..."></textarea><p class="ndl-Text ndl-Text--secondary ndl-TextArea-charCount ndl-CharacterCount ">0/250</p></div>
          </label>
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
          <label> End Date *
            <input id="task-due-date" name="task_end_date" type="text" placeholder="" class="date input-field ndl-DatePicker-input" value="">
        <input id="task_start_date-event" name="task_start_date" type="hidden" placeholder="" class="date input-field ndl-DatePicker-input" value="">
            </label>
          </div>
        </div>
  

   <div class="create-task-button">
    <div class="inner-buttons">
      <input type="hidden" name="type" value="EVENT" >
      <a class="close ndl-Button ndl-Button--primary ndl-Button--medium" href="#" rel="modal:close">Close</a>
      <button class="ndl-Button ndl-Button--primary ndl-Button--medium submit-task">Create</button>
    </div>  
    </div> 
   </form> 
 
</div>
