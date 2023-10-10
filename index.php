
<?php
    session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();
    
    // Cek apakah user sudah login ?
    if(isset($_SESSION['user'])){
        // Jika sudah login, redirect ke halaman dashboard
        header('Location: view/dashboard.php');
    }else{
        // Jika belum, redirect ke halaman login
        header('Location: view/login.php');
    } 
?>

   