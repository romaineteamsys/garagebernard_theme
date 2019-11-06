<?php    
    $main_image = get_sub_field('main_image');
    $wysiwyg = get_sub_field('wysiwyg');
    $id = rand();
?>

<section class="two-column highlighted-content container">        
    <div class="highlighted-img">
        <img src="<?php echo $main_image['url'] ?>">
        <div id="highlighted-wysiwyg-<?php echo $id?>" class="highlighted-wysiwyg">
            <div class="inner-content">
                <div data-id="highlighted-wysiwyg-<?php echo $id?>" class="close-btn-show-more">X</div>
                <?php 
                    echo $wysiwyg;
                ?>
            </div>          
        </div>
    </div>
</section>