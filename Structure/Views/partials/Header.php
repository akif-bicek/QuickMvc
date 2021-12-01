<header id="header" class="header1">
    <div class="container">
        <!-- **Logo - End** -->
        <div class="logo">
            <!--<a href="<?php /*echo dirname($_SERVER['PHP_SELF'])."/";  */?>" title="<?php /*echo $alt ; */?>"> <img src="<?php /*uploads($logo) ; */?>" alt="<?php /*echo $alt ; */?>"/> </a>-->
            <a href="<?php echo dirname($_SERVER['PHP_SELF'])."/";  ?>" title="<?php echo $alt ; ?>"> <h3><span style="background-color: #a81c51">Sanat</span><img
                            src="<?php assets("images/loader-img.png"); ?>" height="50" alt="Sanat Etkinliği"> <span style="background-color: #a81c51">Etkinliği</span></h3> </a>
        </div><!-- **Logo - End** -->
        <nav id="main-menu">
            <div id="dt-menu-toggle" class="dt-menu-toggle">
                Menü
                <span class="dt-menu-toggle-icon"></span>
            </div>
            <ul class="menu type4"><!-- Menu Starts -->
                <?php foreach (falseToArray($header) as $link): ?>
                    <li class="menu-item-simple-parent">
                        <a href="<?php echo $link["Link"] ; ?>"><?php echo $link["Text"] ; ?></a>
                    </li>
                <?php endforeach; ?>
            </ul> <!-- Menu Ends -->
        </nav>
    </div>
</header>