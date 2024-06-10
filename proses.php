<?php

error_reporting(1);
include 'client.php';

if ($_POST['aksi'] == 'add') {
    
    $abc->create([
        'id_barang' => $_POST['id_barang'],
        'nama_barang' => $_POST['nama_barang']
    ]);
    header('location:index.php?page=list');

} elseif ($_POST['aksi'] == 'update') {

    $abc->update([
        'id_barang' => $_POST['id_barang'],
        'nama_barang' => $_POST['nama_barang']
    ]);
    header('location:index.php?page=list');

} elseif ($_GET['aksi'] == 'delete') {

    $abc->delete($_GET['id_barang']);
    header('location:index.php?page=list');
    
}