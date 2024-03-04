<?php
session_start();
include('../includes/db.php');

// Cek apakah pengguna sudah login, jika ya, arahkan ke dashboard
if(isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}

// Proses form login ketika dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirimkan melalui form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk mencari pengguna dengan kredensial yang sesuai
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    // Periksa apakah pengguna ditemukan dalam database
    if ($result->num_rows == 1) {
        // Jika ditemukan, set session dan arahkan ke dashboard
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        // Jika tidak ditemukan, tampilkan pesan error
        $error_message = "Username atau password salah.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<header>
    <!-- Navbar atau bagian header lainnya -->
</header>

<main>
    <div class="container">
        <h2>Login</h2>
        <!-- Form login -->
        <form action="" method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" required><br><br>
            <label for="password">Password:</label>
            <input type="password" name="password" required><br><br>
            <input type="submit" value="Login">
        </form>
        <?php if(isset($error_message)) { ?>
            <p><?php echo $error_message; ?></p>
        <?php } ?>
    </div>
</main>

<footer>
    <p>Hak Cipta &copy; 2024 Situs Web Kami</p>
</footer>

</body>
</html>
