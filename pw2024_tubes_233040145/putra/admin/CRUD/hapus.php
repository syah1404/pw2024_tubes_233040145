<?php
require '../../inc/function.php';

$id = $_GET["id"];

if (hapus($id) > 0) {
    echo "
        <script>
            alert('data berhasil Dihapus!');
            document.location.href = '../admin.php';
        </script>
        ";
} else {
    echo "
        <script>
            alert('data gagal dihapus!');
            document.location.href = '../admin.php';
        </script>
        ";
}
