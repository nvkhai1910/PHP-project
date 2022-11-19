<h1 class="font-weight-bold text-dark">Form thêm mới sản phẩm</h1>
<form method="post" action=""  enctype="multipart/form-data">
    <div class="form-group">
        <label for="category_id">Chọn danh mục</label>
        <select name="category_id" class="form-control" id="category_id">
            <?php foreach ($categories as $category) :
                $selected = '';
                if (isset($_POST['category_id']) && $category['id'] == $_POST['category_id']) {
                    $selected = 'selected';
                }
            ?>
                <option value="<?php echo $category['id'] ?>" <?php echo $selected; ?>>
                    <?php echo $category['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="title">Nhập tên sản phẩm</label>
        <input name="title" type="text" class="form-control" id="title" placeholder="">
    </div>
    <div class="form-group">
        <label for="avatar">Chọn ảnh</label>
        <input type="file" name="avatar" value="" class="form-control" id="avatar" accept="image/*" onchange="loadFile(event)"/> <br>
        <img src="#" id="output" width="100" height="100"/>
    </div>
    <div class="form-group">
        <label for="price">Giá</label>
        <input name="price" type="text" class="form-control" id="price" placeholder="">
    </div>
    <div class="form-group">
        <label for="amount">Số lượng</label>
        <input name="amount" type="text" class="form-control" id="amount" placeholder="">
    </div>
    <div class="form-group">
        <label for="discount">Giảm giá</label>
        <input name="discount" type="number" class="form-control" id="discount" placeholder="">
    </div>
    <div class="form-group">
        <label for="summary">Mô tả ngắn sản phẩm</label>
        <textarea class="form-control" name="summary" id="summary" rows="3"></textarea>
    </div>
    <div class="form-group">
        <label for="content">Mô tả chi tiết sản phẩm</label>
        <textarea class="form-control" name="content" id="content" rows="3"></textarea>
    </div>
    <div class="form-group">
        <label for="seo_title">Seo title</label>
        <input name="seo_title" type="text" class="form-control" id="seo_title" placeholder="">
    </div>
    <div class="form-group">
        <label for="seo_description">Seo description</label>
        <input name="seo_description" type="text" class="form-control" id="seo_description" placeholder="">
    </div>
    <div class="form-group">
        <label for="seo_keywords">Seo keyword</label>
        <input name="seokeywords" type="text" class="form-control" id="seo_keywords" placeholder="">
    </div>
    <div class="form-group">
        <label for="status">Trạng thái danh mục</label>
        <select name="status" id="status" class="form-control">
            <option value="1">Kích hoạt</option>
            <option value="0">Không kích hoạt</option>
        </select>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Thêm mới</button>
</form>