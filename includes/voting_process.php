<?php
session_start();
include('../includes/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['generation'])) {
    // Ambil generasi yang dipilih oleh pengguna
    $generation = $_POST['generation'];

    // Periksa apakah data voting sudah ada di database
    $sql = "SELECT * FROM voting WHERE generation = '$generation'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Jika data sudah ada, update jumlah voting
        $row = $result->fetch_assoc();
        $votes = $row['votes'] + 1;
        $sql_update = "UPDATE voting SET votes = $votes WHERE generation = '$generation'";
        if ($conn->query($sql_update) === TRUE) {
            // Redirect ke halaman utama setelah voting berhasil
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $sql_update . "<br>" . $conn->error;
        }
    } else {
        // Jika data belum ada, masukkan data baru ke dalam tabel voting
        $sql_insert = "INSERT INTO voting (generation, votes) VALUES ('$generation', 1)";
        if ($conn->query($sql_insert) === TRUE) {
            // Redirect ke halaman utama setelah voting berhasil
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $sql_insert . "<br>" . $conn->error;
        }
    }
}
?>
