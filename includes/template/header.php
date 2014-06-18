<?php
// initialise script
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/init.php');
// check for logged in user
$users->logged_out_protect();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo SITE_NAME; ?></title>

    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/"><?php echo SITE_NAME ?></a>
            </div>
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>
                            <a href="/users/edit.php?id=<?php echo $_SESSION['id']; ?>"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="/logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="side-menu">
                        <!-- Admin Menu -->
                        <?php if ($_SESSION['access_level'] == '1') { ?>
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> User Management<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="/users/">View Users</a>
                                </li>
                                <li>
                                    <a href="/users/register.php">Add User</a>
                                </li>
                            </ul>
                        </li>
                        <?php } ?>
                        <!-- /admin menu -->
                        <!-- customer menu -->
                        <?php if ($_SESSION['access_level'] == '2') { ?>
                            <li>
                                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Profile Management<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="/users/edit.php?id=<?php echo $_SESSION['id']; ?>"><i class="fa fa-user fa-fw"></i> User Profile</a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>
                        <!-- /customer menu -->
                    </ul>
                </div>
            </div>
        </nav>
        <div id="page-wrapper">
