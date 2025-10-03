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
function validarEntrada($moeda, $real)
{
    if (validarMoeda($moeda) == false || validarReal($real) == false) {
        return false;
    } else {
        return true;
    }
}

function APImoeda($moeda){
    
$url = "http://economia.awesomeapi.com.br/json/last/{$moeda}-BRL";

$options = [
    "http" => [
        "method" => "GET",
        "header" => "Content-Type: application/json"
    ]
];
$context  = stream_context_create($options);
$response = file_get_contents($url, false, $context);
var_dump($response);
if ($response == false) {
    echo "Erro ao acessar a API";
    exit;
}
$dados = json_decode($response, true);
$dados[$moeda."BRL"]["bid"];
$valormoeda=number_format($dados, 2);
return$valormoeda;
}

function converterMoeda($moeda, $real) {
    $taxa=APImoeda($moeda);

    return $real/$taxa;
}

function mensagem($valorFinal, $simbolos, $moeda)
{
    return "O valor convertido é de " . $valorFinal . $simbolos[$moeda];
}


$moeda = filter_input(INPUT_GET, "moeda");
$real = filter_input(INPUT_GET, "valor");
$real = str_replace(',', '.', $real);
if (validarEntrada($moeda, $real) == true) {
} else {
    header('location: ../index.html');
}
APImoeda($moeda);
$valorFinal = "";
$mensagem = "";
$valorFinal = number_format($valorFinal, 2, ',', '.');
$simbolos = ['USD' => 'US$', 'EUR' => '€', 'GBP' => '£'];
$mensagem = mensagem($valorFinal, $simbolos, $moeda);


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