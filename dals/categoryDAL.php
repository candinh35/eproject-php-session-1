<?php 

require_once 'DB.php';
class categoryDAL extends DB {

    function getList(){
        $sql = "SELECT * FROM category";
        $result = mysqli_query($this->connect, $sql);
        return $result;
    }
    function getSearch($name)
    {
        $sql = "SELECT * fROM category WHERE name = '$name'";
        $result = mysqli_query($this->connect, $sql);
        return $result;
    }

     function getOne($id){
        $sql = "SELECT * FROM category WHERE id = $id";
        $result = mysqli_query($this->connect, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }
    function getByPosition($position){
        $sql = "SELECT * FROM category WHERE position = $position";
        $result = mysqli_query($this->connect, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    function deleteOne($id){
        $sql = "DELETE FROM category WHERE id=$id";
        mysqli_query($this->connect,$sql);
    }

    function add ($name, $position){
        $sql = "INSERT INTO category (name,position) value ('$name',$position)";
        return mysqli_query($this->connect, $sql);
    }

    function edit( $id,$name, $position){
        $sql = "UPDATE `category` SET `name`='$name' `position`= $position WHERE id=$id";
        return mysqli_query($this->connect,$sql);

    }
    function paging($id){
        $location = ($id-1)*10;
        $sql = "SELECT * FROM category LIMIT $location ,10";
        $result = mysqli_query($this->connect, $sql);
    return $result;
    }

}

?>
