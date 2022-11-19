<?php 
    print_r($product);
?>
<h1 class="font-weight-bold text-dark">Form thêm mới sản phẩm</h1>
<form method="post" action=""  enctype="multipart/form-data">
    <div class="form-group">
        <label for="category_id">Chọn danh mục</label>
        <select name="category_id" class="form-control" id="category_id">
            <?php foreach ($categories as $category) :
                $selected = '';
                if (isset($product['category_id']) && $category['id'] == $product['category_id']) {
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
        <input value="<?php echo isset($product['title']) ? $product['title']:''; ?>" name="title" type="text" class="form-control" id="title" placeholder="">
    </div>
    <div class="form-group">
        <label for="avatar">Chọn ảnh</label>
        <input type="file" name="avatar" value="" class="form-control" id="avatar" accept="image/*" onchange="loadFile(event)"/> <br>
        <img src="<?php echo _WEB_ROOT_; ?>/public/assets/admin/uploads/<?php echo $product['avatar'] ?>" id="output" style="" width="100" height="100"/>
    </div>
    <div class="form-group">
        <label for="price">Giá</label>
        <input value="<?php echo isset($product['price']) ? $product['price']:''; ?>" name="price" type="text" class="form-control" id="price" placeholder="">
    </div>
    <div class="form-group">
        <label for="amount">Số lượng</label>
        <input value="<?php echo isset($product['amount']) ? $product['amount']:''; ?>" name="amount" type="text" class="form-control" id="amount" placeholder="">
    </div>
    <div class="form-group">
        <label for="discount">Giảm giá</label>
        <input value="<?php echo isset($product['discount']) ? $product['discount']:''; ?>" name="discount" type="number" class="form-control" id="discount" placeholder="">
    </div>
    <div class="form-group">
        <label for="summary">Mô tả ngắn sản phẩm</label>
        <textarea class="form-control" name="summary" id="summary" rows="3"><?php echo isset($product['summary']) ? $product['summary']:''; ?></textarea>
    </div>
    <div class="form-group">
        <label for="content">Mô tả chi tiết sản phẩm</label>
        <textarea class="form-control" name="content" id="content" rows="3"><?php echo isset($product['content']) ? $product['content']:''; ?></textarea>
    </div>
    <div class="form-group">
        <label for="seo_title">Seo title</label>
        <input value="<?php echo isset($product['seo_title']) ? $product['seo_title']:''; ?>" name="seo_title" type="text" class="form-control" id="seo_title" placeholder="">
    </div>
    <div class="form-group">
        <label for="seo_description">Seo description</label>
        <input value="<?php echo isset($product['seo_description']) ? $product['seo_description']:''; ?>" name="seo_description" type="text" class="form-control" id="seo_description" placeholder="">
    </div>
    <div class="form-group">
        <label for="seo_keywords">Seo keyword</label>
        <input value="<?php echo isset($product['seo_keywords']) ? $product['seo_keywords']:''; ?>" name="seo_keywords" type="text" class="form-control" id="seo_keywords" placeholder="">
    </div>
    <div class="form-group">
        <label for="status">Trạng thái danh mục</label>
        <select name="status" id="status" class="form-control">
            <option value="1" <?php if(isset($product['status']) && $product['status']==1) echo 'selected';?>>Kích hoạt</option>
            <option value="0" <?php if(isset($product['status']) && $product['status']==0) echo 'selected';?>>Không kích hoạt</option>
        </select>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Update</button>
</form>