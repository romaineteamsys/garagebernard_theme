<?php 
  $title       = get_sub_field('content_01_title');
  $isMainTitle = get_sub_field('content_01_title_main');
  $content     = get_sub_field('content_01_content');
  // $contentSize = get_sub_field('content_01_content_font_size');  
  $image       = get_sub_field('content_01_image');
  $position    = get_sub_field('content_01_position');
  $links       = get_sub_field('content_01_links');
  
  // TITRE
  $titleHTML = '';
  if($title) {
    if($isMainTitle) {
      $titleHTML = '<h1>'.$title.'</h1>'; 
    }
    else {
      $titleHTML = '<h2>'.$title.'</h2>';
    }
  }

  // CTA
  $ctaHTML = '';
  if($links) {

    foreach($links as $link) {
      $class= 'btn btn-primary mr-2';
      if($link['content_01_link_color'] == 'secondary') {
        $class= 'btn btn-secondary mr-2';
      }

      $ctaHTML .= '<a href="'.$link['content_01_link']['url'].'"
                      target="'.$link['content_01_link']['target'].'"
                      class="'.$class.'">'.$link['content_01_link']['title'].
                  '</a>';
    }

    $ctaHTML = '<div class="d-flex">'.$ctaHTML.'</div>';
  }

  // CONTENT
  // if($content && $contentSize) {
  //   $content = '<div class="content__size--'.$contentSize.'">'.$content.'</div>';
  // }
  $contentHTML = $titleHTML . $content . $ctaHTML;

  // IMAGE
  $imageHTML = '';
  if($image) {
    $imageHTML = '<a href="'.wp_get_attachment_image_src( $image['ID'], "large" )[0].'" data-lightbox="ets-fancybox-'.$image['ID'].'">
                    <img src="'.wp_get_attachment_image_src( $image['ID'], "large_block_size" )[0].'">
                  </a>';
  }
  
  
?>

<section class="two-column container">
  <div class="two-column-container">
    <div class="row">
      <?php if($imageHTML) : ?>
        <?php if($position == 'image_left') : ?>        
          <!-- IMAGE A GAUCHE -->
            <div class="col-12 col-lg-4 left contains-img order-0" data-aos="fade-right">
              <?php echo $imageHTML; ?>
            </div>
            <div class="col-12 col-lg-8 left showcase-text" data-aos="fade-left">
              <div class="ets-column-content-inner">
                  <?php if($contentHTML) : echo $contentHTML; endif?>
              </div>
            </div>
          <!-------------------->
        <?php elseif($position == 'image_right') : ?>        
          <!-- IMAGE A DROITE -->      
            <div class="col-12 col-lg-8 left showcase-text" data-aos="fade-right">
              <div class="ets-column-content-inner">
                <?php if($contentHTML) : echo $contentHTML; endif?>
              </div>
            </div>
            <div class="col-12 col-lg-4 left contains-img order-0" data-aos="fade-left">
              <?php echo $imageHTML; ?>
            </div>
          <!-------------------->
        <?php elseif($position == 'image_bottom') : ?>
          <!-- IMAGE EN DESSOUS -->
            <div class="col-12 col-lg-10 left mb-4 showcase-text" data-aos="fade-right">
              <div class="ets-column-content-inner">
                <?php if($contentHTML) : echo $contentHTML; endif?>
              </div>
            </div>
            <div class="col-12 col-lg-12 left contains-img order-0" data-aos="fade-left">
              <?php echo $imageHTML; ?>
            </div>
          <!-------------------->
        <?php endif ?>
      <?php else: ?>
        <!-- PAS D'IMAGE -->
        <div class="col-12 col-lg-10 left showcase-text" data-aos="fade-right">
          <div class="ets-column-content-inner">
            <?php if($contentHTML) : echo $contentHTML; endif?>
          </div>
        </div>
        <!-------------------->
      <?php endif ?>
    </div>
  </div>
</section>

