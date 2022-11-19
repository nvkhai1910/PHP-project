<?php 
class Contact extends ControllerClient{
    public $data = [];

    public function index(){
        $message_model = $this->model('MessageModel');
        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $message = $_POST['message'];
            if (empty($name)) {
                $this->error['message']['name'] = 'Name không được để trống';
            }
            if (empty($message)) {
                $this->error['message']['note'] = 'Lời nhắn không được để trống';
            }
            if(empty($email)){
                $this->error['customer']['email'] = 'Email không được để trống';
            }
            if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->error['customer']['email'] = 'Email không đúng định dạng';
            }
            if(empty($this->error['messagge'])){
                $is_insert = $message_model->insert($name, $email, $message);
                if ($is_insert) {
                    $_SESSION['success'] = 'Gửi lời nhắn thành công';
                } else {
                    $_SESSION['error'] = 'Gửi lời nhắn thất bại';
                }
                header('Location: http://localhost/mvc-tranninng');
                exit();
            }
        }
        $this->data['sub_content'] =[];
        $this->data['page_title'] = 'Trang liên hệ';
        $this->data['content'] = 'contact/index';
        $this->render('layouts/client_main', $this->data);
    }
}
?>