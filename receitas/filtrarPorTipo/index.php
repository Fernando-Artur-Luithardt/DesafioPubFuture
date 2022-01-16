<?php

require('./../../auth.php');
require('./../../banco.php');
require('./../../constantes.php');
require('./../../contaVsUsuario.php');

$receitasArr = array();
$userId = $_SESSION['usuario']['id'];
$codConta = isset($_POST['codConta'])? $_POST['codConta']: "";
$tipoReceita = isset($_POST['tipoReceita'])? $_POST['tipoReceita']: "";

if(empty($codConta) || empty($tipoReceita)) {
    $response = array('mensagem' => "necessário codConta e Tipo receita para filtrar despesas");
    $responseJson = json_encode($response);
    http_response_code(400);
    echo $responseJson;
    exit;
}

$sql = "SELECT id, tipoReceita, codConta, dataEntrada, dataPrevista, descricao, valor, ativo FROM `receitas` WHERE codConta = $codConta AND tipoReceita = $tipoReceita";   
$consultaReceitas = mysqli_query($conn,$sql);

while ($receitas = mysqli_fetch_array($consultaReceitas)) {
    $receitasArr[] = [
        'id' => $receitas['id'],
        'tipoReceita' => $tiposReceitas[$receitas['tipoReceita']],
        'codConta' => $receitas['codConta'],
        'dataEntrada' => $receitas['dataEntrada'],
        'dataPrevista' => $receitas['dataPrevista'],
        'descricao' => $receitas['descricao'],
        'valor' => $receitas['valor'],
        'ativo' => $receitas['ativo'],
    ];
}

echo json_encode($receitasArr);

?>