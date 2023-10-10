<?php
    // Memanggil file model/user.php dan config/database.php
    require '../model/user.php';
    require_once '../config/database.php';

    session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();

    class authController{
        function __construct(){   
            // Memanggil class database pada config/database.php     
			$this->obj_config = new database();

            // Memanggil class/model user pada model/user.php
			$this->obj_user =  new user($this->obj_config);
		}

        public function login(){
            // Memanggil function login pada class user untuk melakukan proses login
            $login = $this->obj_user->login();
            
            // Cek apakah login berhasil ?
            if($login){
                // Return 'true' atau login berhasil. Redirect ke halaman dashboard
                header('Location: dashboardController.php?type=index');
            }else{
                // Return 'false' atau login gagal. Redirect ke halaman login
                header("Location: ../view/login.php");
            }
        }

        public function logout(){
            // Menghapus semua session 
            session_unset();
            session_destroy();
            
            // Redirect ke halaman utama (index)
            header("Location: ../index.php");
            exit();
        }
    }

    $init = new authController;

    // Cek apakah method yang dikirm ?
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Method yang dikirim 'POST'

        // Cek type yang dikirim
        switch($_POST['type']){
            //Jika type 'login'
            case 'login':
                // Memanggil function login
                $init->login();
                break;
            default:
            header('Location: ../index.php');
        }   
    }elseif($_SERVER['REQUEST_METHOD'] == 'GET'){
        // Method yang dikirim 'POST'

        // Cek type yang dikirim
        switch($_GET['type']){
            //Jika type 'logout'
            case 'logout':
                // Memanggil function logout
                $init->logout();
                break;
            default:
            header('Location: ../index.php');
        } 
    }


?>