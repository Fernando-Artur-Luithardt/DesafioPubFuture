<?php

require('./../../auth.php'); //verifica se está logado
require('./../../banco.php');

$id = $_SESSION['usuario']['id'];

$sql = "DELETE from `usuario` WHERE id = $id";
$deletar = isset($_POST['deletar'])? $_POST['deletar']: "";

if($deletar == 1) {
    if (mysqli_query($conn,$sql)) {
        http_response_code(204);
        session_destroy();
        exit;
    }
}
$response = array('mensagem' => "Erro ao deletar usuario");
$responseJson = json_encode($response);
http_response_code(400);
echo $responseJson;
exit;

?>