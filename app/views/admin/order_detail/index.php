<h2>Danh sách chi tiết đơn hàng</h2>
<table class="table" border="1">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Order Id</th>
            <th scope="col">Tên sản phẩm</th>
            <th scope="col">Giá sản phẩm</th>
            <th scope="col">Số lượng</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($details as $detail) : ?>
            <tr>
                <th scope="row"><?php echo isset($detail['order_id']) ? 'Đơn hàng '.$detail['order_id'] : ''; ?></th>
                <td><?php echo isset($detail['product_name']) ? $detail['product_name'] : ''; ?></td>
                <td><?php echo isset($detail['product_price']) ? number_format($detail['product_price']) : ''; ?></td>
                <td><?php echo isset($detail['quantity']) ? $detail['quantity'] : ''; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<nav aria-label="Page navigation example"> <?php echo $pages; ?> </nav>