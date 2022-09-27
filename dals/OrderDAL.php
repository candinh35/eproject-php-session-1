<?php
require_once "DB.php";

class OrderDAL extends DB
{

    function makeOrder($data_created, $status, $subTotal, $tax, $total, $user_id)
    {
        $sql = "INSERT INTO `orders`( `date_created`, `status`, `sub_total`, `tax`, `total`, `user_id`) VALUES ('$data_created',$status,$subTotal,$tax,$total,$user_id)";
        mysqli_query($this->connect, $sql);
        return $this->connect->insert_id;
    }
    function getSearch()
    {
        $sql = "SELECT *,order.id as order_id,users.name as users_name FROM orders INNER JOIN users ON order.user_id = users.id WHERE user_id ";
        $result = mysqli_query($this->connect, $sql);
        return $result;
    }
    function makeOrderDetail($data)
    {
        $sql = "INSERT INTO `order_detail`(`product_id`, `order_id`, `price`, `quantity`, `sub_total`) VALUES $data";
        return mysqli_query($this->connect, $sql);
    }
    function getList()
    {
        $sql = "SELECT *,orders.id as order_id,users.email as users_name FROM orders INNER JOIN users ON orders.user_id = users.id";
        $result =  mysqli_query($this->connect, $sql);
        return $result;
    }
    function deleteOne($id)
    {
        $sql = "DELETE FROM orders WHERE id=$id";
        mysqli_query($this->connect, $sql);
    }
    function deleteOrderDetail($id)
    {
        $sql = "DELETE FROM order_detail WHERE order_id = $id";
        mysqli_query($this->connect, $sql);
    }
    function paging($id)
    {
        $location = ($id - 1) * 10;
        $sql = "SELECT *,orders.id as order_id,users.email as users_name FROM orders INNER JOIN users ON orders.user_id = users.id LIMIT $location ,10";
        $result = mysqli_query($this->connect, $sql);
        return $result;
    }
    function getByOrderId($orderId)
    {
        $sql = "SELECT * FROM order_detail  WHERE order_id = $orderId";
        $result = mysqli_query($this->connect, $sql);
        return mysqli_fetch_assoc($result);
    }
}
