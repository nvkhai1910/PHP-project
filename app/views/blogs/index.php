<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="<?php echo _WEB_ROOT_; ?>/public/assets/client/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Blog</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Blog Section Begin -->
<section class="blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-5">
                <div class="blog__sidebar">
                    <div class="blog__sidebar__search">
                        <form action="" method="get">
                            <input type="text" name="keyword" placeholder="Search...">
                            <button type="submit" name="submit"><span class="icon_search"></span></button>
                        </form>
                    </div>
                    <div class="blog__sidebar__item">
                        <h4>Categories</h4>
                        <ul>
                            <li><a href="#">All</a></li>
                            <li><a href="#">Beauty (20)</a></li>
                            <li><a href="#">Food (5)</a></li>
                            <li><a href="#">Life Style (9)</a></li>
                            <li><a href="#">Travel (10)</a></li>
                        </ul>
                    </div>
                    <div class="blog__sidebar__item">
                        <h4>Recent News</h4>
                        <div class="blog__sidebar__recent">
                            <?php foreach ($blogs_new as $blog) : ?>
                                <a href="http://localhost/mvc-tranninng/blog/detail/<?php echo $blog['id'] ?>" class="blog__sidebar__recent__item">
                                    <div class="blog__sidebar__recent__item__pic">
                                        <img width="70px" height="70px" src="<?php echo _WEB_ROOT_; ?>/public/assets/admin/uploads/<?php echo $blog['avatar'] ?>" alt="">
                                    </div>
                                    <div class="blog__sidebar__recent__item__text">
                                        <h6><?php echo $blog['title'] ?></h6>
                                        <span>MAR 05, 2019</span>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-7">
                <div class="row">
                    <?php foreach ($blogs as $blog) : ?>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="blog__item">
                                <div class="blog__item__pic">
                                    <img src="<?php echo _WEB_ROOT_; ?>/public/assets/admin/uploads/<?php echo $blog['avatar'] ?>" alt="">
                                </div>
                                <div class="blog__item__text">
                                    <ul>
                                        <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                        <li><i class="fa fa-comment-o"></i> 5</li>
                                    </ul>
                                    <h5><a href="http://localhost/mvc-tranninng/blog/detail/<?php echo $blog['id'] ?>"><?php echo $blog['title'] ?></a></h5>
                                    <p> <?php echo $blog['summary'] ?> </p>
                                    <a href="http://localhost/mvc-tranninng/blog/detail/<?php echo $blog['id'] ?>" class="blog__btn">READ MORE <span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="col-lg-12">
                        <nav aria-label="Page navigation example"> <?php echo isset($pages) ? $pages : ''; ?> </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Section End -->