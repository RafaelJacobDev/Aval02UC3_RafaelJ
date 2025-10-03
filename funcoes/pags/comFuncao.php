<?php
function validarMoeda($moeda)
{
    if (!in_array($moeda, ["USD", "EUR", "GBP"])) {
        return false;
    } else {
        return true;
    }
}
function validarReal($real)
{
    if (!is_numeric($real)) {
        return false;
    } else {
        return true;
    }
}

function validarEntrada($moeda,$real)
{
    if (validarMoeda($moeda) == false || validarReal($real) == false) {
        return false;
    }else {
        return true;
    }
}


$moeda = filter_input(INPUT_GET, "moeda");
$real = filter_input(INPUT_GET, "valor");
$real = str_replace(',', '.', $real);
if (validarEntrada($moeda, $real) == true) {
} else {
    header('location: ../index.html');
}
$valorFinal = "";

$mensagem = "";


if ($moeda == "USD") {
    $valorFinal = $real / 5.34;
} else if ($moeda == "EUR") {
    $valorFinal = $real / 6.27;
} else if ($moeda == "GBP") {
    $valorFinal = $real / 7.20;
}
$valorFinal = number_format($valorFinal, 2, ',', '.');
$simbolos = ['USD' => 'US$', 'EUR' => '€', 'GBP' => '£'];

$mensagem = "O valor convertido é de " . $valorFinal . $simbolos[$moeda];




?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado da Conversão</title>
    <link rel="stylesheet" href=".././css/estilo.css">

</head>

<body>
    <div class="container">
        <h1>Resultado da Conversão</h1>
        <div class="resultado">
            <?= $mensagem ?>
        </div>

        <a href="../index.html" class="link-voltar">Fazer Nova Conversão</a>
    </div>
</body>

</html>