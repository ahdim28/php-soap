<?php

error_reporting(1); // tampilkan error

class Database
{
    // set variable yang dibutuhkan
    private $hostname  = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "kuliah_sister_toko";
    private $port = null;
    private $socket = null;
    //
    private $conn;

    // fungsi yang pertama kali diload saat class dipanggil
    public function __construct()
    {
        try {

            $this->conn = new mysqli(
                $this->hostname , 
                $this->username, 
                $this->password, 
                $this->dbname, 
                $this->port,
                $this->socket
            );

        } catch (PDOException $e) {
            echo "Koneksi database gagal. Error : ".$e->getMessage();
        }   
    }

    /**
     * fungsi untuk menampilkan semua data
     */
    public function showAll()
    {
        $query = $this->conn->query("SELECT id, nama FROM barang ORDER BY id DESC");
        
        $data = [];
        if ($query->num_rows > 0) {
            while ($row = $query->fetch_assoc()) {
                $data[] = [
                    'id' => $row['id'],
                    'nama' => $row['nama']
                ];
            }
        }

        return $data;
        
        $query->close();
        unset($data);
    }

    /**
     * fungsi untuk menampilkan data berdasarkan ID
     * 
     * @param string $id
     * 
     * @return array
     */
    public function show(string $id): array
    {
        $query = $this->conn->query("SELECT id, nama FROM barang WHERE id = $id");
        
        $data = $query->fetch_assoc();

        return $data;

        $query->close();
        unset($id, $data);
    }

    /**
     * fungsi untuk insert data
     * 
     * @param array $input
     * 
     * @return bool
     */
    public function create(array $input = []): bool
    {
        $id = $input['id'];
        $nama = $input['nama'];

        $query = $this->conn->query("INSERT INTO barang (id, nama) VALUES ('$id', '$nama')");

        return $query;

        $query->close();
        unset($input);
    }

    /**
     * fungsi untuk update data
     * 
     * @param array $input
     * 
     * @return bool
     */
    public function update(array $input = []): bool
    {
        $id = $input['id'];
        $nama = $input['nama'];

        $query = $this->conn->query("UPDATE barang SET id = '$id', nama = '$nama' WHERE id = '$id'");

        return $query;

        $query->close();
        unset($input);
    }

    /**
     * fungsi untuk hapus data
     * 
     * @param string $id
     * 
     * @return bool
     */
    public function delete(string $id): bool
    {
        $query = $this->conn->query("DELETE FROM barang WHERE id = '$id'");

        return $query;

        $query->close();
        unset($id);
    }
}