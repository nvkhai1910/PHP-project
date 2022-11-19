<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Nhứng thủ công các file theo đúng thứ tự sau:
require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';
require_once 'PHPMailer/src/Exception.php';

class Payment extends ControllerClient
{
    public $data = [];

    public function index()
    {
        if (isset($_POST['submit'])) {
            $fullname = $_POST['fullname'];
            $address = $_POST['address'];
            $mobile = $_POST['mobile'];
            $email = $_POST['email'];
            $note = $_POST['note'];
            $method = $_POST['method'];
            if (empty($fullname)) {
                $this->error['payment']['fullname'] = 'Tên không được để trống';
            }
            if (empty($address)) {
                $this->error['payment']['address'] = 'Địa chỉ không được để trống';
            }
            if (empty($mobile)) {
                $this->error['payment']['mobile'] = 'Số điện thoại không được để trống';
            }
            if (empty($email)) {
                $this->error['payment']['email'] = 'Email không được để trống';
            }
            if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->error['payment']['email'] = 'Email không đúng định dạng';
            }
            if (empty($this->error['payment'])) {
                //Xu ly logic thanh toan
                // -Lưu vào bảng order trước
                // lưu trực tiếp vào order_detail
                $price_total = 0;
                foreach ($_SESSION['cart'] as $cart_item) {
                    $price_total += $cart_item['price'] * $cart_item['quantity'];
                }
                $payment_status = 0; //Mặc định chưa thanh toán
                $infos = [
                    'fullname' => $fullname,
                    'address' => $address,
                    'mobile' => $mobile,
                    'email' => $email,
                    'note' => $note,
                    'method' => $method,
                    'price_total' => $price_total,
                    'payment_status' => $payment_status
                ];
                $order_model = $this->model('OrderModel');
                $order_id = $order_model->insertData($infos);
                if (is_numeric($order_id)) {
                    $_SESSION['infors'] = $infos;
                    $_SESSION['infors_bill'] = $_SESSION['cart'];
                }
                foreach ($_SESSION['cart'] as $cart_item) {
                    $order_detail_model = $this->model('OrderDetailModel');
                    $details = [
                        'order_id' => $order_id,
                        'product_name' => $cart_item['name'],
                        'product_price' => $cart_item['price'],
                        'quantity' => $cart_item['quantity']
                    ];
                    $is_insert = $order_detail_model->insertData($details);
                    // -Dựa vào phương thức thanh toán để xử lý:
                    if ($method == 0) {
                        // thanh toán trực tuyến
                    } else {
                        // là thanh toán cod
                    }
                }
                $this->sendMail();
                //Trả vê id của order vừa insert thành công, để insert tiếp vào bảng order_detail
            }
        }
        $this->data['sub_content'] = [];
        $this->data['page_title'] = 'Trang thanh toán';
        $this->data['content'] = 'checkout/index';
        $this->render('layouts/client_main', $this->data);
    }
    public function success()
    {
        if (!empty($_SESSION['infors'])) {
            unset($_SESSION['cart']);
            $this->data['sub_content'] = [];
            $this->data['page_title'] = 'Trang đặt hàng thành công';
            $this->data['content'] = 'checkout/success';
            $this->render('layouts/client_main', $this->data);
        }
        header('Location: http://localhost/mvc-tranninng/payment');
        exit();
    }
    public function sendMail()
    {
        if (!empty($_SESSION['infors']) && !empty($_SESSION['infors_bill'])) {
            $mail = new PHPMailer(true);

            try {
                //Server settings
                // Cho phép gửi có dấu:
                $mail->CharSet = 'utf8';
                $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'websitefood0409@gmail.com';               //SMTP username
                $mail->Password   = 'dqbhirsgluwcrgoj';                     //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS

                //Recipients
                $mail->setFrom('websitefood0409@gmail.com', 'Shop OGANI');
                //$mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
                $mail->addAddress($_SESSION['infors']['email']);               //Name is optional

                //Attachments
                //   $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                //   $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                //Content
                $bill_infor = '';
                foreach($_SESSION['infors_bill'] as $item){
                    $bill_infor .= '<tr>
                        <td>'.$item['name'].'</td>
                        <td>'.$item['price'].'</td>
                        <td>'.$item['quantity'].'</td>
                    </tr>';
                };
                $bill = 'Thông tin chi tiết đơn hàng của bạn: <br>
                         Tổng tiền cần phải thanh toán: '.number_format($_SESSION['infors']['price_total']).'<br>
                         <table border="1">
                            <thead>
                                <tr>
                                    <th >Tên sản phẩm</th>
                                    <th>Giá sản phẩm</th>
                                    <th >Số lượng</th>
                                </tr>
                            </thead>
                            <tbody>'.$bill_infor.'
                            </tbody>
                        </table>';
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Đặt hàng thành công';
                $mail->Body    = $bill;
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                header('Location: http://localhost/mvc-tranninng/payment/success');
                exit();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
        header('Location: http://localhost/mvc-tranninng/payment');
        exit();
    }
}
