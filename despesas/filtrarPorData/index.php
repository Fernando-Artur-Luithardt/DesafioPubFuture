<?php

require('./../../auth.php');
require('./../../banco.php');
require('./../../constantes.php');

$despesasArr = array();
$id = $_SESSION['usuario']['id'];
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
//validar se conta pertence ao usuario logado
$sql = "SELECT * FROM `conta` WHERE userId = '$id' AND codConta = $codConta";
$contaVsUsuario = mysqli_query($conn, $sql);

if (mysqli_num_rows($contaVsUsuario)==0) {
    $response = array('mensagem' => "codigo de conta incorreto ou não pertence ao usuario logado");
    $responseJson = json_encode($response);
    http_response_code(400);
    echo $responseJson;
    exit;
}

$sql = "SELECT id, categoria, codConta, dataEntrada, dataPrevista, descricao, valor, ativo FROM `despesas` WHERE dataEntrada BETWEEN $dataInicial and $dataFinal";   
$consultaDespesas = mysqli_query($conn,$sql);

while ($despesasData = mysqli_fetch_array($consultaDespesas)) {
    $despesasArr[] = [
        'id' => $despesasData['id'],
        'categoria' => $despesasData['categoria'],
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