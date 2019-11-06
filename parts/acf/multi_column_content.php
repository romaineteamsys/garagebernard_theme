<?php
    $subtitle = get_sub_field('subtitle');
    $title = get_sub_field('title');
    $description = get_sub_field('description');
    $show_tab = get_sub_field('show_tab');
    $tabs = get_sub_field('tabs');
    $footer = get_sub_field('footer');
    $more_section = get_sub_field('more_section');
?>

<section class="two-column container">
    <?php if($subtitle):?>  
        <h3 class="two-column-subtitle"><?php echo $subtitle; ?></h3>
    <?php endif; ?>
    <?php if($title):?>  
        <h2 class="two-column-title"><?php echo $title; ?></h2>
    <?php endif; ?>
    <?php if($description):?>  
        <p class="two-column-description"><?php echo $description; ?></p>
    <?php endif; ?>
    <?php
        echo '<ul class="nav nav-pills '.$show_tab.'" id="pills-tab" role="tablist">';
        foreach($tabs as $index => $tab) {
            $content_title = $tab['content_title'];
            $show_current_tab = '';
            $aria_selected = 'false';
            if($index === 0) {
                $show_current_tab = 'active';
                $aria_selected = 'true';
            }
            echo '<li class="nav-item">
                        <a class="nav-link '.$show_current_tab.'" id="pills-'.$index.'-tab" data-toggle="pill" href="#pills-'.$index.'" role="tab" aria-controls="pills-'.$index.'" aria-selected="'.$show_current_tab.'">'.$content_title.'</a>
                    </li>';
            $content_title = $tab['left_column'];
            $content_title = $tab['right_column'];
        }
        echo '</ul>';
        echo '<div class="tab-content" id="pills-tabContent">';
        foreach($tabs as $index => $tab) :
            $id_content = $tab['id_content'];
            $left_column = $tab['left_column'];
            $right_column = $tab['right_column'];
            $show_current_tab = '';
            if($index === 0) {
                $show_current_tab = 'show active';
            }

            echo '<div class="tab-pane fade '.$show_current_tab.'" id="pills-'.$index.'" role="tabpanel" aria-labelledby="pills-'.$index.'-tab">';
    ?>
    <div class="row">
        <?php if(!empty($left_column['image'])):?>
            <div class="col-12 col-lg-4 left contains-img order-0" data-aos="fade-right">
                <a href="<?php echo $left_column['image']['sizes']['large'] ?>" data-lightbox="<?php echo $id_content; ?>">
                    <div class="showcase-img"
                        style="background-image: url('<?php echo $left_column['image']['sizes']['large'] ?>');">
                    </div>
                </a>    
            </div>
        <?php endif; ?>
        <?php if(empty($left_column['image'])):?>
            <div class="col-12 col-lg-8 left showcase-text" data-aos="fade-right">
                <div class="column-content-inner">
                    <?php if(!empty($left_column['content'])) {
                                echo $left_column['content'];
                            }
                            echo '<div class="d-flex">';
                            if(!empty($left_column['first_link'])) {
                                echo '<a href='.$left_column['first_link']['url'].'"
                                target="'.$left_column['first_link']['target'].'"
                                class="btn btn-primary mr-2">'.$left_column['first_link']['title'].'</a>';
                            }
                            if(!empty($left_column['second_link'])) {
                                echo '<a href='.$left_column['second_link']['url'].'"
                                target="'.$left_column['second_link']['target'].'"
                                class="btn btn-secondary">'.$left_column['second_link']['title'].'</a>';
                            }
                            echo '</div>';
                    ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if(!empty($right_column['image'])):?>
            <div class="col-12 col-lg-4 right contains-img order-0" data-aos="fade-left">
                <a href="<?php echo $right_column['image']['sizes']['large'] ?>" data-lightbox="<?php echo $id_content; ?>">
                    <div class="showcase-img"
                        style="background-image: url('<?php echo $right_column['image']['sizes']['large'] ?>');">
                    </div>
                </a>
            </div>
        <?php endif; ?>
        <?php if(empty($right_column['image']) && !empty($left_column['image'])):?>
            <div class="col-12 col-lg-8 right showcase-text order-12" data-aos="fade-left">
                <div class="column-content-inner">
                    <?php if(!empty($right_column['Content'])) {
                                echo $right_column['Content'];
                            }
                            if(!empty($right_column['first_link'])) {
                                echo '<a href='.$right_column['first_link']['url'].'"
                                target="'.$right_column['first_link']['target'].'"
                                class="btn btn-primary mr-2">'.$right_column['first_link']['title'].'</a>';
                            }
                            if(!empty($right_column['second_link'])) {
                            echo '<a href='.$right_column['second_link']['url'].'"
                            target="'.$right_column['second_link']['target'].'"
                            class="btn btn-secondary">'.$right_column['second_link']['title'].'</a>';
                        }
                    ?>
                <div>
            </div>
        <?php endif; ?>
    </div>
    <?php
            echo '</div>';
        endforeach;
        echo '</div>';
    ?>
    <?php if($footer):?>  
        <div class="two-column-footer"><?php echo $footer; ?></p>
    <?php endif; ?>
    <?php $more_content_rows = $more_section['more_content_rows']; if($more_content_rows):
        echo '<div class="more-section">
                <div id="'.$more_section['id'].'-two-col" data-id="'.$more_section['id'].'" class="show-more-two-col"><span>Plus d\'infos</span></div>
                <div id="'.$more_section['id'].'" class="show-more-content">';
                if($more_section['top_image']['sizes']['large']) {
                    echo '<img src="'.$more_section['top_image']['sizes']['large'].'" id="'.$more_section['id'].'-top-img" class="top-img-more-section" data-lightbox="'.$more_section['id'].'">';
                }                    
        echo '<div id="'.$more_section['id'].'-close-btn" data-id="'.$more_section['id'].'" class="close-btn-show-more">X</div>
                    <div class="inner-content">';
        foreach($more_content_rows as $index => $more_content_row) :
            $title = $more_content_row['title'];
            $description = $more_content_row['description'];
            $footer = $more_content_row['footer'];
            $left_column = $more_content_row['left_column'];
            $right_column = $more_content_row['right_column'];
            $full_width_gallery = $more_content_row['full_width_gallery'];
            $content = $more_content_row['content'];
            $id_two_column = $more_content_row['id_two_column'];
            $id_gallery = $more_content_row['id_gallery'];
    ?>
            <?php if(!empty($title)):?>
                <h3><?php echo $title; ?></h3>
            <?php endif; ?>
            <?php if(!empty($description)):?>
                <p><?php echo $description; ?></p>
            <?php endif; ?>
            <?php if(!empty($right_column['Content']) || !empty($left_column['content'])):?>
                <div class="row">
                    <?php if(!empty($left_column['image'])):?>
                        <div class="col-12 <?php echo $left_column['col_width'] ?> left contains-img order-0" data-aos="fade-right">
                            <a href="<?php echo $left_column['image']['sizes']['large'] ?>" data-lightbox="<?php echo $id_two_column; ?>">
                                <div class="showcase-img"
                                    style="background-image: url('<?php echo $left_column['image']['sizes']['large'] ?>');">
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if(empty($left_column['image'])):?>
                        <div class="col-12 <?php echo $left_column['col_width'] ?> left showcase-text" data-aos="fade-right">
                            <div class="column-content-inner">
                                <?php if(!empty($left_column['content'])) {
                                            echo $left_column['content'];
                                        }
                                        if(!empty($left_column['first_link'])) {
                                            echo '<a href='.$left_column['first_link']['url'].'"
                                            target="'.$left_column['first_link']['target'].'"
                                            class="btn btn-primary mr-2">'.$left_column['first_link']['title'].'</a>';
                                        }
                                        if(!empty($left_column['second_link'])) {
                                            echo '<a href='.$left_column['second_link']['url'].'"
                                            target="'.$left_column['second_link']['target'].'"
                                            class="btn btn-secondary">'.$left_column['second_link']['title'].'</a>';
                                        }
                                ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if(!empty($right_column['image'])):?>
                        <div class="col-12 <?php echo $right_column['col_width'] ?> right contains-img order-0" data-aos="fade-left">
                            <a href="<?php echo $right_column['image']['sizes']['large'] ?>" data-lightbox="<?php echo $id_two_column; ?>">
                                <div class="showcase-img"
                                    style="background-image: url('<?php echo $right_column['image']['sizes']['large'] ?>');">
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if(empty($right_column['image']) && !empty($left_column['image'])):?>
                        <div class="col-12 <?php echo $right_column['col_width'] ?> right showcase-text order-12" data-aos="fade-left">
                            <div class="column-content-inner">
                                <?php if(!empty($right_column['Content'])) {
                                            echo $right_column['Content'];
                                        }
                                        if(!empty($right_column['first_link'])) {
                                            echo '<a href='.$right_column['first_link']['url'].'"
                                            target="'.$right_column['first_link']['target'].'"
                                            class="btn btn-primary mr-2">'.$right_column['first_link']['title'].'</a>';
                                        }
                                        if(!empty($right_column['second_link'])) {
                                        echo '<a href='.$right_column['second_link']['url'].'"
                                        target="'.$right_column['second_link']['target'].'"
                                        class="btn btn-secondary">'.$right_column['second_link']['title'].'</a>';
                                    }
                                ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <?php if(!empty($full_width_gallery)):?>
                <?php
                    $number = count($full_width_gallery);
                    echo '<div id="carouselIndicators" class="img-gallery carousel slide" data-ride="carousel" data-aos="fade-right">';
                    foreach($full_width_gallery as $index => $slideItem) : ?>
                        <div class="carousel-item <?php echo ($index == 0)? 'active' : '' ; ?>">
                            <a href="<?php echo $slideItem['img']['url'] ?>" data-lightbox="<?php echo $id_gallery; ?>">
                                <div class="img-carousel" style="background-image: url('<?php echo $slideItem['img']['url'] ?>');"></div>
                            </a>
                        </div>
                    <?php
                    endforeach; ?>
                    <ol class="carousel-indicators">
                        <?php for($i = 0 ; $i < $number ; $i++): ?>
                        <li data-target="#carouselIndicators" data-slide-to="<?php echo $i ?>"
                            <?php echo ($i == 0)? 'class="active"' : '' ; ?>></li>
                        <?php endfor; ?>
                    </ol>
                </div>
            <?php endif; ?>
            <?php if(!empty($content)) { 
                    echo $content;
                } 
            ?>
            <?php if($footer): echo $footer; endif; ?>
    <?php
        endforeach;
        echo '</div></div></div>';
    endif;
    ?>
</section>