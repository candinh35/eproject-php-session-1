<?php 

require_once 'DB.php';
class categoryDAL extends DB {

    function getList(){
        $sql = "SELECT * FROM category";
        $result = mysqli_query($this->connect, $sql);
        return $result;
    }

     function getOne($id){
        $sql = "SELECT * FROM category WHERE id = $id";
        $result = mysqli_query($this->connect, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    function deleteOne($id){
        $sql = "DELETE FROM category WHERE id=$id";
        mysqli_query($this->connect,$sql);
    }

    function add ($name){
        $sql = "INSERT INTO category (name) value ('$name') ";
        mysqli_query($this->connect, $sql);
    }

    function edit( $id,$name){
        $sql = "UPDATE `category` SET `name`='$name' WHERE id=$id";
        mysqli_query($this->connect,$sql);
    }
}

   
    
    

?>
