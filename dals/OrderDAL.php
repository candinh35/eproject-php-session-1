<?php
require_once "DB.php";

class OrderDAL extends DB {

    function makeOrder($data_created,$status,$subTotal,$tax,$total,$user_id){
        $sql = "INSERT INTO `orders`( `date_created`, `status`, `sub_total`, `tax`, `total`, `user_id`) VALUES ('$data_created',$status,$subTotal,$tax,$total,$user_id)";
        mysqli_query($this->connect, $sql);
       return $this->connect->insert_id;
       
    }
    function makeOrderDetail($data){
        $sql = "INSERT INTO `order_detail`(`product_id`, `order_id`, `price`, `quantity`, `sub_total`) VALUES $data";
        return mysqli_query($this->connect, $sql);
       
       
    }

   
}

?>