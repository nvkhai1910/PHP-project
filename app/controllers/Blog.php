<?php
require_once 'app/models/PaginationClient.php';
class Blog extends ControllerClient
{
    public $data = [];

    public function index()
    {
        $blog_model = $this->model('BlogModel');
        $keyword = '';
        if (isset($_GET['submit'])) {
            $keyword = $_GET['keyword'];
        }
        $params = [
            'limit' => 6, //giới hạn 6 bản ghi 1 trang
            'query_string' => 'page',
            'controller' => 'blog',
            'action' => 'index',
            'full_mode' => FALSE,
        ];
        // mặc đinh page hiện tại là 1
        $page = 1;
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }

        //lấy tổng số bản ghi dựa theo các điều kiện có được từ mảng params truyền vào
        $count_total = $blog_model->countTotal();
        $params['total'] = $count_total;

        //gán biến name cho mảng params với key là name
        $params['page'] = $page;

        $pagination = new PaginationClient($params);
        //lấy ra html phân trang
        $pages = $pagination->getPagination();
        if (empty($keyword)) {
            $this->data['sub_content']['blogs'] = $blog_model->getAllPagination($params);
            $this->data['sub_content']['pages'] = $pages;
        } else {
            $this->data['sub_content']['blogs'] = $blog_model->getAll($keyword);
            $this->data['sub_content']['pages'] = false;
        }

        $this->data['sub_content']['blogs_new'] = $blog_model->getByOutstanding();
        $this->data['page_title'] = 'Trang blog';
        $this->data['content'] = 'blogs/index';
        $this->render('layouts/client_main', $this->data);
    }
    public function detail($blog_id)
    {
        if (!isset($blog_id) || !is_numeric($blog_id)) {
            $_SESSION['error'] = 'ID không hợp lệ';
            header('Location: http://localhost/mvc-tranninng/blog/index/');
            exit();
        }
        $blog_model = $this->model('BlogModel');
        $this->data['sub_content']['blog_detail'] = $blog_model->getById($blog_id);
        $this->data['sub_content']['blogs_new'] = $blog_model->getByOutstanding();
        $this->data['page_title'] = 'Trang chi tiết blog';
        $this->data['content'] = 'blogs/detail';
        $this->render('layouts/client_main', $this->data);
    }
}
