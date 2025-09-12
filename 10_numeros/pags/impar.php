<?php
$mensagem2 = "";

$numeros = $_GET["numeros"];

$par = 0;
$impar = 0;



for ($i = 0; $i < count($numeros); $i++) {
    if ($numeros[$i] % 2 == 0) {
        $par++;
    } else {
        $impar++;
    }

    $mensagem2 .= "<li>$numeros[$i]</li>";
}




$mensagem = "Tem " . $par . " numeros pares e " . $impar . " numeros impar.";

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impar ou par</title>
    <link rel="stylesheet" href="./../css/estilo.css">
</head>

<body>
    <h1>Resultado</h1>
    <div id="resultado">

        <?= $mensagem; ?>
        <?= $mensagem2; ?>


    </div>
</body>

</html>