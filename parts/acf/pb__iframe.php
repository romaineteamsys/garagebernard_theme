<?php
  $iframeUrl = get_sub_field('iframe_url');
  $iframeHeight = get_field('iframe_height');
  if($iframeUrl) : 
  ?>

<section class="contents-grid container">
  <div class="embed-responsive embed-responsive-16by9">
    <iframe class="embed-responsive-item" src="<?php echo $iframeUrl ?>"></iframe>
  </div>
</section>

<?php endif ?>