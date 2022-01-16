<?php

require('./../../auth.php');
require('./../../banco.php');
require('./../../constantes.php');

$userId = $_SESSION['usuario']['id'];
$codContaPartida = isset($_POST['codContaPartida'])? $_POST['codContaPartida']: "";
$codContaDestino = isset($_POST['codContaDestino'])? $_POST['codContaDestino']: "";
$valorTransferencia = isset($_POST['valorTransferencia'])? $_POST['valorTransferencia']: "";
$tipoDeContaPartida = isset($_POST['tipoDeContaPartida'])? $_POST['tipoDeContaPartida']: "";
$tipoDeContaDestino = isset($_POST['tipoDeContaDestino'])? $_POST['tipoDeContaDestino']: "";

//confere se a conta de partida existe no banco e se relaciona ao usuario logado
$sql = "SELECT * FROM `conta` WHERE userId = '$userId' AND codConta = $codContaPartida AND tipoDeConta = $tipoDeContaPartida";
$contaPartidaVerifica = mysqli_query($conn, $sql);

if (mysqli_num_rows($contaPartidaVerifica)==0) {
    $response = array('mensagem' => "codigo conta partida ou tipo de conta partida incorreto ou não pertence ao usuario logado");
    $responseJson = json_encode($response);
    http_response_code(400);
    echo $responseJson;
    exit;
}

//confere se conta destino existe no banco
$sql = "SELECT * FROM `conta` WHERE codConta = $codContaDestino AND tipoDeConta = $tipoDeContaDestino";
$contaDestinoVerifica = mysqli_query($conn, $sql);

if (mysqli_num_rows($contaDestinoVerifica)==0) {
    $response = array('mensagem' => "codigo conta destino ou tipo de conta destino incorreto");
    $responseJson = json_encode($response);
    http_response_code(400);
    echo $responseJson;
    exit;
}

$valorTransferencia = abs($valorTransferencia);
$sql = "UPDATE `conta` SET saldo=saldo+$valorTransferencia WHERE codConta = $codContaDestino AND tipoDeConta = $tipoDeContaDestino";
$atualizaSaldoDestino = mysqli_query($conn,$sql);

$sql = "UPDATE `conta` SET saldo=saldo-$valorTransferencia WHERE codConta = $codContaPartida AND tipoDeConta = $tipoDeContaPartida";
$atualizaSaldoPartida = mysqli_query($conn,$sql);

$response = array('mensagem' => "OK");
$responseJson = json_encode($response);
http_response_code(200);
echo $responseJson;

?>