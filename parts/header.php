<?php 
/**
 * global header options
 * 
 */

 $mainMenuItems =  eTeamsys_get_menu_items(2);
 $nav_menu_items = wp_get_nav_menu_items(2);
 $logoMercedes = get_template_directory_uri() . '/assets/img/logomercedes.svg';
 $mercedes_typo = get_template_directory_uri() . '/assets/img/mercedes-typo.svg';
 $logo_centretoile = get_template_directory_uri() . '/assets/img/logo-centretoile.png';
 $phone = get_field( 'phone', 'option' );
 $address = get_field( 'address', 'option' );
 
?>

<!-- <pre style="color:white;"> -->
<?php 
// var_dump($mainMenuItems);die(); 
?>

<nav class="navbar navbar-expand-xl navbar-dark bg-dark fixed-top">
    <div class="container">
        <a href="<?php bloginfo('url') ?>" class="brand-logo logo-mercedes"><img src="<?php echo  $logoMercedes ?>"></a>
        <a href="<?php bloginfo('url') ?>" class="brand-logo mercedes-typo"><img src="<?php echo  $mercedes_typo ?>"></a>

        <ul class="main-menu-links d-none d-lg-flex">
            <?php foreach($mainMenuItems as $menuItem): 
                $level2 = get_nav_menu_item_children($menuItem['id'], $nav_menu_items, false);
            ?>

                <li class="nav-item dropdown">
                    <a class="nav-link <?php echo (count($level2) > 0 )? 'dropdown-toggle' : '' ?>" <?php echo ($menuItem['type'] == 'custom')? 'target="_blank"' : '' ?> href="<?php echo $menuItem['url'] ?>" <?php if(count($level2) > 0 ): ?>id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" <?php endif; ?>>
                        <?php echo $menuItem['title'] ?>
                    </a>
                    <?php if(count($level2) > 0 ): ?>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a href="javascript:void(0)" class="closebtn-dropdown" onclick="closeDropdown()"><i class="fas fa-times"></i></a>
                            <div class="container">
                                <div class="dropdown-menu-title"><?php echo $menuItem['title'] ?></div>
                                <div class="overflowing-content">
                                    <?php foreach ($level2 as $menuItemlvl2):?>
                                        <div class="mega-menu-content-type content-menu-type">
                                            <div class="dropdown-menu-subtitle">
                                                <?php echo $menuItemlvl2->title ?>  
                                            </div>  
                                                <?php
                                                    $level3 = get_nav_menu_item_children($menuItemlvl2->ID, $nav_menu_items, false);
                                                    if($level3) : ?>
                                                    <div class="sub-content-menu-type">
                                                        <?php foreach($level3 as $menuItem) : ?>
                                                            <div class="mega-menu-item-title">
                                                                <a href="<?php echo $menuItem->url ?>" class="mega-menu-link" title='<?php echo $menuItem->title ?>' target='<?php echo $menuItem->target ?>'>
                                                                    <?php echo $menuItem->title ?>
                                                                </a>
                                                            </div>
                                                        <?php endforeach ?>
                                                    </div>
                                                <?php endif ?>
                                           
                                        </div>
                                    <?php  endforeach; ?>
                                </div>
                                <img src="<?php echo  get_template_directory_uri() . '/assets/img/cars-menu.png' ?>">
                            </div>                            
                        </div>
                        <div class="triangle-bottom"></div>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>    

        <div class="contact-navbar d-none d-lg-block" data-aos="fade-left">
            <span>CentrEtoile SA</span>
            <span class="d-none d-lg-block">Téléphone: <a href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a></span>
            <a class="d-lg-none icon-phone" href="tel:<?php echo $phone; ?>">
                <i class="fas fa-phone-volume"></i>
            </a>
        </div>

        <a href="<?php bloginfo('url') ?>" class="brand-logo logo-centretoile"><img src="<?php echo  $logo_centretoile ?>"></a>

        <div id="overlay-menu" class="overlay-menu">
            <a id="close-nav-btn" href="javascript:void(0)" class="closebtn" onclick="closeNav()"><img src="<?php echo  get_template_directory_uri() . '/assets/img/close-btn.svg' ?>"></a>

            <div class="overlay-content">
                <?php foreach($mainMenuItems as $menuItem): 
                    $level2 = get_nav_menu_item_children($menuItem['id'], $nav_menu_items, false);
                ?>
                    <div class="nav-item dropdown">
                        <a class="nav-link <?php echo (count($level2) > 0 )? 'dropdown-toggle' : '' ?>" <?php echo ($menuItem['type'] == 'custom')? 'target="_blank"' : '' ?> href="<?php echo $menuItem['url'] ?>" <?php if(count($level2) > 0 ): ?>id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" <?php endif; ?>>
                            <?php echo $menuItem['title'] ?>
                        </a>
                        <?php if(count($level2) > 0 ): ?>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <div class="overflowing-content container">
                                <?php foreach ($level2 as $menuItemlvl2):?>
                                <div class="mega-menu-content-type content-menu-type">
                                    <h3>
                                        <?php echo $menuItemlvl2->title ?> 
                                    </h3>
                                    <?php
                                        $level3 = get_nav_menu_item_children($menuItemlvl2->ID, $nav_menu_items);
                                        if($level3) : ?>
                                        <div class="sub-content-menu-type">
                                            <?php foreach($level3 as $menuItem) : ?>
                                                <div class="mega-menu-item-title">
                                                    <a href="<?php echo $menuItem->url ?>" class="mega-menu-link" title='<?php echo $menuItem->title ?>' target='<?php echo $menuItem->target ?>'>
                                                        <?php echo $menuItem->title ?>
                                                    </a>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                    <?php endif ?>
                                </div>
                                <?php  endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
                <img src="<?php echo  get_template_directory_uri() . '/assets/img/cars-menu.png' ?>">
                <p class="overlay-company-name">CentreEtoile SA</p>
                <div class="overlay-contact-infos"><?php echo $address; ?></div>
                <div class="overlay-contact-infos">Téléphone: <a href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a></div>
                <?php get_template_part( 'parts/socials' ); ?>
            </div>
        </div>

        <button class="navbar-toggler" id="open-nav-btn" type="button" onclick="openNav()" data-aos="fade-right">
            <img src="<?php echo  get_template_directory_uri() . '/assets/img/open-btn.svg' ?>">
        </button>
    </div> 
</nav>