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

<?php 
  Starkers_Utilities::get_template_parts( array( 'parts/html-header', 'parts/header' ) ); 
?>


<?php if(have_rows('page_builder')): ?>

 <?php if ( have_posts() ): $postCount = 0; while( have_posts() ): the_post(); ?>
     <?php if(have_rows('page_builder')): ?>
       <?php while(have_rows('page_builder')): the_row(); ?>
           <?php get_template_part( 'parts/acf/'. get_row_layout() ); ?>
       <?php endwhile; ?>
     <?php endif; ?>   
   <?php endwhile; ?> 
 <?php endif; ?> 
<?php endif; ?>
<?php if(strlen(strip_tags(get_the_content())) > 0 ): ?>
  <p><?php echo get_the_content(); ?></p>
<?php endif; ?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/footer','parts/html-footer' ) ); ?>
