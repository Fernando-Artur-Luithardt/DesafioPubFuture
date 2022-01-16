<?php

require('./../../auth.php');
require('./../../banco.php');
require('./../../constantes.php');
require('./../../contaVsUsuario.php');

$despesasArr = array();
$userId = $_SESSION['usuario']['id'];
$codConta = isset($_POST['codConta'])? $_POST['codConta']: "";
$tipoDespesa = isset($_POST['tipoDespesa'])? $_POST['tipoDespesa']: "";

if(empty($codConta) || empty($tipoDespesa)) {
    $response = array('mensagem' => "necessário codConta e tipoDespesa para filtrar despesas");
    $responseJson = json_encode($response);
    http_response_code(400);
    echo $responseJson;
    exit;
}

$sql = "SELECT id, tipoDespesa, codConta, dataEntrada, dataPrevista, descricao, valor, ativo FROM `despesas` WHERE codConta = $codConta AND tipoDespesa = $tipoDespesa";   
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