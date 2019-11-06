<?php
/**
 * squares grid ACF fields
 */
?>

<section class="grid-content grid_icons">
    <div class="container">
        <?php if( have_rows('grid_elements') ): ?>
            <div class="custom-cards">
                <?php while( have_rows('grid_elements') ): the_row(); 
                    $image = get_sub_field('image');
                    $link = get_sub_field('link');
                    ?>
                    <a class="custom-card-item" href="<?php echo $link['url'];?>" data-aos="zoom-in">
                        <img class="grid-icon" src="<?php echo  $image['url']; ?>">
                        <h4 class="grid-icons-title"><?php echo $link['title']; ?></h4> 
                        <img class="right-arrow" src="<?php echo get_template_directory_uri() . '/assets/img/right-arrow.svg'; ?>">                 
                    </a>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>