<h1 class="font-weight-bold text-dark">Form thêm mới blog</h1>
<form method="post"  action="" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Nhập tiêu đề tin tức</label>
        <input name="title" type="text" class="form-control" id="title" placeholder="">
        <span style="color: red;"> <?php echo (!empty($this->error['blog']['title'])) ? $this->error['blog']['title'] : ''; ?></span>
    </div>
    <div class="form-group">
        <label for="summary">Mô tả ngắn cho tin tức</label>
        <textarea class="form-control" name="summary" id="editor1" rows="3"></textarea>
    </div>
    <div class="form-group">
        <label for="content">Nội dung tin tức</label>
        <textarea class="form-control" name="content" id="editor2" rows="5"></textarea>
    </div>
    <div class="form-group">
        <label for="avatar">Hình ảnh tin tức</label>
        <input type="file" name="avatar" value="" class="form-control" id="avatar" accept="image/*" onchange="loadFile(event)"/> <br>
        <img id="output" width="100" height="100"/>
    </div>
    <div class="form-group">
        <label for="type">Trạng thái danh mục</label>
        <select name="status" class="w-50 form-control">
            <option value="1">Kích hoạt</option>
            <option value="0">Không kích hoạt</option>
        </select>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>