<?php

require('./../../auth.php'); //verifica se está logado
require('./../../banco.php');
require('./../../contaVsUsuario.php');

$userId = $_SESSION['usuario']['id'];
$codConta = isset($_POST['codConta'])? $_POST['codConta']: "";
$idDespesa = isset($_POST['idDespesa'])? $_POST['idDespesa']: "";

//validar se despesa pertence a conta do usuário logado
$sql = "SELECT * FROM `despesas` WHERE userId = '$userId' AND contaId = $codConta AND id = '$idDespesa'";

$despesaVsUsuario = mysqli_query($conn, $sql);

if (mysqli_num_rows($despesaVsUsuario)==0) {
    $response = array('mensagem' => "despesa não pertence a conta selecionada");
    $responseJson = json_encode($response);
    http_response_code(400);
    echo $responseJson;
    exit;
}

$sql = "DELETE from `despesas` WHERE userId = '$userId' AND contaId = $codConta AND id = '$idDespesa'";

if (mysqli_query($conn,$sql)) {
    http_response_code(204);
    exit;
}

$response = array('mensagem' => "Erro ao deletar despesa");
$responseJson = json_encode($response);
http_response_code(500);
echo $responseJson;
exit;

?>