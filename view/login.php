<?php 
    // Memanggil source code bagian header
    require 'layout/header.php'; 
    
    session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();

    // Cek apakah user sudah login ?
    if(isset($_SESSION['user'])){
        // Jika sudah login, redirect ke halaman dashboard
        header('Location: ../view/dashboard.php');
    }
?>

<!-- Import CSS untuk tampilan halaman login -->
<link rel="stylesheet" href="../assets/css/login.css">

<div class="card">
    <div class="text-left py-3">
        <h2 class="fw-bold">Login</h2>
        <p class="text-sm fw-light">Aplikasi Monitoring Kesehatan karyawan</p>
    </div>
    
    <div>
        <!-- Form Login menggunakan username dan passowrd -->
        <form action="../controllers/authController.php" method="post" class="row g-3">
            <input type="hidden" name="type" value="login">
            <div class="col-12">
                <label>Username</label>
                <input type="text" name="username" class="form-control" placeholder="Username">
            </div>
            <div class="col-12">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
            <div class="mt-2 proceed"> 
                <div class="form-check mb-1"> 
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"> 
                    <label class="form-check-label" for="flexCheckDefault"> Remember Me </label> 
                </div>
            </div>
            <div class="col-12 d-grid gap-2">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
    </div>
</div>

<?php 
    // Memanggil source code bagian footer
    require 'layout/footer.php'; 
?>