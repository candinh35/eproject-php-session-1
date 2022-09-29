<?php
require_once "DB.php";

class orderDetailDAL extends DB
{
    function getList()
    {
        $sql = "SELECT *,order_detail.id as order_detail_id , products.name as product_name  FROM order_detail INNER JOIN products ON order_detail.product_id = products.id";
        $result =  mysqli_query($this->connect, $sql);
        return $result;
    }
    function makeOrderDetail($data)
    {
        $sql = "INSERT INTO `order_detail`(`product_id`, `order_id`, `price`, `quantity`, `sub_total`) VALUES $data";
        return mysqli_query($this->connect, $sql);
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
        $sql = "SELECT *,order_detail.id as order_detail_id , products.name as product_name FROM order_detail  INNER JOIN products ON order_detail.product_id = products.id WHERE order_id = $orderId ";
        $result = mysqli_query($this->connect, $sql);
        return $result;
    }
}
