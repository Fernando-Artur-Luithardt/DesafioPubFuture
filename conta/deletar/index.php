<?php

require('./../../auth.php'); //verifica se está logado
require('./../../banco.php');

$id = $_SESSION['usuario']['id'];
$codConta = isset($_POST['codConta'])? $_POST['codConta']: "";

//validar se conta pertence ao usuario logado
$sql = "SELECT * FROM `conta` WHERE userId = '$id' AND codConta = $codConta";

$contaVsUsuario = mysqli_query($conn, $sql);

if (mysqli_num_rows($contaVsUsuario)==0) {
    $response = array('mensagem' => "codido conta incorreto ou não pertence ao usuario logado");
    $responseJson = json_encode($response);
    http_response_code(400);
    echo $responseJson;
    exit;
}

$sql = "DELETE from `conta` WHERE userId = $id AND codConta = $codConta";

if (mysqli_query($conn,$sql)) {
    http_response_code(200);
    exit;
}

$response = array('mensagem' => "Erro ao deletar conta");
$responseJson = json_encode($response);
http_response_code(400);
echo $responseJson;
exit;

?>