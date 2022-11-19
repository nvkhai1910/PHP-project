<?php
require_once 'app/models/CategoryModel.php';
$category_model = new CategoryModel;
$categories = $category_model->getAll();
?>
<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>

<!-- Humberger Begin -->
<div class="humberger__menu__overlay"></div>
<div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
        <a href="#"><img src="<?php echo _WEB_ROOT_; ?>/public/assets/client/img/logo.png" alt=""></a>
    </div>
    <div class="humberger__menu__cart">
        <ul>
            <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
            <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
        </ul>
        <div class="header__cart__price">item: <span>$150.00</span></div>
    </div>
    <div class="humberger__menu__widget">
        <div class="header__top__right__auth">
            <a href="#"><i class="fa fa-user"></i> Login</a>
        </div>
    </div>
    <nav class="humberger__menu__nav mobile-menu">
        <ul>
            <li class="active"><a href="./index.html">Home</a></li>
            <li><a href="./shop-grid.html">Shop</a></li>
            <li><a href="#">Pages</a>
                <ul class="header__menu__dropdown">
                    <li><a href="./shop-details.html">Shop Details</a></li>
                    <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                    <li><a href="./checkout.html">Check Out</a></li>
                    <li><a href="./blog-details.html">Blog Details</a></li>
                </ul>
            </li>
            <li><a href="./blog.html">Blog</a></li>
            <li><a href="./contact.html">Contact</a></li>
        </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="header__top__right__social">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-linkedin"></i></a>
        <a href="#"><i class="fa fa-pinterest-p"></i></a>
    </div>
    <div class="humberger__menu__contact">
        <ul>
            <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
            <li>Free Shipping for all Order of $99</li>
        </ul>
    </div>
</div>
<!-- Humberger End -->

<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-envelope"></i>nvkhai@gmail.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right">
                        <div class="header__top__right__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-youtube"></i></a>
                        </div>
                        <?php if (isset($_SESSION['customer'])) : ?>
                            <div class="header__top__right__auth profile clearfix">
                                <div class="dropdown">
                                    <img class="rounded-circle" width="20px" height="20px" src="<?php echo _WEB_ROOT_; ?>/public/assets/admin/images/img.jpg" alt="" class="img-circle profile_img">
                                    &ensp; <span  class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <?php echo $_SESSION['customer']['username'] ?></span>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="http://localhost/mvc-tranninng/client/profile/<?php echo $_SESSION['customer']['id']; ?>">Profile</a>
                                        <a class="dropdown-item" href="#">Help</a>
                                        <a class="dropdown-item" href="http://localhost/mvc-tranninng/client/logout">Log Out <i class="fa fa-sign-out pull-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        <?php else : ?>
                            <div class="header__top__right__auth">
                                <a href="http://localhost/mvc-tranninng/client/"><i class="fa fa-user"></i> Đăng nhập</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="#"><img src="<?php echo _WEB_ROOT_; ?>/public/assets/client/img/logo.png" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
                    <ul>
                        <li class="<?php if(empty($_GET)) echo 'active'; ?>"><a href="http://localhost/mvc-tranninng">Home</a></li>
                        <li class="<?php if(isset($_GET['shop/index/'])) echo 'active'; ?>"><a href="http://localhost/mvc-tranninng/shop/index/">Shop</a></li>
                        <li class="<?php if(isset($_GET['payment/index/']) || isset($_GET['cart/index/'])) echo 'active'; ?>"><a href="http://localhost/mvc-tranninng/cart/index/">Pages</a>
                            <ul class="header__menu__dropdown">
                                <li><a href="http://localhost/mvc-tranninng/cart/index/">Shoping Cart</a></li>
                                <li><a href="http://localhost/mvc-tranninng/payment/index/">Check Out</a></li>
                            </ul>
                        </li>
                        <li class="<?php if(isset($_GET['blog/index/'])) echo 'active'; ?>"><a href="http://localhost/mvc-tranninng/blog/index/">Blog</a></li>
                        <li class="<?php if(isset($_GET['contact/index/'])) echo 'active'; ?>"><a href="http://localhost/mvc-tranninng/contact/index/">Contact</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__cart">
                    <ul>
                        <?php
                        $cart_total = 0;
                        if (isset($_SESSION['cart'])) {
                            foreach ($_SESSION['cart'] as $cart) {
                                $cart_total += $cart['quantity'];
                            }
                        }
                        ?>
                        <li><a href="http://localhost/mvc-tranninng/cart/"><i class="fa fa-shopping-bag"></i> <span class="cart_amount"><?php echo $cart_total; ?></span></a></li>
                    </ul>
                    <p class="ajax-message text-success"></p>
                </div>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
<!-- Header Section End -->

<!-- Hero Section Begin -->
<section class="hero <?php if (!isset($this->model_home)) echo 'hero-normal'; ?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>Danh Mục</span>
                    </div>
                    <ul>
                        <?php if (!empty($categories)) : ?>
                            <?php foreach ($categories as $category) : ?>
                                <li><a href="http://localhost/mvc-tranninng/shop/index/<?php echo $category['id'] ?>"><?php echo $category['name'] ?></a></li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="http://localhost/mvc-tranninng/shop/index/" method="get">
                            <div class="hero__search__categories">
                                All Categories
                                <span class="arrow_carrot-down"></span>
                            </div>
                            <input type="text" name="keyword" placeholder="What do yo u need?">
                            <button type="submit" name="submit123" class="site-btn">SEARCH</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>+84 974 580 409</h5>
                            <span> <b>Support 24/7 time</b> </span>
                        </div>
                    </div>
                </div>
                <?php if (isset($this->model_home)) {
                    echo '<div class="hero__item set-bg" data-setbg="http://localhost/mvc-tranninng/public/assets/client/img/hero/banner.jpg">
                        <div class="hero__text">
                            <span>FRUIT FRESH</span>
                            <h2>Vegetable <br />100% Organic</h2>
                            <p>Free Pickup and Delivery Available</p>
                            <a href="http://localhost/mvc-tranninng/shop/index/" class="primary-btn">SHOP NOW</a>
                        </div>
                    </div>';
                } ?>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->