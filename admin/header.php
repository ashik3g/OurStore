<?php  
session_start();
if(!isset($_SESSION['admin'])){
    header('location:login.php');
}

$profile = getProfile($_SESSION['admin']['id']);
?>
<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    
    <!-- theme meta -->
    <meta name="theme-name" content="quixlab" />
  
    <title>Our Store - Admin Dashboard</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Pignose Calender -->
    <link href="../plugins/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="../plugins/chartist/css/chartist.min.css">
    <link rel="stylesheet" href="../plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css">
    <link href="../plugins/summernote/dist/summernote.css" rel="stylesheet">
    <link href="../plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/custom.css" rel="stylesheet">

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <!-- <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div> -->
    <!--*******************
        Preloader end
    ********************-->

    
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <div class="brand-logo">
                <a href="index.php">
                    <b class="logo-abbr"><img src="../images/logo.png" alt=""> </b>
                    <span class="logo-compact"><img src="../images/logo-compact.png" alt=""></span>
                    <span class="brand-title">
                        Our Store
                    </span>
                </a>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">    
            <div class="header-content clearfix">
                
                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
                
                <div class="header-right">
                    <ul class="clearfix">
                        
                        <li class="icons dropdown"><a href="javascript:void(0)" data-toggle="dropdown">
                                <i class="mdi mdi-bell-outline"></i>
                                <span class="badge badge-pill gradient-2">3</span>
                            </a>
                            <div class="drop-down animated fadeIn dropdown-menu dropdown-notfication">
                                <div class="dropdown-content-heading d-flex justify-content-between">
                                    <span class="">2 New Notifications</span>  
                                    <a href="javascript:void()" class="d-inline-block">
                                        <span class="badge badge-pill gradient-2">5</span>
                                    </a>
                                </div>
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-success-lighten-2"><i class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Events near you</h6>
                                                    <span class="notification-text">Within next 5 days</span> 
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-danger-lighten-2"><i class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Event Started</h6>
                                                    <span class="notification-text">One hour ago</span> 
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-success-lighten-2"><i class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Event Ended Successfully</h6>
                                                    <span class="notification-text">One hour ago</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-danger-lighten-2"><i class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Events to Join</h6>
                                                    <span class="notification-text">After two days</span> 
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                    
                                </div>
                            </div>
                        </li>
                  
                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative"   data-toggle="dropdown">
                                <span class="activity active"></span> 
                                <?php if($profile['photo'] != NULL) : ?>
                                    <img  src="../images/avatar/<?php echo $profile['photo']; ?>" width="40" height="40" alt="">
                                <?php else :  ?>
                                <img src="../images/avatar/11.png" width="40" height="40" alt="">
                                <?php  endif; ?>

                            </div>
                            <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="<?php APP_URL(); ?>/admin/profile.php"><i class="icon-user"></i> <span>Profile</span></a>
                                        </li> 
                                        <li>
                                            <a href="<?php APP_URL(); ?>/admin/change-password.php"><i class="icon-lock"></i> <span>Change Password</span></a>
                                        </li>
                                        <li><a href="<?php APP_URL(); ?>/admin/logout.php"><i class="icon-key"></i> <span>Logout</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">           
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label">Dashboard</li>
                    <li>
                        <a href="<?php APP_URL();?>/admin">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                        </a> 
                    </li>
                    <li class="nav-label">Users</li>
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-user menu-icon"></i><span class="nav-text">Users</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="<?php APP_URL();?>/admin/user-all.php">All Users</a></li>
                            <li><a href="<?php APP_URL();?>/admin/user-pending.php">Pending Users</a>
                            <li><a href="<?php APP_URL();?>/admin/user-blocked.php">Blocked Users</a>
                        </ul>
                    </li>
                    <li class="nav-label">Products</li>
                    <li>
                        <a href="<?php APP_URL();?>/admin/categories.php">
                            <i class="fa fa-shopping-cart menu-icon"></i><span class="nav-text">Categories</span>
                        </a> 
                    </li>
                    <li>
                        <a href="<?php APP_URL();?>/admin/products.php">
                            <i class="fa fa-shopping-cart menu-icon"></i><span class="nav-text">Products</span>
                        </a> 
                    </li>
   
                    <li class="nav-label">Reports</li>
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-globe-alt menu-icon"></i><span class="nav-text">Reports</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="<?php APP_URL();?>/admin/sales-reports.php">Sales Reports</a></li>
                            <li><a href="<?php APP_URL();?>/admin/purchase-reports.php">Purchase Reports</a>
                        </ul>
                    </li>

                    <li>
                        <a href="index.php" >
                            <i class="fa fa-cog menu-icon"></i><span class="nav-text">Settings</span>
                        </a> 
                    </li> 
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div class="container-fluid mt-3">
                
            <!-- Start Main Content Body  -->