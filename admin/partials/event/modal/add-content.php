<?php 
  $defaults = array(
        'numberposts'      => -1,
        'orderby'          => 'date',
        'order'            => 'DESC',
        'post_type'        => 'article',
    );
  $posts = get_posts($defaults);
?>
<div id="add-article" class="modal">
  <div class="modal-contet">
    <?php 
      if(!empty($posts)){
          foreach($posts as $post){
            $date=date_create($post->post_modified);
            ?>
            <div data='<?php echo $post->ID; ?>' class="grid-view-item view-<?php echo $post->ID; ?>">
                <div class="grid-view-card false cursor-pointer false">
                  <div class="card-actiom tax-attachment-<?php echo $post->ID; ?>">
                      <label class="grid-view-checkbox ndl-Checkbox ndl-Checkbox--medium">
                          <div class="ndl-Checkbox-container"><input class="ndl-Checkbox-input" value="<?php echo $post->ID; ?>" type="checkbox" /><span class="ndl-Checkbox-holder"></span></div>
                      </label>
                      <button actiondata="393" class="delete ndl-Button ndl-Button--secondaryAlt ndl-Button--medium ndl-Dropdown-button ndl-Button--iconOnly" type="button">
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
                      <ul class="list-action" id="view-list-<?php echo $post->ID; ?>">
                          <li><a href="delete" data="<?php echo $post->ID; ?>">delete</a></li>
                      </ul>
                  </div>

                    <div data="article" class="grid-view-card-top" id="tax-attachment-484">
                      <?php 
                       // $image_ids = get_post_meta($post->ID,'upload_image',true);
                        
                         $image_ids = get_post_thumbnail_id($post->ID);
                         $feat_image_url = wp_get_attachment_url( $image_ids );
                      ?>
                        <div class="content-thumbnail grid-cl-v3-article-fill">
                            <span class="thumbnail-container false">
                                <img class="thumbnail thumbnail-image" src="<?php echo $feat_image_url;?>" />
                            </span>
                        </div>
                    </div>

                    <div class="grid-view-card-middle">
                        <div class="article rounded-icon-container grid-cl-v3-article-fill">
                            <span class="nc-icon rounded-icon" style="width: 12px; height: 12px;">
                                <i class="nc-icon-wrapper">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16">
                                        <g transform="translate(0, 0)">
                                            <path data-color="color-2" fill="#444444" d="M5,7H1C0.4,7,0,6.6,0,6V2c0-0.6,0.4-1,1-1h4c0.6,0,1,0.4,1,1v4C6,6.6,5.6,7,5,7z"></path>
                                            <rect x="8" y="1" fill="#444444" width="8" height="2"></rect>
                                            <rect x="8" y="5" fill="#444444" width="8" height="2"></rect>
                                            <rect y="9" fill="#444444" width="16" height="2"></rect>
                                            <rect y="13" fill="#444444" width="16" height="2"></rect>
                                        </g>
                                    </svg>
                                </i>
                            </span>
                        </div>
                    </div>

                    <div class="grid-view-card-bottom">
                        <div class="card-title-wrapper">
                            <p class="ndl-Text ndl-Text--body grid-view-card-title"><?php echo $post->post_title; ?></p>
                        </div>
                        <div class="grid-view-card-details">
                            <p class="ndl-Text ndl-Text--secondary small-text">OREGINAL ARTICLE • Shared by Marketing Support</p>
                            <p class="ndl-Text ndl-Text--secondary small-text">Last Modified on <?php echo date_format($date,"D M j, Y"); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <?php 
          }
      }
     ?>
  </div>
  <div class="fotter-button">
    <a class="close" href="#" rel="modal:close">Close</a>
    <input type="button" class="add-data" id="add-data" value="Submit">
  </div>
  
</div>
<style>
.fotter-button {
    position: fixed;
    width: 100%;
    left: 0;
    bottom: 0px;
    background: #fff;
    border-top: 1px solid #d2d2d2;
    padding: 16px 0 !important;
    text-align: center;
    z-index:9;
}
 
.fotter-button .close {
    text-decoration: none;
    vertical-align: middle;
    line-height: 2.5;
    font-size: 14px;
    font-weight: bold;
 
}

input#add-data {
    background: #4655d7;
    border: none;
    color: #fff;
    display: inline-block;
    vertical-align: top;
    padding: 10px 0;
    border-radius: 4px;
    width: 65px;
    cursor: pointer;
    line-height: 1;
    font-weight: 600;
    font-size: 14px;
    margin-left: 10px;
    margin-left: 10px;
}
.modal-contet {
    display: grid;
    grid-template-rows: 1fr 1fr 1fr;
    gap: 20px 20px;
    grid-template-columns: 25% 25% 25% 25%;
    grid-template-areas:
        ". . . ."
        ". . . ."
        ". . . .";
    margin-right: 60px;
}
.close-modal{
  display:none !important;
}
.jquery-modal.blocker.current {
    background: #fff !important;
}
div#add-article {
    box-shadow: none;
    width: 100%;
    max-width: 80%;
    top: 0 !important;
}
</style>