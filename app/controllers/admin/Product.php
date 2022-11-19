<?php
require_once 'app/models/Pagination.php';

class Product extends Controller
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
    $product_model = $this->model('ProductModel');
    $params = [
      'limit' => 5, //giới hạn 5 bản ghi 1 trang
      'query_string' => 'page',
      'controller' => 'product',
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
    $count_total = $product_model->countTotal();
    $params['total'] = $count_total;

    //gán biến name cho mảng params với key là name
    $params['page'] = $page;
    $pagination = new Pagination($params);
    //lấy ra html phân trang
    $pages = $pagination->getPagination();

    //lấy danh sách category sử dụng phân trang
    if (empty($keyword)) {
      $this->data['sub_content']['products'] = $product_model->getAllPagination($params);
      $this->data['sub_content']['pages'] = $pages;
    } else {
      $this->data['sub_content']['products'] = $product_model->getAll($keyword);
      $this->data['sub_content']['pages'] = false;
    }
    $category_model = $this->model('CategoryModel');
    $this->data['sub_content']['categories'] = $category_model->getAll();
    $this->data['page_title'] = 'Trang sản phẩm';
    $this->data['content'] = 'admin/products/index';
    $this->render('layouts/admin_main', $this->data);
  }
  public function create()
  {
    if (isset($_POST['submit'])) {
      $category_id = $_POST['category_id'];
      $title = $_POST['title'];
      $price = $_POST['price'];
      $amount = $_POST['amount'];
      $discount = $_POST['discount'];
      $summary = $_POST['summary'];
      $content = $_POST['content'];
      $seo_title = $_POST['seo_title'];
      $seo_description = $_POST['seo_description'];
      $seo_keywords = $_POST['seo_keywords'];
      $status = $_POST['status'];
      //xử lý validate
      if (empty($title)) {
        $this->error = 'Không được để trống title';
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
          $filename = time() . '-product-' . $_FILES['avatar']['name'];
          move_uploaded_file($_FILES['avatar']['tmp_name'], $dir_uploads . '/' . $filename);
        }
        //save dữ liệu vào bảng products
        $product_model = $this->model('ProductModel');
        $product_model->category_id = $category_id;
        $product_model->title = $title;
        $product_model->avatar = $filename;
        $product_model->price = $price;
        $product_model->amount = $amount;
        $product_model->discount = $discount;
        $product_model->summary = $summary;
        $product_model->content = $content;
        $product_model->seo_title = $seo_title;
        $product_model->seo_description = $seo_description;
        $product_model->seo_keywords = $seo_keywords;
        $product_model->status = $status;
        $is_insert = $product_model->insert();
        if ($is_insert) {
          $_SESSION['success'] = 'Insert dữ liệu thành công';
        } else {
          $_SESSION['error'] = 'Insert dữ liệu thất bại';
        }
        header('Location: http://localhost/mvc-tranninng/admin/product/');
        exit();
      }
    }
    //Lay category
    $category_model = $this->model('CategoryModel');
    $categories = $category_model->getAll();
    //Goi view
    $this->data['sub_content']['categories'] = $categories;
    $this->data['page_title'] = 'Trang thêm mới sản phẩm';
    $this->data['content'] = 'admin/products/create';
    $this->render('layouts/admin_main', $this->data);
  }
  public function update()
  {
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
      $_SESSION['error'] = 'ID không hợp lệ';
      header('Location: http://localhost/mvc-tranninng/admin/product');
      exit();
    }

    $id = $_GET['id'];
    $product_model = $this->model('ProductModel');
    $product = $product_model->getById($id);
    //xử lý submit form
    if (isset($_POST['submit'])) {
      $category_id = $_POST['category_id'];
      $title = $_POST['title'];
      $price = $_POST['price'];
      $amount = $_POST['amount'];
      $discount = $_POST['discount'];
      $summary = $_POST['summary'];
      $content = $_POST['content'];
      $seo_title = $_POST['seo_title'];
      $seo_description = $_POST['seo_description'];
      $seo_keywords = $_POST['seo_keywords'];
      $status = $_POST['status'];
      //xử lý validate
      if (empty($title)) {
        $this->error = 'Không được để trống title';
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
        $filename = $product['avatar'];
        //xử lý upload file nếu có
        if ($_FILES['avatar']['error'] == 0) {
          $dir_uploads = 'public/assets/admin/uploads';
          //xóa file cũ, thêm @ vào trước hàm unlink để tránh báo lỗi khi xóa file ko tồn tại
          @unlink($dir_uploads . '/' . $filename);
          if (!file_exists($dir_uploads)) {
            mkdir($dir_uploads);
          }
          //tạo tên file theo 1 chuỗi ngẫu nhiên để tránh upload file trùng lặp
          $filename = time() . '-product-' . $_FILES['avatar']['name'];
          move_uploaded_file($_FILES['avatar']['tmp_name'], $dir_uploads . '/' . $filename);
        }
        //save dữ liệu vào bảng products
        $product_model->category_id = $category_id;
        $product_model->title = $title;
        $product_model->avatar = $filename;
        $product_model->price = $price;
        $product_model->amount = $amount;
        $product_model->discount = $discount;
        $product_model->summary = $summary;
        $product_model->content = $content;
        $product_model->seo_title = $seo_title;
        $product_model->seo_description = $seo_description;
        $product_model->seo_keywords = $seo_keywords;
        $product_model->status = $status;
        $product_model->updated_at = date('Y-m-d H:i:s');

        $is_update = $product_model->update($id);
        if ($is_update) {
          $_SESSION['success'] = 'Update dữ liệu thành công';
        } else {
          $_SESSION['error'] = 'Update dữ liệu thất bại';
        }
        header('Location: http://localhost/mvc-tranninng/admin/product/');
        exit();
      }
    }

    $category_model = $this->model('CategoryModel');
    $categories = $category_model->getAll();
    $this->data['sub_content']['categories'] = $categories;
    $this->data['sub_content']['product'] = $product;

    $this->data['page_title'] = 'Trang sửa sản phẩm';
    $this->data['content'] = 'admin/products/update';
    $this->render('layouts/admin_main', $this->data);
  }
  public function detail()
  {
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
      $_SESSION['error'] = 'ID không hợp lệ';
      header('Location: http://localhost/mvc-tranninng/admin/product/index');
      exit();
    }

    $id = $_GET['id'];
    $product_model = $this->model('ProductModel');
    $this->data['sub_content']['product'] = $product_model->getById($id);
    $this->data['page_title'] = 'Trang chi tiết sản phẩm';
    $this->data['content'] = 'admin/products/detail';
    $this->render('layouts/admin_main', $this->data);
  }
  public function delete()
  {
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
      $_SESSION['error'] = 'ID không hợp lệ';
      header('Location: http://localhost/mvc-tranninng/admin/product/index');
      exit();
    }
    $id = $_GET['id'];
    $product_model = $this->model('ProductModel');
    $is_delete = $product_model->delete($id);
    if ($is_delete) {
      $_SESSION['success'] = 'Xóa dữ liệu thành công';
    } else {
      $_SESSION['error'] = 'Xóa dữ liệu thất bại';
    }
    header('Location: http://localhost/mvc-tranninng/admin/product/index');
    exit();
  }
}
