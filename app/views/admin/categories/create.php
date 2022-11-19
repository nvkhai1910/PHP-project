<h1 class="font-weight-bold text-dark">Form thêm mới danh mục</h1>
<form method="post"  action="" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Nhập tên danh mục</label>
        <input name="name" type="text" class="form-control" id="name" placeholder="">
        <span style="color: red;"> <?php echo (!empty($this->error['category']['name'])) ? $this->error['category']['name'] : ''; ?></span>
    </div>
    <div class="form-group">
        <label for="type">Loại danh mục</label>
        <select name="type" class="w-50 form-control">
            <option value="0">Product</option>
            <option value="1">News</option>
        </select>
    </div>
    <div class="form-group">
        <label for="avatar">Hình ảnh danh mục</label>
        <input type="file" name="avatar" value="" class="form-control" id="avatar" accept="image/*" onchange="loadFile(event)"/> <br>
        <img id="output" width="100" height="100"/>
    </div>
    <div class="form-group">
        <label for="description">Mô tả danh mục</label>
        <input name="description" type="text" class="form-control" id="description" placeholder="">
    </div>
    <div class="form-group">
        <label for="type">Trạng thái danh mục</label>
        <select name="status" class="w-50 form-control">
            <option value="0">Không kích hoạt</option>
            <option value="1">Kích hoạt</option>
        </select>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>