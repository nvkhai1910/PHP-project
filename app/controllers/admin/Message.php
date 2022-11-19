<?php 
class Message extends Controller{
    public $data = [];

    public function index(){
        $message_model = $this->model('MessageModel');

        $this->data['sub_content']['messages'] = $message_model->getAll();
        $this->data['page_title'] = 'Trang quản lý lời nhắn';
        $this->data['content'] = 'admin/message/index';
        $this->render('layouts/admin_main', $this->data);
    }
}
?>