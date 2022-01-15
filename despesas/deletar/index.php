<?php

require('./../../auth.php'); //verifica se está logado
require('./../../banco.php');

$userId = $_SESSION['usuario']['id'];
$codConta = isset($_POST['codConta'])? $_POST['codConta']: "";
$idDespesa = isset($_POST['idDespesa'])? $_POST['idDespesa']: "";


//validar se conta pertence ao usuario logado
$sql = "SELECT * FROM `conta` WHERE userId = '$userId' AND codConta = $codConta";

$contaVsUsuario = mysqli_query($conn, $sql);

if (mysqli_num_rows($contaVsUsuario)==0) {
    $response = array('mensagem' => "codido conta incorreto ou não pertence ao usuario logado");
    $responseJson = json_encode($response);
    http_response_code(400);
    echo $responseJson;
    exit;
}

//validar se conta pertence ao usuario logado
$sql = "SELECT * FROM `despesas` WHERE userId = '$userId' AND contaId = $codConta AND id = '$idDespesa'";

$contaVsUsuario = mysqli_query($conn, $sql);

if (mysqli_num_rows($contaVsUsuario)==0) {
    $response = array('mensagem' => "codido conta incorreto ou a despesa não pertence ao usuario logado");
    $responseJson = json_encode($response);
    http_response_code(400);
    echo $responseJson;
    exit;
}

$sql = "DELETE from `despesas` userId = '$userId' AND contaId = $codConta AND id = '$idDespesa'";

if (mysqli_query($conn,$sql)) {
    http_response_code(204);
    session_destroy();
    exit;
}

$response = array('mensagem' => "Erro ao deletar despesa");
$responseJson = json_encode($response);
http_response_code(400);
echo $responseJson;
exit;

?>