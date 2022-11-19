<?php
class ProductModel extends Model
{
    public $id;
    public $category_id;
    public $title;
    public $avatar;
    public $price;
    public $amount;
    public $discount;
    public $summary;
    public $content;
    public $seo_title;
    public $seo_description;
    public $seo_keywords;
    public $status;
    public $created_at;
    public $updated_at;

    public $str_search = '';

    public function __construct()
    {
        parent::__construct();
        if (isset($_GET['title']) && !empty($_GET['title'])) {
            $this->str_search .= " AND products.title LIKE '%{$_GET['title']}%'";
        }
        if (isset($_GET['category_id']) && !empty($_GET['category_id'])) {
            $this->str_search .= " AND products.category_id = {$_GET['category_id']}";
        }
    }

    public function getAll($keyword = '')
    {
        $sql_select_all = "SELECT products.*, categories.name AS category_name FROM products 
                            INNER JOIN categories ON categories.id = products.category_id
                            WHERE TRUE $this->str_search ORDER BY products.created_at DESC";
        if (!empty($keyword)) {
            $sql_select_all = "SELECT products.*, categories.name AS category_name FROM products 
                                INNER JOIN categories ON categories.id = products.category_id
                                WHERE title like :keyword or summary LIKE :keyword or content LIKE :keyword
                                And TRUE $this->str_search ORDER BY products.created_at DESC";
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
            ->prepare("INSERT INTO products(category_id, title, avatar, price, amount, discount, summary, content, seo_title, seo_description, seo_keywords, status) 
                                VALUES (:category_id, :title, :avatar, :price, :amount, :discount, :summary, :content, :seo_title, :seo_description, :seo_keywords, :status)");
        $arr_insert = [
            ':category_id' => $this->category_id,
            ':title' => $this->title,
            ':avatar' => $this->avatar,
            ':price' => $this->price,
            ':amount' => $this->amount,
            ':discount' => $this->discount,
            ':summary' => $this->summary,
            ':content' => $this->content,
            ':seo_title' => $this->seo_title,
            ':seo_description' => $this->seo_description,
            ':seo_keywords' => $this->seo_keywords,
            ':status' => $this->status,
        ];
        return $obj_insert->execute($arr_insert);
    }
    public function getById($id)
    {
        $obj_select = $this->connection->prepare("SELECT products.*, categories.name AS category_name,
                    CONVERT((products.price * (100 - products.discount)/100),INT) as price_discount 
                    FROM products INNER JOIN categories ON products.category_id = categories.id 
                    WHERE products.id = :id");
        $selects = [
            ':id' => $id
        ];
        $obj_select->execute($selects);
        return $obj_select->fetch(PDO::FETCH_ASSOC);
    }
    public function getByCategory($category_id)
    {
        $obj_select = $this->connection->prepare("SELECT products.*, categories.name AS category_name,
        CONVERT((products.price * (100 - products.discount)/100),INT) as price_discount
        FROM products INNER JOIN categories ON products.category_id = categories.id 
        WHERE categories.id = :id");
        $selects = [
            ':id' => $category_id
        ];
        $obj_select->execute($selects);
        return $obj_select->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getByDiscount(){
        $obj_select = $this->connection->prepare("SELECT products.*, categories.name AS category_name,
        CONVERT((products.price * (100 - products.discount)/100),INT) as price_discount
        FROM products INNER JOIN categories ON products.category_id = categories.id 
        WHERE products.discount > 0 ORDER BY products.discount DESC ");
        $obj_select->execute();
        return $obj_select->fetchAll(PDO::FETCH_ASSOC);
    }
    public function delete($id)
    {
        $obj_delete = $this->connection->prepare("DELETE FROM products WHERE id = $id");
        return $obj_delete->execute();
    }
    public function update($id)
    {
        $obj_update = $this->connection->prepare("UPDATE products SET category_id=:category_id, title=:title,
                    avatar=:avatar, price=:price, amount=:amount, discount=:discount,summary=:summary, content=:content,
                    seo_title=:seo_title, seo_description=:seo_description, seo_keywords=:seo_keywords, 
                    status=:status, updated_at=:updated_at WHERE id = $id");
        $arr_update = [
            ':category_id' => $this->category_id,
            ':title' => $this->title,
            ':avatar' => $this->avatar,
            ':price' => $this->price,
            ':amount' => $this->amount,
            ':discount' => $this->discount,
            ':summary' => $this->summary,
            ':content' => $this->content,
            ':seo_title' => $this->seo_title,
            ':seo_description' => $this->seo_description,
            ':seo_keywords' => $this->seo_keywords,
            ':status' => $this->status,
            ':updated_at' => $this->updated_at,
        ];
        return $obj_update->execute($arr_update);
    }
    //Lấy ra sản phẩm nổi bật
    public function getByOutstanding(){
        $obj_select = $this->connection->prepare("SELECT products.*, categories.name AS category_name ,
        CONVERT((products.price * (100 - products.discount)/100),INT) as price_discount 
        FROM products INNER JOIN categories ON products.category_id = categories.id 
        ORDER BY products.updated_at DESC LIMIT 10");
        $obj_select->execute();
        return $obj_select->fetchAll(PDO::FETCH_ASSOC);
    }
    //Lấy ra sản phẩm mới nhất
    public function getByLatest($start){
        $obj_select = $this->connection->prepare("SELECT products.*, categories.name AS category_name ,
        CONVERT((products.price * (100 - products.discount)/100),INT) as price_discount 
        FROM products INNER JOIN categories ON products.category_id = categories.id 
        ORDER BY products.created_at DESC LIMIT $start, 3");
        $obj_select->execute();
        return $obj_select->fetchAll(PDO::FETCH_ASSOC);
    }
    //Lấy ra sản phẩm bán chạy nhất
    public function getBYBestseller($start){
        $obj_select = $this->connection->prepare("SELECT products.*, categories.name AS category_name,
        CONVERT((products.price * (100 - products.discount)/100),INT) as price_discount  
        FROM products INNER JOIN categories ON products.category_id = categories.id 
        ORDER BY products.amount DESC LIMIT $start, 3");
        $obj_select->execute();
        return $obj_select->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * Lấy tổng số bản ghi trong bảng categories
     * @return mixed
     */
    public function countTotal()
    {
        $obj_select = $this->connection->prepare("SELECT COUNT(id) FROM products");
        $obj_select->execute();
        return $obj_select->fetchColumn();
    }

    public function getAllPagination($params = [])
    {
        $limit = $params['limit'];
        $page = $params['page'];
        $start = ($page - 1) * $limit;
        $obj_select = $this->connection
            ->prepare("SELECT products.*, categories.name AS category_name,
            CONVERT((products.price * (100 - products.discount)/100),INT) as price_discount 
            FROM products INNER JOIN categories ON categories.id = products.category_id
            ORDER BY products.updated_at DESC, products.created_at DESC
            LIMIT $start, $limit");

        //    do PDO coi tất cả các param luôn là 1 string, nên cần sử dụng bindValue / bindParam cho các tham số start và limit
        //        $obj_select->bindParam(':limit', $limit, PDO::PARAM_INT);
        //        $obj_select->bindParam(':start', $start, PDO::PARAM_INT);
        $obj_select->execute();
        $products = $obj_select->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    }
}
