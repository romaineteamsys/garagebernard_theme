<?php 
  $blocs = get_sub_field('content_02_bloc');
  $columnClass = get_sub_field('content_02_columns');
  
?>

<?php if($blocs) : ?>
  <section class="two-column contents-grid container">
    <div class="custom-cards custom-cards--<?php echo $columnClass ?>">
      <?php foreach ($blocs as $bloc) : 
        $title       = $bloc['content_02_bloc_title'];
        $image       = $bloc['content_02_bloc_image'];
        $thumbSrc    = wp_get_attachment_image_src($image['id'], 'large');
        $description = $bloc['content_02_bloc_description'];
        $link        = $bloc['content_02_bloc_link'];
      ?>      
        <?php if($link && !($description)) : ?>
        <a href="<?php echo $link['url'] ?>" target="<?php echo $link['target'] ?>">
        <?php endif ?>
          <div class="custom-card-item image" style="background-image: url('<?php echo $thumbSrc[0] ?>');">
            <div class="text-img"><?php echo $title ?></div>
            <?php if($description) : ?>
              <div class="text-description"><?php echo $description ?></div>
            <?php endif ?>
            <?php if($link && $description) : 
              $linkTitle = 'Lire la suite';
              if($link['title'] != '') {
                $linkTitle = $link['title'];
              }
            ?>
              <div class="read__more">
                <a href="<?php echo $link['url'] ?>" target="<?php echo $link['target'] ?>"><?php echo $linkTitle ?></a>
              </div>
            <?php endif ?>
          </div>
        <?php if($link && !($description)) : ?>
        </a>
        <?php endif ?>
    <?php endforeach ?>
  </section>
<?php endif ?>
