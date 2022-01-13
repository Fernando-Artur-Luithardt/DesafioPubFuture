<?php

require('./../../auth.php');
require('./../../banco.php');
require('./../../constantes.php');

$usuarios = array();
$destino = array();
$saldoPartida = array();
$saldoDestino = array();

$id = $_SESSION['usuario']['id'];
$codContaPartida = isset($_POST['codContaPartida'])? $_POST['codContaPartida']: "";
$codContaDestino = isset($_POST['codContaDestino'])? $_POST['codContaDestino']: "";
$valorTransferencia = isset($_POST['valorTransferencia'])? $_POST['valorTransferencia']: "";

$sql = "SELECT  saldo FROM `conta` WHERE userId = $id AND codConta = $codContaPartida";

$consultacontaPartida = mysqli_query($conn,$sql);

while ($saldoContaPartida = mysqli_fetch_array($consultacontaPartida)) {
    $saldoPartida[] = [
        'saldo' => $saldoContaPartida['saldo'],
    ];
}
if (!$saldoPartida) {
    $response = array('mensagem' => "conta de partida incorreta");
    $responseJson = json_encode($response);
    http_response_code(400);
    echo $responseJson;
    exit;
}

$sql = "SELECT codConta, tipoDeConta FROM `conta` WHERE codConta = $codContaDestino";

$consultaContaDestino = mysqli_query($conn,$sql);

while ($contaDestino = mysqli_fetch_array($consultaContaDestino)) {
    $saldoDestino[] = [
        'codConta' => $contaDestino['codConta'],
        'tipoDeConta' => $contaDestino['tipoDeConta']
    ];
}
if (!$saldoDestino) {
    $response = array('mensagem' => "conta de destino incorreta");
    $responseJson = json_encode($response);
    http_response_code(400);
    echo $responseJson;
    exit;
}

$sql = "UPDATE `conta` SET saldo=saldo+$valorTransferencia WHERE codConta = $codContaDestino";
$atualizaSaldoDestino = mysqli_query($conn,$sql);

$sql = "UPDATE `conta` SET saldo=saldo-$valorTransferencia WHERE codConta = $codContaPartida";
$atualizaSaldoPartida = mysqli_query($conn,$sql);

$response = array('mensagem' => "OK");
$responseJson = json_encode($response);
http_response_code(200);
echo $responseJson;

?>