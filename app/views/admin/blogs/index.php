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
<a class="btn btn-primary" href="http://localhost/mvc-tranninng/admin/blog/create">Thêm mới</a>
<h2>Danh sách blog</h2>
<table class="table" border="1">
    <thead class="thead-dark">
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Tiêu đề tin tức </th>
            <th scope="col">Mô tả ngắn tin tức</th>
            <th scope="col">Hình ảnh </th>
            <th scope="col">Trạng thái</th>
            <th scope="col">Ngày tạo</th>
            <th scope="col">Ngày cập nhật gần nhất</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($blogs as $blog) : ?>
            <tr>
                <th scope="row"><?php echo isset($blog['id']) ? $blog['id'] : ''; ?></th>
                <td><?php echo isset($blog['title']) ? $blog['title'] : ''; ?></td>
                <td><?php echo isset($blog['summary']) ? $blog['summary'] : ''; ?></td>
                
                <td>
                    <?php if (!empty($blog['avatar'])) : ?>
                        <img height="80" src="<?php echo _WEB_ROOT_; ?>/public/assets/admin/uploads/<?php echo $blog['avatar'] ?>" />
                    <?php endif; ?>
                </td>
                <td>
                    <?php
                    if (isset($blog['status'])) {
                        echo ($blog['status'] == 0) ? 'Không kích hoạt' : 'Kích hoạt';
                    }
                    ?>
                </td>
                <td><?php echo isset($blog['created_at']) ? date('d/m/Y H:i:s', strtotime($blog['created_at'])) : ''; ?></td>
                <td><?php echo isset($blog['updated_at']) ? date('d/m/Y H:i:s', strtotime($blog['updated_at'])) : ''; ?></td>
                <td>
                    <a href="http://localhost/mvc-tranninng/admin/blog/detail/?id=<?php echo isset($blog['id']) ? $blog['id'] : ''; ?>"" title=" Chi tiết"><i class="fa fa-eye"></i></a> |
                    <a title="Sửa" href="http://localhost/mvc-tranninng/admin/blog/update/?id=<?php echo isset($blog['id']) ? $blog['id'] : ''; ?>"> <i class="fa fa-pencil"></i> </a> |
                    <a title="Xóa" href="http://localhost/mvc-tranninng/admin/blog/delete/?id=<?php echo isset($blog['id']) ? $blog['id'] : ''; ?>" onclick="return confirm('Bạn có chắc chắn xóa trường này ?')"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<nav aria-label="Page navigation example"> <?php echo $pages; ?> </nav>