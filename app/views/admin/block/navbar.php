<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Gentelella Alela!</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="<?php echo _WEB_ROOT_; ?>/public/assets/admin/images/<?php echo $_SESSION['user']['avatar']; ?>" alt="<?php echo _WEB_ROOT_; ?>/public/assets/admin." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $_SESSION['user']['name']; ?></h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li><a href="http://localhost/mvc-tranninng/admin/dashboard/index"><i class="fa fa-home"></i> Home </a></li>
                    <li><a href="http://localhost/mvc-tranninng/admin/category/index"><i class="fa fa-edit"></i> Quản lý danh mục </a></li>
                    <li><a href="http://localhost/mvc-tranninng/admin/product/index"><i class="fa fa-desktop"></i> Quản lý sản phẩm </a></li>
                    <li><a href="http://localhost/mvc-tranninng/admin/customer/index"><i class="fa fa-table"></i> Quản lý khách hàng</a></li>
                    <li><a href="http://localhost/mvc-tranninng/admin/order/index"><i class="fa fa-bar-chart-o"></i> Quản lý order</a></li>
                    <li><a href="http://localhost/mvc-tranninng/admin/orderdetail/index"><i class="fa fa-clone"></i>Chi tiết order</a></li>
                    <li><a href="http://localhost/mvc-tranninng/admin/blog/index"><i class="fa fa-newspaper-o"></i>Quản lý blog</a></li>
                    <li><a href="http://localhost/mvc-tranninng/admin/message/index"><i class="fa fa-envelope"></i>Quản lý lời nhắn</a></li>
                </ul>
            </div>
            <div class="menu_section">
            </div>

        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="http://localhost/mvc-tranninng/admin/user/logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>