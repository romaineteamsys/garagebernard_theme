<?php
$slides = get_sub_field('slides');
?>
<header class="masthead">
    <?php if(is_array($slides)): ?>
        <?php $number = count($slides); ?>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php foreach($slides as $index => $slideItem ): ?>
                    <div class="carousel-item <?php echo ($index == 0)? 'active' : '' ; ?>">
                        <div class="img-carousel" style="background-image: url('<?php echo $slideItem['image']['url'] ?>');">
                            <div class="carousel-caption container">
                                <div class="hero-title">
                                    <?php if(!empty($slideItem['title'] )): ?><?php echo $slideItem['title'] ?><?php endif; ?>
                                </div>
                                <div class="hero-subtitle">
                                    <?php if(!empty($slideItem['subtitle'] )): ?><?php echo $slideItem['subtitle'] ?><?php endif; ?>
                                </div>    
                                <div class="hero-links">
                                    <?php if(!empty($slideItem['link_1'])): ?>
                                        <a class="hero-link-square" href="<?php echo $slideItem['link_1']['url'] ?>"
                                            target="<?php echo $slideItem['link_1']['target'] ?>"><span><?php echo $slideItem['link_1']['title'] ?></span></a>
                                    <?php endif; ?>
                                    <?php if(!empty($slideItem['link_2'])): ?>
                                        <a class="hero-link-square" href="<?php echo $slideItem['link_2']['url'] ?>"
                                            target="<?php echo $slideItem['link_2']['target'] ?>"><span><?php echo $slideItem['link_2']['title'] ?></span></a>
                                    <?php endif; ?>
                                </div>                                
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <ol class="carousel-indicators">
                    <?php for($i = 0 ; $i < $number ; $i++): ?>
                    <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i ?>"
                        <?php echo ($i == 0)? 'class="active"' : '' ; ?>></li>
                    <?php endfor; ?>
                </ol>
            </div>
        </div>
    <?php endif; ?>
</header>