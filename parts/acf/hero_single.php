<?php
$title = get_sub_field('title');
$subtitle = get_sub_field('subtitle');
$link = get_sub_field('link');
$image = get_sub_field('image');
if($image['id']) {
    $imageSrc = wp_get_attachment_image_src( $image['id'], 'fullscreen' )[0];
}
?>
<header class="masthead hero-single">
    <div class="img-carousel" style="background-image: url('<?php echo $imageSrc ?>');">
        <div class="hero-caption container">
            <h1 class="hero-title">
                <?php if(!empty($title)): ?><?php echo $title ?><?php endif; ?>
            </h1>
            <h2 class="hero-subtitle">
                <?php if(!empty($subtitle)): ?><?php echo $subtitle ?><?php endif; ?>
            </h2>    
            <?php if(!empty($link)): ?>
                <a class="btn btn-primary cta-btn" href="<?php echo $link['url'] ?>"
                    target="<?php echo $link['target'] ?>"><span><?php echo $link['title'] ?></span></a>
            <?php endif; ?>                              
        </div>
    </div>
</header>