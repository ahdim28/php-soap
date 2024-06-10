<?php

error_reporting(1);
include 'database.php';

$uri = 'http:://192.168.56.30';

// set uri server
$options = ['uri' => $uri];

// buat objek baru dari class Soap Server
$server = new SoapServer(NULL, $options);

// masukan class database ke objek SOAP Server
$server->setClass('database');

// jalankan menggunakan SOAP request handler
$server->handle();