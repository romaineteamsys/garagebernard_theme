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

    <main role="main">
        <section class="blog">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <h1><?php single_cat_title(); ?></h1>
                        <h2>Lorem Ipsum</h2>
                        <p>Nullam dictum felis eu pede mollis pretium. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Etiam iaculis nunc ac metus. Phasellus tempus. Cras risus ipsum, faucibus ut, ullamcorper id, varius ac, leo.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 list-of-news">
                        <?php if ( have_posts() ): $postCount = 0; ?>
                            <?php while ( have_posts() ) : the_post(); $postCount++; ?>

                                <div <?php if(get_field('full_size_img') == 'true') {echo 'class="news-excerpt full-size" style="background-image: url('. get_the_post_thumbnail_url(get_the_ID(),'full') .');"';} else { echo 'class="news-excerpt"';} ?>>
                                    <?php 
                                        if(get_field('full_size_img') == 'false') {
                                            echo '<div class="top-image" style="background-image: url('. get_the_post_thumbnail_url(get_the_ID(),'full') .');"></div>';
                                        }  
                                    ?>
                                    <div class="post-container">
                                        <div class="post-content">
                                            <?php 
                                                $terms = wp_get_post_terms( get_the_ID(), 'category' );
                                                $html = '<h4 class="category-news">';
                                                foreach ( $terms as $tag ) {
                                                    $tag_link = get_term_link( $tag->term_id );
                                                            
                                                    $html .= "<a href='{$tag_link}' title='{$tag->name} Tag' class='post-tag'>";
                                                    $html .= "{$tag->name}</a>";
                                                }
                                                $html .= '</h4>';
                                                echo $html;
                                            ?>
                                            <h3>
                                                <a href="<?php the_permalink(); ?>" class="post-headline"><?php the_title(); ?></a>
                                            </h3>
                                            <div class="post-excerpt">
                                                <?php the_excerpt(); ?>
                                            </div>                                
                                            <div class="post-meta">
                                                <!-- <?php if(get_the_author()): ?>
                                                    <p>Par
                                                        <a href="#"><?php $author = get_the_author(); ?></a>
                                                    </p>
                                                <?php endif; ?>
                                                <p><?php comments_number( '0 commentaire', '1 commentaire', '% commentaires' ); ?></p> -->
                                                <p href="#"><?php echo get_the_date('d') ?> <span><?php echo get_the_date('M') ?></span></p>
                                            </div>
                                        </div>     
                                    </div>                           
                                </div>

                            <?php endwhile; ?>                                

                        </div>
                    </div>
                <?php 
                    if (function_exists("ets_pagination")) {
                    ets_pagination($wp_query->max_num_pages);
                } ?> 

                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php if(have_rows('page_builder', '74')): ?>
            <?php while(have_rows('page_builder', '74')): the_row(); ?>
                <?php get_template_part( 'parts/acf/'. get_row_layout() ); ?>
            <?php endwhile; ?> 
        <?php endif; ?>
    </main>

 <?php Starkers_Utilities::get_template_parts( array( 'parts/footer','parts/html-footer' ) ); ?>