<?php

require '../../inc/function.php';

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

    if (tambah($_POST) > 0) {
        echo "
        <script>
            alert('data berhasil ditambahkan!');
            document.location.href = '../admin.php';
        </script>";
    } else {
        echo "
        <script>
            alert('data gagal ditambahkan!');
            document.location.href = '../admin.php';
        </script>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/tambah.css">
    <title>Tambah Data Film</title>
</head>

<body>
    <h1>Tambah Data Film</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="gambar">Gambar :</label>
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <label for="judul">Judul :</label>
                <input type="text" name="judul" id="judul" required>
            </li>
            <li>
                <label for="genter">Genre :</label>
                <input type="text" name="genre" id="genre" required>
            </li>
        </ul>

        <button name="submit" class="btn">Tambahkan Data</button>
    </form>



</body>

</html>