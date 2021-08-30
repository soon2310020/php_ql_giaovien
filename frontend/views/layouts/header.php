<?php
$year = '';
$username = '';
$jobs = '';
$avatar = '';
if (isset($_SESSION['user'])) {
    $username = $_SESSION['user']['username'];
     $number=$_SESSION['user']['vaiTro'];
     switch ($number)
     {
         case 1:
             $vaiTro="ADMIN";
             break;
         case 2:
             $vaiTro="USER";
             break;
         case 3:
             $vaiTro="TRƯỞNG BỘ MÔN";
             break;
     }
}

?>
<header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>u</b>ser</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>User</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <i class="fa fa-bars"></i>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs"><?php echo $username; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">

                            <p>
                               <?php echo $vaiTro ?>
                            </p>
                        </li>
                        <li class="user-footer">

                            <div class="pull-right">
                                <a href="index.php?controller=login&action=logout" class="btn btn-default btn-flat">Sign
                                    out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">

        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Khoa Công nghệ thông tin</li>


            <li>
                <a href="index.php?controller=congvan&action=index">
                    <i class="fa fa-voicemail"></i> <span>Công văn</span>
                    <span class="pull-right-container">
              <!--<small class="label pull-right bg-green">new</small>-->
            </span>
                </a>
            </li>
            <li>
                <a href="index.php?controller=lichgiangday&action=index">
                    <i class="fa fa-calendar"></i> <span>Lịch giảng dạy</span>
                    <span class="pull-right-container">
              <!--<small class="label pull-right bg-green">new</small>-->
            </span>
                </a>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>



<!-- Messaeg Wrapper. Contains messaege error and success -->
<div class="message-wrap content-wrap content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?php
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($this->error)): ?>
            <div class="alert alert-danger">
                <?php
                echo $this->error;
                ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
            </div>
        <?php endif; ?>
        <!--        <div class="alert alert-danger">Lỗi validate</div>-->
        <!--        <p class="alert alert-success">Thành công</p>-->
    </section>
</div>