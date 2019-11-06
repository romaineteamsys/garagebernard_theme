<?php
    $left_side_title = get_field('left_side_title', 'option');
    $address         = get_field('address', 'option');
    $company_number  = get_field('company_number', 'option');
    $new_cars_phone  = get_field('new_cars_phone', 'option');
    $old_cars_phone  = get_field('old_cars_phone', 'option');
    $service_phone   = get_field('service_phone', 'option');
    $pieces_phone    = get_field('pieces_phone', 'option');
    $email           = get_field('email', 'option');
    $showroom_hours  = get_field('showroom_hours', 'option');
    $service_hours   = get_field('service_hours', 'option');
?>

<section class="two-column contact-infos container">
    <div class="row">
        <div class="col-12 col-lg-6 left-column">
            <h2 class="two-column-title"><?php echo $left_side_title; ?></h2>
            <p><?php echo $address; ?></p>
            <p><?php echo $company_number; ?></p>
            <hr>
            <h3>Général</h3>
            <p>Véhicules neufs: <a href="tel:<?php echo $new_cars_phone; ?>"><?php echo $new_cars_phone; ?></a></p>
            <p>Occasions: <a href="tel:<?php echo $old_cars_phone; ?>"><?php echo $old_cars_phone; ?></a></p>
            <p>Service: <a href="tel:<?php echo $service_phone; ?>"><?php echo $service_phone; ?></a></p>
            <p>Pièces: <a href="tel:<?php echo $pieces_phone; ?>"><?php echo $pieces_phone; ?></a></p>
            <p>Email: <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></p>
        </div>
        <div class="col-12 col-lg-6 right-column">
            <h2 class="two-column-title">Heures d'ouverture</h2>
            <div class="row">
                <div class="col-12 col-lg-5 col-md-6">
                    <h3 class="with-decoration">Showroom</h3>
                    <ul class="times-list">
                        <?php
                            foreach($showroom_hours as $index => $item) {
                                echo '<li><span class="left-side">'.$item['day'].'</span><span class="right-side">'.$item['hours'].'</span></li>';
                            }
                        ?>
                    </ul>
                </div>
                <div class="col-12 col-lg-7 col-md-6">
                    <h3 class="with-decoration">Service</h3>
                    <ul class="times-list">
                        <?php
                            foreach($service_hours as $index => $item) {
                                echo '<li><span class="left-side">'.$item['day'].'</span><span class="right-side">'.$item['hours'].'</span></li>';
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>    
</section>