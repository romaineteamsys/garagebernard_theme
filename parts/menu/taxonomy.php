<?php 

$args = array(
'post_type' => 'megamenu',
'order'=>'ASC',
'orderby'=>'ID',
'tax_query' => array(
    array(
    'taxonomy' => 'menutag',
    'field' => 'term_id',
    'terms' => $sublevel['id']
     )
  )
);

$the_query = new WP_Query( $args ); ?>

<?php 
if ( $the_query->have_posts() ):
?>
    <div class="sub-content-menu-type">
        <?php while ( $the_query->have_posts() ): ?>
        
            <?php $the_query->the_post(); ?>
            <?php $link = get_field('link') ?>
            
                <div class="mega-menu-item-title"><a href="<?php echo $link['url'] ?>" class="mega-menu-link" title='<?php echo $link['title'] ?>' target='<?php echo $link['target'] ?>'><?php the_title() ?></a></div>
                <?php if(!empty(get_field('description'))): ?>
                    <div class="mega-menu-item-title"><span><?php echo get_field('description') ?></span></div>
                <?php endif; ?>
            
        
        <?php endwhile; ?>
    </div>
    <?php wp_reset_postdata(); ?>
<?php endif; ?>