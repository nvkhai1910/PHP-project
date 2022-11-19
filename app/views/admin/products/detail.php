<h1>Chi tiết sản phẩm</h1>

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <td><?php echo $product['id']?></td>
    </tr>
    <tr>
        <th>Tên danh mục</th>
        <td><?php echo $product['category_name']?></td>
    </tr>
    <tr>
        <th>Tên sản phẩm</th>
        <td><?php echo $product['title']?></td>
    </tr>
    <tr>
        <th>Hình ảnh</th>
        <td>
            <?php if (!empty($product['avatar'])): ?>
                <img height="80" src="<?php echo _WEB_ROOT_; ?>/public/assets/admin/uploads/<?php echo $product['avatar'] ?>"/>
            <?php endif; ?>
        </td>
    </tr>
    <tr>
        <th>Giá</th>
        <td><?php echo number_format($product['price']) ?></td>
    </tr>
    <tr>
        <th>Số lượng trong kho</th>
        <td><?php echo number_format($product['amount']) ?></td>
    </tr>
    <tr>
        <th>Giảm giá</th>
        <td><?php echo number_format($product['discount']) ?> %</td>
    </tr>
    <tr>
        <th>Seo Title</th>
        <td><?php echo $product['seo_title'] ?></td>
    </tr>
    <tr>
        <th>Seo description</th>
        <td><?php echo $product['seo_description'] ?></td>
    </tr>
    <tr>
        <th>Seo keywords</th>
        <td><?php echo $product['seo_keywords'] ?></td>
    </tr>
    <tr>
        <th>Status</th>
        <td><?php echo $product['status'] ?></td>
    </tr>
    <tr>
        <th>Ngày tạo</th>
        <td><?php echo date('d-m-Y H:i:s', strtotime($product['created_at'])) ?></td>
    </tr>
    <tr>
        <th>Ngày cập nhật gần nhất</th>
        <td><?php echo !empty($product['updated_at']) ? date('d-m-Y H:i:s', strtotime($product['updated_at'])) : '--' ?></td>
    </tr>
</table>
<a href="http://localhost/mvc-tranninng/admin/product/index" class="btn btn-primary">Back</a>