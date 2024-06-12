<?php
require '../../inc/function.php';

$id = $_GET["id"];

$trending = query("SELECT * FROM trending WHERE id = $id")[0];

if (isset($_POST["ubah"])) {
	if (ubah($_POST) > 0) {
		echo "<script>
                    alert('data berhasil diubah!');
                    document.location.href = '../admin.php';
            	</scrpit>";
	} else {
		echo "<script>
                    alert('data gagal diubah!');
                    document.location.href = '../admin.php';
            </script>";
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/ubah.css">
	<title>Ubah Data Film</title>
</head>

<body>
	<h1>Ubah Data Film</h1>
	<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo $trending["id"]; ?>">
		<input type="hidden" name="gambarLama" value="<?php echo $trending["gambar"]; ?>">
		<ul>
			<li>
				<label for="judul">Judul : </label>
				<input type="text" name="judul" id="judul" value="<?php echo $trending["judul"]; ?>">
			</li>
			<li>
				<label for="genre">Genre : </label>
				<input type="text" name="genre" id="genre" value="<?php echo $trending["genre"]; ?>">
			<li>
				<label for="gambar">gambar : </label>
				<img src="../../images/upload/<?= $trending["gambar"]; ?>" alt="" width="150px">
				<br>
				<input type="file" name="gambar" id="gambar">
			</li>
			<li>
				<button type="submit" name="ubah">Ubah Data!</button>
			</li>
		</ul>
	</form>
</body>

</html>