<?php
    // Memanggil file model/role.php dan config/database.php
    require '../model/role.php';
    require_once '../config/database.php';

    session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();

    class dashboardController{
        function __construct(){          
            // Memanggil class database pada config/database.php  
			$this->obj_config = new database();

            // Memanggil class/model user pada model/role.php
			$this->obj_role =  new role($this->obj_config);
		}

        public function index(){
            // Memanggil function getRole() pada class role untuk mendapatkan data role user
            $myRole = $this->obj_role->getRole($_SESSION['user']['IdRole']);
            $_SESSION['role'] = $myRole;

            // Redirect ke halaman dashboard
            header('Location: ../view/dashboard.php');
        }
    }

    $init = new dashboardController;
    
    // Cek apakah user sudah login ?
    if(isset($_SESSION['user'])){
        // Sudah login
        
        // Cek apakah method yang dikirm GET ?
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            switch($_GET['type']){
                // Jika type 'index' 
                case 'index':
                    // Memanggil function index 
                    $init->index();
                    break;
                default:
                header('Location: ../index.php');
            } 
        }
    }else{
        // Belum login. Redirect ke halaman utama (index)
        header('Location: ../index.php');
    }
    


?>