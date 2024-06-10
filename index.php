<?php
    error_reporting(1);
    include "client.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOAP</title>
</head>
<body>

    <a href="?page=home">Home</a> | 
    <a href="?page=add">Tambah Data</a> | 
    <a href="?page=list">Data Server</a>
    <br><br>

    <fieldset>
        <?php if ($_GET['page'] == 'add') { ?>
            <legend>Tambah Data</legend>
            <form name="form" action="proses.php" method="POST">
                <input type="hidden" name="action" value="add">
                <label for="">ID Barang</label>
                <input type="text" name="id">
                <br>
                <label for="">Nama Barang</label>
                <input type="text" name="nama">
                <br>
                <button type="submit" name="save">Simpan</button>
            </form>
        <?php } elseif ($_GET['page'] == 'update') {
            $getOneData = $abc->show($_GET['id']);
        ?>
            <legend>Ubah Data</legend>
            <form name="form" action="proses.php" method="POST">
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="id" value="<?= $getOneData['id']?>">
                <label for="">ID Barang</label>
                <input type="text" value="<?= $getOneData['id']?>" disabled>
                <br>
                <label for="">Nama Barang</label>
                <input type="text" name="nama" value="<?= $getOneData['nama']?>">
                <br>
                <button type="submit" name="update">Ubah</button>
            </form>
        <?php unset($getOneData); } elseif ($_GET['page'] == 'list') { ?>
            <legend>Daftar Data Server</legend>
            <table border="1">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="10%">ID Barang</th>
                        <th width="75%">Nama</th>
                        <th width="5%" colspan="2">Aks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        $result = $abc->showAll();
                        foreach ($result as $item) {
                    ?>
                    <tr>
                        <td><?= $no++?></td>
                        <td><?= $item['id']?></td>
                        <td><?= $item['nama']?></td>
                        <td>
                            <a href="?page=update&id=<?= $item['id']?>">Ubah</a>
                        </td>
                        <td>
                            <a href="proses.php?action=delete&id=<?= $item['id']?>" 
                                onclick="return confirm('Apakah anda ingin menghapus data ini ?')">Hapus</a>
                        </td>
                    </tr>
                    <?php } unset($result, $item, $no); ?>
                </tbody>
            </table>
        <?php } else {?>
            <legend>Home</legend>
            Aplikasi sederhana ini menggunakan web service SOAP (Simple Object Access Protocol) dengan format data XML (Extensible Markup Language)
        <?php }?>
    </fieldset>

</body>
</html>