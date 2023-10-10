<?php
	
	class user{
        function __construct($config){
            // Deklarasi dan inisialisasi data konfigurasi database (sesuai dengan file database.php)
			$this->host = $config->host;
			$this->user = $config->user;
			$this->pass = $config->pass;
			$this->db   = $config->db;            					
		}

		public function open_db(){
            // Melakukan koneksi ke database
			$this->connection_db=new mysqli($this->host,$this->user,$this->pass,$this->db);

            // Cek apakah koneksi gagal ?
			if ($this->connection_db->connect_error) {
    			die("Koneksi ke database gagal: " . $this->connection_db->connect_error);
			}
		}

        public function close_db(){
            // Menutup koneksi ke database
			$this->connection_db->close();
		}	

        public function login(){
            // Cek apakah user sudah mengisi username dan password ?
            if(isset($_REQUEST['username']) && isset($_REQUEST['password'])){
                // Username & password lengkap

                // Mencari data user berdasarkan username yang diinput
                $user = $this->findByUsername($_REQUEST['username']);

                // Cek apakah data user tersedia ?
                if(!empty($user)){
                    
                    // Cek apakah password yang diinput sesuai dengan password pada database ?
                    if($user['Password'] == md5($_REQUEST['password'])){
                        // Password sesuai
                        
                        $_SESSION['user'] = $user;

                        // Kirim nilai true (login berhasil)
                        return true;
                    }else{
                        // Password tidak sesuai. kirim nilai false
                        return false;
                    }
                }else{
                    // Data user tidak tersedia. kirim nilai false
                    return false;
                }

            }else{
                // Username & password tidak lengkap. kirim nilai false
                return false;
            }
        }

        public function findByUsername($username){
            // Memanggil function open_db (memulai koneksi)
            $this->open_db();

            // Membuat query untuk mengambil data berdasarkan username
            $query = $this->connection_db->prepare("SELECT * FROM user WHERE username=?");
			$query->bind_param("i",$username);

            // Mengeksekusi query dan memindahkan hasil query ke variable $res
            $query->execute();
            $res = $query->get_result();	
			$query->close();

            // Memanggil function close_db (menutup koneksi)
            $this->close_db(); 

            // Mengirim data yang berhasil diambil
            return $res->fetch_assoc();
        }
    }

?>