<?php

error_reporting(1);

class client
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

    // fungsi untuk menghapus selain huruf dan angka
    public function filter(string $data): string 
    {
        $data = preg_replace('/[^a-zA-Z0-9]/', '', $data);
        return $data;
        
        unset($data);
    }

    public function showAllData()
    {
        $data = $this->api->showAllData();
        return $data;

        unset($data);
    }

    public function showData(string $idBarang): array
    {
        $idBarang = $this->filter($idBarang);
        $data = $this->api->showData($idBarang);
        return $data;

        unset($idBarang, $data);
    }

    public function create(array $input): void
    {
        $this->api->create($input);

        unset($input);
    }

    public function update(array $input): void
    {
        $this->api->update($input);

        unset($input);
    }

    public function delete(string $idBarang): void
    {
        $this->api->delete($idBarang);

        unset($idBarang);
    }

    // fungsi yang terakhir kali diload saat class dipanggil
    public function __destruct()
    {
        // hapus variable dari memory
        unset($this->options, $this->api);   
    }
}

// url dan location server
$uri = 'http://192.168.56.30';
$location = $uri.'soap-toko/soap-server/server.php';

// buat objek baru dari class client
$abc = new client($uri, $location);