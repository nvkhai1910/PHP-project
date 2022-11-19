<?php
require_once 'app/models/PaginationClient.php';
class Shop extends ControllerClient
{
  public $data = [];

  public function index($category_id = '')
  {
    $category_model = $this->model('CategoryModel');
    $product_model = $this->model('ProductModel');

    $params = [
      'limit' => 12, //giới hạn 12 bản ghi 1 trang
      'query_string' => 'page',
      'controller' => 'shop',
      'action' => 'index',
      'full_mode' => FALSE,
    ];
    // mặc đinh page hiện tại là 1
    $page = 1;
    if (isset($_GET['page'])) {
      $page = $_GET['page'];
    }

    //lấy tổng số bản ghi dựa theo các điều kiện có được từ mảng params truyền vào
    $count_total = $product_model->countTotal();
    $params['total'] = $count_total;

    //gán biến name cho mảng params với key là name
    $params['page'] = $page;

    $pagination = new PaginationClient($params);
    //lấy ra html phân trang
    $pages = $pagination->getPagination();

    $this->data['sub_content']['categories'] = $category_model->getAll();
    $this->data['sub_content']['products_discount'] = $product_model->getByDiscount();

    if (!empty($category_id) && is_numeric($category_id)) {
      $this->data['sub_content']['products'] = $product_model->getByCategory($category_id);
      $this->data['sub_content']['pages'] = false;
      $this->data['sub_content']['count_total'] = '';
    } else {
      $this->data['sub_content']['products'] = $product_model->getAllPagination($params);
      $this->data['sub_content']['pages'] = $pages;
      $this->data['sub_content']['count_total'] = $count_total;
    }

    $this->data['page_title'] = 'Trang sản phẩm';
    $this->data['content'] = 'shop/index';
    $this->render('layouts/client_main', $this->data);
  }
  public function detail($product_id)
  {
    $product_model = $this->model('ProductModel');
    $product =  $product_model->getById($product_id);
    $category_id = $product['category_id'];
    $products = $product_model->getByCategory($category_id);
    $this->data['sub_content']['product'] = $product;
    $this->data['sub_content']['products'] = $products;
    $this->data['page_title'] = 'Trang chi tiết sản phẩm';
    $this->data['content'] = 'shop/detail';
    $this->render('layouts/client_main', $this->data);
  }
}
