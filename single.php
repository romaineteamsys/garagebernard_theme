<?php
/**
 * The Template for displaying all single posts
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
    <div class="container">
      <?php if ( have_posts() ):  ?>
        <?php while ( have_posts() ) : the_post();  
          $attachementImage = wp_get_attachment_image(get_post_thumbnail_id(), 'lrg_size', '', array('class' => ''));                                    
          $title       = $post->post_title;
          $description = $post->post_content;
          $image = get_the_post_thumbnail($post, 'large');
          $link = get_post_permalink($post);
        ?>
        <h1><?php echo $title ?></h1>
        <?php if($description) : ?>
          <div class="row mb-4">          
            <div class="col-12 col-lg-8 left showcase-text" data-aos="fade-right">
              <div class="ets-column-content-inner">
                <?php echo $description ?>
              </div>
            </div>          
          </div>
        <?php endif ?>
        <div class="single-blog-thumbnail">
          <?php if($attachementImage) : echo $attachementImage; endif?>
        </div>
        <div class="single-blog-content">
          <?php if(have_rows('page_builder')): ?>
            <?php while(have_rows('page_builder')): the_row(); ?>
                <?php get_template_part( 'parts/acf/'. get_row_layout() ); ?>
            <?php endwhile; ?>
          <?php endif; ?>   
        </div>
        <?php endwhile ?>
      <?php endif ?>
    </div>
  </section>
<!-- 
  <div class="text-center pt-0 pb-5">
      <a href="<?php echo get_home_url(); ?>/nos-actualites/" class="other-news-link">Toutes nos news ></a>
  </div> -->

 <?php Starkers_Utilities::get_template_parts( array( 'parts/footer','parts/html-footer' ) ); ?>