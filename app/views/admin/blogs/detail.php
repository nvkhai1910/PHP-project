<h1>Chi tiết blog</h1>

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <td><?php echo $blog['id']; ?></td>
    </tr>
    <tr>
        <th>Tiêu đề tin tức</th>
        <td><?php echo $blog['title']; ?></td>
    </tr>
    <tr>
        <th>Mô tả ngắn tin tức</th>
        <td><?php echo $blog['summary']; ?></td>
    </tr>
    <tr>
        <th>Nội dung tin tức</th>
        <td><?php echo $blog['content']; ?></td>
    </tr>
    <tr>
        <th>Hình ảnh</th>
        <td>
            <?php if (!empty($blog['avatar'])) : ?>
                <img height="80" src="<?php echo _WEB_ROOT_; ?>/public/assets/admin/uploads/<?php echo $blog['avatar'] ?>" />
            <?php endif; ?>
        </td>
    </tr>
    <tr>
        <th>Status</th>
        <td>
            <?php
            $status_text = 'Active';
            if ($blog['status'] == 0) {
                $status_text = 'Disabled';
            }
            echo $status_text;
            ?>
        </td>
    </tr>
    <tr>
        <th>Created_at</th>
        <td>
            <?php echo date('d-m-Y H:i:s', strtotime($blog['created_at'])); ?>
        </td>
    </tr>
    <tr>
        <th>Updated_at</th>
        <td>
            <?php if(!empty($blog['updated_at'])) echo date('d-m-Y H:i:s', strtotime($blog['updated_at'])); ?>
        </td>
    </tr>
</table>
<a class="btn btn-primary" href="http://localhost/mvc-tranninng/admin/blog">Back</a>