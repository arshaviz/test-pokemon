<?php
include('../includes/db.php');
include('../includes/pokeapi.php');

// Ambil data generasi Pokemon dari API
$pokemonGenerations = getPokemonGenerations();

// Tampilkan data
if (!empty($pokemonGenerations['results'])) {
    echo "<h2>Generasi Pokemon Favorit</h2>";
    echo "<ul>";
    foreach ($pokemonGenerations['results'] as $generation) {
        echo "<li>" . $generation['name'] . "</li>";
    }
    echo "</ul>";
} else {
    echo "Tidak dapat mengambil data generasi Pokemon.";
}
?>
