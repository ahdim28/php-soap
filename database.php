<?php

error_reporting(1); // tampilkan error

class Database
{
    private $host = "localhost";
    private $dbname = "kuliah_sister_toko";
    private $user = "root";
    private $password = "";
    private $port = "3306";
    private $conn;

    // fungsi yang pertama kali diload saat class dipanggil
    public function __construct()
    {
        try {

            $this->conn = new PDO(
                "mysql:host=$this->host;port=$this->port;dbname=$this->dbname;charset=utf8", 
                $this->user,
                $this->password
            );

        } catch (PDOException $th) {
            echo "Koneksi Gagal";
        }   
    }

    public function list(int $idBarang): array
    {
        $query = $this->conn->prepare("SELECT id_barang, nama_barang, FROM barang WHERE id_barang=?");
        $query->execute([$idBarang]);

        // mengambil satu data dengan fetch
        $data = $query->fetch(PDO::FETCH_ASSOC);
        // mengembalikan data
        return $data;

        // hapus variable dari memory
        $query->closeCursor();
        unset($idBarang, $data);
    }

    public function create(array $input): void
    {
        $query = $this->conn->prepare("INSERT IGNORE INTO barang (id_barang, nama_barang) VALUES (?, ?)");
        $query->execute([$input['id_barang'], $input['nama_barang']]);
        $query->closeCursor();

        unset($input);
    }

    public function update(array $input): void
    {
        $query = $this->conn->prepare("UPDATE barang SET nama_barang=? WHERE id_barang=?");
        $query->execute([$input['nama_barang'], $input['id_barang']]);
        $query->closeCursor();

        unset($input);
    }

    public function delete(int $idBarang): void
    {
        $query = $this->conn->prepare("DELETE FROM barang WHERE id_barang=?");
        $query->execute([$idBarang]);
        $query->closeCursor();

        unset($idBarang);
    }
}