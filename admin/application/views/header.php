<?php
$user_role=$this->session->userdata('logged_role');
$user_email=$this->session->userdata('logged_email');
$logged_as=$this->session->userdata('logged_role');
?>
<!doctype html>
<html lang="en-US">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>KSS</title>
    <meta name="description" content="" />
    <meta name="Author" content="Dsv" />
    <!-- mobile settings -->
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
    <!-- WEB FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800&amp;subset=latin,latin-ext,cyrillic,cyrillic-ext" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/css/essentials.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/css/layout.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/css/color_scheme/green.css" rel="stylesheet" type="text/css" id="color_scheme" />
    <link href="<?php echo base_url(); ?>assets/css/layout-datatables.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/css/tags-input.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/css/color-pick.min.css" rel="stylesheet" type="text/css" />
    <style>
        .panel-body{
            overflow: auto;
        }
    </style>
</head>
<body>
<!-- WRAPPER -->
<div id="wrapper" class="clearfix">
    <aside id="aside">
        <nav id="sideNav"><!-- MAIN MENU -->
            <br>
            <ul class="nav nav-list">
                <li class="el_primary" id="el_3">
                    <a href="<?php echo base_url(); ?>">
                        <i class="main-icon fa fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="el_primary" id="el_3">
                    <a href="<?php echo base_url(); ?>site/users">
                        <i class="main-icon fa fa-group"></i>
                        <span>Users</span>
                    </a>
                </li>
            </ul>
                <h3><i class="main-icon fa fa-sitemap"></i> Kss Front</h3>

            <ul class="nav nav-list">
                <li class="el_primary " >
                    <a href="#">
                        <i class="fa fa-menu-arrow pull-right"></i>
                        <i class="main-icon fa fa fa-link"></i> <span>Classes</span>
                    </a>
                    <ul><!-- submenus -->
                        <li><a href="<?php echo base_url(); ?>site/classes">Maintain Classes</a></li>
                    </ul>
                </li>
                <li class="el_primary " >
                    <a href="#">
                        <i class="fa fa-menu-arrow pull-right"></i>
                        <i class="main-icon fa fa fa-link"></i> <span>Maintain Parties</span>
                    </a>
                    <ul ><!-- submenus -->
                        <li><a href="<?php echo base_url(); ?>site/parties_package">Parties Packages</a></li>
                    </ul>
                </li>
                <li class="el_primary " >
                    <a href="#">
                        <i class="fa fa-menu-arrow pull-right"></i>
                        <i class="main-icon fa fa fa-link"></i> <span>Maintain Camps</span>
                    </a>
                    <ul ><!-- submenus -->
                        <li><a href="<?php echo base_url(); ?>site/camps_package">Camps Packages</a></li>

                    </ul>
                </li>

                <li class="el_primary " >
                    <a href="#">
                        <i class="fa fa-menu-arrow pull-right"></i>
                        <i class="main-icon fa fa fa-link"></i> <span>Maintain Tutoring</span>
                    </a>
                    <ul><!-- submenus -->
                        <li><a href="<?php echo base_url(); ?>site/tutoring_package">Tutoring Packages</a></li>
                    </ul>
                </li>

                <li class="el_primary">
                    <a href="#">
                        <i class="fa fa-menu-arrow pull-right"></i>
                        <i class="main-icon fa fa fa-link"></i> <span>Other</span>
                    </a>
                    <ul><!-- submenus -->
                        <li><a href="<?php echo base_url(); ?>site/slider">Top Slider</a></li>
                        <li><a href="<?php echo base_url(); ?>site/category">Categories</a></li>
                        <li><a href="<?php echo base_url(); ?>site/advertisement">Advertisement</a></li>
                        <li><a href="<?php echo base_url(); ?>site/experience">Experiences</a></li>

                        <li><a href="<?php echo base_url(); ?>site/terms_conditions">Terms and Conditions</a></li>
                    </ul>
                </li>
            </ul>


            <h3> <i class="main-icon fa fa-building"></i> Kss Store</h3>
            <ul class="nav nav-list">
                <li class="el_primary " >
                    <a href="#">
                        <i class="fa fa-menu-arrow pull-right"></i>
                        <i class="main-icon fa fa fa-link"></i> <span>Products</span>
                    </a>
                    <ul><!-- submenus -->
                        <li><a href="<?php echo base_url(); ?>store/category">Categories</a></li>
                        <li><a href="<?php echo base_url(); ?>store/products">Manage Products</a></li>
                    </ul>
                </li>
            </ul>

            <ul class="nav nav-list">
                <li class="el_primary " >
                    <a href="#">
                        <i class="fa fa-menu-arrow pull-right"></i>
                        <i class="main-icon fa fa fa-link"></i> <span>Reports</span>
                    </a>
                    <ul><!-- submenus -->
                        <li><a href="<?php echo base_url(); ?>site/all_transactions">All Transactions</a></li>
                        <li><a href="<?php echo base_url(); ?>store/store_orders">Product Orders</a></li>
                        <li><a href="<?php echo base_url(); ?>site/classes_orders">Enrolled Classes</a></li>
                        <li><a href="<?php echo base_url(); ?>site/parties_orders">Enrolled Parties</a></li>
                        <li><a href="<?php echo base_url(); ?>site/camps_orders">Enrolled Camps</a></li>
                        <li><a href="<?php echo base_url(); ?>site/tutoring_orders">Enrolled Tutoring</a></li>

                    </ul>
                </li>
            </ul>

        </nav>

        <span id="asidebg"><!-- aside fixed background --></span>
    </aside>
    <!-- /ASIDE -->
    <!-- HEADER -->
    <header id="header">
        <!-- Mobile Button -->
        <button id="mobileMenuBtn"></button>
        <!-- Logo -->
        <span class="logo pull-left">
					<h3 style="color:white;margin-top: 6px;">KSS Admin</h3>
				</span>
        <!--<form method="get" action="page-search.html" class="search pull-left hidden-xs">

            <input type="text" class="form-control" name="k" placeholder="Search for something..." />

        </form>-->
        <div class="pull-left">
            <br>
            Welcome <?php echo $user_email;?> | Logged As : <?php echo $logged_as;?>
        </div>
        <div class="pull-right" style="margin-right: 20px;color: white;">
            <nav>
                <!-- OPTIONS LIST -->
                <ul class="nav pull-right">

                    <!-- USER OPTIONS -->
                    <li class="dropdown pull-left">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" aria-expanded="true">
                            <img class="user-avatar" alt="" src="<?php echo base_url();?>assets/images/noavatar.jpg" height="34">
                            <span class="user-name">
									<span class="hidden-xs">
										Admin <i class="fa fa-angle-down"></i>
									</span>
								</span>
                        </a>
                        <ul class="dropdown-menu hold-on-click">
                            <li>
                                <a href="<?php echo base_url(); ?>dashboard/change_password"><i class="fa fa-edit"></i> Change Password</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>login/logout"><i class="fa fa-power-off"></i> Log Out</a>
                            </li>

                        </ul>
                    </li>
                    <!-- /USER OPTIONS -->

                </ul>
                <!-- /OPTIONS LIST -->

            </nav>
            <br>
        </div>
    </header>

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/jquery/jquery-2.1.4.min.js"></script>
    <script type="text/javascript">var plugin_path = '<?php echo base_url(); ?>assets/plugins/';</script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/app.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/tags-input.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/color-pick.js"></script>
    <!-- /HEADER -->
