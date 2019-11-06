<?php 
  $blocs = get_sub_field('content_05_bloc');
  $columnClass = get_sub_field('content_05_columns');
  
  
?>

<?php if($blocs) : ?>
  <section class="two-column contents-grid container">
    <div class="custom-cards custom-cards-with-more-section custom-cards--<?php echo $columnClass ?>">
      <?php foreach ($blocs as $bloc) : 
        $randomID    = rand();
        $title       = $bloc['content_05_bloc_title'];
        $image       = $bloc['content_05_bloc_image'];
        $thumbSrc    = wp_get_attachment_image_src($image['id'], 'large');
        $description = $bloc['content_05_bloc_description'];

        $moreTitle    = $bloc['content_05_bloc_more_title'];
        $moreContent  = $bloc['content_05_bloc_more_content'];
        $moreImage    = $bloc['content_05_bloc_more_image'];
        $moreThumbSrc = wp_get_attachment_image_src($moreImage['id'], 'large')[0];
        $moreFullSrc = wp_get_attachment_image_src($moreImage['id'], 'fullscreen')[0];
      ?>      
        
        <div id="<?php echo $randomID.'-custom-card-img' ?>" class="custom-card-item image" style="background-image: url('<?php echo $thumbSrc[0] ?>');">
          <div class="text-img"><?php echo $title ?></div>          
          
          <div id="<?php echo 'two-col--' . $randomID ?>" data-id="<?php echo $randomID ?>" class="show-more-custom-card"><span>+</span></div>

          <div class="more-section">
            <div id="<?php echo $randomID ?>" class="show-more-content">
            <div id="<?php echo $randomID ?>-close-btn" data-id="<?php echo $randomID ?>" class="close-btn-show-more-custom-card">X</div>
              <div class="inner-content">
                <div class="row">
                  <?php if($moreThumbSrc) : ?>
                    <div class="col-12 col-lg-8 left contains-img order-0 aos-init aos-animate" data-aos="fade-right">
                      <a href="<?php echo $moreFullSrc ?>" data-lightbox="lightbox-<?php echo $randomID ?>">
                        <div class="showcase-img" style="background-image: url('<?php echo $moreThumbSrc ?>');">
                        </div>
                      </a>
                    </div> 
                  <?php endif ?>                                                                                                                                                                                                                               <div class="col-12 col-lg-4 right showcase-text order-12 aos-init aos-animate" data-aos="fade-left">
                  <div class="column-content-inner">
                    <?php if($moreTitle) : ?>
                      <h3><?php echo $moreTitle ?></h3>
                    <?php endif ?>
                    <?php if($moreContent) : ?>
                      <?php echo $moreContent ?>
                    <?php endif ?>
                  </div>
                </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        
    <?php endforeach ?>
  </section>
<?php endif ?>
