<?php 

  $args = array (
    // 'post_type' => 'gifts',
    'posts_per_page' => 3,
  );



$lastNewsPosts = get_posts($args);
?>

<?php if (count($lastNewsPosts) > 0) : ?>
<section class="two-column contents-grid container">
    <h2>Dernières actualités</h2>
    <div class="custom-cards">
    <?php foreach($lastNewsPosts as $newPost) :
      $title       = $newPost->post_title;
      $description = $newPost->post_content;
      $thumbSrc    = get_the_post_thumbnail_url($newPost, 'large');
      // var_dump($newPost);
    ?>
      <div class="custom-card-item image" style="background-image: url('<?php echo $thumbSrc ?>');">
        <div class="text-img"><?php echo $title ?></div>
        <?php if($description) : ?>
          <div class="text-description"><?php echo $description ?></div>
        <?php endif ?>
        <div class="read__more">
          <a href="<?php echo get_permalink($newPost) ?>">Lire la suite</a>
        </div>
      </div>
    <?php endforeach ?>
  </section>
<?php endif ?>