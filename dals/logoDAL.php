<?php 
require_once 'DB.php';
    class logoDAL extends DB {
        
    function getList(){
        $sql = "SELECT * FROM logo";
        $result = mysqli_query($this->connect, $sql);
        return $result;
    }
    function getOne($id){
        $sql = "SELECT * FROM logo WHERE id = $id";
        $result = mysqli_query($this->connect, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

        function add($logo){
            $sql = "INSERT INTO logo (logo) value ('$logo')";
            mysqli_query($this->connect,$sql);
        }
        function deleteOne($id){
            $sql = "DELETE FROM logo WHERE id=$id";
            mysqli_query($this->connect,$sql);
        }
    }
?>