<?php
require 'config.php';
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM mahasiswa");
?>
<!DOCTYPE html>
<html>
<body>
    <h2><?= $teks[$lang]['title'] ?></h2>
    <a href="?lang=id">ID</a> | <a href="?lang=en">EN</a> | <a href="logout.php"><?= $teks[$lang]['logout'] ?></a>
    <br><br>
    <a href="create.php"><?= $teks[$lang]['add'] ?></a>
    <table border="1" cellpadding="10">
        <tr>
            <th><?= $teks[$lang]['nim'] ?></th>
            <th><?= $teks[$lang]['name'] ?></th>
            <th><?= $teks[$lang]['major'] ?></th>
            <th><?= $teks[$lang]['action'] ?></th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $row['nim'] ?></td>
            <td><?= htmlspecialchars($row['nama']) ?></td>
            <td><?= htmlspecialchars($row['jurusan']) ?></td>
            <td>
                <a href="update.php?id=<?= $row['id'] ?>"><?= $teks[$lang]['edit'] ?></a> | 
                <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin?')"><?= $teks[$lang]['delete'] ?></a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>