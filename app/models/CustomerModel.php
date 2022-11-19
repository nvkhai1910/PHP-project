<?php
class CustomerModel extends Model
{
    public $id;
    public $username;
    public $password;
    public $customer_name;
    public $phone;
    public $email;
    public $address;
    public $created_at;
    public $updated_at;

    public $str_search;

    public function __construct()
    {
        parent::__construct();
        if (isset($_GET['username']) && !empty($_GET['username'])) {
            $username = addslashes($_GET['username']);
            $this->str_search .= " AND users.username LIKE '%$username%'";
        }
    }
    public function getAll($keyword = '')
    {
        $sql_select_all = "SELECT * FROM customers";
        if (!empty($keyword)) {
            $sql_select_all = "SELECT * FROM customers WHERE username like :keyword";
        }
        $obj_select_all = $this->connection->prepare($sql_select_all);
        $selects = [];
        if (!empty($keyword)) {
            $selects = [
                ':keyword' => "%$keyword%"
            ];
        }
        $obj_select_all->execute($selects);
        return $obj_select_all->fetchAll(PDO::FETCH_ASSOC);
    }
    public function insert()
    {
        $obj_insert = $this->connection
            ->prepare("INSERT INTO customers(username, password, customer_name, phone, email, address)
                    VALUES(:username, :password, :customer_name, :phone, :email, :address)");
        $arr_insert = [
            ':username' => $this->username,
            ':password' => $this->password,
            ':customer_name' => $this->customer_name,
            ':phone' => $this->phone,
            ':email' => $this->email,
            ':address' => $this->address,
        ];
        return $obj_insert->execute($arr_insert);
    }
    public function getCustomerByUsername($username)
    {
        $obj_select = $this->connection
            ->prepare("SELECT * FROM customers WHERE username='$username'");
        $obj_select->execute();
        return $obj_select->fetch(PDO::FETCH_ASSOC);
    }
    public function getById($id)
    {
        $obj_select = $this->connection
            ->prepare("SELECT * FROM customers WHERE id = $id");
        $obj_select->execute();
        return $obj_select->fetch(PDO::FETCH_ASSOC);
    }
    public function update($id)
    {
        $obj_update = $this->connection
            ->prepare("UPDATE customers SET customer_name=:customer_name, phone=:phone, email=:email, 
              address=:address, updated_at=:updated_at WHERE id = $id");
        $arr_update = [
            ':customer_name' => $this->customer_name,
            ':phone' => $this->phone,
            ':email' => $this->email,
            ':address' => $this->address,
            ':updated_at' => $this->updated_at,
        ];
        $obj_update->execute($arr_update);

        return $obj_update->execute($arr_update);
    }
    public function delete($id)
    {
        $obj_delete = $this->connection->prepare("DELETE FROM customers WHERE id = $id");
        return $obj_delete->execute();
    }
    /**
     * Lấy tổng số bản ghi trong bảng categories
     * @return mixed
     */
    public function countTotal()
    {
        $obj_select = $this->connection->prepare("SELECT COUNT(id) FROM customers");
        $obj_select->execute();

        return $obj_select->fetchColumn();
    }
    public function getAllPagination($params = [])
    {
        $limit = $params['limit'];
        $page = $params['page'];
        $start = ($page - 1) * $limit;
        $obj_select = $this->connection
            ->prepare("SELECT * FROM customers LIMIT $start, $limit");

        //    do PDO coi tất cả các param luôn là 1 string, nên cần sử dụng bindValue / bindParam cho các tham số start và limit
        //        $obj_select->bindParam(':limit', $limit, PDO::PARAM_INT);
        //        $obj_select->bindParam(':start', $start, PDO::PARAM_INT);
        $obj_select->execute();
        $categories = $obj_select->fetchAll(PDO::FETCH_ASSOC);

        return $categories;
    }
    public function insertRegister()
    {
        $obj_insert = $this->connection->prepare("INSERT INTO customers(username, password, email)
                                                VALUES(:username, :password, :email)");
        $arr_insert = [
            ':username' => $this->username,
            ':password' => $this->password,
            ':email' => $this->email,
        ];
        return $obj_insert->execute($arr_insert);
    }
    public function getCustomerByUsernameAndPassword($username, $password)
    {
        $obj_select = $this->connection
            ->prepare("SELECT * FROM customers WHERE username=:username AND password=:password LIMIT 1");
        $arr_select = [
            ':username' => $username,
            ':password' => $password,
        ];
        $obj_select->execute($arr_select);

        $customer = $obj_select->fetch(PDO::FETCH_ASSOC);

        return $customer;
    }
}
