<!--This file is sidebar of admin section-->


<!-- **********************************************************************************************************************************************************
   MAIN SIDEBAR MENU
   *********************************************************************************************************************************************************** -->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">

            <p class="centered">
                <a href="<?=ROOT?>profile"><img src="<?= ASSETS . THEME ?>admin/img/ui-sam.jpg" class="img-circle"
                                            width="60"></a>
            </p>
            <h5 class="centered"><?= $data['user_data']->user_full_name ?></h5>
            <h5 class="centered"><?= $data['user_data']->user_email ?></h5>


            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-dashboard"></i>
                    <span>Dasboard</span>
                </a>

            </li>

            <li class="sub-menu">
                <a href="<?= ROOT ?>admin/products">
                    <i class="fa fa-barcode fa-fw"></i>
                    <span>Sản Phẩm</span>
                </a>

            </li>

            <li class="sub-menu">
                <a href="<?= ROOT ?>admin/categories">
                    <i class="fa fa-list-alt"></i>
                    <span>Danh Mục</span>
                </a>
            </li>

            <li class="sub-menu">
                <a href="<?= ROOT ?>admin/orders">
                    <i class="fa fa-book"></i>
                    <span>Đơn Hàng</span>
                </a>

            </li>

            <li class="sub-menu">
                <a href="<?= ROOT ?>admin/settings">
                    <i class="fa fa-cogs"></i>
                    <span>Cài Đặt</span>
                </a>
                <ul class="sub">
                    <li><a href="<?= ROOT ?>admin/settings"><i class="fa fa-plus"></i> Slider Ảnh </a></li>
                </ul>
            </li>

            <li class="sub-menu">
                <a href="<?= ROOT ?>admin/users">
                    <i class="fa fa-users"></i>
                    <span>Users</span>
                </a>
                <ul class="sub">
                    <li><a href="<?= ROOT ?>admin/users/customers">Khách Hàng </a></li>
                    <li><a href="<?= ROOT ?>admin/users/admins">Admin </a></li>
                </ul>
            </li>

            <li class="sub-menu">
                <a href="<?= ROOT ?>admin/backup">
                    <i class="fa fa-cloud-download"></i>
                    <span>Backup Website </span>
                </a>

            </li>

        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->

<!-- **********************************************************************************************************************************************************
MAIN CONTENT
*********************************************************************************************************************************************************** -->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> <?= $data['page_title'] ?></h3>
        <div class="row mt">
            <div class="col-lg-12">