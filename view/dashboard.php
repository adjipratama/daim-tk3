<?php
    // Memanggil source code bagian header
    require 'layout/header.php'; 

    session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();
        
    // Cek apakah user sudah login dan memiliki data role ?
    if(isset($_SESSION['role'])){
        $myRole = $_SESSION['role'];
        // Memanggil halaman dashboard sesuai dengan role user
        require 'dashboard/'.strtolower($myRole['NamaRole']).'.php';
    }else{
        // Data role tidak ada, redirect untuk mendapatkan data role
        header('Location: ../controllers/dashboardController.php?type=index');
    }

    // Memanggil source code bagian footer
    require 'layout/footer.php'; 
?>