<?php
// echo '<pre>';
// print_r($customer);
// echo '</pre>';
?>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="<?php echo _WEB_ROOT_; ?>/public/assets/client/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Thông tin khách hàng</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->
<!-- Contact Form Begin -->
<div class="contact-form spad">
    <div class="container">
        <h4 class="text-danger">
            <?php
            if (isset($_SESSION['success'])) {
                echo $_SESSION['success'];
                unset($_SESSION['success']);
            }
            if (isset($_SESSION['error'])) {
                echo $_SESSION['error'];
                unset($_SESSION['error']);
            }
            ?>
        </h4> <br><br>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th scope="row">Tên đăng nhập</th>
                    <td><?php echo isset($customer['username']) ? $customer['username'] : ''; ?></td>
                </tr>
                <tr>
                    <th scope="row">Tên khách hàng</th>
                    <td><?php echo isset($customer['customer_name']) ? $customer['customer_name'] : ''; ?></td>
                </tr>
                <tr>
                    <th scope="row">Số điện thoại</th>
                    <td><?php echo isset($customer['phone']) ? $customer['phone'] : ''; ?></td>
                </tr>
                <tr>
                    <th scope="row">Email</th>
                    <td><?php echo isset($customer['email']) ? $customer['email'] : ''; ?></td>
                </tr>
                <tr>
                    <th scope="row">Địa chỉ</th>
                    <td><?php echo isset($customer['address']) ? $customer['address'] : ''; ?></td>
                </tr>
            </tbody>
        </table>
        <a href="http://localhost/mvc-tranninng/client/update/<?php echo $customer['id']; ?>" class="btn btn-primary"> Cập nhật thông tin </a>
    </div>
</div>
<!-- Contact Form End -->