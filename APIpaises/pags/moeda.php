<?php
$moeda = filter_input(INPUT_GET, "moeda");

$url = "https://restcountries.com/v3.1/currency/{$moeda}";
$options = [
    "http" => [
        "method" => "GET",
        "header" => "Content-Type: application/json"
    ]
];
$context  = stream_context_create($options);
$response = file_get_contents($url, false, $context);

if ($response === false) {
    die("Erro ao acessar a API");
}

$dados = json_decode($response, true);

if (!empty($dados)) {
    foreach ($dados as $pais) {
        // nome oficial do país
        $nomePais = $pais['name']['official'];
        // nome da moeda para esse país
        $nomeMoeda = $pais['currencies'][$moeda]['name'] ?? 'Nome de moeda não encontrado';

        echo "País: {$nomePais} - Moeda: {$nomeMoeda}<br>";
    }
}
?>

<!DOCTYPE html>
<html lang="PT-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado - Busca CEP</title>
    <link rel="stylesheet" href=".././css/estilo.css">
</head>

<body>
    <div id="cep-buscado">
        <li>
            <ul> </ul>
        </li>

    </div>
</body>

</html>