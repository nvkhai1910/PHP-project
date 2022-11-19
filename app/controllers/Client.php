<?php
class Client extends ControllerClient
{
    public $data = [];
    public function index()
    {
        $customer_model = $this->model('CustomerModel');
        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            if (empty($username)) {
                $this->error['customer']['username'] = 'Username không được để trống';
            }
            if (empty($password)) {
                $this->error['customer']['password'] = 'Password không được để trống';
            }

            if (empty($this->error['customer'])) {
                $customer = $customer_model->getCustomerByUsername($username);
                if (empty($customer)) {
                    $this->error['customer']['username'] = 'Username không tồn tại';
                } else {
                    $is_login = password_verify($password, $customer['password']);
                    if ($is_login) {
                        $_SESSION['customer'] = $customer;
                        header('Location: http://localhost/mvc-tranninng/');
                        exit();
                    } else {
                        $this->error['customer']['password'] = 'Sai mật khẩu hoặc tài khoản';
                    }
                }
            }
        };
        $this->render('customer/login');
    }
    public function register()
    {
        $customer_model = $this->model('CustomerModel');
        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $password_confirm = $_POST['password_confirm'];
            $email = $_POST['email'];
            if (empty($username)) {
                $this->error['customer']['username'] = 'Username không được để trống';
            }
            if (empty($password)) {
                $this->error['customer']['password'] = 'Password không được để trống';
            }
            if (empty($password_confirm)) {
                $this->error['customer']['password_confirm'] = 'Password confirm không được để trống';
            }
            if ($password != $password_confirm) {
                $this->error['customer']['password_confirm'] = 'Password confirm chưa đúng';
            }
            if (empty($email)) {
                $this->error['customer']['email'] = 'Email không được để trống';
            }
            if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->error['customer']['email'] = 'Email không đúng định dạng';
            }
            if (!empty($username)) {
                //kiếm tra xem username đã tồn tại trong DB hay chưa, nếu tồn tại sẽ báo lỗi
                $count_user = $customer_model->getCustomerByUsername($username);
                if ($count_user) {
                    $this->error['customer']['username'] = 'Username này đã tồn tại';
                }
            }

            if (empty($this->error['customer'])) {
                $customer_model->username = $username;
                //lưu password dưới dạng mã hóa, hiện tại sử dụng cơ chế md5
                $customer_model->password = password_hash($password, PASSWORD_BCRYPT);
                $customer_model->email = $email;
                $is_insert = $customer_model->insertRegister();
                if ($is_insert) {
                    $_SESSION['success'] = 'Đăng ký thành công';
                } else {
                    $_SESSION['error'] = 'Đăng ký thất bại';
                }
                header('Location: http://localhost/mvc-tranninng/client/');
                exit();
            }
        }
        $this->render('customer/register');
    }
    public function logout()
    {
        unset($_SESSION['customer']);
        header('Location: http://localhost/mvc-tranninng/');
        exit();
    }
    public function profile($customer_id = '')
    {
        if (!isset($customer_id) || !is_numeric($customer_id) || !isset($_SESSION['customer'])) {
            $_SESSION['error'] = 'ID không hợp lệ';
            header('Location: http://localhost/mvc-tranninng/');
            exit();
        }
        $customer_model = $this->model('CustomerModel');
        $this->data['sub_content']['customer'] = $customer_model->getById($customer_id);
        $this->data['page_title'] = 'Trang cá nhân khách hàng';
        $this->data['content'] = 'customer/profile';
        $this->render('layouts/client_main', $this->data);
    }
    public function update($customer_id = '')
    {
        if (!isset($customer_id) || !is_numeric($customer_id) || !isset($_SESSION['customer'])) {
            $_SESSION['error'] = 'ID không hợp lệ';
            header('Location: http://localhost/mvc-tranninng/');
            exit();
        }
        $customer_model = $this->model('CustomerModel');
        $customer =  $customer_model->getById($customer_id);
        if (isset($_POST['submit'])) {

            $customer_name = $_POST['customer_name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            //xử lý validate
            if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->error['customer']['email'] = 'Email không đúng định dạng';
            }

            //xủ lý lưu dữ liệu khi biến error rỗng
            if (empty($this->error['customer'])) {
                $customer_model->customer_name = $customer_name;
                $customer_model->phone = $phone;
                $customer_model->email = $email;
                $customer_model->address = $address;
                $customer_model->updated_at = date('Y-m-d H:i:s');
                $is_update = $customer_model->update($customer_id);
                if ($is_update) {
                    $_SESSION['success'] = 'Update dữ liệu thành công';
                } else {
                    $_SESSION['error'] = 'Update dữ liệu thất bại';
                }
                header('Location: http://localhost/mvc-tranninng/client/profile/'.$customer['id']);
                exit();
            }
        }
        $this->data['sub_content']['customer'] = $customer;
        //Gọi view, page_title
        $this->data['page_title'] = 'Trang sửa thông tin khách hàng';
        $this->data['content'] = 'customer/update';
        $this->render('layouts/client_main', $this->data);
    }
}
