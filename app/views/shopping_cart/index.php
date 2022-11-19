    <?php
        // echo '<pre>';
        // print_r($_SESSION['cart']);
        // echo '</pre>';
    ?>
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="<?php echo _WEB_ROOT_; ?>/public/assets/client/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping Cart</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <form action="" method="post">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shoping__cart__table">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="shoping__product">Sản phẩm</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Thành tiền</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Khai báo tổng giá trị đơn hàng
                                    $total_cart = 0;
                                    if(isset($_SESSION['cart'])):
                                        foreach ($_SESSION['cart'] as $product_id => $cart) :
                                        ?>
                                            <tr>
                                                <td class="shoping__cart__item">
                                                    <img width="100px" height="80px" src="<?php echo _WEB_ROOT_; ?>/public/assets/admin/uploads/<?php echo $cart['avatar'] ?>" alt="">
                                                    <h5><?php echo $cart['name'] ?></h5>
                                                </td>
                                                <td class="shoping__cart__price">
                                                    <?php echo number_format($cart['price']) ?>
                                                </td>
                                                <td class="shoping__cart__quantity">
                                                    <div class="quantity">
                                                        <div class="pro-qty">
                                                            <input type="text" value="<?php echo $cart['quantity'] ?>" name="<?php echo $product_id; ?>">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="shoping__cart__total">
                                                    <?php
                                                    $total_item = $cart['price'] * $cart['quantity'];
                                                    echo number_format($total_item);
                                                    $total_cart += $total_item;
                                                    ?>
                                                </td>
                                                <td class="shoping__cart__item__close">
                                                    <a href="http://localhost/mvc-tranninng/cart/delete/<?php echo $product_id; ?>"><span class="icon_close"></span></a>
                                                </td>
                                            </tr>
                                    <?php 
                                        endforeach;
                                        endif; 
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shoping__cart__btns">
                            <form action="" method="post">
                                <a href="http://localhost/mvc-tranninng/shop" class="primary-btn btn cart-btn">CONTINUE SHOPPING</a>
                                <?php if(isset($_SESSION['cart'])): ?>
                                    <button type="submit" name="submit" class="float-right btn btn-primary">Cập nhật giỏ hàng</button>
                                <?php endif; ?>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="shoping__continue">
                            <div class="shoping__discount">
                                <h5>Discount Codes</h5>
                                <form action="#">
                                    <input type="text" placeholder="Enter your coupon code">
                                    <button type="submit" class="site-btn">APPLY COUPON</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="shoping__checkout">
                            <h5>Cart Total</h5>
                            <ul>
                                <li>Subtotal <span><?php echo number_format($total_cart) ?></span></li>
                                <li>Total <span>
                                        <?php echo number_format($total_cart); ?>
                                    </span></li>
                            </ul>
                            <?php if($total_cart > 0): ?>
                                <a href="http://localhost/mvc-tranninng/payment/" class="primary-btn">Thanh toán</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <!-- Shoping Cart Section End -->