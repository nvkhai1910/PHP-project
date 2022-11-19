<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng ký</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="<?php echo _WEB_ROOT_; ?>/public/assets/customer/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="<?php echo _WEB_ROOT_; ?>/public/assets/customer/css/style.css">
</head>
<body>

    <div class="container">
        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" class="register-form" id="register-form">
                            <div class="form-group">
                                <label for="username"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="username" id="username" placeholder="Username"/>
                            </div>
                            <span style="color: red;"><?php echo (!empty($this->error['customer']['username'])) ? $this->error['customer']['username'] : ''; ?></span>
                            <div class="form-group">
                                <label for="password"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="Password"/>
                            </div>
                            <span style="color: red;"> <?php echo (!empty($this->error['customer']['password'])) ? $this->error['customer']['password'] : ''; ?></span>
                            <div class="form-group">
                                <label for="password_confirm"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="password_confirm" id="password_confirm" placeholder="Repeat your password"/>
                            </div>
                            <span style="color: red;"> <?php echo (!empty($this->error['customer']['password_confirm'])) ? $this->error['customer']['password_confirm'] : ''; ?></span>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email"/>
                            </div>
                            <span style="color: red;"> <?php echo (!empty($this->error['customer']['email'])) ? $this->error['customer']['email'] : ''; ?></span>
                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="submit" id="submit" class="form-submit" value="Register"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="<?php echo _WEB_ROOT_; ?>/public/assets/customer/images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="http://localhost/mvc-tranninng/client/index" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="<?php echo _WEB_ROOT_; ?>/public/assets/customer/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo _WEB_ROOT_; ?>/public/assets/customer/js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>