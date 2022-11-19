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
</form>
<a class="btn btn-primary" href="http://localhost/mvc-tranninng/admin/category/create">Thêm mới</a>
<h2>Danh sách danh mục</h2>
<table class="table" border="1">
    <thead class="thead-dark">
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Tên danh mục </th>
            <th scope="col">Loại danh mục </th>
            <th scope="col">Hình ảnh </th>
            <th scope="col">Mô tả danh mục</th>
            <th scope="col">Trạng thái</th>
            <th scope="col">Ngày tạo</th>
            <th scope="col">Ngày cập nhật gần nhất</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categories as $category) : ?>
            <tr>
                <th scope="row"><?php echo isset($category['id']) ? $category['id'] : ''; ?></th>
                <td><?php echo isset($category['name']) ? $category['name'] : ''; ?></td>
                <td>
                    <?php
                    if (isset($category['type'])) {
                        echo ($category['type'] == 0) ? 'Sản phẩm' : 'Tin tức';
                    }
                    ?>
                </td>
                <td>
                    <?php if (!empty($category['avatar'])) : ?>
                        <img height="80" src="<?php echo _WEB_ROOT_; ?>/public/assets/admin/uploads/<?php echo $category['avatar'] ?>" />
                    <?php endif; ?>
                </td>
                <td><?php echo isset($category['description']) ? $category['description'] : ''; ?></td>
                <td>
                    <?php
                    if (isset($category['status'])) {
                        echo ($category['status'] == 0) ? 'Không kích hoạt' : 'Kích hoạt';
                    }
                    ?>
                </td>
                <td><?php echo isset($category['created_at']) ? date('d/m/Y H:i:s', strtotime($category['created_at'])) : ''; ?></td>
                <td><?php echo isset($category['updated_at']) ? date('d/m/Y H:i:s', strtotime($category['updated_at'])) : ''; ?></td>
                <td>
                    <a href="http://localhost/mvc-tranninng/admin/category/detail/?id=<?php echo isset($category['id']) ? $category['id'] : ''; ?>"" title=" Chi tiết"><i class="fa fa-eye"></i></a> |
                    <a title="Sửa" href="http://localhost/mvc-tranninng/admin/category/update/?id=<?php echo isset($category['id']) ? $category['id'] : ''; ?>"> <i class="fa fa-pencil"></i> </a> |
                    <a title="Xóa" href="http://localhost/mvc-tranninng/admin/category/delete/?id=<?php echo isset($category['id']) ? $category['id'] : ''; ?>" onclick="return confirm('Bạn có chắc chắn xóa trường này ?')"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<nav aria-label="Page navigation example"> <?php echo $pages; ?> </nav>