<?php

require_once 'DB.php';
class userDAL extends DB
{

    function getList()
    {
        $sql = "SELECT * FROM users";
        $result = mysqli_query($this->connect, $sql);
        return $result;
    }
    function getSearch($name)
    {
        $sql = "SELECT * fROM users WHERE email = '$name'";
        $result = mysqli_query($this->connect, $sql);
        return $result;
    }
    function getOne($id)
    {
        $sql = "SELECT * FROM users WHERE id = $id";
        $result = mysqli_query($this->connect, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    function deleteOne($id)
    {
        $sql = "DELETE FROM users WHERE id=$id";
        mysqli_query($this->connect, $sql);
    }

    function add($email, $password,$phone, $address)
    {
        $sql = "INSERT INTO users (email,password,phone,address) value ('$email', '$password','$phone', '$address') ";
        return mysqli_query($this->connect, $sql);
    }
    function edit($id,$email, $password ,$phone ,$address)
    {
        $sql = "UPDATE `users` SET `email`='$email', `password`='$password',`phone`='$phone' ,`address`='$address' WHERE id=$id";
        mysqli_query($this->connect, $sql);
    }

    function editUser($id, $password ,$phone ,$address)
    {
        $sql = "UPDATE `users` SET `password`='$password',`phone`='$phone',`address`='$address' WHERE id=$id";
        mysqli_query($this->connect, $sql);
    }
    function login($email, $password)
    {
        $sql = "SELECT * FROM users where email = '$email' and password = '$password'";
        $result = mysqli_query($this->connect, $sql);
        return $result;
    }
    function signup($email)
    {
        $sql = "SELECT * FROM users where email = '$email'";
        $result = mysqli_query($this->connect, $sql);
        return $result;
    }
    function paging($id){
        $location = ($id-1)*10;
        $sql = "SELECT * FROM users LIMIT $location ,10";
        $result = mysqli_query($this->connect, $sql);
    return $result;
    }
}
