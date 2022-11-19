<h1 class="font-weight-bold text-dark">Form sửa danh mục</h1>
<form method="post"  action="" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Nhập tên danh mục</label>
        <input value="<?php echo isset($category['name']) ? $category['name']:''; ?>" name="name" type="text" class="form-control" id="name" placeholder="">
        <span style="color: red;"> <?php echo (!empty($this->error['category']['name'])) ? $this->error['category']['name'] : ''; ?></span>
    </div>
    <div class="form-group">
        <label for="type">Loại danh mục</label>
        <select name="type" class="w-50 form-control">
            <option value="0" <?php if(isset($category['type']) && $category['type']==0) echo 'selected';?>>Product</option>
            <option value="1" <?php if(isset($category['type']) && $category['type']==1) echo 'selected';?>>News</option>
        </select>
    </div>
    <div class="form-group">
        <label for="avatar">Hình ảnh danh mục</label>
        <input accept="image/*" onchange="loadFile(event)" type="file" name="avatar" value="" class="form-control" id="avatar"/> <br>
        <img src="<?php echo _WEB_ROOT_; ?>/public/assets/admin/uploads/<?php echo $category['avatar'] ?>" id="output" style="" width="100" height="100"/>
    </div>
    <div class="form-group">
        <label for="description">Mô tả danh mục</label>
        <input value="<?php echo isset($category['description']) ? $category['description']:''; ?>" name="description" type="text" class="form-control" id="description" placeholder="">
    </div>
    <div class="form-group">
        <label for="type">Trạng thái danh mục</label>
        <select name="status" class="w-50 form-control">
            <option value="0" <?php if(isset($category['status']) && $category['status']==0) echo 'selected';?>>Không kích hoạt</option>
            <option value="1" <?php if(isset($category['status']) && $category['status']==1) echo 'selected';?>>Kích hoạt</option>
        </select>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>