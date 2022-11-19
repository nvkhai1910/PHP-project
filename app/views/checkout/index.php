

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="<?php echo _WEB_ROOT_; ?>/public/assets/client/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Checkout</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your code
                </h6>
            </div>
        </div>
        <div class="checkout__form">
            <h4>Thanh toán</h4>
            <form action="" method="post">
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <div class="checkout__input">
                            <p>Họ và tên<span>*</span></p>
                            <input value="<?php echo isset($_SESSION['customer']['customer_name']) ? $_SESSION['customer']['customer_name'] :  ''; ?>" type="text" name="fullname">
                            <span style="color: red;"> <?php echo (!empty($this->error['payment']['fullname'])) ? $this->error['payment']['fullname'] : ''; ?></span>
                        </div>
                        <div class="checkout__input">
                            <p>Địa chỉ<span>*</span></p>
                            <input value="<?php echo isset($_SESSION['customer']['address']) ? $_SESSION['customer']['address'] :  ''; ?>" type="text" name="address" placeholder="" class="checkout__input__add">
                            <span style="color: red;"> <?php echo (!empty($this->error['payment']['address'])) ? $this->error['payment']['address'] : ''; ?></span>

                        </div>
                        <div class="checkout__input">
                            <p>Số điện thoại<span>*</span></p>
                            <input value="<?php echo isset($_SESSION['customer']['phone']) ? $_SESSION['customer']['phone'] :  ''; ?>" type="text" name="mobile">
                            <span style="color: red;"> <?php echo (!empty($this->error['payment']['mobile'])) ? $this->error['payment']['mobile'] : ''; ?></span>

                        </div>
                        <div class="checkout__input">
                            <p>Email<span>*</span></p>
                            <input value="<?php echo isset($_SESSION['customer']['email']) ? $_SESSION['customer']['email'] :  ''; ?>" type="email" name="email">
                            <span style="color: red;"> <?php echo (!empty($this->error['payment']['email'])) ? $this->error['payment']['email'] : ''; ?></span>

                        </div>
                        <div class="checkout__input">
                            <p>Ghi chú<span>*</span></p>
                            <input type="text" name="note" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Chọn phương thức thanh toán</label> <br />
                            <input type="radio" name="method" value="0" /> Thanh toán trực tuyến <br />
                            <input type="radio" name="method" checked value="1" /> COD (dựa vào địa chỉ của bạn) <br />
                        </div>
                    </div>
                    <?php
                        //biến lưu tổng giá trị đơn hàng
                        $total = 0;
                        if (isset($_SESSION['cart'])):
                    ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4>Your Order</h4>
                            <div class="checkout__order__products">Products <span>Total</span></div>
                            <ul>
                                <?php foreach ($_SESSION['cart'] as $product_id=>$cart): ?>
                                    <?php
                                    $price_total = $cart['price'] * $cart['quantity'];
                                    $total += $price_total;
                                    ?>
                                    <li>  <?php echo $cart['name'] ?> <span><?php echo number_format($price_total) ?></span></li> <br>
                                <?php endforeach; ?>
                            </ul>
                            <div class="checkout__order__subtotal">Subtotal <span><?php echo number_format($total) ?></span></div>
                            <div class="checkout__order__total">Total <span><?php echo number_format($total) ?></span></div>
                    <?php endif; ?>
                            <div class="checkout__input__checkbox">

                                <label for="acc-or">
                                    Create an account?
                                    <input type="checkbox" id="acc-or">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="payment">
                                    Check Payment
                                    <input type="checkbox" id="payment">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="paypal">
                                    Paypal
                                    <input type="checkbox" id="paypal">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <?php if($total > 0): ?>
                                <button type="submit" name="submit" class="site-btn">PLACE ORDER</button>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Checkout Section End -->