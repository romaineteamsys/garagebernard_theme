<?php 
  $copyrightMenu = eTeamsys_get_menu_items(4);

  $address     = get_field( 'address', 'option' );
  $email       = get_field( 'email_address', 'option' );
  $phone       = get_field( 'phone', 'option' );
  $fax         = get_field( 'fax', 'option' );
  $rpm         = get_field( 'rpm', 'option' );
  $fsma        = get_field( 'fsma', 'option' );
  $schedules   = get_field( 'schedules', 'option' );
  $tva         = get_field( 'tva_number', 'option' );
  $footer_menu = get_field( 'footer_menu', 'option' );

  // S'abonner
  $newsletterTitle     = get_field( 'newsletter_title', 'option' );
  $newsletterSubtitle  = get_field( 'newsletter_subtitle', 'option' );
  $newsletterShortcode = get_field( 'newsletter_shortcode', 'option' );
?>

</div> <!-- CLOSE .main-content -->

<footer class="footer">
    <div class="container">
        <div class="row d-lg-none">
            <div class="col-12 text-center">
                <a href="#top" class="scroll-top big"><img class="footer_arrow_up_mobile" src="<?php echo get_template_directory_uri() . '/assets/img/arrow_footer_up.svg'; ?>"></a>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-between">
                <?php
                if ( function_exists('yoast_breadcrumb') ) {
                    yoast_breadcrumb('
                    <p id="breadcrumbs">','</p>');
                }
                ?>
                <a href="#top" class="scroll-top d-none d-lg-block">Haut de page <i class="fas fa-angle-up"></i></a>
            </div>            
        </div>
        <div class="row">
            <div class="col-12 col-md-7">
                <?php if($newsletterTitle) : ?>
                  <h3><?php echo $newsletterTitle ?></h3>
                <?php endif ?>
                <?php if($newsletterSubtitle) : ?>
                  <p><?php echo $newsletterSubtitle ?></p>
                <?php endif ?>
                <div class="d-flex">
                  <?php if($newsletterShortcode) : ?>
                    <?php echo do_shortcode($newsletterShortcode); ?>
                  <?php endif ?>                    
                </div>                
            </div>
            <div class="col-12 col-md-5 pt-3">
                <p class="d-none d-lg-block">Centre Étoile sur les réseaux sociaux :</p>
                <?php get_template_part( 'parts/socials' ); ?>
            </div>            
        </div>
        <div class="row footer-menu">
            <?php foreach($footer_menu as $menuColumn): ?>
                <div class="footer-menu-columns">
                    <h3><?php echo $menuColumn['column_title']; ?></h3>
                    <ul class="list-unstyled">
                        <?php foreach($menuColumn['links'] as $index => $menuItem): ?>
                        <li>
                            <a class="footer-menu-link" href="<?php echo $menuItem['link']['url']; ?>"><?php echo $menuItem['link']['title']; ?></a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>                
            <?php endforeach; ?>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <ul class="copyright-menu list-inline">
                <li class="list-inline-item">© <?php echo date("Y"); ?> Centre Étoile Mercedes-Benz Huy. Tous droits réservés. Website by <a href="https://www.eteamsys.com" target="_blank">Eteamsys</a>.</li><span class="menu-separator">|</span>
                <?php
                    $number_of_links = count($copyrightMenu); 
                    $count = 0;
                    foreach($copyrightMenu as $index => $menuItem): $count ++;?>
                    <li class="list-inline-item">
                        <a href="<?php echo $menuItem['url']; ?>"><?php echo $menuItem['title']; ?></a>
                        <?php if($count < $number_of_links) : ?>
                            <span class="menu-separator">|</span>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</footer>