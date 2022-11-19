<?php 
class Dashboard extends Controller{
    public $data = [];

    public function index(){
        $this->data['page_title'] = 'Trang chủ';
        $this->data['sub_content'] = [];
        $this->data['content'] = 'admin/dashboard/index';
        $this->render('layouts/admin_main', $this->data);
    }
}
?>