<?php
require 'config.php';

if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}
$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE id='$id'");
$data = mysqli_fetch_assoc($result);

if (!$data) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nim = htmlspecialchars($_POST['nim']);
    $nama = htmlspecialchars($_POST['nama']);
    $jurusan = htmlspecialchars($_POST['jurusan']);
    if (empty($nim) || empty($nama) || empty($jurusan)) {
        $error = $teks[$lang]['empty_err'];
    } else {
        $query = "UPDATE mahasiswa SET nim='$nim', nama='$nama', jurusan='$jurusan' WHERE id='$id'";
        if (mysqli_query($conn, $query)) {
            header("Location: index.php");
            exit;
        } else {
            $error = "Gagal memperbarui data: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= $teks[$lang]['edit'] ?> - <?= $teks[$lang]['title'] ?></title>
</head>
<body>
    <h2><?= $teks[$lang]['edit'] ?> <?= $teks[$lang]['title'] ?></h2>
    
    <a href="?id=<?= $id ?>&lang=id">ID</a> | <a href="?id=<?= $id ?>&lang=en">EN</a>
    <br><br>

    <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <form method="POST" action="">
        <label><?= $teks[$lang]['nim'] ?>:</label><br>
        <input type="text" name="nim" value="<?= htmlspecialchars($data['nim']) ?>"><br><br>

        <label><?= $teks[$lang]['name'] ?>:</label><br>
        <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>"><br><br>

        <label><?= $teks[$lang]['major'] ?>:</label><br>
        <input type="text" name="jurusan" value="<?= htmlspecialchars($data['jurusan']) ?>"><br><br>

        <button type="submit"><?= $teks[$lang]['save'] ?></button>
        <a href="index.php">Batal</a>
    </form>
</body>
</html>