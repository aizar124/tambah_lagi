<?php
include "koneksi.php";
session_start();
$id = $_POST['id'];
$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username = '$username' AND password = md5('$password') " ;
$query = mysqli_query($koneksi,$sql);
$role = mysqli_fetch_assoc($query);
if ($role['role']== "customer"){
        $_SESSION['username'] = $username;
        if($id == 2){
            header("location:kursi.php?login=sukses");
            exit;
        }else{
            header("location:home.php?login=sukses"); 
            exit;
        }
        
    
}else if($role['role']=="admin"){
    header("location:admin_azfa.php?loginAdmin=sukses");
    $_SESSION['admin'] = $username;
    exit;
    
}else{
    header("location:login.php?login=gagal");
    exit;
}

?>