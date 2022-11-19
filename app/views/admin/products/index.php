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
<form action="" method="get">
    <div class="form-group">
        <label class="font-weight-bold text-primary" for="keyword">Tìm theo tên hoặc mô tả</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="keyword" id="keyword" placeholder="Search" aria-label="Recipient's username">
            <div class="input-group-append">
                <button class="btn btn-info" name="submit" id="button-addon2">Tìm kiếm</button>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="title">Chọn danh mục</label>
        <select name="category_id" class="form-control">
            <?php foreach ($categories as $category) :
                //giữ trạng thái selected của category sau khi chọn dựa vào
                //                tham số category_id trên trình duyệt
                $selected = '';
                if (isset($_GET['category_id']) && $category['id'] == $_GET['category_id']) {
                    $selected = 'selected';
                }
            ?>
                <option value="<?php echo $category['id'] ?>" <?php echo $selected; ?>>
                    <?php echo $category['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
</form>
<h2>Danh sách sản phẩm</h2>
<a class="btn btn-success" href="http://localhost/mvc-tranninng/admin/product/create">Thêm mới</a>
<table class="table table-bordered" border="1">
    <thead class="thead-dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Tên danh mục</th>
            <th scope="col">Tên sản phẩm</th>
            <th scope="col">Hình ảnh</th>
            <th scope="col">Giá</th>
            <th scope="col">Số lượng</th>
            <th scope="col">Giảm giá</th>
            <th scope="col">Trạng thái</th>
            <th scope="col">Ngày tạo</th>
            <th scope="col">Ngày cập nhật gần nhất</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($products)) : ?>
            <?php foreach ($products as $product) : ?>
                <tr>
                    <td scope="row"><?php echo $product['id'] ?></td>
                    <td><?php echo $product['category_name'] ?></td>
                    <td><?php echo $product['title'] ?></td>
                    <td>
                        <?php if (!empty($product['avatar'])) : ?>
                            <img height="80" src="<?php echo _WEB_ROOT_; ?>/public/assets/admin/uploads/<?php echo $product['avatar'] ?>" />
                        <?php endif; ?>
                    </td>
                    <td><?php echo number_format($product['price']) ?></td>
                    <td><?php echo $product['amount'] ?></td>
                    <td><?php echo $product['discount'] ?> %</td>
                    <td>
                        <?php
                            if (isset($product['status'])) {
                                echo ($product['status'] == 0) ? 'Không kích hoạt' : 'Kích hoạt';
                            }
                        ?>
                    </td>
                    <td><?php echo date('d-m-Y H:i:s', strtotime($product['created_at'])) ?></td>
                    <td><?php echo !empty($product['updated_at']) ? date('d-m-Y H:i:s', strtotime($product['updated_at'])) : '--' ?></td>
                    <td>
                        <?php
                        $url_detail = "http://localhost/mvc-tranninng/admin/product/detail/?id=".$product['id'];
                        $url_update = "http://localhost/mvc-tranninng/admin/product/update/?id=".$product['id'];
                        $url_delete = "http://localhost/mvc-tranninng/admin/product/delete/?id=".$product['id'];
                        ?>
                        <a title="Chi tiết" href="<?php echo $url_detail ?>"><i class="fa fa-eye"></i></a> &nbsp;&nbsp;
                        <a title="Update" href="<?php echo $url_update ?>"><i class="fa fa-pencil"></i></a> &nbsp;&nbsp;
                        <a title="Xóa" href="<?php echo $url_delete ?>"  onclick="return confirm('Bạn có chắc chắn xóa trường này ?')"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="9">No data found</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
<nav aria-label="Page navigation example"> <?php echo $pages; ?> </nav>