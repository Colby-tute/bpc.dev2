<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en" dir="">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gull - Laravel + Bootstrap 4 admin template</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link id="gull-theme" rel="stylesheet" href="<?php echo base_url()."assets/"; ?>assets/styles/css/themes/lite-purple.min.css">
    <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>assets/styles/vendor/perfect-scrollbar.css">

</head>

<body class="text-left">
    <!-- Pre Loader Strat  -->
    <div class='loadscreen' id="preloader">

        <div class="loader spinner-bubble spinner-bubble-primary">



        </div>
    </div>
    <!-- Pre Loader end  -->
    <div class="app-admin-wrap layout-sidebar-large clearfix">
        <div class="main-header">
            <div class="logo">
                <img src="<?php echo base_url()."assets/"; ?>/assets/images/logo.png" alt="">
            </div>

            <div class="menu-toggle">
                <div></div>
                <div></div>
                <div></div>
            </div>

            <div class="d-flex align-items-center">
                <!-- Mega menu -->
                <div class="dropdown mega-menu d-none d-md-block">
                    <a href="<?php echo base_url()."assets/"; ?>#" class="btn text-muted dropdown-toggle mr-3" id="dropdownMegaMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Mega Menu</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <div class="row m-0">
                            <div class="col-md-4 p-4 text-left bg-img">
                                <h2 class="title">Mega Menu <br> Sidebar</h2>
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Asperiores natus laboriosam fugit, consequatur.
                                </p>
                                <p class="mb-4">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Exercitationem odio amet eos dolore suscipit placeat.</p>
                                <button class="btn btn-lg btn-rounded btn-outline-warning">Learn More</button>
                            </div>
                            <div class="col-md-4 p-4 text-left">
                                <p class="text-primary text--cap border-bottom-primary d-inline-block">Features</p>
                                <div class="menu-icon-grid w-auto p-0">
                                    <a href="<?php echo base_url()."assets/"; ?>#"><i class="i-Shop-4"></i> Home</a>
                                    <a href="<?php echo base_url()."assets/"; ?>#"><i class="i-Library"></i> UI Kits</a>
                                    <a href="<?php echo base_url()."assets/"; ?>#"><i class="i-Drop"></i> Apps</a>
                                    <a href="<?php echo base_url()."assets/"; ?>#"><i class="i-File-Clipboard-File--Text"></i> Forms</a>
                                    <a href="<?php echo base_url()."assets/"; ?>#"><i class="i-Checked-User"></i> Sessions</a>
                                    <a href="<?php echo base_url()."assets/"; ?>#"><i class="i-Ambulance"></i> Support</a>
                                </div>
                            </div>
                            <div class="col-md-4 p-4 text-left">
                                <p class="text-primary text--cap border-bottom-primary d-inline-block">Components</p>
                                <ul class="links">
                                    <li><a href="<?php echo base_url()."assets/"; ?>accordion.html">Accordion</a></li>
                                    <li><a href="<?php echo base_url()."assets/"; ?>alerts.html">Alerts</a></li>
                                    <li><a href="<?php echo base_url()."assets/"; ?>buttons.html">Buttons</a></li>
                                    <li><a href="<?php echo base_url()."assets/"; ?>badges.html">Badges</a></li>
                                    <li><a href="<?php echo base_url()."assets/"; ?>carousel.html">Carousels</a></li>
                                    <li><a href="<?php echo base_url()."assets/"; ?>lists.html">Lists</a></li>
                                    <li><a href="<?php echo base_url()."assets/"; ?>popover.html">Popover</a></li>
                                    <li><a href="<?php echo base_url()."assets/"; ?>tables.html">Tables</a></li>
                                    <li><a href="<?php echo base_url()."assets/"; ?>datatables.html">Datatables</a></li>
                                    <li><a href="<?php echo base_url()."assets/"; ?>modals.html">Modals</a></li>
                                    <li><a href="<?php echo base_url()."assets/"; ?>nouislider.html">Sliders</a></li>
                                    <li><a href="<?php echo base_url()."assets/"; ?>tabs.html">Tabs</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- / Mega menu -->
                <div class="search-bar">
                    <input type="text" placeholder="Search">
                    <i class="search-icon text-muted i-Magnifi-Glass1"></i>
                </div>
            </div>

            <div style="margin: auto"></div>

            <div class="header-part-right">
                <!-- Full screen toggle -->
                <i class="i-Full-Screen header-icon d-none d-sm-inline-block" data-fullscreen></i>
                <!-- Grid menu Dropdown -->
                <div class="dropdown">
                    <i class="i-Safe-Box text-muted header-icon" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false"></i>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <div class="menu-icon-grid">
                            <a href="<?php echo base_url()."assets/"; ?>#"><i class="i-Shop-4"></i> Home</a>
                            <a href="<?php echo base_url()."assets/"; ?>#"><i class="i-Library"></i> UI Kits</a>
                            <a href="<?php echo base_url()."assets/"; ?>#"><i class="i-Drop"></i> Apps</a>
                            <a href="<?php echo base_url()."assets/"; ?>#"><i class="i-File-Clipboard-File--Text"></i> Forms</a>
                            <a href="<?php echo base_url()."assets/"; ?>#"><i class="i-Checked-User"></i> Sessions</a>
                            <a href="<?php echo base_url()."assets/"; ?>#"><i class="i-Ambulance"></i> Support</a>
                        </div>
                    </div>
                </div>
                <!-- Notificaiton -->
                <div class="dropdown">
                    <div class="badge-top-container" id="dropdownNotification" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="badge badge-primary">3</span>
                        <i class="i-Bell text-muted header-icon"></i>
                    </div>
                    <!-- Notification dropdown -->
                    <div class="dropdown-menu rtl-ps-none dropdown-menu-right notification-dropdown" aria-labelledby="dropdownNotification" data-perfect-scrollbar data-suppress-scroll-x="true">
                        <div class="dropdown-item d-flex">
                            <div class="notification-icon">
                                <i class="i-Speach-Bubble-6 text-primary mr-1"></i>
                            </div>
                            <div class="notification-details flex-grow-1">
                                <p class="m-0 d-flex align-items-center">
                                    <span>New message</span>
                                    <span class="badge badge-pill badge-primary ml-1 mr-1">new</span>
                                    <span class="flex-grow-1"></span>
                                    <span class="text-small text-muted ml-auto">10 sec ago</span>
                                </p>
                                <p class="text-small text-muted m-0">James: Hey! are you busy?</p>
                            </div>
                        </div>
                        <div class="dropdown-item d-flex">
                            <div class="notification-icon">
                                <i class="i-Receipt-3 text-success mr-1"></i>
                            </div>
                            <div class="notification-details flex-grow-1">
                                <p class="m-0 d-flex align-items-center">
                                    <span>New order received</span>
                                    <span class="badge badge-pill badge-success ml-1 mr-1">new</span>
                                    <span class="flex-grow-1"></span>
                                    <span class="text-small text-muted ml-auto">2 hours ago</span>
                                </p>
                                <p class="text-small text-muted m-0">1 Headphone, 3 iPhone x</p>
                            </div>
                        </div>
                        <div class="dropdown-item d-flex">
                            <div class="notification-icon">
                                <i class="i-Empty-Box text-danger mr-1"></i>
                            </div>
                            <div class="notification-details flex-grow-1">
                                <p class="m-0 d-flex align-items-center">
                                    <span>Product out of stock</span>
                                    <span class="badge badge-pill badge-danger ml-1 mr-1">3</span>
                                    <span class="flex-grow-1"></span>
                                    <span class="text-small text-muted ml-auto">10 hours ago</span>
                                </p>
                                <p class="text-small text-muted m-0">Headphone E67, R98, XL90, Q77</p>
                            </div>
                        </div>
                        <div class="dropdown-item d-flex">
                            <div class="notification-icon">
                                <i class="i-Data-Power text-success mr-1"></i>
                            </div>
                            <div class="notification-details flex-grow-1">
                                <p class="m-0 d-flex align-items-center">
                                    <span>Server Up!</span>
                                    <span class="badge badge-pill badge-success ml-1 mr-1">3</span>
                                    <span class="flex-grow-1"></span>
                                    <span class="text-small text-muted ml-auto">14 hours ago</span>
                                </p>
                                <p class="text-small text-muted m-0">Server rebooted successfully</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Notificaiton End -->

                <!-- User avatar dropdown -->
                <div class="dropdown">
                    <div class="user col align-self-end">
                        <img src="<?php echo base_url()."assets/"; ?>assets/images/faces/1.jpg" id="userDropdown" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            <div class="dropdown-header">
                                <i class="i-Lock-User mr-1"></i> Timothy Carlson
                            </div>
                            <a class="dropdown-item">Account settings</a>
                            <a class="dropdown-item">Billing history</a>
                            <a class="dropdown-item" href="<?php echo base_url()."assets/"; ?>signin.html">Sign out</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- header top menu end -->

        <div class="side-content-wrap">
            <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
                <ul class="navigation-left">
                    <li class="nav-item" data-item="dashboard">
                        <a class="nav-item-hold" href="<?php echo base_url()."assets/"; ?>#">
                            <i class="nav-icon i-Bar-Chart"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                        <div class="triangle"></div>
                    </li>
                    <li class="nav-item" data-item="uikits">
                        <a class="nav-item-hold" href="<?php echo base_url()."assets/"; ?>#">
                            <i class="nav-icon i-Library"></i>
                            <span class="nav-text">UI kits</span>
                        </a>
                        <div class="triangle"></div>
                    </li>
                    <li class="nav-item" data-item="extrakits">
                        <a class="nav-item-hold" href="<?php echo base_url()."assets/"; ?>#">
                            <i class="nav-icon i-Suitcase"></i>
                            <span class="nav-text">Extra kits</span>
                        </a>
                        <div class="triangle"></div>
                    </li>
                    <li class="nav-item" data-item="apps">
                        <a class="nav-item-hold" href="<?php echo base_url()."assets/"; ?>#">
                            <i class="nav-icon i-Computer-Secure"></i>
                            <span class="nav-text">Apps</span>
                        </a>
                        <div class="triangle"></div>
                    </li>

                    <li class="nav-item" data-item="widgets">
                        <a class="nav-item-hold" href="<?php echo base_url()."assets/"; ?>#">
                            <i class="nav-icon i-Computer-Secure"></i>
                            <span class="nav-text">Widgets</span>
                        </a>
                        <div class="triangle"></div>
                    </li>

                    <li class="nav-item " data-item="charts">
                        <a class="nav-item-hold" href="<?php echo base_url()."assets/"; ?>#">
                            <i class="nav-icon i-File-Clipboard-File--Text"></i>
                            <span class="nav-text">Charts</span>
                        </a>
                        <div class="triangle"></div>
                    </li>


                    <li class="nav-item" data-item="forms">
                        <a class="nav-item-hold" href="<?php echo base_url()."assets/"; ?>#">
                            <i class="nav-icon i-File-Clipboard-File--Text"></i>
                            <span class="nav-text">Forms</span>
                        </a>
                        <div class="triangle"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-item-hold" href="<?php echo base_url()."assets/"; ?>datatables.html">
                            <i class="nav-icon i-File-Horizontal-Text"></i>
                            <span class="nav-text">Datatables</span>
                        </a>
                        <div class="triangle"></div>
                    </li>
                    <li class="nav-item" data-item="sessions">
                        <a class="nav-item-hold" href="<?php echo base_url()."assets/"; ?>#">
                            <i class="nav-icon i-Administrator"></i>
                            <span class="nav-text">Sessions</span>
                        </a>
                        <div class="triangle"></div>
                    </li>
                    <li class="nav-item active" data-item="others">
                        <a class="nav-item-hold" href="<?php echo base_url()."assets/"; ?>#">
                            <i class="nav-icon i-Double-Tap"></i>
                            <span class="nav-text">Others</span>
                        </a>
                        <div class="triangle"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-item-hold" href="<?php echo base_url()."assets/"; ?>http://demos.ui-lib.com/gull-html-doc/" target="_blank">
                            <i class="nav-icon i-Safe-Box1"></i>
                            <span class="nav-text">Doc</span>
                        </a>
                        <div class="triangle"></div>
                    </li>
                </ul>
            </div>

            <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
                <!-- Submenu Dashboards -->
                <ul class="childNav" data-parent="dashboard">
                    <li class="nav-item">
                        <a href="<?php echo base_url()."assets/"; ?>dashboard.v1.html">
                            <i class="nav-icon i-Clock-3"></i>
                            <span class="item-name">Version 1</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url()."assets/"; ?>dashboard.v2.html">
                            <i class="nav-icon i-Clock-4"></i>
                            <span class="item-name">Version 2</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url()."assets/"; ?>dashboard.v3.html">
                            <i class="nav-icon i-Over-Time"></i>
                            <span class="item-name">Version 3</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url()."assets/"; ?>dashboard.v4.html">
                            <i class="nav-icon i-Clock"></i>
                            <span class="item-name">Version 4</span>
                        </a>
                    </li>
                </ul>
                <ul class="childNav" data-parent="forms">
                    <li class="nav-item">
                        <a href="<?php echo base_url()."assets/"; ?>form.basic.html">
                            <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                            <span class="item-name">Basic Elements</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url()."assets/"; ?>form.layouts.html">
                            <i class="nav-icon i-Split-Vertical"></i>
                            <span class="item-name">Form Layouts</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url()."assets/"; ?>form.input.group.html">
                            <i class="nav-icon i-Receipt-4"></i>
                            <span class="item-name">Input Groups</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url()."assets/"; ?>form.validation.html">
                            <i class="nav-icon i-Close-Window"></i>
                            <span class="item-name">Form Validation</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url()."assets/"; ?>smart.wizard.html">
                            <i class="nav-icon i-Width-Window"></i>
                            <span class="item-name">Smart Wizard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url()."assets/"; ?>tag.input.html">
                            <i class="nav-icon i-Tag-2"></i>
                            <span class="item-name">Tag Input</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url()."assets/"; ?>editor.html">
                            <i class="nav-icon i-Pen-2"></i>
                            <span class="item-name">Rich Editor</span>
                        </a>
                    </li>
                </ul>
                <ul class="childNav" data-parent="apps">
                    <li class="nav-item">
                        <a href="<?php echo base_url()."assets/"; ?>invoice.html">
                            <i class="nav-icon i-Add-File"></i>
                            <span class="item-name">Invoice</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url()."assets/"; ?>inbox.html">
                            <i class="nav-icon i-Email"></i>
                            <span class="item-name">Inbox</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url()."assets/"; ?>chat.html">
                            <i class="nav-icon i-Speach-Bubble-3"></i>
                            <span class="item-name">Chat</span>
                        </a>
                    </li>
                </ul>

                <ul class="childNav" data-parent="widgets">
                    <li class="nav-item">
                        <a class="" href="<?php echo base_url()."assets/"; ?>widget-card.html">
                            <i class="nav-icon i-Receipt-4"></i>
                            <span class="item-name">widget card</span>
                        </a>
                    </li>
                    <li class="nav-item">
        
        
                        <a class=""
                            href="<?php echo base_url()."assets/"; ?>widgets-statistics.html">
                            <i class="nav-icon i-Receipt-4"></i>
                            <span class="item-name">widget statistics</span>
                        </a>
                    </li>
        
                    <li class="nav-item">
        
        
                        <a class="" href="<?php echo base_url()."assets/"; ?>widget-list.html">
                            <i class="nav-icon i-Receipt-4"></i>
                            <span class="item-name">Widget List <span class="ml-2 badge badge-pill badge-danger">
                                    New</span></span>
                        </a>
                    </li>
        
                    <li class="nav-item">
        
        
                        <a class="" href="<?php echo base_url()."assets/"; ?>widget-app.html">
                            <i class="nav-icon i-Receipt-4"></i>
                            <span class="item-name">Widget App <span class="ml-2 badge badge-pill badge-danger"> New</span>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
        
        
                        <a class=""
                            href="<?php echo base_url()."assets/"; ?>weather-card.html">
                            <i class="nav-icon i-Receipt-4"></i>
                            <span class="item-name"> Weather App <span class="ml-2 badge badge-pill badge-danger"> New</span>
                            </span>
                        </a>
                    </li>
        
                </ul>


                <!-- chartjs -->
                <ul class="childNav" data-parent="charts">
                    <li class="nav-item">
                        <a class="" href="<?php echo base_url()."assets/"; ?>charts.echarts.html">
                            <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                            <span class="item-name">echarts</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="" href="<?php echo base_url()."assets/"; ?>charts.chartsjs.html">
                            <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                            <span class="item-name">ChartJs</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown-sidemenu">
                        <a class="" href="<?php echo base_url()."assets/"; ?>">
                            <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                            <span class="item-name">Apex Charts</span>
                            <i class="dd-arrow i-Arrow-Down"></i>
                        </a>
                        <ul class="submenu">
                            <li><a class=""
                                    href="<?php echo base_url()."assets/"; ?>charts.apexAreaCharts.html">Area Charts</a></li>
                            <li><a class=""
                                    href="<?php echo base_url()."assets/"; ?>charts.apexBarCharts.html">Bar Charts</a></li>
                            <li><a class=""
                                    href="<?php echo base_url()."assets/"; ?>charts.apexBubbleCharts.html">Bubble Charts</a></li>
                            <li><a class=""
                                    href="<?php echo base_url()."assets/"; ?>charts.apexColumnCharts.html">Column Charts</a></li>
                            <li><a class=""
                                    href="<?php echo base_url()."assets/"; ?>charts.apexCandleStickCharts.html">CandleStick Charts</a></li>
                            <li><a class=""
                                    href="<?php echo base_url()."assets/"; ?>charts.apexLineCharts.html">Line Charts</a></li>
                            <li><a class=""
                                    href="<?php echo base_url()."assets/"; ?>charts.apexMixCharts.html">Mix Charts</a></li>
                            <li><a class=""
                                    href="<?php echo base_url()."assets/"; ?>charts.apexPieDonutCharts.html">PieDonut Charts</a></li>
                            <li><a class=""
                                    href="<?php echo base_url()."assets/"; ?>charts.apexRadarCharts.html">Radar Charts</a></li>
                            <li><a class=""
                                    href="<?php echo base_url()."assets/"; ?>charts.apexRadialBarCharts.html">RadialBar Charts</a></li>
                            <li><a class=""
                                    href="<?php echo base_url()."assets/"; ?>charts.apexScatterCharts.html">Scatter Charts</a></li>
                            <li><a class=""
                                    href="<?php echo base_url()."assets/"; ?>charts.apexSparklineCharts.html">Sparkline Charts</a></li>
        
                        </ul>
                    </li>
        
        
        
        
        
                </ul>


                <ul class="childNav" data-parent="extrakits">
                    <li class="nav-item">
                        <a href="<?php echo base_url()."assets/"; ?>image.cropper.html">
                            <i class="nav-icon i-Crop-2"></i>
                            <span class="item-name">Image Cropper</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url()."assets/"; ?>loaders.html">
                            <i class="nav-icon i-Loading-3"></i>
                            <span class="item-name">Loaders</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url()."assets/"; ?>ladda.button.html">
                            <i class="nav-icon i-Loading-2"></i>
                            <span class="item-name">Ladda Buttons</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url()."assets/"; ?>toastr.html">
                            <i class="nav-icon i-Bell"></i>
                            <span class="item-name">Toastr</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url()."assets/"; ?>sweet.alerts.html">
                            <i class="nav-icon i-Approved-Window"></i>
                            <span class="item-name">Sweet Alerts</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url()."assets/"; ?>tour.html">
                            <i class="nav-icon i-Plane"></i>
                            <span class="item-name">User Tour</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url()."assets/"; ?>upload.html">
                            <i class="nav-icon i-Data-Upload"></i>
                            <span class="item-name">Upload</span>
                        </a>
                    </li>
                </ul>
                <ul class="childNav" data-parent="uikits">
                    <li class="nav-item">
                        <a href="<?php echo base_url()."assets/"; ?>alerts.html">
                            <i class="nav-icon i-Bell1"></i>
                            <span class="item-name">Alerts</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown-sidemenu">
                        <a href="<?php echo base_url()."assets/"; ?>accordion.html">
                            <i class="nav-icon i-Split-Horizontal-2-Window"></i>
                            <span class="item-name">Accordion</span>
                            <i class="dd-arrow i-Arrow-Down"></i>
                        </a>
                        <ul class="submenu">
                            <li><a href="<?php echo base_url()."assets/"; ?>">Sub menu item 1</a></li>
                            <li><a href="<?php echo base_url()."assets/"; ?>">Sub menu item 1</a></li>
                            <li><a href="<?php echo base_url()."assets/"; ?>">Sub menu item 1</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown-sidemenu">
                        <a href="<?php echo base_url()."assets/"; ?>badges.html">
                            <i class="nav-icon i-Medal-2"></i>
                            <span class="item-name">Badges</span>
                            <i class="dd-arrow i-Arrow-Down"></i>
                        </a>
                        <ul class="submenu">
                            <li><a href="<?php echo base_url()."assets/"; ?>">Sub menu item 1</a></li>
                            <li><a href="<?php echo base_url()."assets/"; ?>">Sub menu item 1</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url()."assets/"; ?>buttons.html">
                            <i class="nav-icon i-Cursor-Click"></i>
                            <span class="item-name">Buttons</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url()."assets/"; ?>cards.html">
                            <i class="nav-icon i-Line-Chart-2"></i>
                            <span class="item-name">Cards</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url()."assets/"; ?>card.metrics.html">
                            <i class="nav-icon i-ID-Card"></i>
                            <span class="item-name">Card Metrics</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url()."assets/"; ?>carousel.html">
                            <i class="nav-icon i-Video-Photographer"></i>
                            <span class="item-name">Carousels</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url()."assets/"; ?>lists.html">
                            <i class="nav-icon i-Belt-3"></i>
                            <span class="item-name">Lists</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url()."assets/"; ?>pagination.html">
                            <i class="nav-icon i-Arrow-Next"></i>
                            <span class="item-name">Paginations</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url()."assets/"; ?>popover.html">
                            <i class="nav-icon i-Speach-Bubble-2"></i>
                            <span class="item-name">Popover</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url()."assets/"; ?>progressbar.html">
                            <i class="nav-icon i-Loading"></i>
                            <span class="item-name">Progressbar</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url()."assets/"; ?>tables.html">
                            <i class="nav-icon i-File-Horizontal-Text"></i>
                            <span class="item-name">Tables</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url()."assets/"; ?>tabs.html">
                            <i class="nav-icon i-New-Tab"></i>
                            <span class="item-name">Tabs</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url()."assets/"; ?>tooltip.html">
                            <i class="nav-icon i-Speach-Bubble-8"></i>
                            <span class="item-name">Tooltip</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="<?php echo base_url()."assets/"; ?>modals.html">
                            <i class="nav-icon i-Duplicate-Window"></i>
                            <span class="item-name">Modals</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url()."assets/"; ?>nouislider.html">
                            <i class="nav-icon i-Width-Window"></i>
                            <span class="item-name">Sliders</span>
                        </a>
                    </li>
                </ul>
                <ul class="childNav" data-parent="sessions">
                    <li class="nav-item">
                        <a href="<?php echo base_url()."assets/"; ?>signin.html">
                            <i class="nav-icon i-Checked-User"></i>
                            <span class="item-name">Sign in</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url()."assets/"; ?>signup.html">
                            <i class="nav-icon i-Add-User"></i>
                            <span class="item-name">Sign up</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url()."assets/"; ?>forgot.html">
                            <i class="nav-icon i-Find-User"></i>
                            <span class="item-name">Forgot</span>
                        </a>
                    </li>
                </ul>
                <ul class="childNav" data-parent="others">
                    <li class="nav-item">
                        <a href="<?php echo base_url()."assets/"; ?>not.found.html">
                            <i class="nav-icon i-Error-404-Window"></i>
                            <span class="item-name">Not Found</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url()."assets/"; ?>user.profile.html">
                            <i class="nav-icon i-Male"></i>
                            <span class="item-name">User Profile</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url()."assets/"; ?>blank.html" class="open">
                            <i class="nav-icon i-File-Horizontal"></i>
                            <span class="item-name">Blank Page</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="sidebar-overlay"></div>
        </div>
        <!--=============== Left side End ================-->

        <!-- ============ Body content start ============= -->
        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <div class="breadcrumb">
                <h1 class="mr-2">Version 1</h1>
                <ul>
                    <li><a href="<?php echo base_url()."assets/"; ?>">Dashboard</a></li>
                    <li>Version 1</li>
                </ul>
            </div>

            <div class="separator-breadcrumb border-top"></div>

            <div class="row">
                <!-- ICON BG -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <i class="i-Add-User"></i>
                            <div class="content">
                                <p class="text-muted mt-2 mb-0">New Leads</p>
                                <p class="text-primary text-24 line-height-1 mb-2">205</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <i class="i-Financial"></i>
                            <div class="content">
                                <p class="text-muted mt-2 mb-0">Sales</p>
                                <p class="text-primary text-24 line-height-1 mb-2">$4021</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <i class="i-Checkout-Basket"></i>
                            <div class="content">
                                <p class="text-muted mt-2 mb-0">Orders</p>
                                <p class="text-primary text-24 line-height-1 mb-2">80</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <i class="i-Money-2"></i>
                            <div class="content">
                                <p class="text-muted mt-2 mb-0">Expense</p>
                                <p class="text-primary text-24 line-height-1 mb-2">$1200</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="card-title">This Year Sales</div>
                            <div id="echartBar" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="card-title">Sales by Countries</div>
                            <div id="echartPie" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-12">

                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="card card-chart-bottom o-hidden mb-4">
                                <div class="card-body">
                                    <div class="text-muted">Last Month Sales</div>
                                    <p class="mb-4 text-primary text-24">$40250</p>
                                </div>
                                <div id="echart1" style="height: 260px;"></div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12">
                            <div class="card card-chart-bottom o-hidden mb-4">
                                <div class="card-body">
                                    <div class="text-muted">Last Week Sales</div>
                                    <p class="mb-4 text-warning text-24">$10250</p>
                                </div>
                                <div id="echart2" style="height: 260px;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card o-hidden mb-4">
                                <div class="card-header d-flex align-items-center border-0">
                                    <h3 class="w-50 float-left card-title m-0">New Users</h3>
                                    <div class="dropdown dropleft text-right w-50 float-right">
                                        <button class="btn bg-gray-100" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="nav-icon i-Gear-2"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <a class="dropdown-item" href="<?php echo base_url()."assets/"; ?>#">Add new user</a>
                                            <a class="dropdown-item" href="<?php echo base_url()."assets/"; ?>#">View All users</a>
                                            <a class="dropdown-item" href="<?php echo base_url()."assets/"; ?>#">Something else here</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="">
                                    <div class="table-responsive">
                                        <table id="user_table" class="table  text-center">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Avatar</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">1</th>
                                                    <td>Smith Doe</td>
                                                    <td>

                                                        <img class="rounded-circle m-0 avatar-sm-table " src="<?php echo base_url()."assets/"; ?>assets/images/faces/1.jpg" alt="">

                                                    </td>

                                                    <td>Smith@gmail.com</td>
                                                    <td><span class="badge badge-success">Active</span></td>
                                                    <td>
                                                        <a href="<?php echo base_url()."assets/"; ?>#" class="text-success mr-2">
                                                            <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                        </a>
                                                        <a href="<?php echo base_url()."assets/"; ?>#" class="text-danger mr-2">
                                                            <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">2</th>
                                                    <td>Jhon Doe</td>
                                                    <td>

                                                        <img class="rounded-circle m-0 avatar-sm-table " src="<?php echo base_url()."assets/"; ?>assets/images/faces/1.jpg" alt="">

                                                    </td>

                                                    <td>Jhon@gmail.com</td>
                                                    <td><span class="badge badge-info">Pending</span></td>
                                                    <td>
                                                        <a href="<?php echo base_url()."assets/"; ?>#" class="text-success mr-2">
                                                            <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                        </a>
                                                        <a href="<?php echo base_url()."assets/"; ?>#" class="text-danger mr-2">
                                                            <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">3</th>
                                                    <td>Alex</td>
                                                    <td>

                                                        <img class="rounded-circle m-0 avatar-sm-table " src="<?php echo base_url()."assets/"; ?>assets/images/faces/1.jpg" alt="">

                                                    </td>

                                                    <td>Otto@gmail.com</td>
                                                    <td><span class="badge badge-warning">Not Active</span></td>
                                                    <td>
                                                        <a href="<?php echo base_url()."assets/"; ?>#" class="text-success mr-2">
                                                            <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                        </a>
                                                        <a href="<?php echo base_url()."assets/"; ?>#" class="text-danger mr-2">
                                                            <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                                        </a>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th scope="row">4</th>
                                                    <td>Mathew Doe</td>
                                                    <td>

                                                        <img class="rounded-circle m-0 avatar-sm-table " src="<?php echo base_url()."assets/"; ?>/assets/images/faces/1.jpg" alt="">

                                                    </td>

                                                    <td>Mathew@gmail.com</td>
                                                    <td><span class="badge badge-success">Active</span></td>
                                                    <td>
                                                        <a href="<?php echo base_url()."assets/"; ?>#" class="text-success mr-2">
                                                            <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                        </a>
                                                        <a href="<?php echo base_url()."assets/"; ?>#" class="text-danger mr-2">
                                                            <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>


                <div class="col-lg-6 col-md-12">

                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="card-title">Top Selling Products</div>
                            <div class="d-flex flex-column flex-sm-row align-items-sm-center mb-3">
                                <img class="avatar-lg mb-3 mb-sm-0 rounded mr-sm-3" src="<?php echo base_url()."assets/"; ?>/assets/images/products/headphone-4.jpg" alt="">
                                <div class="flex-grow-1">
                                    <h5 class=""><a href="<?php echo base_url()."assets/"; ?>">Wireless Headphone E23</a></h5>
                                    <p class="m-0 text-small text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                    <p class="text-small text-danger m-0">$450 <del class="text-muted">$500</del></p>
                                </div>
                                <div>
                                    <button class="btn btn-outline-primary mt-3 mb-3 m-sm-0 btn-rounded btn-sm">View details</button>
                                </div>
                            </div>
                            <div class="d-flex flex-column flex-sm-row align-items-sm-center mb-3">
                                <img class="avatar-lg mb-3 mb-sm-0 rounded mr-sm-3" src="<?php echo base_url()."assets/"; ?>/assets/images/products/headphone-2.jpg" alt="">
                                <div class="flex-grow-1">
                                    <h5 class=""><a href="<?php echo base_url()."assets/"; ?>">Wireless Headphone Y902</a></h5>
                                    <p class="m-0 text-small text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                    <p class="text-small text-danger m-0">$550 <del class="text-muted">$600</del></p>
                                </div>
                                <div>
                                    <button class="btn btn-outline-primary mt-3 mb-3 m-sm-0 btn-sm btn-rounded">View details</button>
                                </div>
                            </div>
                            <div class="d-flex flex-column flex-sm-row align-items-sm-center mb-3">
                                <img class="avatar-lg mb-3 mb-sm-0 rounded mr-sm-3" src="<?php echo base_url()."assets/"; ?>/assets/images/products/headphone-3.jpg" alt="">
                                <div class="flex-grow-1">
                                    <h5 class=""><a href="<?php echo base_url()."assets/"; ?>">Wireless Headphone E09</a></h5>
                                    <p class="m-0 text-small text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                    <p class="text-small text-danger m-0">$250 <del class="text-muted">$300</del></p>
                                </div>
                                <div>
                                    <button class="btn btn-outline-primary mt-3 mb-3 m-sm-0 btn-sm btn-rounded">View details</button>
                                </div>
                            </div>
                            <div class="d-flex flex-column flex-sm-row align-items-sm-center mb-3">
                                <img class="avatar-lg mb-3 mb-sm-0 rounded mr-sm-3" src="<?php echo base_url()."assets/"; ?>/assets/images/products/headphone-4.jpg" alt="">
                                <div class="flex-grow-1">
                                    <h5 class=""><a href="<?php echo base_url()."assets/"; ?>">Wireless Headphone X89</a></h5>
                                    <p class="m-0 text-small text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                    <p class="text-small text-danger m-0">$450 <del class="text-muted">$500</del></p>
                                </div>
                                <div>
                                    <button class="btn btn-outline-primary mt-3 mb-3 m-sm-0 btn-sm btn-rounded">View details</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body p-0">
                            <div class="card-title border-bottom d-flex align-items-center m-0 p-3">
                                <span>User activity</span>
                                <span class="flex-grow-1"></span>
                                <span class="badge badge-pill badge-warning">Updated daily</span>
                            </div>
                            <div class="d-flex border-bottom justify-content-between p-3">
                                <div class="flex-grow-1">
                                    <span class="text-small text-muted">Pages / Visit</span>
                                    <h5 class="m-0">2065</h5>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="text-small text-muted">New user</span>
                                    <h5 class="m-0">465</h5>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="text-small text-muted">Last week</span>
                                    <h5 class="m-0">23456</h5>
                                </div>
                            </div>
                            <div class="d-flex border-bottom justify-content-between p-3">
                                <div class="flex-grow-1">
                                    <span class="text-small text-muted">Pages / Visit</span>
                                    <h5 class="m-0">1829</h5>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="text-small text-muted">New user</span>
                                    <h5 class="m-0">735</h5>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="text-small text-muted">Last week</span>
                                    <h5 class="m-0">92565</h5>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between p-3">
                                <div class="flex-grow-1">
                                    <span class="text-small text-muted">Pages / Visit</span>
                                    <h5 class="m-0">3165</h5>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="text-small text-muted">New user</span>
                                    <h5 class="m-0">165</h5>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="text-small text-muted">Last week</span>
                                    <h5 class="m-0">32165</h5>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body p-0">
                            <h5 class="card-title m-0 p-3">Last 20 Day Leads</h5>
                            <div id="echart3" style="height: 360px;"></div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Footer Start -->
            <div class="flex-grow-1"></div>
            <div class="app-footer">
                <div class="row">
                    <div class="col-md-9">
                        <p><strong>Gull - Laravel + Bootstrap 4 admin template</strong></p>
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Libero quis beatae officia saepe perferendis voluptatum minima eveniet voluptates dolorum, temporibus nisi maxime nesciunt totam repudiandae commodi sequi dolor quibusdam
                            sunt.
                        </p>
                    </div>
                </div>
                <div class="footer-bottom border-top pt-3 d-flex flex-column flex-sm-row align-items-center">
                    <a class="btn btn-primary text-white btn-rounded" href="<?php echo base_url()."assets/"; ?>https://themeforest.net/user/mh_rafi" target="_blank">Buy
                        Gull HTML</a>
                    <span class="flex-grow-1"></span>
                    <div class="d-flex align-items-center">
                        <img class="logo" src="<?php echo base_url()."assets/"; ?>/assets/images/logo.png" alt="">
                        <div>
                            <p class="m-0">&copy; 2018 Gull HTML</p>
                            <p class="m-0">All rights reserved</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- fotter end -->
        </div>
        <!-- ============ Body content End ============= -->
    </div>
    <!--=============== End app-admin-wrap ================-->

    <!-- ============ Search UI Start ============= -->
    <div class="search-ui">
        <div class="search-header o-hidden">
            <img src="<?php echo base_url()."assets/"; ?>/assets/images/logo.png" alt="" class="logo float-left">
            <button class="search-close btn btn-icon bg-transparent float-right mt-2">
                <i class="i-Close-Window text-22 text-muted"></i>
            </button>
        </div>

        <input type="text" placeholder="Type here" class="search-input" autofocus>

        <div class="search-title">
            <span class="text-muted">Search results</span>
        </div>

        <div class="search-results list-horizontal">
            <div class="list-item col-md-12 p-0">
                <div class="card o-hidden flex-row mb-4 d-flex">
                    <div class="list-thumb d-flex">
                        <!-- TUMBNAIL -->
                        <img src="<?php echo base_url()."assets/"; ?>/assets/images/products/headphone-1.jpg" alt="">
                    </div>
                    <div class="flex-grow-1 pl-2 d-flex">
                        <div class="card-body align-self-center d-flex flex-column justify-content-between align-items-lg-center flex-lg-row">
                            <!-- OTHER DATA -->
                            <a href="<?php echo base_url()."assets/"; ?>" class="w-40 w-sm-100">
                                <div class="item-title">Headphone 1</div>
                            </a>
                            <p class="m-0 text-muted text-small w-15 w-sm-100">Gadget</p>
                            <p class="m-0 text-muted text-small w-15 w-sm-100">
                                $300
                                <del class="text-secondary">$400</del>
                            </p>
                            <p class="m-0 text-muted text-small w-15 w-sm-100 d-none d-lg-block item-badges">
                                <span class="badge badge-danger">Sale</span>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
            <div class="list-item col-md-12 p-0">
                <div class="card o-hidden flex-row mb-4 d-flex">
                    <div class="list-thumb d-flex">
                        <!-- TUMBNAIL -->
                        <img src="<?php echo base_url()."assets/"; ?>/assets/images/products/headphone-2.jpg" alt="">
                    </div>
                    <div class="flex-grow-1 pl-2 d-flex">
                        <div class="card-body align-self-center d-flex flex-column justify-content-between align-items-lg-center flex-lg-row">
                            <!-- OTHER DATA -->
                            <a href="<?php echo base_url()."assets/"; ?>" class="w-40 w-sm-100">
                                <div class="item-title">Headphone 1</div>
                            </a>
                            <p class="m-0 text-muted text-small w-15 w-sm-100">Gadget</p>
                            <p class="m-0 text-muted text-small w-15 w-sm-100">
                                $300
                                <del class="text-secondary">$400</del>
                            </p>
                            <p class="m-0 text-muted text-small w-15 w-sm-100 d-none d-lg-block item-badges">
                                <span class="badge badge-primary">New</span>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
            <div class="list-item col-md-12 p-0">
                <div class="card o-hidden flex-row mb-4 d-flex">
                    <div class="list-thumb d-flex">
                        <!-- TUMBNAIL -->
                        <img src="<?php echo base_url()."assets/"; ?>/assets/images/products/headphone-3.jpg" alt="">
                    </div>
                    <div class="flex-grow-1 pl-2 d-flex">
                        <div class="card-body align-self-center d-flex flex-column justify-content-between align-items-lg-center flex-lg-row">
                            <!-- OTHER DATA -->
                            <a href="<?php echo base_url()."assets/"; ?>" class="w-40 w-sm-100">
                                <div class="item-title">Headphone 1</div>
                            </a>
                            <p class="m-0 text-muted text-small w-15 w-sm-100">Gadget</p>
                            <p class="m-0 text-muted text-small w-15 w-sm-100">
                                $300
                                <del class="text-secondary">$400</del>
                            </p>
                            <p class="m-0 text-muted text-small w-15 w-sm-100 d-none d-lg-block item-badges">
                                <span class="badge badge-primary">New</span>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
            <div class="list-item col-md-12 p-0">
                <div class="card o-hidden flex-row mb-4 d-flex">
                    <div class="list-thumb d-flex">
                        <!-- TUMBNAIL -->
                        <img src="<?php echo base_url()."assets/"; ?>/assets/images/products/headphone-4.jpg" alt="">
                    </div>
                    <div class="flex-grow-1 pl-2 d-flex">
                        <div class="card-body align-self-center d-flex flex-column justify-content-between align-items-lg-center flex-lg-row">
                            <!-- OTHER DATA -->
                            <a href="<?php echo base_url()."assets/"; ?>" class="w-40 w-sm-100">
                                <div class="item-title">Headphone 1</div>
                            </a>
                            <p class="m-0 text-muted text-small w-15 w-sm-100">Gadget</p>
                            <p class="m-0 text-muted text-small w-15 w-sm-100">
                                $300
                                <del class="text-secondary">$400</del>
                            </p>
                            <p class="m-0 text-muted text-small w-15 w-sm-100 d-none d-lg-block item-badges">
                                <span class="badge badge-primary">New</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- PAGINATION CONTROL -->
        <div class="col-md-12 mt-5 text-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination d-inline-flex">
                    <li class="page-item">
                        <a class="page-link" href="<?php echo base_url()."assets/"; ?>#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="<?php echo base_url()."assets/"; ?>#">1</a></li>
                    <li class="page-item"><a class="page-link" href="<?php echo base_url()."assets/"; ?>#">2</a></li>
                    <li class="page-item"><a class="page-link" href="<?php echo base_url()."assets/"; ?>#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="<?php echo base_url()."assets/"; ?>#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- ============ Search UI End ============= -->

    <script src="<?php echo base_url()."assets/"; ?>assets/js/vendor/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url()."assets/"; ?>assets/js/vendor/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url()."assets/"; ?>assets/js/vendor/perfect-scrollbar.min.js"></script>
    <script src="<?php echo base_url()."assets/"; ?>assets/js/vendor/echarts.min.js"></script>

    <script src="<?php echo base_url()."assets/"; ?>assets/js/es5/echart.options.min.js"></script>
    <script src="<?php echo base_url()."assets/"; ?>assets/js/es5/dashboard.v1.script.min.js"></script>

    <script src="<?php echo base_url()."assets/"; ?>assets/js/es5/script.min.js"></script>
    <script src="<?php echo base_url()."assets/"; ?>assets/js/es5/sidebar.large.script.min.js"></script>
</body>

</html>