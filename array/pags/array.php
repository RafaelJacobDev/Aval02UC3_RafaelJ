<?php

$pokemons = array("Clefable", "Starmie", "Victreebell", "Dragonite", "Malamar");
$mensagem = "";
$mensagem2 = "";
$mensagem3 = "";
$mensagem4 = "";


for ($a = 0; $a < count($pokemons); $a++) {
    $mensagem .= "<li>" . $pokemons[$a] . "</li>";
}





// Primeira parte;

array_splice($pokemons, 2, 1, "Feraligatr");

for ($a = 0; $a < count($pokemons); $a++) {
    $mensagem2 .= "<li>" . $pokemons[$a] . "</li>";
}

// Segunda parte

array_pop($pokemons);

for ($a = 0; $a < count($pokemons); $a++) {
    $mensagem3 .= "<li>" . $pokemons[$a] . "</li>";
}


//Terceira parte

$posicao = array_search("Dragonite", $pokemons);

if ($posicao !== false) {
    $mensagem4 = "pokemon encontrado na " . $posicao;
} else {
    $mensagem4 = "pokemon não localizado";
}

//Quarta parte

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./../css/estilo.css">
</head>

<body>
    <main class="main-container">
        <div class="content-wrapper">
            <div class="header-section">
                <h1 class="main-title">Bem-vindo ao Pokemon Manager</h1>
                <p class="subtitle">Gerencie sua coleção de Pokemon de forma simples e elegante</p>
            </div>


            <?= $mensagem ?>



            <?= $mensagem2 ?>

            <?= $mensagem3 ?>

            <?= $mensagem4 ?>



        </div>
    </main>
</body>

</html>