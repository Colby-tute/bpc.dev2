<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
    <head>

       <head>

        <meta charset="UTF-8">
        <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Virtual Business Incubation (VBI), a VBI is a platform that offers you the ability to access, manage, monitor and evaluate your incubation BEDCO offers you a platform for Data Management, Monitoring, Evaluation and Reporting portal for entrepreneurs, business incubators, mentors and coaches.">
        <meta name="Author" content="Standafric | admin@standafric.com">
        <meta name="Keywords" content="Small and Medium Enterprises, Entrepreneurship, Entrepreneurs, Incubators, Business Development Service Providers"/>

        <!-- Title -->
        <title>BEDCO :: Virtual Business Incubator </title>

        <!-- Favicon -->

        <link rel="icon" href="<?php echo base_url()."/"; ?>assets/img/brand/favicon.ico" type="image/x-icon"/>

        <!-- Icons css -->

        <link href="<?php echo base_url()."/"; ?>assets/css/icons.css" rel="stylesheet">

        <!--- Morris css-->
        <link href="<?php echo base_url()."/"; ?>assets/plugins/morris.js/morris.css" rel="stylesheet">

        <!--  Right-sidemenu css -->
        <link href="<?php echo base_url()."/"; ?>assets/plugins/sidebar/sidebar.css" rel="stylesheet">

        <!--  Custom Scroll bar-->
        <link href="<?php echo base_url()."/"; ?>assets/plugins/mscrollbar/jquery.mCustomScrollbar.css" rel="stylesheet"/>

        <!--  Left-Sidebar css -->
        <link href="<?php echo base_url()."/"; ?>assets/css/left-menu.css" rel="stylesheet">

        <link href="<?php echo base_url()."/"; ?>assets/css/custom.css" rel="stylesheet">

        <!--- Dashboard-1 css-->
        <link href="<?php echo base_url()."/"; ?>assets/css/bootstrap-custom.css" rel="stylesheet">
        <link href="<?php echo base_url()."/"; ?>assets/css/style.css" rel="stylesheet">
        <link href="<?php echo base_url()."/"; ?>assets/css/style-dark.css" rel="stylesheet">

        <!--- Animations css-->
        <link href="<?php echo base_url()."/"; ?>assets/css/animate.css" rel="stylesheet">

    </head>
    <body class="main-body app sidebar-mini">

        <!-- Loader -->
        <div id="global-loader">
            <img src="<?php echo base_url()."/"; ?>assets/img/loader.svg" class="loader-img" alt="Loader">
        </div>
        <!-- /Loader -->

        <div class="page">

            <!-- main-sidebar opened -->
            <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
            <aside class="app-sidebar">
                <div class="main-sidebar-header">
                    <a class=" desktop-logo logo-light" href="index.html"><img src="<?php echo base_url()."/"; ?>assets/img/brand/logo.png" class="main-logo" alt="logo"></a>
                    <a class=" desktop-logo logo-dark" href="index.html"><img src="<?php echo base_url()."/"; ?>assets/img/brand/logo-white.png" class="main-logo dark-theme" alt="logo"></a>
                    <a class="logo-icon mobile-logo icon-light" href="index.html"><img src="<?php echo base_url()."/"; ?>assets/img/brand/favicon.png" class="logo-icon" alt="logo"></a>
                    <a class="logo-icon mobile-logo icon-dark" href="index.html"><img src="<?php echo base_url()."/"; ?>assets/img/brand/favicon-white.png" class="logo-icon dark-theme" alt="logo"></a>
                </div>
                <div class="sidebar-scroll">
                    <div class="main-sidebar-loggedin">
                        <div class="main-img-user online"><img alt="" class="" src="<?php echo base_url()."/"; ?>assets/img/faces/6.jpg"></div>
                        <div class="media-body pt-1">
                            <h6>Robin Banks</h6><span>Premium Member</span>
                        </div>
                    </div>

                    <div class="nav-search p-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="search..." aria-label="search" aria-describedby="search">
                            <div class="input-group-append">
                                <span class="input-group-text" id="search">
                                    <i class="ti-search"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="main-sidebar-body">
                        <ul class="side-menu ">
                            <li><h3 class="pt-0">Dashboard</h3></li>
                            <li class="slide">
                                <a class="side-menu__item" href="index.html"><i class="side-menu__icon typcn typcn-device-desktop"></i><span class="side-menu__label">Dashboard</span><span class="badge badge-warning side-badge">1</span></a>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" href="<?= site_url('role') ?>"><i class="side-menu__icon typcn typcn-archive"></i><span class="side-menu__label">Roles</span></a>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" href="<?= site_url('adminmaster') ?>"><i class="side-menu__icon typcn typcn-archive"></i><span class="side-menu__label">Admins</span></a>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" href="<?= site_url('role_rights') ?>"><i class="side-menu__icon typcn typcn-archive"></i><span class="side-menu__label">Role Rights</span></a>
                            </li>
                            <!-- <li><h3>Widgets & Maps</h3></li>
                            <li class="slide">
                                <a class="side-menu__item" href="widgets.html"><i class="side-menu__icon typcn typcn-archive"></i><span class="side-menu__label">Widgets</span></a>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon typcn typcn-mail menu-icons"></i><span class="side-menu__label">Mail</span><span class="badge badge-pink side-badge">2</span><i class="angle fe fe-chevron-down"></i></a>
                                <ul class="slide-menu">
                                    <li><a class="slide-item" href="mail.html">Mail</a></li>
                                    <li><a class="slide-item" href="mail-compose.html">Mail Compose</a></li>
                                    <li><a class="slide-item" href="mail-read.html">Read-mail</a></li>
                                    <li><a class="slide-item" href="mail-settings.html">mail-settings</a></li>
                                    <li><a class="slide-item" href="chat.html">Chat</a></li>
                                </ul>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon typcn typcn-database"></i><span class="side-menu__label">Apps</span><i class="angle fe fe-chevron-down"></i></a>
                                <ul class="slide-menu">
                                    <li><a class="slide-item" href="cards.html">Cards</a></li>
                                    <li><a class="slide-item" href="darggablecards.html">Darggablecards</a></li>
                                    <li><a class="slide-item" href="rangeslider.html">Range-slider</a></li>
                                    <li><a class="slide-item" href="calendar.html">Calendar</a></li>
                                    <li><a class="slide-item" href="contacts.html">Contacts</a></li>
                                    <li><a class="slide-item" href="image-compare.html">Image-compare</a></li>
                                    <li><a class="slide-item" href="notification.html">Notification</a></li>
                                    <li><a class="slide-item" href="widget-notification.html">Widget-notification</a></li>
                                    <li><a class="slide-item" href="treeview.html">Treeview</a></li>
                                </ul>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" href="icons.html"><i class="side-menu__icon typcn typcn-archive"></i><span class="side-menu__label">Icons</span></a>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon typcn typcn-map menu-icon"></i><span class="side-menu__label">Maps</span><span class="badge badge-secondary side-badge">2</span><i class="angle fe fe-chevron-down"></i></a>
                                <ul class="slide-menu">
                                    <li><a class="slide-item" href="map-leaflet.html">Mapel Maps</a></li>
                                    <li><a class="slide-item" href="map-vector.html">Vector Maps</a></li>
                                </ul>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon typcn typcn-book menu-icon"></i><span class="side-menu__label">Tables</span><i class="angle fe fe-chevron-down"></i></a>
                                <ul class="slide-menu">
                                    <li><a class="slide-item" href="table-basic.html">Basic Tables</a></li>
                                    <li><a class="slide-item" href="table-data.html">Data Tables</a></li>
                                </ul>
                            </li>
                            <li><h3>COMPONENTS</h3></li>
                            <li class="slide">
                                <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon typcn typcn-tabs-outline"></i><span class="side-menu__label">Elements</span><i class="angle fe fe-chevron-down"></i></a>
                                <ul class="slide-menu">
                                    <li><a class="slide-item" href="alerts.html">Alerts</a></li>
                                    <li><a class="slide-item" href="avatar.html">Avatar</a></li>
                                    <li><a class="slide-item" href="breadcrumbs.html">Breadcrumbs</a></li>
                                    <li><a class="slide-item" href="buttons.html">Buttons</a></li>
                                    <li><a class="slide-item" href="badge.html">Badge</a></li>
                                    <li><a class="slide-item" href="dropdown.html">Dropdown</a></li>
                                    <li><a class="slide-item" href="thumbnails.html">Thumbnails</a></li>
                                    <li><a class="slide-item" href="images.html">Images</a></li>
                                    <li><a class="slide-item" href="list-group.html">List Group</a></li>
                                    <li><a class="slide-item" href="navigation.html">Navigation</a></li>
                                    <li><a class="slide-item" href="pagination.html">Pagination</a></li>
                                    <li><a class="slide-item" href="popover.html">Popover</a></li>
                                    <li><a class="slide-item" href="progress.html">Progress</a></li>
                                    <li><a class="slide-item" href="spinners.html">Spinners</a></li>
                                    <li><a class="slide-item" href="media-object.html">Media Object</a></li>
                                    <li><a class="slide-item" href="typography.html">Typography</a></li>
                                    <li><a class="slide-item" href="tooltip.html">Tooltip</a></li>
                                    <li><a class="slide-item" href="toast.html">Toast</a></li>
                                    <li><a class="slide-item" href="tags.html">Tags</a></li>
                                </ul>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon typcn typcn-film"></i><span class="side-menu__label">Advanced UI</span><i class="angle fe fe-chevron-down"></i></a>
                                <ul class="slide-menu">
                                    <li><a class="slide-item" href="accordion.html">Accordion</a></li>
                                    <li><a class="slide-item" href="carousel.html">Carousel</a></li>
                                    <li><a class="slide-item" href="collapse.html">Collapse</a></li>
                                    <li><a class="slide-item" href="modals.html">Modals</a></li>
                                    <li><a class="slide-item" href="timeline.html">Timeline</a></li>
                                    <li><a class="slide-item" href="sweet-alert.html">Sweet Alert</a></li>
                                    <li><a class="slide-item" href="rating.html">Ratings</a></li>
                                    <li><a class="slide-item" href="counters.html">Counters</a></li>
                                    <li><a class="slide-item" href="search.html">Search</a></li>
                                    <li><a class="slide-item" href="userlist.html">Userlist</a></li>
                                    <li><a class="slide-item" href="blog.html">Blog</a></li>
                                </ul>
                            </li>

                            <li><h3>Forms</h3></li>
                            <li class="slide">
                                <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon typcn typcn-edit"></i><span class="side-menu__label">Forms</span><span class="badge badge-info side-badge">6</span><i class="angle fe fe-chevron-down"></i></a>
                                <ul class="slide-menu">
                                    <li><a class="slide-item" href="form-elements.html">Form Elements</a></li>
                                    <li><a class="slide-item" href="form-advanced.html">Advanced Forms</a></li>
                                    <li><a class="slide-item" href="form-layouts.html">Form Layouts</a></li>
                                    <li><a class="slide-item" href="form-validation.html">Form Validation</a></li>
                                    <li><a class="slide-item" href="form-wizards.html">Form Wizards</a></li>
                                    <li><a class="slide-item" href="form-editor.html">WYSIWYG Editor</a></li>
                                </ul>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon typcn typcn-chart-pie-outline"></i><span class="side-menu__label">Charts</span><span class="badge badge-danger side-badge">5</span><i class="angle fe fe-chevron-down"></i></a>
                                <ul class="slide-menu">
                                    <li><a class="slide-item" href="chart-morris.html">Morris Charts</a></li>
                                    <li><a class="slide-item" href="chart-flot.html">Flot Charts</a></li>
                                    <li><a class="slide-item" href="chart-chartjs.html">ChartJS</a></li>
                                    <li><a class="slide-item" href="chart-echart.html">Echart</a></li>
                                    <li><a class="slide-item" href="chart-sparkline.html">Sparkline</a></li>
                                    <li><a class="slide-item" href="chart-peity.html">Chart-peity</a></li>
                                </ul>
                            </li>
                            <li><h3>OTHER PAGES</h3></li>
                            <li class="slide">
                                <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon typcn typcn-user-add-outline"></i><span class="side-menu__label">Pages</span><i class="angle fe fe-chevron-down"></i></a>
                                <ul class="slide-menu">
                                    <li><a class="slide-item" href="profile.html">Profile</a></li>
                                    <li><a class="slide-item" href="editprofile.html">Edit-Profile</a></li>
                                    <li><a class="slide-item" href="invoice.html">Invoice</a></li>
                                    <li><a class="slide-item" href="pricing.html">Pricing</a></li>
                                    <li><a class="slide-item" href="gallery.html">Gallery</a></li>
                                    <li><a class="slide-item" href="todotask.html">Todotask</a></li>
                                    <li><a class="slide-item" href="faq.html">Faqs</a></li>
                                    <li><a class="slide-item" href="empty.html">Empty Page</a></li>
                                </ul>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon typcn typcn-shopping-bag"></i><span class="side-menu__label">Ecommerce</span><span class="badge badge-success side-badge">3</span><i class="angle fe fe-chevron-down"></i></a>
                                <ul class="slide-menu">
                                    <li><a class="slide-item" href="products.html">Products</a></li>
                                    <li><a class="slide-item" href="product-details.html">Product-Details</a></li>
                                    <li><a class="slide-item" href="product-cart.html">Cart</a></li>
                                </ul>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon typcn typcn-point-of-interest-outline"></i><span class="side-menu__label">Utilities</span><i class="angle fe fe-chevron-down"></i></a>
                                <ul class="slide-menu">
                                    <li><a class="slide-item" href="background.html">Background</a></li>
                                    <li><a class="slide-item" href="border.html">Border</a></li>
                                    <li><a class="slide-item" href="display.html">Display</a></li>
                                    <li><a class="slide-item" href="flex.html">Flex</a></li>
                                    <li><a class="slide-item" href="height.html">Height</a></li>
                                    <li><a class="slide-item" href="margin.html">Margin</a></li>
                                    <li><a class="slide-item" href="padding.html">Padding</a></li>
                                    <li><a class="slide-item" href="position.html">Position</a></li>
                                    <li><a class="slide-item" href="width.html">Width</a></li>
                                    <li><a class="slide-item" href="extras.html">Extras</a></li>
                                </ul>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon typcn typcn-lock-closed-outline"></i><span class="side-menu__label">Custom Pages</span><i class="angle fe fe-chevron-down"></i></a>
                                <ul class="slide-menu">
                                    <li><a class="slide-item" href="signin.html">Sign In</a></li>
                                    <li><a class="slide-item" href="signup.html">Sign Up</a></li>
                                    <li><a class="slide-item" href="forgot.html">Forgot Password</a></li>
                                    <li><a class="slide-item" href="reset.html">Reset Password</a></li>
                                    <li><a class="slide-item" href="lockscreen.html">Lockscreen</a></li>
                                    <li><a class="slide-item" href="underconstruction.html">UnderConstruction</a></li>
                                    <li><a class="slide-item" href="404.html">404 Error</a></li>
                                    <li><a class="slide-item" href="500.html">500 Error</a></li>
                                </ul>
                            </li> -->
                        </ul>
                    </div>
                </div>
            </aside>