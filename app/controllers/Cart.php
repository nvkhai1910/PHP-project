<?php
class Cart extends ControllerClient
{
    public function index()
    {
        if (isset($_POST['submit'])) {
            //Update lại số lượng sản phẩm trong giỏ hàng
            foreach ($_SESSION['cart'] as $product_id => $cart_item) {
                if ($_POST[$product_id] < 0) {
                    $_SESSION['error'] = 'So luong phai > 0';
                    header('Location: http://localhost/mvc-tranninng/cart/index');
                    exit();
                }
                $_SESSION['cart'][$product_id]['quantity'] = $_POST[$product_id];
            }
        }
        $this->data['sub_content'] = [];
        $this->data['page_title'] = 'Trang giỏ hàng';
        $this->data['content'] = 'shopping_cart/index';
        $this->render('layouts/client_main', $this->data);
    }
    public function add($product_id)
    {
        $product_id = $_GET['product_id'];
        $product_model = $this->model('ProductModel');
        $product = $product_model->getById($product_id);
        $cart_item = [
            'name' => $product['title'],
            'price' => $product['price_discount'],
            'avatar' => $product['avatar'],
            'quantity' => 1
        ];
        //Nếu như giỏ hàng chưa tồn tại, khởi tạo giỏ hàng và thêm item đầu tiên
        //Nếu giỏ hàng đã tồn tại :
        // + Sp đã tồn tại thì cập nhật số lượng
        // + Sp không tồn tại thì thêm mới
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'][$product_id] = $cart_item;
        } else {
            if (isset($_SESSION['cart'][$product_id])) {
                $_SESSION['cart'][$product_id]['quantity']++;
            } else {
                $_SESSION['cart'][$product_id] = $cart_item;
            }
        }
    }
    public function delete($product_id)
    {
        unset($_SESSION['cart'][$product_id]);
        $_SESSION['success'] = "Xoa sp co id = $product_id thành công";
        header('Location: http://localhost/mvc-tranninng/cart/');
        exit();
    }
}
