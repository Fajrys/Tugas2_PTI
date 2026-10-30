<?php
require 'config.php';
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nim = htmlspecialchars($_POST['nim']);
    $nama = htmlspecialchars($_POST['nama']);
    $jurusan = htmlspecialchars($_POST['jurusan']);
	
    if (empty($nim) || empty($nama) || empty($jurusan)) {
        $error = $teks[$lang]['empty_err'];
    } else {
        $query = "INSERT INTO mahasiswa (nim, nama, jurusan) VALUES ('$nim', '$nama', '$jurusan')";
        if (mysqli_query($conn, $query)) {
            header("Location: index.php");
            exit;
        } else {
            $error = "Error: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html>
<body>
    <h2><?= $teks[$lang]['add'] ?></h2>
    <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST" action="">
        <input type="text" name="nim" placeholder="<?= $teks[$lang]['nim'] ?>"><br><br>
        <input type="text" name="nama" placeholder="<?= $teks[$lang]['name'] ?>"><br><br>
        <input type="text" name="jurusan" placeholder="<?= $teks[$lang]['major'] ?>"><br><br>
        <button type="submit"><?= $teks[$lang]['save'] ?></button>
    </form>
</body>
</html>