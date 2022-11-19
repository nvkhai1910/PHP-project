<?php
require_once 'app/models/Pagination.php';

class Category extends Controller
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
        $category_model = $this->model('CategoryModel');
        //do có sử dụng phân trang nên sẽ khai báo mảng các params
        $params = [
            'limit' => 5, //giới hạn 5 bản ghi 1 trang
            'query_string' => 'page',
            'controller' => 'category',
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
        $count_total = $category_model->countTotal();
        $params['total'] = $count_total;

        //gán biến name cho mảng params với key là name
        $params['page'] = $page;
        $pagination = new Pagination($params);
        //lấy ra html phân trang
        $pages = $pagination->getPagination();

        //lấy danh sách category sử dụng phân trang
        $category_model->getAllPagination($params);
        //lấy ra all bản ghi danh mục
        if(empty($keyword)){
            $this->data['sub_content']['categories'] = $category_model->getAllPagination($params);
            $this->data['sub_content']['pages'] = $pages;
        }else{
            $this->data['sub_content']['categories'] = $category_model->getAll($keyword);
            $this->data['sub_content']['pages'] = false;
        }
        //Gọi view, page_title
        $this->data['page_title'] = 'Trang danh mục sản phẩm';
        $this->data['content'] = 'admin/categories/index';
        $this->render('layouts/admin_main', $this->data);
    }
    public function create()
    {
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $type = $_POST['type'];
            $description = $_POST['description'];
            $status = $_POST['status'];
            if (empty($name)) {
                $this->error['category']['name'] = "Không được bỏ trống tên danh mục";
            } elseif ($_FILES['avatar']['error'] == 0) {
                //validate khi có file upload lên thì bắt buộc phải là ảnh và dung lượng không quá 2 Mb
                $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
                $extension = strtolower($extension);
                $arr_extension = ['jpg', 'jpeg', 'png', 'gif'];

                $file_size_mb = $_FILES['avatar']['size'] / 1024 / 1024;
                //làm tròn theo đơn vị thập phân
                $file_size_mb = round($file_size_mb, 2);

                if (!in_array($extension, $arr_extension)) {
                    $this->error['category']['avatar'] = 'Cần upload file định dạng ảnh';
                } else if ($file_size_mb > 2) {
                    $this->error['category']['avatar'] = 'File upload không được quá 2MB';
                }
            }
            if (empty($this->error['category'])) {
                $filename = '';
                //xử lý upload file nếu có
                if ($_FILES['avatar']['error'] == 0) {
                    $dir_uploads = 'public/assets/admin/uploads';
                    if (!file_exists($dir_uploads)) {
                        mkdir($dir_uploads);
                    }
                    //tạo tên file theo 1 chuỗi ngẫu nhiên để tránh upload file trùng lặp
                    $filename = time() . '-product-' . $_FILES['avatar']['name'];
                    move_uploaded_file($_FILES['avatar']['tmp_name'], $dir_uploads . '/' . $filename);
                }
                $category_model = $this->model('CategoryModel');
                $is_create = $category_model->create($name, $type, $filename, $description, $status);
                if ($is_create) {
                    $_SESSION['success'] = 'Insert dữ liệu thành công';
                } else {
                    $_SESSION['error'] = 'Insert dữ liệu thất bại';
                }
                header('Location: http://localhost/mvc-tranninng/admin/category/');
                exit();
            }
        }

        $this->data['sub_content'] = [];
        $this->data['page_title'] = 'Trang thêm mới danh mục sản phẩm';
        $this->data['content'] = 'admin/categories/create';
        $this->render('layouts/admin_main', $this->data);
    }
    public function update()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = 'Tham so id khong hop le';
            header('Location: http://localhost/mvc-tranninng/admin/category/');
            exit();
        }
        $id = $_GET['id'];
        $category_model = $this->model('CategoryModel');
        $category = $category_model->getById($id);

        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $type = $_POST['type'];
            $description = $_POST['description'];
            $status = $_POST['status'];
            if (empty($name)) {
                $this->error['category']['name'] = "Không được bỏ trống tên danh mục";
            } else if ($_FILES['avatar']['error'] == 0) {
                //validate khi có file upload lên thì bắt buộc phải là ảnh và dung lượng không quá 2 Mb
                $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
                $extension = strtolower($extension);
                $arr_extension = ['jpg', 'jpeg', 'png', 'gif'];

                $file_size_mb = $_FILES['avatar']['size'] / 1024 / 1024;
                //làm tròn theo đơn vị thập phân
                $file_size_mb = round($file_size_mb, 2);

                if (!in_array($extension, $arr_extension)) {
                    $this->error['category']['avatar'] = 'Cần upload file định dạng ảnh';
                } else if ($file_size_mb > 2) {
                    $this->error['category']['avatar'] = 'File upload không được quá 2MB';
                }
            }
            if (empty($this->error['category'])) {
                $filename = $category['avatar'];
                //xử lý upload file nếu có
                if ($_FILES['avatar']['error'] == 0) {
                    $dir_uploads = 'public/assets/admin/uploads';
                    //xóa file cũ, thêm @ vào trước hàm unlink để tránh báo lỗi khi xóa file ko tồn tại
                    @unlink($dir_uploads . '/' . $filename);
                    if (!file_exists($dir_uploads)) {
                        mkdir($dir_uploads);
                    }
                    //tạo tên file theo 1 chuỗi ngẫu nhiên để tránh upload file trùng lặp
                    $filename = time() . '-category-' . $_FILES['avatar']['name'];
                    move_uploaded_file($_FILES['avatar']['tmp_name'], $dir_uploads . '/' . $filename);
                }
                //save dữ liệu vào bảng products
                $is_update = $category_model->update($name, $type, $filename, $description, $status, $id);
                if ($is_update) {
                    $_SESSION['success'] = 'Update dữ liệu thành công';
                } else {
                    $_SESSION['error'] = 'Update dữ liệu thất bại';
                }
                header('Location: http://localhost/mvc-tranninng/admin/category/');
                exit();
            }
        }

        //view
        $this->data['sub_content']['category'] = $category;
        $this->data['page_title'] = 'Trang sửa danh mục sản phẩm';
        $this->data['content'] = 'admin/categories/update';
        $this->render('layouts/admin_main', $this->data);
    }
    public function delete()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = 'Tham so id khong hop le';
            header('Location: http://localhost/mvc-tranninng/admin/category/');
            exit();
        }
        $id = $_GET['id'];
        $category_model = $this->model('CategoryModel');
        $is_delete = $category_model->delete($id);
        if ($is_delete) {
            $_SESSION['success'] = 'Xoa thanh cong';
        } else {
            $_SESSION['success'] = 'Xoa that bai';
        }
        header('Location: http://localhost/mvc-tranninng/admin/category/');
        exit();
    }
    public function detail()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = 'Tham so id khong hop le';
            header('Location: http://localhost/mvc-tranninng/admin/category/');
            exit();
        }
        $id = $_GET['id'];
        $category_model = $this->model('CategoryModel');
        $category = $category_model->getById($id);

        $this->data['sub_content']['category'] = $category;
        $this->data['page_title'] = 'Trang chi tiết danh mục sản phẩm';
        $this->data['content'] = 'admin/categories/detail';
        $this->render('layouts/admin_main', $this->data);
    }
}
