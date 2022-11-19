<h1 class="font-weight-bold text-dark">Form thêm mới khách hàng</h1>
<form method="post"  action="">
    <div class="form-group">
        <label for="username">Nhập tên đăng nhập</label>
        <input name="username" type="text" class="form-control" id="username" placeholder="">
        <span style="color: red;"> <?php echo (!empty($this->error['customer']['username'])) ? $this->error['customer']['username'] : ''; ?></span>
    </div>
    <div class="form-group">
        <label for="password">Nhập mật khẩu</label>
        <input name="password" type="password" class="form-control" id="password" placeholder="">
        <span style="color: red;"> <?php echo (!empty($this->error['customer']['password'])) ? $this->error['customer']['password'] : ''; ?></span>
    </div>
    <div class="form-group">
        <label for="password_confirm">Nhập lại mật khẩu</label>
        <input name="password_confirm" type="password" class="form-control" id="password_confirm" placeholder="">
        <span style="color: red;"> <?php echo (!empty($this->error['customer']['password_confirm'])) ? $this->error['customer']['password_confirm'] : ''; ?></span>
    </div>
    <div class="form-group">
        <label for="customer_name">Nhập tên khách hàng</label>
        <input name="customer_name" type="text" class="form-control" id="customer_name" placeholder="">
    </div>
    <div class="form-group">
        <label for="phone">Nhập số điện thoại</label>
        <input name="phone" type="text" class="form-control" id="phone" placeholder="">
    </div>
    <div class="form-group">
        <label for="email">Nhập email</label>
        <input name="email" type="email" class="form-control" id="email" placeholder="">
        <span style="color: red;"> <?php echo (!empty($this->error['customer']['email'])) ? $this->error['customer']['email'] : ''; ?></span>
    </div>
    <div class="form-group">
        <label for="address">Nhập địa chỉ</label>
        <input name="address" type="text" class="form-control" id="address" placeholder="">
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>