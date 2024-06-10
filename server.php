<?php

error_reporting(1);
include 'Database.php';

$uri = 'http://kuliah.vm/';

// set uri server
$options = ['uri' => $uri];

// buat objek baru dari class Soap Server
$server = new SoapServer(NULL, $options);

// masukan class database ke objek SOAP Server
$server->setClass('Database');

// jalankan menggunakan SOAP request handler
$server->handle();