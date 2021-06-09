<!-- file header html of website -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Ecommer Website using MVC PHP">
    <meta name="author" content="Nguyễn Mạnh Tâm">

    <!--Tittle of Website-->
    <title> <?= $page_title ?> | E-Shopper</title>
    <link href="<?= ASSETS . THEME ?>css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= ASSETS . THEME ?>css/prettyPhoto.css" rel="stylesheet">
    <link href="<?= ASSETS . THEME ?>css/price-range.css" rel="stylesheet">
    <link href="<?= ASSETS . THEME ?>css/animate.css" rel="stylesheet">
    <link href="<?= ASSETS . THEME ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= ASSETS . THEME ?>css/main.css" rel="stylesheet">
    <link href="<?= ASSETS . THEME ?>css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="<?= ASSETS . THEME ?>js/html5shiv.js"></script>
    <script src="<?= ASSETS . THEME ?>js/respond.min.js"></script>
    <![endif] -->


    <link rel="shortcut icon" href="<?= ASSETS . THEME ?>images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
          href="<?= ASSETS . THEME ?>images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
          href="<?= ASSETS . THEME ?>images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
          href="<?= ASSETS . THEME ?>images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?= ASSETS . THEME ?>images/ico/apple-touch-icon-57-precomposed.png">
</head>
<!--/head-->

<body>
<header id="header">
    <!--header-->
    <div class="header_top">
        <!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="contactinfo pull-left">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> <?=Setting::so_dien_thoai()?></a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> <?=Setting::dia_chi_email()?></a></li>
                            <li><a  target="_new" href="https://github.com/tamnm99"><i class="fa fa-github"></i>
                                    https://github.com/tamnm99</a></li>

                            <!--show user data if user log in success-->
                            <?php if (isset($data['user_data'])): ?>
                                <li><a href="#"><i class="fa fa fa-user"></i>
                                        Xin chào <?= ucwords($data['user_data']->user_full_name) ?> !
                                    </a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a target="_new" href="<?=Setting::duong_dan_facebook()?>"><i
                                            class="fa fa-facebook"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/header_top-->

    <div class="header-middle">
        <!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="<?= ROOT ?>"><img src="<?= ASSETS . THEME ?>images/home/logo.png" alt=""/></a>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">

                            <!--user login is Admin, show link to profile.php of admin-->
                            <?php if (isset($data['user_data'])): ?>
                                <li><a href="<?= ROOT ?>profile/<?= $data['user_data']->user_url_address ?>"><i
                                                class="fa fa-user"></i>Tài Khoản</a></li>
                            <?php endif; ?>
                            <li><a href="<?= ROOT ?>"><i class="fa fa-star"></i> Yêu Thích</a></li>
                            <li><a href="<?= ROOT ?>checkout"><i class="fa fa-crosshairs"></i> Thanh Toán</a></li>
                            <li><a href="<?= ROOT ?>cart"><i class="fa fa-shopping-cart"></i> Giỏ Hàng</a></li>

                            <!--user login, link Login change to link Logout-->
                            <?php if (isset($data['user_data'])): ?>
                                <li><a href="<?= ROOT ?>logout"><i class="fa fa-lock"></i> Đăng Xuất</a></li>
                            <?php else: ?>
                                <li><a href="<?= ROOT ?>login"><i class="fa fa-lock"></i> Đăng Nhập</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/header-middle-->

    <div class="header-bottom">
        <!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">

                            <li><a href="<?= ROOT ?>" class="<?= $page_title == "Trang Chủ" ? "active" : ""; ?>">Trang
                                    Chủ</a></li>
                            <li><a href="<?= ROOT ?>shop" class="<?= $page_title == "Cửa Hàng" ? "active" : ""; ?>">Cửa
                                    Hàng</a></li>
                            <li><a href="<?= ROOT ?>blog" class="<?= $page_title == "Blog" ? "active" : ""; ?>">Blog</a>
                            </li>
                            <li><a href="<?= ROOT ?>contact-us"
                                   class="<?= $page_title == "Liên Hệ" ? "active" : ""; ?>">Liên Hệ</a></li>
                        </ul>
                    </div>
                </div>

              <!--  Page home and shop will show search bar-->
                <?php if(isset($show_search)):?>
                <div class="col-sm-3">
                    <form method="GET">
                        <div class="search_box pull-right">
                            <input name ="find" type="text" placeholder="Tìm Kiếm"/>
                        </div>
                    </form>
                </div>
                <?php endif;?>
            </div>
        </div>
    </div>
    <!--/header-bottom-->
</header>
<!--/header-->

<style type="text/css">
    .product-image {
        transition: all 1s ease;
    }

    .product-image:hover {
        transform: scale(1.5);
    }
</style>