<?php 
class Home extends ControllerClient{
    public $model_home;
    public $data = [];

    function __construct(){
        $this->model_home = $this->model('HomeModel');
    }

    public function index(){
        //Lấy danh sách danh mục
        $category_model = $this->model('CategoryModel');
        $product_model = $this->model('ProductModel');
        $blog_model = $this->model('BlogModel');
        //Lấy ra sản phẩm mới nhất
        

        $this->data['sub_content']['products'] = $product_model->getByOutstanding();
        $this->data['sub_content']['blogs'] = $blog_model->getByOutstanding();

        $this->data['sub_content']['products_latest_page1'] = $product_model->getByLatest(1);
        $this->data['sub_content']['products_latest_page2'] = $product_model->getByLatest(4);
        $this->data['sub_content']['products_latest_page3'] = $product_model->getByLatest(7);

        $this->data['sub_content']['products_bestseller_page1'] = $product_model->getByBestseller(1);
        $this->data['sub_content']['products_bestseller_page2'] = $product_model->getByBestseller(4);
        $this->data['sub_content']['products_bestseller_page3'] = $product_model->getByBestseller(7);


        $this->data['sub_content']['categories'] = $category_model->getAll();
        //
        $this->data['page_title'] = 'Trang chủ';
        $this->data['content'] = 'home/index';
        $this->render('layouts/client_main', $this->data);
    }
}
?>