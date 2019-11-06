<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * Please see /external/starkers-utilities.php for info on Starkers_Utilities::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
 ?>
 <?php Starkers_Utilities::get_template_parts( array( 'parts/html-header', 'parts/header' ) ); ?>

<section class="blog-section">

 <section class="two-column container">      
  <h3 class="two-column-subtitle">Blog</h3>        
  <h2 class="two-column-title"><?php echo get_the_title( get_option('page_for_posts', true) ); ?></h2>
</section> 

<?php if ( have_posts() ): $count = 0;?>
  <?php while ( have_posts() ) : the_post(); 
    $count++;
    $title       = $post->post_title;
    $description = $post->post_content;
    $image = get_the_post_thumbnail($post, 'large');
    $link = get_permalink($post);
  ?>
  <section class="two-column container">
    <div class="row">
      <?php if(!empty($image) && $count%2 == 0):?>
        <div class="col-12 col-lg-4 left contains-img order-0" data-aos="fade-right">
          <?php echo $image ?>
        </div>
      <?php endif; ?>
      <div class="col-12 col-lg-8 left showcase-text" data-aos="fade-left">
        <div class="ets-column-content-inner">
          <h2><a href="<?php echo $link ?>"><?php echo $title ?></a></h2>
          <?php echo $description ?>
        </div>
      </div>
      <?php if(!empty($image) && $count%2 != 0):?>
        <div class="col-12 col-lg-4 left contains-img order-0" data-aos="fade-right">
          <?php echo $image ?>
        </div>
      <?php endif; ?>
    </div>
    <div class="more-section ets-more-section">
      <a href="<?php echo $link ?>">
        Voir plus
      </a>
    </div>
  </section>
  <?php endwhile ?>
</section>
<?php endif ?>

 <?php Starkers_Utilities::get_template_parts( array( 'parts/footer','parts/html-footer' ) ); ?>
