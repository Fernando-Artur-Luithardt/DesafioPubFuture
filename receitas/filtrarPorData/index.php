<?php
require('./../../auth.php');
require('./../../banco.php');
require('./../../constantes.php');
require('./../../contaVsUsuario.php');

$receitasArr = array();
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

$sql = "SELECT id, tipoReceita, codConta, dataEntrada, dataPrevista, descricao, valor, ativo FROM `receitas` WHERE codConta = $codConta AND dataEntrada BETWEEN $dataInicial and $dataFinal AND codConta = $codConta ORDER BY dataEntrada ASC";   
$consultaReceitas = mysqli_query($conn,$sql);

while ($receitasData = mysqli_fetch_array($consultaReceitas)) {
    $receitasArr[] = [
        'id' => $receitasData['id'],
        'tipoReceita' => $tiposReceitas[$receitasData['tipoReceita']],
        'codConta' => $receitasData['codConta'],
        'dataEntrada' => $receitasData['dataEntrada'],
        'dataPrevista' => $receitasData['dataPrevista'],
        'descricao' => $receitasData['descricao'],
        'valor' => $receitasData['valor'],
        'ativo' => $receitasData['ativo'],
    ];
}

echo json_encode($receitasArr);

?>