<h1 class="text-danger">
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
</h1>
<a class="btn btn-primary" href="http://localhost/mvc-tranninng/admin/order/create">Thêm mới</a>
<h2>Danh sách order</h2>
<table class="table" border="1">
    <thead class="thead-dark">
        <tr>
            <th scope="col">STT</th>
            <th scope="col">ID khách hàng </th>
            <th scope="col">Họ tên </th>
            <th scope="col">Địa chỉ </th>
            <th scope="col">Số điện thoại</th>
            <th scope="col">Email</th>
            <th scope="col">Ghi chú</th>
            <th scope="col">Tổng giá trị đơn hàng</th>
            <th scope="col">Trạng thái</th>
            <th scope="col">Ngày tạo</th>
            <th scope="col">Ngày cập nhật gần nhất</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orders as $order) : ?>
            <tr>
                <th scope="row"><?php echo isset($order['id']) ? $order['id'] : ''; ?></th>
                <td><?php echo isset($order['customer_id']) ? $order['customer_id'] : ''; ?></td>
                <td><?php echo isset($order['fullname']) ? $order['fullname'] : ''; ?></td>
                <td><?php echo isset($order['address']) ? $order['address'] : ''; ?></td>
                <td><?php echo isset($order['mobile']) ? $order['mobile'] : ''; ?></td>
                <td><?php echo isset($order['email']) ? $order['email'] : ''; ?></td>
                <td><?php echo isset($order['note']) ? $order['note'] : ''; ?></td>
                <td><?php echo isset($order['price_total']) ? number_format($order['price_total']) : ''; ?></td>
                <td>
                    <?php
                    if (isset($order['payment_status'])) {
                        echo ($order['payment_status'] == 0) ? 'Chưa thanh toán' : 'Đã thanh toán';
                    }
                    ?>
                </td>
                <td><?php echo isset($order['created_at']) ? date('d/m/Y H:i:s', strtotime($order['created_at'])) : ''; ?></td>
                <td><?php echo isset($order['updated_at']) ? date('d/m/Y H:i:s', strtotime($order['updated_at'])) : ''; ?></td>
                <td>
                    <a href="" title="Chi tiết"><i class="fa fa-eye"></i></a> |
                    <a title="Sửa" href=""> <i class="fa fa-pencil"></i> </a> |
                    <a title="Xóa" href="" onclick="return confirm('Bạn có chắc chắn xóa trường này ?')"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<nav aria-label="Page navigation example"> <?php echo $pages; ?> </nav>