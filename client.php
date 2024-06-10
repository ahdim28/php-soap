<?php

error_reporting(1);

class Client
{
    private $options, $api;

    // fungsi yang pertama kali diload saat class dipanggil
    public function __construct($uri, $location)
    {
        $this->options = [
            'location' => $location,
            'uri' => $uri
        ];

        // buat objek baru dari class SOAP Client
        $this->api = new SoapClient(NULL, $this->options);

        // menghapus variable dari memory
        unset($uri, $location);
    }

    /**
     * fungsi untuk menghapus selain huruf dan angka
     * 
     * @param string $filter
     * 
     * @return string
     */
    public function filter(string $filter): string 
    {
        $filter = preg_replace('/[^a-zA-Z0-9]/', '', $filter);

        return $filter;
        
        unset($filter);
    }

    /**
     * fungsi untuk menampilkan data
     * 
     * @return mix
     */
    public function showAll()
    {
        $data = $this->api->showAll();

        return $data;

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
        $id = $this->filter($id);
        $data = $this->api->show($id);

        return $data;

        unset($id, $data);
    }

    /**
     * fungsi untuk insert data
     * 
     * @param array $input
     * 
     * @return bool
     */
    public function create(array $input): bool
    {
        $create = $this->api->create($input);

        return $create;

        unset($input);
    }

    /**
     * fungsi untuk update data
     * 
     * @param array $input
     * 
     * @return bool
     */
    public function update(array $input): bool
    {
        $update = $this->api->update($input);

        return $update;

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
        $delete = $this->api->delete($id);

        return $delete;

        unset($id);
    }

    // fungsi yang terakhir kali diload saat class dipanggil
    public function __destruct()
    {
        // hapus variable dari memory
        unset($this->options, $this->api);   
    }
}

// url dan location server
$uri = 'http://kuliah.vm/';
$location = $uri.'sister/soap/server.php';

// buat objek baru dari class client
$abc = new Client($uri, $location);