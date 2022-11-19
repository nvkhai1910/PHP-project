<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- doan code nay co tac dung set lai url goc cho toan bo cac trang -->
    <base href="<?php echo $_SERVER['SCRIPT_NAME'] ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <!-- Google Font -->
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT_; ?>/public/assets/client/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT_; ?>/public/assets/client/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT_; ?>/public/assets/client/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT_; ?>/public/assets/client/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT_; ?>/public/assets/client/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT_; ?>/public/assets/client/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT_; ?>/public/assets/client/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT_; ?>/public/assets/client/css/style.css" type="text/css">
</head>

<body>
    <?php $this->render('block/header'); ?>
    <?php $this->render($content, $sub_content); ?>
    <?php $this->render('block/footer'); ?>

    <!-- Js Plugins -->
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="<?php echo _WEB_ROOT_; ?>/public/assets/client/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo _WEB_ROOT_; ?>/public/assets/client/js/bootstrap.min.js"></script>
    <script src="<?php echo _WEB_ROOT_; ?>/public/assets/client/js/jquery.nice-select.min.js"></script>
    <script src="<?php echo _WEB_ROOT_; ?>/public/assets/client/js/jquery-ui.min.js"></script>
    <script src="<?php echo _WEB_ROOT_; ?>/public/assets/client/js/jquery.slicknav.js"></script>
    <script src="<?php echo _WEB_ROOT_; ?>/public/assets/client/js/mixitup.min.js"></script>
    <script src="<?php echo _WEB_ROOT_; ?>/public/assets/client/js/owl.carousel.min.js"></script>
    <script src="<?php echo _WEB_ROOT_; ?>/public/assets/client/js/main.js"></script>
    <script src="<?php echo _WEB_ROOT_; ?>/public/assets/client/js/script.js"></script>

</body>

</html>