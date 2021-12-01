<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?php echo $title ?></title>
    <base href="<?php echo dirname($_SERVER['PHP_SELF'])."/"; ?>">
    <meta name="robots" content="noindex, nofollow, noarchive">
    <meta name="googlebot" content="noindex, nofollow, noarchive">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Pignose Calender -->
    <link href="<?php assets('Admin/plugins/pg-calendar/css/pignose.calendar.min.css'); ?>" rel="stylesheet">
    <!-- Chartist -->
    <?php styleImploader("Admin/plugins/jquery-asColorPicker-master/css/asColorPicker.css", false); ?>
    <link rel="stylesheet" href="<?php assets('Admin/plugins/chartist/css/chartist.min.css'); ?>">
    <link rel="stylesheet" href="<?php assets('Admin/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css'); ?>">
    <!-- Custom Stylesheet -->
    <link href="<?php assets('Admin/css/style.css'); ?>" rel="stylesheet">
    <style>
        /* width */
        ::-webkit-scrollbar {
            width: 12px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #7571f9;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #6610f2;
        }
    </style>
</head>
<body>
<div id="preloader">
    <div class="loader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
        </svg>
    </div>
</div>
<div id="main-wrapper">
    <div class="nav-header">
        <div class="brand-logo">
            <a href="index.html">
                <b class="logo-abbr"><img src="images/logo.png" alt=""> </b>
                <span class="logo-compact"><img src="./images/logo-compact.png" alt=""></span>
                <span class="brand-title">
                        <img src="images/logo-text.png" alt="">
                    </span>
            </a>
        </div>
    </div>
    <div class="header">
        <div class="header-content clearfix">
            <div class="nav-control">
                <div class="hamburger">
                    <span class="toggle-icon"><i class="icon-menu"></i></span>
                </div>
            </div>
            <div class="header-left">
                <div class="input-group icons">
                    <a target="_blank" href="./" class="btn mt-2 btn-primary pull-right text-white p-1"><i class="fa fa-eye text-white"></i> <?php sc('view-site'); ?></a>
                </div>
            </div>
            <div class="header-right">
                <ul class="clearfix">
                    <li class="icons dropdown">
                        <?php partials("Admin/Partials/Messages", ['messages' => $messages]); ?>
                    </li>
                    <li class="icons dropdown d-none d-md-flex">
                        <?php partials("Admin/Partials/Languages", ['languages' => $languages]); ?>
                    </li>
                    <li class="icons dropdown">
                        <div class="user-img c-pointer position-relative"  data-toggle="dropdown">
                            <span class="activity active"></span>
                            <img src="<?php assets('Admin/images/avatar/'. rand(1, 8) .'.jpg'); ?>" height="40" width="40" alt="">
                        </div>
                        <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                            <div class="dropdown-content-body">
                                <ul>
                                    <li>
                                        <a href="app-profile.html"><i class="icon-user"></i> <span>Profile</span></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void()">
                                            <i class="icon-envelope-open"></i> <span>Inbox</span> <div class="badge gradient-3 badge-pill gradient-1">3</div>
                                        </a>
                                    </li>

                                    <hr class="my-2">
                                    <li>
                                        <a href="page-lock.html"><i class="icon-lock"></i> <span>Lock Screen</span></a>
                                    </li>
                                    <li><a href="page-login.html"><i class="icon-key"></i> <span>Logout</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nk-sidebar">
        <?php partials("Admin/Partials/Sidebar", ['sidebar' => $sidebar]); ?>
    </div>
    <div class="content-body">
        <div class="container-fluid">
            <?php renderAction(); ?>
        </div>
    </div>
</div>
<div class="footer">
    <div class="copyright">
        <p>Copyright &copy; Designed & Developed by <a href="https://akifbicek.com">AkifBicek</a> 2021</p>
    </div>
</div>
<?php styles(); ?>

<script src="<?php assets('Admin/plugins/common/common.min.js'); ?>"></script>
<script src="<?php assets('Admin/js/custom.min.js'); ?>"></script>
<script src="<?php assets('Admin/js/settings.js'); ?>"></script>
<script src="<?php assets('Admin/js/gleek.js'); ?>"></script>
<script src="<?php assets('Admin/js/styleSwitcher.js'); ?>"></script>
<script src="<?php assets('Admin/plugins/chart.js/Chart.bundle.min.js'); ?>"></script>
<script src="<?php assets('Admin/plugins/circle-progress/circle-progress.min.js'); ?>"></script>
<script src="<?php assets('Admin/plugins/d3v3/index.js'); ?>"></script>
<script src="<?php assets('Admin/plugins/topojson/topojson.min.js'); ?>"></script>
<script src="<?php assets('Admin/plugins/raphael/raphael.min.js'); ?>"></script>
<script src="<?php assets('Admin/plugins/morris/morris.min.js'); ?>"></script>
<script src="<?php assets('Admin/plugins/moment/moment.min.js'); ?>"></script>
<script src="<?php assets('Admin/plugins/pg-calendar/js/pignose.calendar.min.js'); ?>"></script>
<script src="<?php assets('Admin/plugins/chartist/js/chartist.min.js'); ?>"></script>
<script src="<?php assets('Admin/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js'); ?>"></script>
<script src="<?php assets('Admin/js/dashboard/dashboard-1.js'); ?>"></script>
<script src="<?php assets('Admin/js/others.js'); ?>"></script>
<?php scripts(); ?>
</body>
</html>