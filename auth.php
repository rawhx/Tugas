<?php 
session_start();
switch ($_SERVER["REQUEST_METHOD"]) {
    case 'GET':
        session_unset();
        session_destroy();
        header("location: ./login.php");
        $_SESSION["message"] = "Logout berhasil";
        break;
    case 'POST':
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        if($password == explode("@", $email)[1]) {
            $_SESSION['email'] = $email;
            $_SESSION["message"] = "Login berhasil";
            header("Location: ./");
        } else{
            $_SESSION["message"] = "Email atau password salah";
            header("location: ./login.php");
        }
        break;
    default:
        $_SESSION["message"] = "Method not allowed";
        header("location: ./login.php");
        break;
} 