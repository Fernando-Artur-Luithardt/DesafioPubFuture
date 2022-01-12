<?php
require('./../../banco.php');

$usuario = isset($_POST['usuario'])? $_POST['usuario']: "";
$senha = isset($_POST['senha'])? $_POST['senha']: "";

//validação não nulo

if(empty($usuario) || empty($senha)) {
    $response = array('mensagem' => "Usuario e senha obrigatórios");
    $responseJson = json_encode($response);
    http_response_code(400);
    echo $responseJson;
    exit;
}

//validar se o usuário existe

$sql = "SELECT * FROM `conta` WHERE usuario = '$usuario'";

$usuariosCadastrados = mysqli_query($conn, $sql);

if (mysqli_num_rows($usuariosCadastrados)>0) {
    $response = array('mensagem' => "Usuário já existente");
    $responseJson = json_encode($response);
    http_response_code(400);
    echo $responseJson;
    exit;
}
//cadastro no banco
$senha = md5($senha);
$sql = "INSERT INTO `usuario`(`usuario`, `senha`) VALUES ('$usuario','$senha')";

$resultado = mysqli_query($conn, $sql);

if (!$resultado) {
    $response = array('mensagem' => "Erro do servidor");
    $responseJson = json_encode($response);
    http_response_code(500);
    echo $responseJson;
    exit;
}

$response = array('mensagem' => "OK");
$responseJson = json_encode($response);
echo $responseJson;

?>