<?php

$conn = mysqli_connect("localhost", "root", "", "pw2024_tubes_233040145");

function query($query)
{

    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;

}

function tambah($data)
{

    global $conn;
    $judul = htmlspecialchars($data['judul']);
    $genre = htmlspecialchars($data['genre']);

    $gambar = upload();

    if (!$gambar) {
        return false;
    }

    $query = "INSERT INTO trending 
                VALUES 
               ('0', '$gambar', '$judul', '$genre') 
    ";

    mysqli_query($conn, $query);

    mysqli_affected_rows($conn);
}

function upload()
{

    $namaFile = $_FILES["gambar"]["name"];
    $ukuran = $_FILES["gambar"]["size"];
    $tmpName = $_FILES["gambar"]["tmp_name"];
    $error = $_FILES["gambar"]["error"];

    if ($error === 4) {
        echo "
        <script>
            alert('Silahkan pilih gambar terlebih dahulu!')
        </script>";
        return false;
    }

    $ekstensiGambarValid = ["jpg", "jpeg", "png"];
    $ekstensiGambar = explode(".", $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "
        <script>
            alert('yang anda upload bukan gambar!')
        </script>";
        return false;
    }

    if($ukuran > 1000000){
        echo "
        <script>
            alert('ukuran gambar terlalu besar!')
        </script>";
        return false;
    }

    $namaFileBaru = uniqid() . '.' . $ekstensiGambar;

    move_uploaded_file($tmpName, '../../images/upload/' . $namaFileBaru);

    return $namaFileBaru;

}

function hapus($id){

    global $conn;
    mysqli_query($conn, "DELETE FROM trending WHERE id = $id");
    mysqli_affected_rows($conn);

}

function ubah($data){
    global $conn;
    $id = $data["id"];
    $judul = htmlspecialchars($data["judul"]);
    $genre = htmlspecialchars($data["genre"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    // Cek apakah user pilih gambar baru atau tidak
    if ( $_FILES['gambar']['error']  === 4 ){
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    $query = "UPDATE trending SET
                gambar = '$gambar',
                judul = '$judul',
                genre = '$genre'
              WHERE id = $id      
    ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


function cari($keyword){
    $query = "SELECT * FROM trending
                WHERE 
              judul LIKE '%$keyword%'  
                ";

    return query($query);
}



