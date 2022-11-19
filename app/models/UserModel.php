<?php 
class UserModel extends Model{
    public function getUser($username){
        $sql_select_one = "SELECT * FROM admin WHERE username=:username";
        $obj_select_one = $this->connection->prepare($sql_select_one);
        $selects = [
            ':username'=>$username
        ];
        $obj_select_one->execute($selects);
        $user = $obj_select_one->fetch(PDO::FETCH_ASSOC);
        return $user;
    }
}
?>