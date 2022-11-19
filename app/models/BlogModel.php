<?php 
class BlogModel extends Model{
    public $id;
    public $title;
    public $summary;
    public $content;
    public $avatar;
    public $status;
    public $created_at;
    public $updated_at;

    public function getAll($keyword = '')
    {
        $sql_select_all = "SELECT * FROM blogs";
        if (!empty($keyword)) {
            $sql_select_all = "SELECT * FROM blogs WHERE title like :keyword or summary LIKE :keyword";
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
    public function getById($id)
    {
        $sql_select_one = "SELECT * FROM blogs WHERE id=:id";
        $obj_select_one = $this->connection->prepare($sql_select_one);
        $selects = [
            ':id' => $id
        ];
        $obj_select_one->execute($selects);
        $blog = $obj_select_one->fetch(PDO::FETCH_ASSOC);
        return $blog;
    }
    public function insert()
    {
        $obj_insert = $this->connection->prepare("INSERT INTO blogs(id, title, summary, content, avatar, status) 
                                VALUES (:id, :title, :summary, :content, :avatar, :status)");
        $arr_insert = [
            ':id' => $this->id,
            ':title' => $this->title,
            ':summary' => $this->summary,
            ':content' => $this->content,
            ':avatar' => $this->avatar,
            ':status' => $this->status
        ];
        return $obj_insert->execute($arr_insert);
    }
    public function update($id)
    {
        $obj_update = $this->connection->prepare("UPDATE blogs SET title=:title, summary=:summary, 
                    content=:content, avatar=:avatar, status=:status, updated_at=:updated_at WHERE id = $id");
        $arr_update = [
            ':title' => $this->title,
            ':summary' => $this->summary,
            ':content' => $this->content,
            ':avatar' => $this->avatar,
            ':status' => $this->status,
            ':updated_at' => $this->updated_at,
        ];
        return $obj_update->execute($arr_update);
    }
    public function delete($id)
    {
        $obj_delete = $this->connection->prepare("DELETE FROM blogs WHERE id = $id");
        return $obj_delete->execute();
    }
    //Lấy ra blog nổi bật
    public function getByOutstanding(){
        $obj_select = $this->connection->prepare("SELECT * FROM blogs 
        ORDER BY blogs.created_at DESC LIMIT 3");
        $obj_select->execute();
        return $obj_select->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countTotal()
    {
        $obj_select = $this->connection->prepare("SELECT COUNT(id) FROM blogs");
        $obj_select->execute();
        return $obj_select->fetchColumn();
    }

    public function getAllPagination($params = [])
    {
        $limit = $params['limit'];
        $page = $params['page'];
        $start = ($page - 1) * $limit;
        $obj_select = $this->connection->prepare("SELECT * FROM blogs LIMIT $start, $limit");
        //    do PDO coi tất cả các param luôn là 1 string, nên cần sử dụng bindValue / bindParam cho các tham số start và limit
        //        $obj_select->bindParam(':limit', $limit, PDO::PARAM_INT);
        //        $obj_select->bindParam(':start', $start, PDO::PARAM_INT);
        $obj_select->execute();
        $blogs = $obj_select->fetchAll(PDO::FETCH_ASSOC);
        return $blogs;
    }
}
?>