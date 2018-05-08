<?php
/*
 * Required params, username,password
 * returns true, false, exists
 */
require_once('../classes/DB.php');
if(isset($_POST['username'])){
    $username=$_POST['username'];
    $password=$_POST['password'];
    if(userExists($username)==true){
        die("exists");
    }
    $hash=password_hash($password,PASSWORD_DEFAULT);
    $query="insert into user(username,password,type) values(?,?,'student')";
    $db=new DB();
    $stmt=$db->connect()->prepare($query);
    $stmt->bind_param('ss',$username,$password);
    $r=$stmt->execute();
    $stmt->close();
    if($r>0)
        die("true");
    else die("false");
}
function userExists($username){
    $query="select username from user where username=?";
    $db=new DB();
    $stmt=$db->connect()->prepare($query);
    $stmt->bind_param('s',$username);
    $stmt->execute();
    $result=$stmt->get_result();
    $stmt->close();
    if($row=$result->fetch_assoc()){
        return true;
    }
    return false;
}