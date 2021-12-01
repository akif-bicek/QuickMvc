<!Doctype html>
<!--[if IE 7 ]>
<html lang="<?php echo language; ?>" class="isie ie7 oldie no-js"> <![endif]-->
<!--[if IE 8 ]>
<html lang="<?php echo language; ?>" class="isie ie8 oldie no-js"> <![endif]-->
<!--[if IE 9 ]>
<html lang="<?php echo language; ?>" class="isie ie9 no-js"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="<?php echo language; ?>" class="no-js"> <!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $title; ?></title>

    <meta name="description" content="<?php echo $desc; ?>">
    <meta name="keywords" content="<?php echo $keywords; ?>">
    <meta name="author" content="Akif Biçek">

    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    

    <link rel="shortcut icon" href="<?php assets('favicon.ico'); ?>'" type="image/x-icon"/>

    <!-- **CSS - stylesheets** -->
    <link id="default-css" rel="stylesheet" href="<?php assets('style.css'); ?>" type="text/css" media="all"/>

    <!-- **Additional - stylesheets** -->
    <link href="<?php assets('css/animations.css'); ?>" rel="stylesheet" type="text/css" media="all"/>
    <link id="shortcodes-css" href="<?php assets('css/shortcodes.css'); ?>" rel="stylesheet" type="text/css"
          media="all"/>
    <link id="skin-css" href="<?php assets('skins/'. $settings["Skin"] .'/style.css'); ?>" rel="stylesheet" media="all"/>
    <link href="<?php assets('css/isotope.css'); ?>" rel="stylesheet" type="text/css" media="all"/>
    <link href="<?php assets('css/prettyPhoto.css'); ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php assets('css/pace.css'); ?>" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="<?php assets('css/responsive.css'); ?>" type="text/css" media="all"/>

    <link id="light-dark-css" href="<?php assets($settings["Theme"]. '/' . $settings["Theme"] . '.css'); ?>" rel="stylesheet" media="all"/>

    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/css/swiper.min.css">

    <link href="<?php assets('css/others.css'); ?>" rel="stylesheet" media="all"/>
    <!-- **Font Awesome** -->
    <link rel="stylesheet" href="<?php assets('css/font-awesome.min.css'); ?>" type="text/css"/>
    <style>
        .my-float{
            margin-left: 16px;
        }
        .my-float span{
            font-family: 'Josefin Sans', sans-serif;
            font-size: 20px;
        }
        .float{
            position:fixed;
            width:215px;
            bottom:40px;
            left:20px;
            background-color:#25d366;
            color:#FFF;
            border-radius:25px;
            text-align:left;
            font-size:20px;
            box-shadow: 2px 2px 3px #999;
            z-index:100;
        }
    </style>
    <!-- Modernizr -->
    <script src="<?php assets('js/modernizr.js'); ?>"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-MG64ZTELB5"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-MG64ZTELB5');
    </script>
</head>

<body>
<div class="loader-wrapper">
    <div id="large-header" class="large-header">
        <h1 class="loader-title"><span>&nbsp;&nbsp;&nbsp;&nbsp;Sanat</span>Etkınlıgı</h1>
    </div>
</div>
<!-- **Wrapper** -->
<div class="wrapper">
    <div class="inner-wrapper">
        <div id="header-wrapper"> <!-- **header-wrapper Starts** -->
            <?php partials("partials/Header", ["header" => $navbar, "logo" => $settings["Logo"], "alt" => $settings["SiteName"] ]); ?>
        </div>  <!-- **header-wrapper Ends** -->

        <div id="main">
            <?php renderAction(); ?>
            <?php partials("partials/Footer", ["footer" => $footer, "copyright" => $settings["Copyright"]]); ?>
        </div><!-- Main Ends Here-->
    </div><!-- **inner-wrapper - End** -->
</div><!-- **Wrapper Ends** -->
<a href="https://api.whatsapp.com/send?phone=905423969555" class="float" target="_blank">
    <i class="fa fa-whatsapp my-float"> <span>+90 542 396 95 55</span></i>
</a>
<!-- **jQuery** -->
<script src="<?php assets('js/jquery-1.11.2.min.js'); ?>" type="text/javascript"></script>

<script src="<?php assets('js/jquery.inview.js'); ?>" type="text/javascript"></script>
<script src="<?php assets('js/jquery.viewport.js'); ?>" type="text/javascript"></script>

<script type="text/javascript" src="<?php assets('js/jquery.isotope.min.js'); ?>"></script>

<script src="<?php assets('js/jsplugins.js'); ?>" type="text/javascript"></script>

<script src="<?php assets('js/jquery.prettyPhoto.js'); ?>" type="text/javascript"></script>

<script src="<?php assets('js/jquery.validate.min.js'); ?>" type="text/javascript"></script>

<script src="<?php assets('js/jquery.tipTip.minified.js'); ?>" type="text/javascript"></script>

<script type="text/javascript" src="<?php assets('js/jquery.bxslider.min.js'); ?>"></script>

<script src="<?php assets('js/custom.js'); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/js/swiper.min.js"></script>
<script src="<?php assets('js/others.js'); ?>"></script>
</body>
</html>
