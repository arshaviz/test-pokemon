<?php
function getPokemonGenerations() {
    $url = "https://pokeapi.co/api/v2/generation";
    $response = file_get_contents($url);
    return json_decode($response, true);
}
?>
