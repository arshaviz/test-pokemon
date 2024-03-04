<?php
include('../includes/db.php');

// Ambil data hasil voting dari database
$sql = "SELECT * FROM voting";
$result = $conn->query($sql);

// Siapkan array untuk menyimpan hasil
$votingResults = array();

// Loop melalui hasil query dan simpan dalam array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $votingResults[$row['generation']] = $row['votes'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
</head>
<body>

<header>
    <div class="container">
        <h1>Selamat Datang di Situs Web Kami</h1>
    </div>
</header>

<main>
    <div class="container">
        <h2>Hasil Voting</h2>
        <table>
            <tr>
                <th>Generasi</th>
                <th>Persentase Voting</th>
            </tr>
            <?php
            // Query untuk mengambil total suara dari semua generasi
            $sql_total_votes = "SELECT SUM(votes) AS total_votes FROM voting";
            $result_total_votes = $conn->query($sql_total_votes);
            $row_total_votes = $result_total_votes->fetch_assoc();
            $total_votes = $row_total_votes['total_votes'];

            // Query untuk mengambil hasil voting untuk setiap generasi
            $sql_voting_results = "SELECT generation, votes FROM voting";
            $result_voting_results = $conn->query($sql_voting_results);

            // Loop untuk menampilkan hasil voting dalam bentuk tabel
            if ($result_voting_results->num_rows > 0) {
                while ($row_voting_results = $result_voting_results->fetch_assoc()) {
                    $generation = $row_voting_results['generation'];
                    $votes = $row_voting_results['votes'];
                    $percentage = ($total_votes > 0) ? round(($votes / $total_votes) * 100, 2) : 0;
                    echo "<tr>";
                    echo "<td>" . $generation . "</td>";
                    echo "<td>" . $percentage . "%</td>";
                    echo "</tr>";
                }
            }
            ?>
        </table>
    </div>
</main>

<aside>
    <div class="container">
        <h2>Panel Register dan Login</h2>
        <div class="panel">
            <h3>Register</h3>
            <!-- Form registrasi -->
            <form action="register.php" method="post">
                <input type="text" name="username" placeholder="Username" required><br><br>
                <input type="password" name="password" placeholder="Password" required><br><br>
                <input type="submit" value="Register">
            </form>
        </div>
        <div class="panel">
            <h3>Login</h3>
            <!-- Form login -->
            <form action="login.php" method="post">
                <input type="text" name="username" placeholder="Username" required><br><br>
                <input type="password" name="password" placeholder="Password" required><br><br>
                <input type="submit" value="Login">
            </form>
        </div>
    </div>
</aside>

<footer>
    <div class="container">
        <p>Hak Cipta &copy; 2024 Situs Web Kami</p>
    </div>
</footer>

</body>
</html>
