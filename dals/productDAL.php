<?php

require_once 'DB.php';

class productDAL extends DB
{

    function getList()
    {
        $sql = "SELECT *, products.name as product_name, products.id as product_id , category.name as category_name,category.id as category_id
          FROM products LEFT JOIN category ON products.category_id = category.id";
        $result = mysqli_query($this->connect, $sql);
        return $result;
    }

    function getSearch($min, $max)
    {
        $sql = "SELECT *, products.name as product_name, products.id as product_id , category.name as category_name,category.id as category_id
        FROM products LEFT JOIN category ON products.category_id = category.id WHERE price BETWEEN $min AND $max";
        $result = mysqli_query($this->connect, $sql);
        return $result;
    }

    function getOne($id)
    {
        $sql = "SELECT * FROM products  WHERE id = $id";
        $result = mysqli_query($this->connect, $sql);
        return mysqli_fetch_assoc($result);
    }

    function deleteOne($id)
    {
        $sql = "DELETE FROM products WHERE id=$id";
        mysqli_query($this->connect, $sql);
    }

    function add($name, $price, $image, $description, $category_id)
    {
        $sql = "INSERT INTO products (name,price,description,image,category_id) value ('$name', $price,'$description','$image',$category_id) ";
        return mysqli_query($this->connect, $sql);
    }

    function edit($id, $name, $price, $description, $image, $category_id)
    {
        $sql = "UPDATE `products` SET `name`='$name', price= $price ,`description`='$description',`image`='$image',`category_id`=$category_id WHERE id=$id";
       return mysqli_query($this->connect, $sql);
    }

    function edit1($id, $name, $price, $description, $category_id)
    {
        $sql = "UPDATE `products` SET `name`='$name', `price`= '$price' ,`description`='$description',`category_id`='$category_id' WHERE id=$id";
       return mysqli_query($this->connect, $sql);
    }

    function getListByIdCategory($category_id)
    {
        $sql = "SELECT * FROM products WHERE category_id = $category_id LIMIT 0,8";
        $result = mysqli_query($this->connect, $sql);
        echo mysqli_error($this->connect);
        return $result;
    }

    function paging($id)
    {
        $location = ($id - 1) * 10;
        $sql = "SELECT *, products.name as product_name, products.id as product_id , category.name as category_name,category.id as category_id
        FROM products LEFT JOIN category ON products.category_id = category.id LIMIT $location ,10";
        $result = mysqli_query($this->connect, $sql);
        return $result;
    }
    function getOrder($arr){
        $sql = "SELECT * FROM `products` WHERE `id` IN ($arr)";
        $result = mysqli_query($this->connect, $sql);
        return $result;
    }
    function searchIndex($search){
        $sql = "SELECT * FROM products WHERE name LIKE '%$search%'";
        $result = mysqli_query($this->connect, $sql);
        return $result;
    }
    function checkCate($category_id){
        $sql = "SELECT * FROM products WHERE category_id = $category_id";
        $result = mysqli_query($this->connect, $sql);
        return $result;
    }
}
