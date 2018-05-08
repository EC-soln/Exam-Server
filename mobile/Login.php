<?php
/*
 * Required: username,password
 * Response: true,false,admin
 */
require_once("../classes/DB.php");
if(isset($_POST['username'])){
    $username=$_POST['username'];
    $password=$_POST['password'];

    $query="select password from user where username? and type='student'";
    $db=new DB();
    $stmt=$db->connect()->prepare($query);
    $stmt->bind_param('s',$username);
    $stmt->execute();
    $result=$stmt->get_result();
    $stmt->close();
    if($row=$result->fetch_assoc()){
        $hash=$row['password'];
        if(password_verify($password,$hash)==true){
            die("true");
        }
        else{
            die("false");
        }
    }else{
        die("true");
    }
}