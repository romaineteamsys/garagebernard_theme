<?php
    $people = get_sub_field('people');
?>

<section class="team-section container">
    <h2>Notre équipe</h2>
    <div class="custom-cards">
        <?php
            foreach($people as $index => $employee):
                $image = $employee['image'];
                $name = $employee['name'];
                $title = $employee['title'];
                $phone = $employee['phone'];
                $email = $employee['email'];
        ?>
            <div class="custom-card-item">
                <div class="custom-card-img" style="background-image: url('<?php echo $image['url'] ?>');"></div>
                <h3><?php echo $name; ?></h3>
                <p><?php echo $title; ?></p>
                <br>
                <p><a href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a></p>
                <p><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></p>
            </div>
        <?php
            endforeach;
        ?>   
    </div>
</section>