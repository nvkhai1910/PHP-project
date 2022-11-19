<section class="checkout spad">
    <div class="container">
        <h3 class="text-success jus">Đặt hàng thành công</h3> <br>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th scope="row">Tên khách hàng</th>
                    <td><?php echo isset($_SESSION['infors']['fullname']) ? $_SESSION['infors']['fullname'] : ''; ?></td>
                </tr>
                <tr>
                    <th scope="row">Số điện thoại</th>
                    <td><?php echo isset($_SESSION['infors']['mobile']) ? $_SESSION['infors']['mobile'] : ''; ?></td>
                </tr>
                <tr>
                    <th scope="row">Email</th>
                    <td><?php echo isset($_SESSION['infors']['email']) ? $_SESSION['infors']['email'] : ''; ?></td>
                </tr>
                <tr>
                    <th scope="row">Địa chỉ</th>
                    <td><?php echo isset($_SESSION['infors']['address']) ? $_SESSION['infors']['address'] : ''; ?></td>
                </tr>
                <tr>
                    <th scope="row">Số tiền phải thanh toán</th>
                    <td><?php echo isset($_SESSION['infors']['price_total']) ? number_format($_SESSION['infors']['price_total']) : ''; ?></td>
                </tr>
            </tbody>
        </table> <br>
        <h3 class="text-primary jus">Thông tin đơn hàng</h3> <br>
        <table class="table" border="1">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Giá sản phẩm</th>
                    <th scope="col">Số lượng</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_SESSION['infors_bill'])) :
                    foreach ($_SESSION['infors_bill'] as $item) :
                ?>
                        <tr>
                            <td><?php echo isset($item['name']) ? $item['name'] : ''; ?></td>
                            <td><?php echo isset($item['price']) ? number_format($item['price']) : ''; ?></td>
                            <td><?php echo isset($item['quantity']) ? $item['quantity'] : ''; ?></td>
                        </tr>
                <?php
                    endforeach;
                endif;
                ?>
            </tbody>
        </table>
    </div>
</section>
<!-- Checkout Section End -->