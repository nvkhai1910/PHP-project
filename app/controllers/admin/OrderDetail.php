<?php 
require_once 'app/models/Pagination.php';
class OrderDetail extends Controller{
    public function index(){
        $order_detail_model = $this->model('OrderDetailModel');

        $params = [
            'limit' => 10, //giới hạn 5 bản ghi 1 trang
            'query_string' => 'page',
            'controller' => 'orderdetail',
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
        $count_total = $order_detail_model->countTotal();
        $params['total'] = $count_total;

        //gán biến name cho mảng params với key là name
        $params['page'] = $page;
        $pagination = new Pagination($params);
        //lấy ra html phân trang
        $pages = $pagination->getPagination();

        $this->data['sub_content']['pages'] = $pages;
        $this->data['sub_content']['details']= $order_detail_model->getAllPagination($params);
        $this->data['page_title'] = 'Trang quản lý order_detail';
        $this->data['content'] = 'admin/order_detail/index';
        $this->render('layouts/admin_main', $this->data);
    }
}
?>