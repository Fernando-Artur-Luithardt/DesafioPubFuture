<?php
require('./../../auth.php');
require('./../../banco.php');
require('./../../constantes.php');

$codBanco = isset($_POST['codBanco'])? $_POST['codBanco']: "";
$tipoDeConta = isset($_POST['tipoDeConta'])? $_POST['tipoDeConta']: "";

$userId = $_SESSION['usuario']['id'];



//validação não nulo

if(empty($codBanco) || empty($tipoDeConta) || empty($userId)) {
    $response = array('mensagem' => "campos obrigatórios faltando");
    $responseJson = json_encode($response);
    http_response_code(400);
    echo $responseJson;
    exit;
}

//validar se código do banco é válido


if (!array_key_exists($codBanco, $codBancos)) {
    $response = array('mensagem' => "o código do banco está incorreto");
    $responseJson = json_encode($response);
    http_response_code(400);
    echo $responseJson;
    exit;
}

if (!array_key_exists($tipoDeConta, $tiposConta)) {
    $response = array('mensagem' => "o código do tipo de conta está incorreto");
    $responseJson = json_encode($response);
    http_response_code(400);
    echo $responseJson;
    exit;
}

//validar se conta existe no banco relaciona ao mesmo usuario
$sql = "SELECT * FROM `conta` WHERE userId = '$userId' AND tipoDeConta = $tipoDeConta AND codBanco = $codBanco";

$contaJaCadastrada = mysqli_query($conn, $sql);

if (mysqli_num_rows($contaJaCadastrada)>0) {
    $response = array('mensagem' => "Conta do mesmo tipo no mesmo banco já existente");
    $responseJson = json_encode($response);
    http_response_code(400);
    echo $responseJson;
    exit;
}
//cadastro no banco
$sql = "INSERT INTO `conta`(`codBanco`, `tipoDeConta`,`userId`) VALUES ('$codBanco','$tipoDeConta','$userId')";

$resultado = mysqli_query($conn, $sql);

if (!$resultado) {
    $response = array('mensagem' => "Erro do servidor");
    $responseJson = json_encode($response);
    http_response_code(500);
    echo $responseJson;
    exit;
}

// retornando a nova conta em um json

$idConta = mysqli_insert_id($conn);
$sql = "SELECT * FROM `conta` WHERE id = '$idConta'";
$novaConta = mysqli_query($conn, $sql);

$response = array(
    'mensagem' => "OK",
    'conta' => mysqli_fetch_object($novaConta)
);
$responseJson = json_encode($response);
echo $responseJson;

?>