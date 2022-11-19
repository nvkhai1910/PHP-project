<?php
// echo '<pre>';
// print_r($_SESSION['customer']);
// echo '</pre>';
?>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="<?php echo _WEB_ROOT_; ?>/public/assets/client/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Cập nhật thông tin khách hàng</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->
<!-- Contact Form Begin -->
<div class="contact-form spad">
    <div class="container">
        <form method="post" action="">
            <div class="form-group">
                <label for="customer_name">Nhập tên khách hàng <span style="color: red;"> *</span></label>
                <input value="<?php echo isset($customer['customer_name']) ? $customer['customer_name'] : ''; ?>" name="customer_name" type="text" class="form-control" id="customer_name" placeholder="">
            </div>
            <div class="form-group">
                <label for="phone">Nhập số điện thoại <span style="color: red;"> *</span></label>
                <input value="<?php echo isset($customer['phone']) ? $customer['phone'] : ''; ?>" name="phone" type="text" class="form-control" id="phone" placeholder="">
            </div>
            <div class="form-group">
                <label for="email">Nhập email <span style="color: red;"> *</span></label>
                <input value="<?php echo isset($customer['email']) ? $customer['email'] : ''; ?>" name="email" type="email" class="form-control" id="email" placeholder="">
                <span style="color: red;"> <?php echo (!empty($this->error['customer']['email'])) ? $this->error['customer']['email'] : ''; ?></span>
            </div>
            <div class="form-group">
                <label for="address">Nhập địa chỉ <span style="color: red;"> *</span></label>
                <input value="<?php echo isset($customer['address']) ? $customer['address'] : ''; ?>" name="address" type="text" class="form-control" id="address" placeholder="">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
<!-- Contact Form End -->