<?php
// echo '<pre>';
// print_r($_SESSION['customer']);
// echo '</pre>';

?>
<!-- Categories Section Begin -->
<section class="categories">
    <div class="container">
        <div class="row">
            <div class="categories__slider owl-carousel">
                <?php if (!empty($categories)) : ?>
                    <?php foreach ($categories as $category) : ?>
                        <?php if (!empty($category['avatar'])) : ?>
                            <div class="col-lg-3">
                                <div class="categories__item set-bg" data-setbg="<?php echo _WEB_ROOT_; ?>/public/assets/admin/uploads/<?php echo $category['avatar'] ?>">
                                    <h5><a href="#"><?php echo $category['name'] ?></a></h5>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<!-- Categories Section End -->

<!-- Featured Section Begin -->
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Sản phẩm nổi bật</h2>
                </div>
                <div class="featured__controls">
                    <ul>
                        <li class="active" data-filter="*">Tất cả</li>
                        <!-- <?php foreach ($categories as $category) : ?>
                            <li data-filter=".<?php echo $category['name'] ?>"><?php echo $category['name'] ?></li>
                        <?php endforeach; ?> -->
                        <li data-filter=".traicay">Trái cây</li>
                        <li data-filter=".rau">Rau hữu cơ</li>
                        <li data-filter=".thit">Thịt tươi sống</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row featured__filter">
            <?php foreach ($products as $product) : ?>
                <?php if ($product['discount'] == 0) : ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mix 
                    <?php
                    switch ($product['category_id']) {
                        case 1:
                            echo 'thit';
                            break;
                        case 2:
                            echo 'rau';
                            break;
                        case 3:
                            echo 'traicay';
                            break;
                    }
                    ?>">
                        <div class="featured__item">
                            <div class="featured__item__pic set-bg" data-setbg="<?php echo _WEB_ROOT_; ?>/public/assets/admin/uploads/<?php echo $product['avatar'] ?>">
                                <ul class="featured__item__pic__hover">
                                    <li><a title="chi tiết" href="http://localhost/mvc-tranninng/shop/detail/<?php echo $product['id'] ?>"><i class="fa fa-retweet"></i></a></li>
                                    <li><span data-id="<?php echo $product['id'] ?>" class="add-to-cart"><a href="#"><i class="fa fa-shopping-cart "></i></a></span></li>
                                </ul>
                            </div>
                            <div class="featured__item__text">
                                <h6><a href="#"><?php echo $product['title'] ?></a></h6>
                                <h5><?php echo number_format($product['price']) ?>đ / 1kg</h5>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mix 
                    <?php
                    switch ($product['category_id']) {
                        case 1:
                            echo 'thit';
                            break;
                        case 2:
                            echo 'rau';
                            break;
                        case 3:
                            echo 'traicay';
                            break;
                    }
                    ?>">
                        <div class="featured__item">
                            <div class="featured__item__pic product__discount__item__pic set-bg" data-setbg="<?php echo _WEB_ROOT_; ?>/public/assets/admin/uploads/<?php echo $product['avatar'] ?>">
                                <div class="product__discount__percent">- <?php echo $product['discount'] ?>%</div>
                                <ul class="featured__item__pic__hover">
                                    <li><a title="chi tiết" href="http://localhost/mvc-tranninng/shop/detail/<?php echo $product['id'] ?>"><i class="fa fa-retweet"></i></a></li>
                                    <li><span data-id="<?php echo $product['id'] ?>" class="add-to-cart"><a href="#"><i class="fa fa-shopping-cart "></i></a></span></li>
                                </ul>
                            </div>
                            <div class="featured__item__text">
                                <h6><a href="#"><?php echo $product['title'] ?></a></h6>
                                <h5><?php echo number_format($product['price_discount']) ?>đ / 1kg</h5>
                            </div>
                        </div>
                    </div>
            <?php
                endif;
            endforeach;
            ?>
        </div>
    </div>
</section>
<!-- Featured Section End -->

<!-- Banner Begin -->
<div class="banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="<?php echo _WEB_ROOT_; ?>/public/assets/client/img/banner/banner-1.jpg" alt="">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="<?php echo _WEB_ROOT_; ?>/public/assets/client/img/banner/banner-2.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Banner End -->

<!-- Latest Product Section Begin -->
<section class="latest-product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="latest-product__text">
                    <h4>Sản phẩm mới nhất</h4>
                    <div class="latest-product__slider owl-carousel">
                        <div class="latest-prdouct__slider__item">
                            <?php foreach ($products_latest_page1 as $product) : ?>
                                <a href="http://localhost/mvc-tranninng/shop/detail/<?php echo $product['id']; ?>" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="<?php echo _WEB_ROOT_; ?>/public/assets/admin/uploads/<?php echo $product['avatar'] ?>" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6><?php echo $product['title'] ?></h6>
                                        <span><?php echo number_format($product['price']) ?></span>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                        <div class="latest-prdouct__slider__item">
                            <?php foreach ($products_latest_page2 as $product) : ?>
                                <a href="http://localhost/mvc-tranninng/shop/detail/<?php echo $product['id']; ?>" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="<?php echo _WEB_ROOT_; ?>/public/assets/admin/uploads/<?php echo $product['avatar'] ?>" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6><?php echo $product['title'] ?></h6>
                                        <span><?php echo number_format($product['price']) ?></span>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                        <div class="latest-prdouct__slider__item">
                            <?php foreach ($products_latest_page3 as $product) : ?>
                                <a href="http://localhost/mvc-tranninng/shop/detail/<?php echo $product['id']; ?>" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="<?php echo _WEB_ROOT_; ?>/public/assets/admin/uploads/<?php echo $product['avatar'] ?>" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6><?php echo $product['title'] ?></h6>
                                        <span><?php echo number_format($product['price']) ?></span>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="latest-product__text">
                    <h4>Sản phẩm bán chạy nhất</h4>
                    <div class="latest-product__slider owl-carousel">
                        <div class="latest-prdouct__slider__item">
                            <?php foreach ($products_bestseller_page1 as $product) : ?>
                                <a href="http://localhost/mvc-tranninng/shop/detail/<?php echo $product['id']; ?>" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="<?php echo _WEB_ROOT_; ?>/public/assets/admin/uploads/<?php echo $product['avatar'] ?>" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6><?php echo $product['title'] ?></h6>
                                        <span><?php echo number_format($product['price_discount']) ?></span>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                        <div class="latest-prdouct__slider__item">
                            <?php foreach ($products_bestseller_page2 as $product) : ?>
                                <a href="http://localhost/mvc-tranninng/shop/detail/<?php echo $product['id']; ?>" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="<?php echo _WEB_ROOT_; ?>/public/assets/admin/uploads/<?php echo $product['avatar'] ?>" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6><?php echo $product['title'] ?></h6>
                                        <span><?php echo number_format($product['price']) ?></span>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                        <div class="latest-prdouct__slider__item">
                            <?php foreach ($products_bestseller_page3 as $product) : ?>
                                <a href="http://localhost/mvc-tranninng/shop/detail/<?php echo $product['id']; ?>" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="<?php echo _WEB_ROOT_; ?>/public/assets/admin/uploads/<?php echo $product['avatar'] ?>" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6><?php echo $product['title'] ?></h6>
                                        <span><?php echo number_format($product['price']) ?></span>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Latest Product Section End -->

<!-- Blog Section Begin -->
<section class="from-blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title from-blog__title">
                    <h2>From The Blog</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php foreach ($blogs as $blog) : ?>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="<?php echo _WEB_ROOT_; ?>/public/assets/admin/uploads/<?php echo $blog['avatar'] ?>" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="http://localhost/mvc-tranninng/blog/detail/<?php echo $blog['id'] ?>"><?php echo $blog['title'] ?></a></h5>
                            <p> <?php echo $blog['summary'] ?> </p>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</section>
<!-- Blog Section End -->