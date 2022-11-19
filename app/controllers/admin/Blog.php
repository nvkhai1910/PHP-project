<?php
require_once 'app/models/Pagination.php';

class Blog extends Controller
{
    public $data = [];
    public function index()
    {
        $keyword = '';
        if (isset($_GET['submit'])) {
            $keyword = $_GET['keyword'];
            if (empty($this->error)) {
            }
        }
        //Gọi model
        $blog_model = $this->model('BlogModel');
        //do có sử dụng phân trang nên sẽ khai báo mảng các params
        $params = [
            'limit' => 5, //giới hạn 5 bản ghi 1 trang
            'query_string' => 'page',
            'controller' => 'blog',
            'action' => 'index',
            'full_mode' => FALSE,
        ];
        //    mặc đinh page hiện tại là 1
        $page = 1;
        //nếu có truyền tham số page lên trình duyêt - tương đương đang ở tại trang nào, thì gán giá trị đó cho biến $page
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }
        //xử lý form tìm kiếm
        // if (isset($_GET['keyword'])) {
        //     $params['query_additional'] = '&name=' . $_GET['keyword'];
        // }

        //lấy tổng số bản ghi dựa theo các điều kiện có được từ mảng params truyền vào
        $count_total = $blog_model->countTotal();
        $params['total'] = $count_total;

        //gán biến name cho mảng params với key là name
        $params['page'] = $page;
        $pagination = new Pagination($params);
        //lấy ra html phân trang
        $pages = $pagination->getPagination();

        //lấy danh sách blog sử dụng phân trang
        $blog_model->getAllPagination($params);
        //lấy ra all bản ghi danh mục
        if (empty($keyword)) {
            $this->data['sub_content']['blogs'] = $blog_model->getAllPagination($params);
            $this->data['sub_content']['pages'] = $pages;
        } else {
            $this->data['sub_content']['blogs'] = $blog_model->getAll($keyword);
            $this->data['sub_content']['pages'] = false;
        }
        //Gọi view, page_title
        $this->data['page_title'] = 'Trang quản lý blog';
        $this->data['content'] = 'admin/blogs/index';
        $this->render('layouts/admin_main', $this->data);
    }
    public function detail()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = 'Tham so id khong hop le';
            header('Location: http://localhost/mvc-tranninng/admin/blog');
            exit();
        }
        $id = $_GET['id'];
        $blog_model = $this->model('BlogModel');
        $blog = $blog_model->getById($id);

        $this->data['sub_content']['blog'] = $blog;
        $this->data['page_title'] = 'Trang chi tiết blog';
        $this->data['content'] = 'admin/blogs/detail';
        $this->render('layouts/admin_main', $this->data);
    }
    public function create()
    {
        if (isset($_POST['submit'])) {
            $title = $_POST['title'];
            $summary = $_POST['summary'];
            $content = $_POST['content'];
            $status = $_POST['status'];
            //xử lý validate
            if (empty($title)) {
                $this->error['blog']['title'] = 'Không được để trống title';
            } elseif ($_FILES['avatar']['error'] == 0) {
                //validate khi có file upload lên thì bắt buộc phải là ảnh và dung lượng không quá 2 Mb
                $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
                $extension = strtolower($extension);
                $arr_extension = ['jpg', 'jpeg', 'png', 'gif'];

                $file_size_mb = $_FILES['avatar']['size'] / 1024 / 1024;
                //làm tròn theo đơn vị thập phân
                $file_size_mb = round($file_size_mb, 2);

                if (!in_array($extension, $arr_extension)) {
                    $this->error = 'Cần upload file định dạng ảnh';
                } else if ($file_size_mb > 2) {
                    $this->error = 'File upload không được quá 2MB';
                }
            }

            //nếu ko có lỗi thì tiến hành save dữ liệu
            if (empty($this->error)) {
                $filename = '';
                //xử lý upload file nếu có
                if ($_FILES['avatar']['error'] == 0) {
                    $dir_uploads = 'public/assets/admin/uploads';
                    if (!file_exists($dir_uploads)) {
                        mkdir($dir_uploads);
                    }
                    //tạo tên file theo 1 chuỗi ngẫu nhiên để tránh upload file trùng lặp
                    $filename = time() . '-blog-' . $_FILES['avatar']['name'];
                    move_uploaded_file($_FILES['avatar']['tmp_name'], $dir_uploads . '/' . $filename);
                }
                //save dữ liệu vào bảng blogs
                $blog_model = $this->model('BlogModel');
                $blog_model->title = $title;
                $blog_model->summary = $summary;
                $blog_model->content = $content;
                $blog_model->avatar = $filename;
                $blog_model->status = $status;
                $is_insert = $blog_model->insert();
                if ($is_insert) {
                    $_SESSION['success'] = 'Insert dữ liệu thành công';
                } else {
                    $_SESSION['error'] = 'Insert dữ liệu thất bại';
                }
                header('Location: http://localhost/mvc-tranninng/admin/blog');
                exit();
            }
        }
        $this->data['sub_content'] = [];
        $this->data['page_title'] = 'Trang thêm mới blog';
        $this->data['content'] = 'admin/blogs/create';
        $this->render('layouts/admin_main', $this->data);
    }
    public function update()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = 'ID không hợp lệ';
            header('Location: http://localhost/mvc-tranninng/admin/blog');
            exit();
        }

        $id = $_GET['id'];
        $blog_model = $this->model('BlogModel');
        $blog = $blog_model->getById($id);
        //xử lý submit form
        if (isset($_POST['submit'])) {
            $title = $_POST['title'];
            $summary = $_POST['summary'];
            $content = $_POST['content'];
            $status = $_POST['status'];
            //xử lý validate
            if (empty($title)) {
                $this->error['blog']['title'] = 'Không được để trống title';
            } else if ($_FILES['avatar']['error'] == 0) {
                //validate khi có file upload lên thì bắt buộc phải là ảnh và dung lượng không quá 2 Mb
                $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
                $extension = strtolower($extension);
                $arr_extension = ['jpg', 'jpeg', 'png', 'gif'];

                $file_size_mb = $_FILES['avatar']['size'] / 1024 / 1024;
                //làm tròn theo đơn vị thập phân
                $file_size_mb = round($file_size_mb, 2);

                if (!in_array($extension, $arr_extension)) {
                    $this->error = 'Cần upload file định dạng ảnh';
                } else if ($file_size_mb > 2) {
                    $this->error = 'File upload không được quá 2MB';
                }
            }

            //nếu ko có lỗi thì tiến hành save dữ liệu
            if (empty($this->error)) {
                $filename = $blog['avatar'];
                //xử lý upload file nếu có
                if ($_FILES['avatar']['error'] == 0) {
                    $dir_uploads = 'public/assets/admin/uploads';
                    //xóa file cũ, thêm @ vào trước hàm unlink để tránh báo lỗi khi xóa file ko tồn tại
                    @unlink($dir_uploads . '/' . $filename);
                    if (!file_exists($dir_uploads)) {
                        mkdir($dir_uploads);
                    }
                    //tạo tên file theo 1 chuỗi ngẫu nhiên để tránh upload file trùng lặp
                    $filename = time() . '-blog-' . $_FILES['avatar']['name'];
                    move_uploaded_file($_FILES['avatar']['tmp_name'], $dir_uploads . '/' . $filename);
                }
                //save dữ liệu vào bảng blogs
                $blog_model->title = $title;
                $blog_model->summary = $summary;
                $blog_model->content = $content;
                $blog_model->avatar = $filename;
                $blog_model->status = $status;
                $blog_model->updated_at = date('Y-m-d H:i:s');

                $is_update = $blog_model->update($id);
                if ($is_update) {
                    $_SESSION['success'] = 'Update dữ liệu thành công';
                } else {
                    $_SESSION['error'] = 'Update dữ liệu thất bại';
                }
                header('Location: http://localhost/mvc-tranninng/admin/blog');
                exit();
            }
        }
        $this->data['sub_content']['blog'] = $blog;
        $this->data['page_title'] = 'Trang sửa blog';
        $this->data['content'] = 'admin/blogs/update';
        $this->render('layouts/admin_main', $this->data);
    }
    public function delete()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = 'ID không hợp lệ';
            header('Location: http://localhost/mvc-tranninng/admin/blog/index');
            exit();
        }

        $id = $_GET['id'];
        $blog_model = $this->model('BlogModel');
        $is_delete = $blog_model->delete($id);
        if ($is_delete) {
            $_SESSION['success'] = 'Xóa dữ liệu thành công';
        } else {
            $_SESSION['error'] = 'Xóa dữ liệu thất bại';
        }
        header('Location: http://localhost/mvc-tranninng/admin/blog/index');
        exit();
    }
}
