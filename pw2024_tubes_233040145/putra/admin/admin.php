<?php

require '../inc/function.php';

$trending = query("SELECT * FROM trending");

if(isset($_POST["cari"])){
    $trending = cari($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/admin.css">
    <title>Halaman Administrator</title>

    <style>
        #spinner {
            display: none;
        }
    </style>
</head>

<body>


    <a href="">Logout</a>

    <h1>Daftar Film</h1>


    <a href="CRUD/tambah.php">Tambah data pelanggan</a>
    <br><br>

    <form action="" method="post">
        <input type="search" name="keyword" placeholder="Cari disini..." size="40" autocomplete="off" id="keyword">
        <button type="submit" name="cari" id="cari">Cari</button>
    </form>

    <br>

    <img src="img/spinner.gif" width="30" id="spinner">

    <div id="container">
        <table border="1" cellpadding="10" cellspacing="0">


            <tr>
                <th>No.</th>
                <th>Aksi</th>
                <th>Gambar</th>
                <th>Judul</th>
                <th>Genre</th>
            </tr>

            <?php if (empty($trending)) : ?>
                <tr>
                    <td colspan="7" align="center">Data pelanggan tidak di temukan</td>
                </tr>
            <?php endif; ?>

            <?php $i = 1; ?>
            <?php foreach ($trending as $row) : ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td>
                        <a href="CRUD/ubah.php?id=<?= $row["id"]; ?>">ubah</a>
                        <a href="CRUD/hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?');">hapus</a>
                    </td>
                    <td><img src="../images/upload/<?= $row["gambar"]; ?>" width="120px"></td>
                    <td><?= $row["judul"]; ?></td>
                    <td><?= $row["genre"]; ?></td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>






        </table>






</body>

</html>