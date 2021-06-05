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
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i>  0388489308</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i>  tamnm1999@gmail.com</a></li>

                            <!--show user data if user log in success-->
                            <?php if (isset($data['user_data'])): ?>
                                <li><a href="#"><i class="fa fa fa-user"></i>
                                        Xin chào <?= $data['user_data']->user_full_name ?> !
                                    </a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
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
                    <div class="btn-group pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                VIỆT NAM
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Hà Nội</a></li>
                                <li><a href="#">Hồ Chí Minh</a></li>
                            </ul>
                        </div>

<!--                        <div class="btn-group">-->
<!--                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">-->
<!--                                DOLLAR-->
<!--                                <span class="caret"></span>-->
<!--                            </button>-->
<!--                            <ul class="dropdown-menu">-->
<!--                                <li><a href="#">Canadian Dollar</a></li>-->
<!--                                <li><a href="#">Pound</a></li>-->
<!--                            </ul>-->
<!--                        </div>-->
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">

                            <!--user login is Admin, show link to profile.php of admin-->
                            <?php if (isset($data['user_data']) && ($data['user_data']->user_rank == 'Admin')): ?>
                                <li><a href="<?= ROOT ?>profile"><i class="fa fa-user"></i>Tài Khoản</a></li>
                            <?php endif; ?>
                            <li><a href="<?= ROOT ?>"><i class="fa fa-star"></i> Yêu Thích</a></li>
                            <li><a href="<?= ROOT ?>checkout"><i class="fa fa-crosshairs"></i> Thanh Toán</a></li>
                            <li><a href="<?= ROOT ?>cart"><i class="fa fa-shopping-cart"></i> Giỏ Hàng</a></li>

                            <!--user login, link Login change to link Logout-->
                            <?php if (isset($data['user_data'])): ?>
                                <li><a href="logout"><i class="fa fa-lock"></i> Đăng Xuất</a></li>
                            <?php else: ?>
                                <li><a href="login"><i class="fa fa-lock"></i> Đăng Nhập</a></li>
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
                            <li><a href="<?= ROOT ?>" class="active">Trang Chủ</a></li>
                            <li class="dropdown"><a href="#">Cửa Hàng<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="<?= ROOT ?>shop">Sản Phẩm</a></li>
                                    <li><a href="<?= ROOT ?>">Chi tiết Sản Phẩm</a></li>
                                    <li><a href="<?= ROOT ?>">Thanh Toán</a></li>
                                    <li><a href="<?= ROOT ?>cart">Giỏ Hàng</a></li>
                                    <li><a href="<?= ROOT ?>">Đăng Nhập</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="<?= ROOT ?>blog">Blog List</a></li>
                                    <li><a href="<?= ROOT ?>blog-single">Blog Single</a></li>
                                </ul>
                            </li>
                            <li><a href="<?= ROOT ?>404">404</a></li>
                            <li><a href="<?= ROOT ?>contact-us">Liên Hệ</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="search_box pull-right">
                        <input type="text" placeholder="Tìm Kiếm"/>
                    </div>
                </div>
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