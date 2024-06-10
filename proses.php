<?php

error_reporting(1);
include 'Client.php';

if ($_POST['action'] == 'add') {
    
    $abc->create([
        'id' => $_POST['id'],
        'nama' => $_POST['nama']
    ]);
    header('location:index.php?page=list');

} elseif ($_POST['action'] == 'update') {

    $abc->update([
        'id' => $_POST['id'],
        'nama' => $_POST['nama']
    ]);
    header('location:index.php?page=list');

} elseif ($_GET['action'] == 'delete') {

    $abc->delete($_GET['id']);
    header('location:index.php?page=list');
    
}