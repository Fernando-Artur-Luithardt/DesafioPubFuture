<?php

require('./../../auth.php'); //verifica se está logado
require('./../../banco.php');
require('./../../contaVsUsuario.php');

$id = $_SESSION['usuario']['id'];
$codConta = isset($_POST['codConta'])? $_POST['codConta']: "";
$deletar = isset($_POST['deletar'])? $_POST['deletar']: "";

$sql = "DELETE from `conta` WHERE userId = $id AND codConta = $codConta";

if($deletar == 1) {
    if (mysqli_query($conn,$sql)) {
        http_response_code(204);
        session_destroy();
        exit;
    }
}

$response = array('mensagem' => "Erro ao deletar conta");
$responseJson = json_encode($response);
http_response_code(400);
echo $responseJson;
exit;

?>