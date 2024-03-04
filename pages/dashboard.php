<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include('../includes/db.php');
include('../includes/pokeapi.php');

// Ambil data generasi Pokemon dari API
$pokemonGenerations = getPokemonGenerations();

// Inisialisasi pesan
$message = "";

// Proses form jika ada data yang dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Cek apakah generasi dipilih
    if(isset($_POST['generation'])) {
        // Simpan pesan untuk ditampilkan
        $message = "Selamat, data Anda telah ter-voting!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <script>
        // Fungsi untuk menampilkan popup dan redirect
        function showPopupAndRedirect(message, url) {
            alert(message);
            window.location.href = url;
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Selamat datang, <?php echo $_SESSION['username']; ?></h2>
        <p><a href="logout.php">Logout</a></p>
        <h3>Pilih Generasi Pokemon Favorit Anda</h3>
        <form action="dashboard.php" method="post" onsubmit="showPopupAndRedirect('<?php echo $message; ?>', 'index.php')">
            <label for="generation">Generasi:</label>
            <select name="generation">
                <?php
                if (!empty($pokemonGenerations['results'])) {
                    foreach ($pokemonGenerations['results'] as $generation) {
                        echo "<option value='" . $generation['name'] . "'>" . $generation['name'] . "</option>";
                    }
                } else {
                    echo "<option value=''>Tidak dapat mengambil data generasi Pokemon.</option>";
                }
                ?>
            </select><br><br>
            <input type="submit" value="Simpan">
        </form>
    </div>
</body>
</html>
