<?php

    require_once "connect.php";
    session_start();
    session_unset();
    $id = str_replace("\'"," ",$_POST['id'] );
    $pass = $_POST['password'];
    $userQuery="SELECT * from user where username = '$id'";
    $result=mysqli_query($connect, $userQuery);
    $row=mysqli_fetch_assoc($result);
    if(!$result) {
        die ("Could not successfully run the query $userQuery".mysqli_error($connect));
    }
    if(empty($id) || empty($pass))
    {
        header("Location:login.php");       
    }
    if($row['username'] == $id && $row['password'] == $pass)
    {

        $_SESSION['user_level'] = $row['level']; 
        $_SESSION['user_name'] = $row['Fname'];
        header("Location:index.php");
    }
    else
    {
        $_SESSION['error'] = "Username หรือ Password ผิด";
        header("Location:login.php");       
    }

?>