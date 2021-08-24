<?php
$year = '';
$username = '';
$jobs = '';
$avatar = '';
if (isset($_SESSION['user'])) {
    $username = $_SESSION['user']['username'];
    $jobs = $_SESSION['user']['jobs'];
    $avatar = $_SESSION['user']['avatar'];
    $year = date('Y', strtotime($_SESSION['user']['created_at']));
}

?>
<header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>d</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Admin</b></span>
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
                        <img src="assets/uploads/<?php echo $avatar; ?>" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?php echo $username; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="assets/uploads/<?php echo $avatar; ?>" class="img-circle" alt="User Image">

                            <p>

                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="index.php?controller=user&action=logout" class="btn btn-default btn-flat">Sign
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
            <div class="pull-left image">
                <img src="assets/uploads/<?php echo $avatar; ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $username; ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Khoa Công nghệ thông tin</li>

            <li>
                <a href="index.php?controller=mon&action=index">
                    <i class="fa fa-book"></i> <span>Quản lý môn học</span>
                    <span class="pull-right-container">
              <!--<small class="label pull-right bg-green">new</small>-->
            </span>
                </a>
            </li>
            <li>
                <a href="index.php?controller=congvan&action=index">
                    <i class="fa fa-voicemail"></i> <span>Quản lý công văn</span>
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