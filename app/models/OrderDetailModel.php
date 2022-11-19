<?php
class OrderDetailModel extends Model
{
    public function insertData($details)
    {
        $sql_insert = "INSERT INTO order_details(order_id, product_name, product_price, quantity)
                        VALUES (:order_id, :product_name, :product_price, :quantity)";
        $obj_insert = $this->connection->prepare($sql_insert);
        $inserts = [
            ':order_id' => $details['order_id'],
            ':product_name' => $details['product_name'],
            ':product_price' => $details['product_price'],
            ':quantity' => $details['quantity']
        ];
        return $obj_insert->execute($inserts);
    }
    public function getAll()
    {
        $sql_select_all = "SELECT * FROM order_details";
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
        $obj_select = $this->connection->prepare("SELECT COUNT(order_id) FROM order_details");
        $obj_select->execute();
        return $obj_select->fetchColumn();
    }

    public function getAllPagination($params = [])
    {
        $limit = $params['limit'];
        $page = $params['page'];
        $start = ($page - 1) * $limit;
        $obj_select = $this->connection
            ->prepare("SELECT * FROM order_details LIMIT $start, $limit");

        //    do PDO coi tất cả các param luôn là 1 string, nên cần sử dụng bindValue / bindParam cho các tham số start và limit
        //        $obj_select->bindParam(':limit', $limit, PDO::PARAM_INT);
        //        $obj_select->bindParam(':start', $start, PDO::PARAM_INT);
        $obj_select->execute();
        $order_detail= $obj_select->fetchAll(PDO::FETCH_ASSOC);
        return $order_detail;
    }
}
