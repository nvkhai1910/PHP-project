<h1>Chi tiết category</h1>

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <td><?php echo $category['id']; ?></td>
    </tr>
    <tr>
        <th>Name</th>
        <td><?php echo $category['name']; ?></td>
    </tr>
    <tr>
        <th>Hình ảnh</th>
        <td>
            <?php if (!empty($category['avatar'])) : ?>
                <img height="80" src="<?php echo _WEB_ROOT_; ?>/public/assets/admin/uploads/<?php echo $category['avatar'] ?>" />
            <?php endif; ?>
        </td>
    </tr>
    <tr>
        <th>Description</th>
        <td><?php echo $category['description']; ?></td>
    </tr>
    <tr>
        <th>Status</th>
        <td>
            <?php
            $status_text = 'Active';
            if ($category['status'] == 0) {
                $status_text = 'Disabled';
            }
            echo $status_text;
            ?>
        </td>
    </tr>
    <tr>
        <th>Created_at</th>
        <td>
            <?php echo date('d-m-Y H:i:s', strtotime($category['created_at'])); ?>
        </td>
    </tr>
    <tr>
        <th>Updated_at</th>
        <td>
            <?php  if(!empty($category['updated_at'])) echo date('d-m-Y H:i:s', strtotime($category['updated_at'])); ?>
        </td>
    </tr>
</table>
<a class="btn btn-primary" href="http://localhost/mvc-tranninng/admin/category/">Back</a>