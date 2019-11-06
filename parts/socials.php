<?php
    /**
     * @place here your custom datas
     */
   $facebook   =  get_field('facebook' , 'option');
   $twitter    =  get_field('twitter' , 'option');
   $youtube    =  get_field('youtube' , 'option');
   $linkedin   =  get_field('linkedin' , 'option');
   $instagram  =  get_field('instagram' , 'option');

?>
<div class="socials">
  <?php if( ! empty($facebook) ): ?>
    <a href="<?php echo $facebook ;?>" target="_blank">
      <img src="<?php echo get_template_directory_uri() . '/assets/img/facebook.svg'; ?>">
    </a>
  <?php endif; ?>
  <?php if( ! empty($twitter) ): ?>
    <a href="<?php echo $twitter ;?>" target="_blank">
      <img src="<?php echo get_template_directory_uri() . '/assets/img/twitter.svg'; ?>">
    </a>
  <?php endif; ?>
  <?php if( ! empty($linkedin) ): ?>
    <a href="<?php echo $linkedin ?>" target="_blank">
      <img src="<?php echo get_template_directory_uri() . '/assets/img/linkedin.svg'; ?>">
    </a>
  <?php endif; ?>
  <?php if( ! empty($instagram) ): ?>
    <a href="<?php echo $instagram ?>" target="_blank">
      <img src="<?php echo get_template_directory_uri() . '/assets/img/instagram.svg'; ?>">
    </a>
  <?php endif; ?>
  <?php if( ! empty($youtube) ): ?>
    <a href="<?php echo $youtube ?>" target="_blank">
      <img src="<?php echo get_template_directory_uri() . '/assets/img/youtube.svg'; ?>">
    </a>
  <?php endif; ?>
</div>