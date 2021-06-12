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
                <a href="<?= ROOT ?>profile/<?= $data['user_data']->user_url_address ?>"><img
                            src="<?= ASSETS . THEME ?>admin/img/ui-sam.jpg" class="img-circle"
                            width="60"></a>
            </p>
            <h5 class="centered"><?= ucwords($data['user_data']->user_full_name) ?></h5>
            <h5 class="centered"><?= $data['user_data']->user_email ?></h5>


            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-dashboard"></i>
                    <span>Dasboard</span>
                </a>

            </li>

            <li class="sub-menu">
                <a <?= (isset($current_page) && $current_page == "products") ? 'class = "active"' : ''; ?> href="<?= ROOT ?>admin/products">
                    <i class="fa fa-barcode fa-fw"></i>
                    <span>Sản Phẩm</span>
                </a>

            </li>

            <li class="sub-menu">
                <a <?= (isset($current_page) && $current_page == "categories") ? 'class = "active"' : ''; ?> href="<?= ROOT ?>admin/categories">
                    <i class="fa fa-list-alt"></i>
                    <span>Danh Mục</span>
                </a>
            </li>

            <li class="sub-menu">
                <a <?= (isset($current_page) && $current_page == "orders") ? 'class = "active"' : ''; ?> href="<?= ROOT ?>admin/orders">
                    <i class="fa fa-book"></i>
                    <span>Đơn Hàng</span>
                </a>

            </li>

            <li class="sub-menu">
                <a <?= (isset($current_page) && $current_page == "messages") ? 'class = "active"' : ''; ?> href="<?= ROOT ?>admin/messages">
                    <i class="fas fa-sms"></i>
                    <span>Thông Điệp</span>
                </a>

            </li>

            <li class="sub-menu">
                <a <?= (isset($current_page) && $current_page == "settings") ? 'class = "active"' : ''; ?>
                        href="<?= ROOT ?>admin/settings">
                    <i class="fa fa-cogs"></i>
                    <span>Cài Đặt</span>
                </a>
                <ul class="sub">
                    <li><a href="<?= ROOT ?>admin/settings/slider_image"><i class="fas fa-image"></i> Slider Ảnh </a>
                    </li>
                </ul>

                <ul class="sub">
                    <li><a href="<?= ROOT ?>admin/settings/socials"><i class="fas fa-share-alt-square"></i> MXH / Liên
                            Hệ </a></li>
                </ul>
            </li>

            <!-- Link to method users in controllers admin.php-->
            <li class="sub-menu">
                <a <?= (isset($current_page) && $current_page == "users") ? 'class = "active"' : ''; ?> href="<?= ROOT ?>admin/users">
                    <i class="fas fa-user-cog"></i>
                    <span>Users</span>
                </a>
                <ul class="sub">
                    <li><a href="<?= ROOT ?>admin/users/customers"><i class="fas fa-users"></i> Khách Hàng </a></li>
                    <li><a href="<?= ROOT ?>admin/users/admins"><i class="fas fa-user-tie"></i> Admin </a></li>
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