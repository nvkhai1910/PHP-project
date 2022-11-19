<?php
class OrderModel extends Model {
    public function insertData($infos){
        $sql_insert = "INSERT INTO orders(fullname, address, mobile, email, note, price_total, payment_status)
                        VALUES (:fullname, :address, :mobile, :email, :note, :price_total, :payment_status)";
        $obj_insert = $this->connection->prepare($sql_insert);
        $inserts = [
            ':fullname'=>$infos['fullname'],
            ':address'=>$infos['address'],
            ':mobile'=>$infos['mobile'],
            ':email'=>$infos['email'],
            ':note'=>$infos['note'],
            ':price_total'=>$infos['price_total'],
            ':payment_status'=>$infos['payment_status']
        ];
        $obj_insert->execute($inserts);
        //Tra ve id cua order sau khi insert
        $order_id = $this->connection->LastInsertId();
        return $order_id;
    }
    public function getAll(){
        $sql_select_all = "SELECT * FROM orders";
        $obj_select_all = $this->connection->prepare($sql_select_all);
        $obj_select_all->execute();
        return $obj_select_all->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * Lấy tổng số bản ghi trong bảng categories
     * @return mixed
     */
    public function countTotal()
    {
        $obj_select = $this->connection->prepare("SELECT COUNT(id) FROM orders");
        $obj_select->execute();
        return $obj_select->fetchColumn();
    }

    public function getAllPagination($params = [])
    {
        $limit = $params['limit'];
        $page = $params['page'];
        $start = ($page - 1) * $limit;
        $obj_select = $this->connection
            ->prepare("SELECT * FROM orders LIMIT $start, $limit");

        //    do PDO coi tất cả các param luôn là 1 string, nên cần sử dụng bindValue / bindParam cho các tham số start và limit
        //        $obj_select->bindParam(':limit', $limit, PDO::PARAM_INT);
        //        $obj_select->bindParam(':start', $start, PDO::PARAM_INT);
        $obj_select->execute();
        $orders = $obj_select->fetchAll(PDO::FETCH_ASSOC);
        return $orders;
    }
}
?>