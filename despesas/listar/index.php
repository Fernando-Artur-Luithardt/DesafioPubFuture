<?php

require('./../../auth.php');
require('./../../banco.php');
require('./../../constantes.php');

$despesasArr = array();
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

$sql = "SELECT id, categoria, codConta, dataEntrada, dataPrevista, descricao, valor, ativo FROM `despesas` WHERE codConta = $codConta";   
$consultaDespesas = mysqli_query($conn,$sql);

while ($despesas = mysqli_fetch_array($consultaDespesas)) {
    $despesasArr[] = [
        'id' => $despesas['id'],
        'categoria' => $despesas['categoria'],
        'codConta' => $despesas['codConta'],
        'dataEntrada' => $despesas['dataEntrada'],
        'dataPrevista' => $despesas['dataPrevista'],
        'descricao' => $despesas['descricao'],
        'valor' => $despesas['valor'],
        'ativo' => $despesas['ativo'],
    ];
}

echo json_encode($despesasArr);

?>