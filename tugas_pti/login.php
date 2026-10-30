<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $error = "Username dan password wajib diisi.";
    } else {
        $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
        if (mysqli_num_rows($query) > 0) {
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $username;
            header("Location: index.php");
            exit;
        } else {
            $error = "Kredensial salah.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<body>
    <h2><?= $teks[$lang]['login'] ?></h2>
    <a href="?lang=id">ID</a> | <a href="?lang=en">EN</a>
    <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST" action="">
        <input type="text" name="username" placeholder="Username"><br><br>
        <input type="password" name="password" placeholder="Password"><br><br>
        <button type="submit"><?= $teks[$lang]['login'] ?></button>
    </form>
</body>
</html>