<?php 
    header("content-type:text/html;chaset=utf-8");
    session_start();
    include_once("../models/selectUser.php");
    $userName = $_POST["userName"];
    $userPW = $_POST["userPW"];
    $btnlogin = $_POST["btnlogin"];
    $btnlogout = $_POST["logout"];
    
    if(isset ($btnlogin))
    {
        $row = selectUser($userName);
        if($userName == $row['userName'] && $userPW ==$row['userPW'])
        {
            $_SESSION['userName'] = $userName;
            header("location:../views/indexx.php"); 
        }
        else
            header("location:../views/LoginFail.php");
    }
    
    if(isset($btnlogout))
    {
        unset($_SESSION['userName']);
        header("location:../views/Logout.php");
    }
?>