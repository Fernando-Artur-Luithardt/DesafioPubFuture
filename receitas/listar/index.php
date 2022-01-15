<?php

require('./../../auth.php');
require('./../../banco.php');
require('./../../constantes.php');

$receitasArr = array();
$id = $_SESSION['usuario']['id'];
$codConta = isset($_POST['codConta'])? $_POST['codConta']: "";

if(empty($codConta)) {
    $response = array('mensagem' => "necessário codConta para listar despesas");
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

$sql = "SELECT id, categoria, codConta, dataEntrada, dataPrevista, descricao, valor, ativo FROM `receitas` WHERE codConta = $codConta";   
$consultaReceitas = mysqli_query($conn,$sql);

while ($receitas = mysqli_fetch_array($consultaReceitas)) {
    $receitasArr[] = [
        'id' => $receitas['id'],
        'categoria' => $receitas['categoria'],
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