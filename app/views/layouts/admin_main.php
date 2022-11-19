<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo _WEB_ROOT_; ?>/public/assets/admin/images/favicon.ico" type="image/ico" />

    <title><?php echo $page_title; ?></title>
    <!-- Bootstrap -->
    <link href="<?php echo _WEB_ROOT_; ?>/public/assets/admin/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo _WEB_ROOT_; ?>/public/assets/admin/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo _WEB_ROOT_; ?>/public/assets/admin/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo _WEB_ROOT_; ?>/public/assets/admin/vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="<?php echo _WEB_ROOT_; ?>/public/assets/admin/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo _WEB_ROOT_; ?>/public/assets/admin/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo _WEB_ROOT_; ?>/public/assets/admin/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo _WEB_ROOT_; ?>/public/assets/admin/build/css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <?php $this->render('admin/block/navbar') ?>
            <?php $this->render('admin/block/header') ?>
            <div class="right_col" role="main">
                <?php $this->render($content, $sub_content); ?>
            </div>
            <?php $this->render('admin/block/footer') ?>
        </div>
    </div>


    <!-- jQuery -->
    <script src="<?php echo _WEB_ROOT_; ?>/public/assets/admin/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo _WEB_ROOT_; ?>/public/assets/admin/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo _WEB_ROOT_; ?>/public/assets/admin/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo _WEB_ROOT_; ?>/public/assets/admin/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="<?php echo _WEB_ROOT_; ?>/public/assets/admin/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="<?php echo _WEB_ROOT_; ?>/public/assets/admin/vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?php echo _WEB_ROOT_; ?>/public/assets/admin/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo _WEB_ROOT_; ?>/public/assets/admin/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="<?php echo _WEB_ROOT_; ?>/public/assets/admin/vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="<?php echo _WEB_ROOT_; ?>/public/assets/admin/vendors/Flot/jquery.flot.js"></script>
    <script src="<?php echo _WEB_ROOT_; ?>/public/assets/admin/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="<?php echo _WEB_ROOT_; ?>/public/assets/admin/vendors/Flot/jquery.flot.time.js"></script>
    <script src="<?php echo _WEB_ROOT_; ?>/public/assets/admin/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="<?php echo _WEB_ROOT_; ?>/public/assets/admin/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="<?php echo _WEB_ROOT_; ?>/public/assets/admin/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="<?php echo _WEB_ROOT_; ?>/public/assets/admin/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="<?php echo _WEB_ROOT_; ?>/public/assets/admin/vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="<?php echo _WEB_ROOT_; ?>/public/assets/admin/vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="<?php echo _WEB_ROOT_; ?>/public/assets/admin/vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="<?php echo _WEB_ROOT_; ?>/public/assets/admin/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="<?php echo _WEB_ROOT_; ?>/public/assets/admin/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo _WEB_ROOT_; ?>/public/assets/admin/vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo _WEB_ROOT_; ?>/public/assets/admin/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="<?php echo _WEB_ROOT_; ?>/public/assets/admin/ckeditor/ckeditor.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo _WEB_ROOT_; ?>/public/assets/admin/build/js/custom.min.js"></script>
    <script>
        var loadFile = function(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('output');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        };
        CKEDITOR.replace('editor1');
        CKEDITOR.replace('editor2');

    </script>
</body>

</html>