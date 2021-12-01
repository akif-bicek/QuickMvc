<section id="primary" class="content-full-width">
    <div class="container">
        <div class="dt-sc-hr-invisible-small"></div>
        <div class="main-title pullDown" data-animation="pullDown" data-delay="100">
            <h3> Hakkımızda </h3>
            <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</p>-->
        </div>
        <div class="dt-sc-service-content">
            <p><?php echo decodeSecurity($content) ;?></p>
        </div>
        <div class="dt-sc-hr-invisible-small"></div>
        <?php if(count(falseToArray($team)) > 0): ?>
            <div class="main-title pullDown" data-animation="pullDown" data-delay="100">
                <h3> Ekibimiz </h3>
                <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</p>-->
            </div>
            <div class="dt-sc-service-content">
                <?php foreach (falseToArray($team) as $personal): ?>
                <div class="dt-sc-tabs-frame-content" style="display: block;">
                    <p><img src="<?php echo assets("images/art.gif"); ?>" data-src="<?php uploads($personal["ImagePath"]); ?>" alt="<?php echo $personal["Name"]; ?>" title="<?php echo $personal["Name"]; ?>" class="alignleft async">
                        <h4><?php echo $personal["Name"]; ?></h4>
                        <?php echo decodeSecurity($personal["Content"]); ?>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>