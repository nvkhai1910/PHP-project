<?php 
class User extends Controller{
    //Login
    public function index(){
        if(isset($_POST['submit'])){
            $username = $_POST['username'];
            $password = $_POST['password'];
            if(empty($this->error)){
                $user_model = $this->model('UserModel');
                $user = $user_model->getUser($username);
                if(empty($user)){
                    $this->error['user']['username'] = 'Username không tồn tại';
                }else{
                    if($password == $user['password']){
                        $_SESSION['user'] = $user; 
                        header('Location: http://localhost/mvc-tranninng/admin/dashboard/index');
                        exit();
                    }else{
                        $this->error['user']['password'] = "Sai tài khoản hoặc mật khẩu";
                    }
                }
            }
        }

        $this->render('admin/users/login');
    }
    public function logout(){
        unset($_SESSION['user']);
        header('Location: http://localhost/mvc-tranninng/admin/user/index');
        exit();
    }
}
?>