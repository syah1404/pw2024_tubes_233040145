<?php
// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "tubes");


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

//hapus data dari tiap elemen dalam form
function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM Admins WHERE id = $id");

    return mysqli_affected_rows($conn);
}

//ambil data dari tiap elemen dalam form
function tambah($data)
{
    global $conn;

    $nik = htmlspecialchars($data["nik"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $asalkota = htmlspecialchars($data["asalkota"]);
    $gambar = htmlspecialchars($data["gambar"]);

    // jika user tidak pilih gambar
    if ($_FILES['gambar']['eror'] == 4) {
        echo "<script>
                    alert('harap pilih gambar terlebih dahulu!');
                    document.location.href = 'tambah.php';
                </script>";
        return false;
    }

    if (!cek_gambar()) {
        return false;
    }


    // buat nama file baru
    $ekstensiGambar = explode('.', $_FILES['gambar']['nama']);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    $nama_file_baru = uniqid() . '.' . $ekstensiGambar;
    $gambar = $nama_file_baru;

    move_uploaded_file($_FILES['gambar']['tmp_name'], 'img/' . $gambar);

    $sql = "INSERT INTO Admins
                            VALUES
                    ('', '$nik', '$nama', '$email', '$asalkota', '$gambar')";
    mysqli_query($conn, $sql);
    //query insert data
    $query = "INSERT INTO pelanggan
                VALUES
                ('', '$nik', '$nama', '$email', '$asalkota', '$gambar')
                ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


function cek_gambar()
{
    // ambil data gambar
    $gambar = $_FILES["gambar"]["name"];
    $tmp_name = $_FILES["gambar"]["tmp_name"];
    $ukuran = $_FILES["gambar"]["size"];
    $tipe = $_FILES["gambar"]["type"];
    $error = $_FILES["gambar"]["error"];

    // pengecekan gambar
    // jika ukuran file melebihi 5MB
    if ($ukuran > 5000000) {
        echo "<script>
                        alert('ukuran file terlalu besar!');
                        document.location.href = '';
                        </script>";
        return false;
    }


    // jika bukan gambar
    $tipeGambarAman = ['jpg', 'jpeg', 'png', 'gif'];
    $ekstensiGambar = explode('.', $gambar);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $tipeGambarAman)) {
        echo "<script>
            alert('yang anda pilih bukan gambar!');
            document.location.href = '';
            </script>";
        return false;
    }

    return true;
}

function ubah($data) {
    global $conn;

    $id = $data["id"];
    $nik = htmlspecialchars($data["nik"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $asalkota = htmlspecialchars($data["asalkota"]);
    $gambar = htmlspecialchars($data["gambar"]);

    // cek apakah user upload gambar baru 
    if($_FILES['gambar']['eror'] === 0) {
        // cek gambar
        if( ! cek_gambar() ) {
            return false;
        }

        // upload gambar baru
        $ekstensiGambar = explode('.', $_FILES['gambar']['name']);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        $nama_file_baru = uniqid() . '.' . $ekstensiGambar;
        $gambar = $nama_file_baru;

        move_uploaded_file($_FILES['gambar']['tmp_nama'], 'img/' . $gambar);
    }

    $sql = "UPDATE Admins SET
                        nik = '$nik',
                        nama = '$nama',
                        email = '$email',
                        asalkota = '$asalkota',
                        gambar = '$gambar'
                    WHERE
                        id = $id
                        
                    ";
    
    mysqli_query($conn, $sql);

    return mysqli_affected_rows($conn);
}

function register($data) {
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);
    // $email = htmlspecialchars($_POST["email"]);

    // cek username sudah pernah ada atau belum
    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    if( mysqli_fetch_assoc($result) ) {
        echo "<script>
                    alert('username sudah terpakai!');
                    </script>";
        return false;
    }


    // cek konfirmasi password
    if( $password !== $password2) {
        echo "<script>
                alert('konfirmasi password tidak sesuai!');
                </script>";
        return false;
    }

    // tambahkan user baru ke database
        mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");

        return mysqli_affected_rows($conn);

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // insert ke DB
    // $sql = "INSERT INTO user VALUES ('', '$username', '$password', '$email', CURRENT_TIMESTAMP)";
    // mysqli_query($conn, $sql);

    // return mysqli_affected_rows($conn);
}
?>
