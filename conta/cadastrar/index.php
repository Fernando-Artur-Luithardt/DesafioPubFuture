<?php
require('./../../auth.php');
require('./../../banco.php');
require('./../../constantes.php');

$nomeBanco = isset($_POST['nomeBanco'])? $_POST['nomeBanco']: "";
$tipoDeConta = isset($_POST['tipoDeConta'])? $_POST['tipoDeConta']: "";
$codConta = isset($_POST['codConta'])? $_POST['codConta']: "";
$userId = $_SESSION['usuario']['id'];

//validação não nulo
if(empty($nomeBanco) || empty($tipoDeConta) || empty($userId)) {
    $response = array('mensagem' => "campos obrigatórios faltando");
    $responseJson = json_encode($response);
    http_response_code(400);
    echo $responseJson;
    exit;
}

//validar se conta existe no banco relaciona ao mesmo usuario
$sql = "SELECT * FROM `conta` WHERE userId = '$userId' AND tipoDeConta = $tipoDeConta AND nomeBanco = $nomeBanco AND codConta = $codConta";
$contaJaCadastrada = mysqli_query($conn, $sql);

if (mysqli_num_rows($contaJaCadastrada)>0) {
    $response = array('mensagem' => "Conta do mesmo tipo com o mesmo codConta no mesmo banco já existente");
    $responseJson = json_encode($response);
    http_response_code(400);
    echo $responseJson;
    exit;
}

//validar se codConta já existe no sistema
$sql = "SELECT * FROM `conta` WHERE codConta = $codConta";
$contaJaCadastrada = mysqli_query($conn, $sql);

if (mysqli_num_rows($contaJaCadastrada)>0) {
    $response = array('mensagem' => "codConta já cadastrado no sistema");
    $responseJson = json_encode($response);
    http_response_code(400);
    echo $responseJson;
    exit;
}

//cadastro no banco
$sql = "INSERT INTO `conta`(`nomeBanco`, `tipoDeConta`,`userId`,`codConta`) VALUES ('$nomeBanco','$tipoDeConta','$userId','$codConta')";
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