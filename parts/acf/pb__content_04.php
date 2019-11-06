<?php 
  
  $gallery_type = get_sub_field('content_04_gallery_type');
  $randomID = rand();
?>

<section class="two-column container">

  <?php if($gallery_type == 'masonry') : 
    $gallery = get_sub_field('content_04_gallery');
    ?>
    <!-- IMAGES EN COLONNES -->
    <div class="grid-masonry">
      <div class="grid-masonry-sizer"></div>
      <div class="gutter-masonry-sizer"></div>
      <?php foreach($gallery as $image) : ?>                      
      <div class="grid-masonry-item">
          <?php $imageAttachment = wp_get_attachment_image_src( $image['ID'], "masonry" ); ?>
          <a href="<?php echo wp_get_attachment_image_src( $image['ID'], "fullscreen" )[0]; ?>" data-lightbox="mansonry_slideshow_<?php echo $randomID ?>">
          <img src="<?php echo $imageAttachment[0]; ?>" class="img-fluid">
          </a>
      </div>
      <?php endforeach ?>              
    </div> 
  <?php elseif($gallery_type == 'carousel') :
    $gallery = get_sub_field('content_04_gallery');
    $number = count($gallery);
    ?>
    <!-- CAROUSEL SANS CONTENU -->
    <div id="carouselIndicators--<?php echo $randomID ?>" class="img-gallery carousel slide" data-ride="carousel" data-aos="fade-right">
      <?php foreach($gallery as $index => $image) : 
        $imageAttachment = wp_get_attachment_image_src( $image['ID'], "large" );
      ?>
        <div class="carousel-item <?php echo ($index == 0)? 'active' : '' ; ?>">
          <a href="<?php echo wp_get_attachment_image_src( $image['ID'], "fullscreen" )[0]; ?>" data-lightbox="carousel_slideshow_<?php echo $randomID; ?>">
              <img src="<?php echo $imageAttachment[0] ?>">
          </a>
        </div>
      <?php endforeach; ?>
      <ol class="carousel-indicators">
          <?php for($i = 0 ; $i < $number ; $i++): ?>
          <li data-target="#carouselIndicators--<?php echo $randomID ?>" data-slide-to="<?php echo $i ?>"
              <?php echo ($i == 0)? 'class="active"' : '' ; ?>></li>
          <?php endfor; ?>
      </ol>
    </div>
  <?php elseif($gallery_type == 'carousel-texte') :
    $gallery = get_sub_field('content_04_gallery_text');
    $number = count($gallery);
    ?>
    <!-- CAROUSEL AVEC CONTENU -->
    <div id="carouselIndicators--<?php echo $randomID ?>" class="img-gallery carousel slide" data-ride="carousel" data-aos="fade-right">
      <?php foreach($gallery as $index => $element) : 
        $title    = $element['content_04_gallery_text_title'];
        $image    = $element['content_04_gallery_text_image'];
        $content  = $element['content_04_gallery_text_content'];
        $position = $element['content_04_gallery_text_position'];

        $imageAttachment = wp_get_attachment_image_src( $image['ID'], "large" );
      ?>
        <div class="carousel-item <?php echo ($index == 0)? 'active' : '' ; ?>">
          <a href="<?php echo wp_get_attachment_image_src( $image['ID'], "fullscreen" )[0]; ?>" data-lightbox="carousel_slideshow_<?php echo $randomID; ?>">
            <img src="<?php echo $imageAttachment[0] ?>">
          </a>
          <div class="img__gallery__content img__gallery__content--<?php echo $position ?>">
            <?php if($title) : ?>
              <h3><?php echo $title ?></h3>
            <?php endif ?>
            <div class="img__gallery__content__content">
              <?php echo $content ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
      <ol class="carousel-indicators">
          <?php for($i = 0 ; $i < $number ; $i++): ?>
            <li data-target="#carouselIndicators--<?php echo $randomID ?>" data-slide-to="<?php echo $i ?>"
              <?php echo ($i == 0)? 'class="active"' : '' ; ?>>
            </li>
          <?php endfor; ?>
      </ol>
    </div>
  <?php endif ?>
</section>
