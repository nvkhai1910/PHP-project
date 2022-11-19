<?php 
class MessageModel extends Model{
    public function getAll(){
        $sql_select_all = "SELECT * FROM message";
        $obj_select_all = $this->connection->prepare($sql_select_all);
        $obj_select_all->execute();
        return $obj_select_all->fetchAll(PDO::FETCH_ASSOC);
    }
    public function insert($name, $email, $message){
        $sql_insert = "INSERT INTO message(name, email, message)
                        VALUES (:name, :email, :message)";
        $obj_insert = $this->connection->prepare($sql_insert);
        $inserts = [
            ':name'=>$name,
            ':email'=>$email,
            ':message'=>$message
        ];
        return $obj_insert->execute($inserts);
    }
}
?>