<?php 
  $title       = get_sub_field('content_03_title');
  $subtitle    = get_sub_field('content_03_subtitle');
  $description = get_sub_field('content_03_description');
?>

<section class="two-column container">
    <?php if($subtitle):?>  
        <h3 class="two-column-subtitle"><?php echo $subtitle; ?></h3>
    <?php endif; ?>
    <?php if($title):?>  
        <h2 class="two-column-title"><?php echo $title; ?></h2>
    <?php endif; ?>
    <?php if($description):?>  
        <div class="two-column-description"><?php echo $description; ?></div>
    <?php endif; ?>
</section>