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
        <label class="font-weight-bold text-primary" for="keyword">Tìm theo tên đăng nhập</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="keyword" id="keyword" placeholder="Search" aria-label="Recipient's username">
            <div class="input-group-append">
                <button class="btn btn-info" name="submit" id="button-addon2">Tìm kiếm</button>
            </div>
        </div>
    </div>
</form>
<a class="btn btn-primary" href="http://localhost/mvc-tranninng/admin/customer/create">Thêm mới</a>
<h2>Danh sách khách hàng</h2>
<table class="table" border="1">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Tên đăng nhập</th>
            <th scope="col">Tên khách hàng</th>
            <th scope="col">Số điện thoại</th>
            <th scope="col">Email</th>
            <th scope="col">Địa chỉ</th>
            <th scope="col">Ngày tạo</th>
            <th scope="col">Ngày cập nhật gần nhất</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($customers)) : ?>
            <?php foreach ($customers as $customer) : ?>
                <tr>
                    <td scope="row"><?php echo $customer['id'] ?></td>
                    <td scope="row"><?php echo $customer['username'] ?></td>
                    <td><?php echo $customer['customer_name'] ?></td>
                    <td><?php echo $customer['phone'] ?></td>
                    <td><?php echo $customer['email'] ?></td>
                    <td><?php echo $customer['address'] ?></td>
                    <td><?php echo date('d-m-Y H:i:s', strtotime($customer['created_at'])) ?></td>
                    <td><?php echo !empty($customer['updated_at']) ? date('d-m-Y H:i:s', strtotime($customer['updated_at'])) : '--' ?></td>
                    <td>
                        <?php

                        $url_update = "http://localhost/mvc-tranninng/admin/customer/update/?id=" . $customer['id'];
                        $url_delete = "http://localhost/mvc-tranninng/admin/customer/delete/?id=" . $customer['id'];
                        ?>
                        <a title="Update" href="<?php echo $url_update ?>"><i class="fa fa-pencil"></i></a> &nbsp;&nbsp;
                        <a title="Xóa" href="<?php echo $url_delete ?>" onclick="return confirm('Bạn có chắc chắn xóa trường này ?')"><i class="fa fa-trash"></i></a>
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