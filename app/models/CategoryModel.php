<?php
class CategoryModel extends Model
{
    public function getAll($keyword = '')
    {
        $sql_select_all = "SELECT * FROM categories";
        if (!empty($keyword)) {
            $sql_select_all = "SELECT * FROM categories WHERE name like :keyword or description LIKE :keyword";
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
    public function create($name, $type, $avatar, $description, $status)
    {
        $sql_insert = "INSERT INTO categories(name, type, avatar, description, status)
                        VALUES (:name, :type, :avatar, :description, :status) ";
        $obj_insert = $this->connection->prepare($sql_insert);
        $inserts = [
            ':name' => $name,
            ':type' => $type,
            ':avatar' => $avatar,
            ':description' => $description,
            ':status' => $status
        ];
        $is_insert = $obj_insert->execute($inserts);
        return $is_insert;
    }
    public function getById($id)
    {
        $sql_select_one = "SELECT * FROM categories WHERE id=:id";
        $obj_select_one = $this->connection->prepare($sql_select_one);
        $selects = [
            ':id' => $id
        ];
        $obj_select_one->execute($selects);
        $category = $obj_select_one->fetch(PDO::FETCH_ASSOC);
        return $category;
    }
    public function update($name, $type, $avatar, $description, $status, $id)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $sql_update = "UPDATE categories SET name=:name, type=:type, avatar=:avatar, description=:description,
                        status=:status, updated_at=:updated_at where id=:id";
        $obj_update = $this->connection->prepare($sql_update);
        $updates = [
            ':name' => $name,
            ':type' => $type,
            ':avatar' => $avatar,
            ':description' => $description,
            ':status' => $status,
            'updated_at' => date('Y-m-d H:i:s'),
            ':id' => $id
        ];
        $is_update = $obj_update->execute($updates);
        return $is_update;
    }
    public function delete($id)
    {
        $sql_delete = "DELETE FROM categories where id=:id";
        $obj_delete = $this->connection->prepare($sql_delete);
        $deletes = [
            ':id' => $id
        ];
        return $obj_delete->execute($deletes);
    }
    /**
     * L???y t???ng s??? b???n ghi trong b???ng categories
     * @return mixed
     */
    public function countTotal()
    {
        $obj_select = $this->connection->prepare("SELECT COUNT(id) FROM categories");
        $obj_select->execute();

        return $obj_select->fetchColumn();
    }

    public function getAllPagination($params = [])
    {
        $limit = $params['limit'];
        $page = $params['page'];
        $start = ($page - 1) * $limit;
        $obj_select = $this->connection
            ->prepare("SELECT * FROM categories LIMIT $start, $limit");

        //    do PDO coi t???t c??? c??c param lu??n l?? 1 string, n??n c???n s??? d???ng bindValue / bindParam cho c??c tham s??? start v?? limit
        //        $obj_select->bindParam(':limit', $limit, PDO::PARAM_INT);
        //        $obj_select->bindParam(':start', $start, PDO::PARAM_INT);
        $obj_select->execute();
        $categories = $obj_select->fetchAll(PDO::FETCH_ASSOC);

        return $categories;
    }
    public function getAll1($params = [])
    {
        //    echo "<pre>";
        //    print_r($params);
        //    echo "</pre>";
        //t???o 1 chu???i truy v???n ????? th??m c??c ??i???u ki???n search
        //d???a v??o m???ng params truy???n v??o
        $str_search = 'WHERE TRUE';
        //check m???ng param truy???n v??o ????? thay ?????i l???i chu???i search
        if (isset($params['keyword']) && !empty($params['keyword'])) {
            $keyword = $params['keyword'];
            //nh??? ph???i c?? d???u c??ch ??? ?????u chu???i
            $str_search .= " AND `name` LIKE '%$keyword%'";
        }
        //t???o c??u truy v???n
        //g???n chu???i search n???u c?? v??o truy v???n ban ?????u
        $sql_select_all = "SELECT * FROM categories $str_search";
        //cbi ?????i t?????ng truy v???n
        $obj_select_all = $this->connection
            ->prepare($sql_select_all);
        $obj_select_all->execute();
        $categories = $obj_select_all
            ->fetchAll(PDO::FETCH_ASSOC);
        return $categories;
    }
}
