<?php
class Customer extends Controller
{
    public $data = [];
    public function index()
    {
        $keyword = '';
        if (isset($_GET['submit'])) {
            $keyword = $_GET['keyword'];
            if (empty($this->error)) {
            }
        }
        //Gọi model
        $customer_model = $this->model('CustomerModel');
        //lấy ra all bản ghi danh mục
        $this->data['sub_content']['customers'] = $customer_model->getAll($keyword);
        //Gọi view, page_title
        $this->data['page_title'] = 'Trang danh sách khách hàng';
        $this->data['content'] = 'admin/customers/index';
        $this->render('layouts/admin_main', $this->data);
    }
    public function create()
    {
        $customer_model = $this->model('CustomerModel');
        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $password_confirm = $_POST['password_confirm'];
            $customer_name = $_POST['customer_name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            //xử lý validate
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

            //xủ lý lưu dữ liệu khi biến error rỗng
            if (empty($this->error['customer'])) {
                $customer_model->username = $username;
                //lưu password dưới dạng mã hóa, hiện tại sử dụng cơ chế md5
                $customer_model->password = password_hash($password, PASSWORD_BCRYPT);
                $customer_model->customer_name = $customer_name;
                $customer_model->phone = $phone;
                $customer_model->email = $email;
                $customer_model->address = $address;
                $is_insert = $customer_model->insert();
                if ($is_insert) {
                    $_SESSION['success'] = 'Insert dữ liệu thành công';
                } else {
                    $_SESSION['error'] = 'Insert dữ liệu thất bại';
                }
                header('Location: http://localhost/mvc-tranninng/admin/customer/');
                exit();
            }
        }

        $this->data['sub_content'] = [];
        //Gọi view, page_title
        $this->data['page_title'] = 'Trang thêm mới khách hàng';
        $this->data['content'] = 'admin/customers/create';
        $this->render('layouts/admin_main', $this->data);
    }
    public function update()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            header("Location: http://localhost/mvc-tranninng/admin/customer/");
            exit();
        }

        $id = $_GET['id'];
        $customer_model = $this->model('CustomerModel');
        $customer =  $customer_model->getById($id);
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
                $is_update = $customer_model->update($id);
                if ($is_update) {
                    $_SESSION['success'] = 'Update dữ liệu thành công';
                } else {
                    $_SESSION['error'] = 'Update dữ liệu thất bại';
                }
                header('Location: http://localhost/mvc-tranninng/admin/customer/');
                exit();
            }
        }
        $this->data['sub_content']['customer'] = $customer;
        //Gọi view, page_title
        $this->data['page_title'] = 'Trang sửa thông tin khách hàng';
        $this->data['content'] = 'admin/customers/update';
        $this->render('layouts/admin_main', $this->data);
    }
    public function delete()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            header("Location: index.php?controller=user");
            exit();
        }
        $id = $_GET['id'];
        $customer_model = $this->model('CustomerModel');
        $is_delete = $customer_model->delete($id);
        if ($is_delete) {
            $_SESSION['success'] = 'Xóa dữ liệu thành công';
        } else {
            $_SESSION['error'] = 'Xóa dữ liệu thất bại';
        }
        header('Location: http://localhost/mvc-tranninng/admin/customer/');
        exit();
    }
}
