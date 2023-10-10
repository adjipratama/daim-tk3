<?php
	
	class role{
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

        public function getRole($idRole){
            // Memanggil function open_db (memulai koneksi)
            $this->open_db();

            // Membuat query untuk mengambil data role berdasarkan ID Role
            $query = $this->connection_db->prepare("SELECT * FROM role WHERE IdRole=?");
			$query->bind_param("i",$idRole);

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