<?php 
class Controller{
    public $error;
     /**
     * @param $file string Đường dẫn tới file
     * @param array $variables array Danh sách các biến truyền vào file
     * @return false|string
     */
    public function __construct()
    {
        if(!isset($_SESSION['user']) && !isset($_GET['admin/user'])){
            $_SESSION['error'] = 'Bạn chưa đăng nhập';
            header('Location: http://localhost/mvc-tranninng/admin/user');
            exit();
        }
        
    }
    public function model($model){
        if(file_exists(_DIR_ROOT_.'/app/models/'.$model.'.php')){
            require_once _DIR_ROOT_.'/app/models/'.$model.'.php';
            //Kiem tra class ton tai
            if(class_exists($model)){
                $model = new $model();
                return $model;
            }
        }
        return false;
    }
    public function render($view, $data=[]){
        //Doi key cua mang thanh bien
        extract($data);
        if(file_exists(_DIR_ROOT_.'/app/views/'.$view.'.php')){
            require_once _DIR_ROOT_.'/app/views/'.$view.'.php';
        }
    }
}
?>