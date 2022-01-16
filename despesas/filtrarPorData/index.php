<?php

require('./../../auth.php');
require('./../../banco.php');
require('./../../constantes.php');
require('./../../contaVsUsuario.php');

$despesasArr = array();
$userId = $_SESSION['usuario']['id'];
$codConta = isset($_POST['codConta'])? $_POST['codConta']: "";
$dataInicial = isset($_POST['dataInicial'])? $_POST['dataInicial']: "";
$dataFinal = isset($_POST['dataFinal'])? $_POST['dataFinal']: "";

if(empty($codConta) || empty($dataInicial) || empty($dataFinal)) {
    $response = array('mensagem' => "necessário codConta, dataInicial e dataFinal da busca");
    $responseJson = json_encode($response);
    http_response_code(400);
    echo $responseJson;
    exit;
}

$sql = "SELECT id, categoria, codConta, dataEntrada, dataPrevista, descricao, valor, ativo FROM `despesas` WHERE dataEntrada BETWEEN $dataInicial and $dataFinal ORDER BY dataEntrada ASC";   
$consultaDespesas = mysqli_query($conn,$sql);

while ($despesasData = mysqli_fetch_array($consultaDespesas)) {
    $despesasArr[] = [
        'id' => $despesasData['id'],
        'tipoDespesa' => $tiposDespesas[$despesasData['tipoDespesa']],
        'codConta' => $despesasData['codConta'],
        'dataEntrada' => $despesasData['dataEntrada'],
        'dataPrevista' => $despesasData['dataPrevista'],
        'descricao' => $despesasData['descricao'],
        'valor' => $despesasData['valor'],
        'ativo' => $despesasData['ativo'],
    ];
}

echo json_encode($despesasArr);

?>