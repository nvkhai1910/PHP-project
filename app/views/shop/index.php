
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="<?php echo _WEB_ROOT_; ?>/public/assets/client/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Ogani Shop</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-5">
                <div class="sidebar">
                    <div class="sidebar__item">
                        <h4>Department</h4>
                        <ul>
                            <?php foreach ($categories as $category) : ?>
                                <li><a href="http://localhost/mvc-tranninng/shop/index/<?php echo $category['id'] ?>"><?php echo isset($category['name']) ? $category['name'] : ''; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="sidebar__item">
                        <h4>Price</h4>
                        <div class="price-range-wrap">
                            <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content" data-min="10" data-max="540">
                                <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                            </div>
                            <div class="range-slider">
                                <div class="price-input">
                                    <input type="text" id="minamount">
                                    <input type="text" id="maxamount">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar__item sidebar__item__color--option">
                        <h4>Colors</h4>
                        <div class="sidebar__item__color sidebar__item__color--white">
                            <label for="white">
                                White
                                <input type="radio" id="white">
                            </label>
                        </div>
                        <div class="sidebar__item__color sidebar__item__color--gray">
                            <label for="gray">
                                Gray
                                <input type="radio" id="gray">
                            </label>
                        </div>
                        <div class="sidebar__item__color sidebar__item__color--red">
                            <label for="red">
                                Red
                                <input type="radio" id="red">
                            </label>
                        </div>
                        <div class="sidebar__item__color sidebar__item__color--black">
                            <label for="black">
                                Black
                                <input type="radio" id="black">
                            </label>
                        </div>
                        <div class="sidebar__item__color sidebar__item__color--blue">
                            <label for="blue">
                                Blue
                                <input type="radio" id="blue">
                            </label>
                        </div>
                        <div class="sidebar__item__color sidebar__item__color--green">
                            <label for="green">
                                Green
                                <input type="radio" id="green">
                            </label>
                        </div>
                    </div>
                    <div class="sidebar__item">
                        <h4>Popular Size</h4>
                        <div class="sidebar__item__size">
                            <label for="large">
                                Large
                                <input type="radio" id="large">
                            </label>
                        </div>
                        <div class="sidebar__item__size">
                            <label for="medium">
                                Medium
                                <input type="radio" id="medium">
                            </label>
                        </div>
                        <div class="sidebar__item__size">
                            <label for="small">
                                Small
                                <input type="radio" id="small">
                            </label>
                        </div>
                        <div class="sidebar__item__size">
                            <label for="tiny">
                                Tiny
                                <input type="radio" id="tiny">
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-7">
                <div class="product__discount">
                    <div class="section-title product__discount__title">
                        <h2>Sale Off</h2>
                    </div>
                    <div class="row">
                        <div class="product__discount__slider owl-carousel">
                            <?php foreach ($products_discount as $product) : ?>
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg" data-setbg="<?php echo _WEB_ROOT_; ?>/public/assets/admin/uploads/<?php echo $product['avatar'] ?>">
                                            <div class="product__discount__percent">- <?php echo $product['discount'] ?>%</div>
                                            <ul class="product__item__pic__hover">
                                                <li><a title="chi tiết" href="http://localhost/mvc-tranninng/shop/detail/<?php echo $product['id'] ?>"><i class="fa fa-retweet"></i></a></li>
                                                <li><span data-id="<?php echo $product['id'] ?>" class="add-to-cart"><a href="#"><i class="fa fa-shopping-cart "></i></a></span></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <h5><a href="http://localhost/mvc-tranninng/shop/detail/<?php echo $product['id'] ?>"><?php echo $product['title'] ?></a></h5>
                                            <div class="product__item__price"><?php echo number_format($product['price_discount']); ?> <span><?php echo number_format($product['price']) ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="filter__item">
                    <div class="row">
                        <div class="col-lg-4 col-md-5">
                            <div class="filter__sort">
                                <span>Sort By</span>
                                <select>
                                    <option value="0">Default</option>
                                    <option value="0">Default</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="filter__found">
                                <h6><span><?php echo isset($count_total) ? $count_total : ''; ?></span> Products found</h6>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-3">
                            <div class="filter__option">
                                <span class="icon_grid-2x2"></span>
                                <span class="icon_ul"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php foreach ($products as $product) : ?>
                        <?php if ($product['discount'] == 0) : ?>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="<?php echo _WEB_ROOT_; ?>/public/assets/admin/uploads/<?php echo $product['avatar'] ?>">
                                        <ul class="product__item__pic__hover">
                                            <li><a title="chi tiết" href="http://localhost/mvc-tranninng/shop/detail/<?php echo $product['id'] ?>"><i class="fa fa-retweet"></i></a></li>
                                            <li><span data-id="<?php echo $product['id'] ?>" class="add-to-cart"><a href="#"><i class="fa fa-shopping-cart "></i></a></span></li>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6><a href="#"><?php echo $product['title'] ?></a></h6>
                                        <h5><?php echo number_format($product['price']) ?></h5>
                                    </div>
                                </div>
                            </div>
                        <?php else : ?>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__discount__item">
                                    <div class="product__discount__item__pic set-bg" data-setbg="<?php echo _WEB_ROOT_; ?>/public/assets/admin/uploads/<?php echo $product['avatar'] ?>">
                                        <div class="product__discount__percent">- <?php echo $product['discount'] ?>%</div>
                                        <ul class="product__item__pic__hover">
                                            <li><a title="chi tiết" href="http://localhost/mvc-tranninng/shop/detail/<?php echo $product['id'] ?>"><i class="fa fa-retweet"></i></a></li>
                                            <li><span data-id="<?php echo $product['id'] ?>" class="add-to-cart"><a href="#"><i class="fa fa-shopping-cart "></i></a></span></li>
                                        </ul>
                                    </div>
                                    <div class="product__discount__item__text">
                                        <h5><a href="http://localhost/mvc-tranninng/shop/detail/<?php echo $product['id'] ?>"><?php echo $product['title'] ?></a></h5>
                                        <div class="product__item__price"><?php echo number_format($product['price_discount']); ?> <span><?php echo number_format($product['price']) ?></span></div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>

                <nav aria-label="Page navigation example"> <?php echo isset($pages) ? $pages : ''; ?> </nav>
            </div>
        </div>
    </div>
</section>
<!-- Product Section End -->