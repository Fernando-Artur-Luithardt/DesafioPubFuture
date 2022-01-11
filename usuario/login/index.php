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

$sql = "SELECT * FROM `usuario` WHERE usuario = '$usuario'";

$usuariosCadastrados = mysqli_query($conn, $sql);

if ($arrUsuario = mysqli_fetch_array($usuariosCadastrados)) {
    $senha = md5($senha);
    if($senha == $arrUsuario['senha']){
        session_start();
        $_SESSION['usuario'] = $arrUsuario;

        $response = array('mensagem' => "OK");
        $responseJson = json_encode($response);
        echo $responseJson;
        exit;
    }
}

$response = array('mensagem' => "Usuario ou senha errados");
$responseJson = json_encode($response);
http_response_code(401);
echo $responseJson;

?>