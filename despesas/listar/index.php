<?php

require('./../../auth.php');
require('./../../banco.php');
require('./../../constantes.php');
require('./../../contaVsUsuario.php');

$despesasArr = array();
$userId = $_SESSION['usuario']['id'];
$codConta = isset($_POST['codConta'])? $_POST['codConta']: "";

if(empty($codConta)) {
    $response = array('mensagem' => "necessário codConta para listar despesas");
    $responseJson = json_encode($response);
    http_response_code(400);
    echo $responseJson;
    exit;
}

$sql = "SELECT id, categoriaDespesa, codConta, dataEntrada, dataPrevista, descricao, valor, ativo FROM `despesas` WHERE codConta = $codConta";   
$consultaDespesas = mysqli_query($conn,$sql);

while ($despesas = mysqli_fetch_array($consultaDespesas)) {
    $despesasArr[] = [
        'id' => $despesas['id'],
        'tipoDespesa' => $tiposDespesas[$despesas['tipoDespesa']],
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