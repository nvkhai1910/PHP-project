<h1 class="font-weight-bold text-dark">Form sửa thông tin khách hàng</h1>
<form method="post"  action="">
    <div class="form-group">
        <label for="customer_name">Nhập tên khách hàng</label>
        <input value="<?php echo isset($customer['customer_name']) ? $customer['customer_name']:''; ?>" name="customer_name" type="text" class="form-control" id="customer_name" placeholder="">
    </div>
    <div class="form-group">
        <label for="phone">Nhập số điện thoại</label>
        <input value="<?php echo isset($customer['phone']) ? $customer['phone']:''; ?>" name="phone" type="text" class="form-control" id="phone" placeholder="">
    </div>
    <div class="form-group">
        <label for="email">Nhập email</label>
        <input value="<?php echo isset($customer['email']) ? $customer['email']:''; ?>" name="email" type="email" class="form-control" id="email" placeholder="">
        <span style="color: red;"> <?php echo (!empty($this->error['customer']['email'])) ? $this->error['customer']['email'] : ''; ?></span>
    </div>
    <div class="form-group">
        <label for="address">Nhập địa chỉ</label>
        <input value="<?php echo isset($customer['address']) ? $customer['address']:''; ?>" name="address" type="text" class="form-control" id="address" placeholder="">
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>