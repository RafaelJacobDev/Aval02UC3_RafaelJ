<?php
$moeda = filter_input(INPUT_GET, "moeda");
$meuarray = "";
$paises = []; // Array para armazenar dados dos países

$url = "https://restcountries.com/v3.1/currency/{$moeda}";
$options = [
    "https" => [
        "method" => "GET",
        "header" => "Content-Type: application/json"
    ]
];
$context  = stream_context_create($options);
$response = file_get_contents($url, false, $context);

if ($response == false) {
    echo "Erro ao acessar a API";
    exit;
}
$dados = json_decode($response, true);
$moedagrande = strtoupper($moeda);

if (!empty($dados)) {
    foreach ($dados as $pais) {
        // nome oficial do país
        $nomePais = $pais['name']['official'];
        
        $meuarray = array_values($pais['currencies']);
        
        if (isset($meuarray[0])) {
            $nomeMoeda = $meuarray[0]['name'];
            $simboloMoeda = isset($meuarray[0]['symbol']) ? $meuarray[0]['symbol'] : 'N/A';
            
            $paisInfo = [
                'nome' => $nomePais,
                'moeda' => $nomeMoeda,
                'simbolo' => $simboloMoeda
            ];
            
            // Se houver uma segunda moeda (posição 1)
            if (isset($meuarray[1])) {
                $nomeMoeda2 = $meuarray[1]['name'];
                $simboloMoeda2 = isset($meuarray[1]['symbol']) ? $meuarray[1]['symbol'] : 'N/A';
                $paisInfo['segunda_moeda'] = $nomeMoeda2;
                $paisInfo['segundo_simbolo'] = $simboloMoeda2;
            }
            
            $paises[] = $paisInfo;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="PT-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado - Busca Moeda</title>
    <link rel="stylesheet" href="./css/estilo.css">
</head>

<body>
    <div id="cep-buscado">
        <h2>Resultados da Busca por Moeda: <?php echo htmlspecialchars($moedagrande); ?></h2>
        
        <?php if (!empty($paises)): ?>
            <!-- Lista HTML estruturada com as informações dos países -->
            <ul class="lista-paises">
                <?php foreach ($paises as $paisInfo): ?>
                    <li class="item-pais">
                        <strong>País:</strong> <?php echo htmlspecialchars($paisInfo['nome']); ?><br>
                        <strong>Moeda:</strong> <?php echo htmlspecialchars($paisInfo['moeda']); ?> 
                        (<?php echo htmlspecialchars($paisInfo['simbolo']); ?>)
                        
                        <?php if (isset($paisInfo['segunda_moeda'])): ?>
                            <br><strong>Segunda moeda:</strong> <?php echo htmlspecialchars($paisInfo['segunda_moeda']); ?> 
                            (<?php echo htmlspecialchars($paisInfo['segundo_simbolo']); ?>)
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Nenhum país encontrado para a moeda informada.</p>
        <?php endif; ?>
    </div>
</body>

</html>
