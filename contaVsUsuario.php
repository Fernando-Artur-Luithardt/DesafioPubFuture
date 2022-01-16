<?php
//validar se conta pertence ao usuario logado
$userId = $_SESSION['usuario']['id'];
$codConta = isset($_POST['codConta'])? $_POST['codConta']: "";
$sql = "SELECT * FROM `conta` WHERE userId = '$userId' AND codConta = $codConta";

$contaVsUsuario = mysqli_query($conn, $sql);

if (mysqli_num_rows($contaVsUsuario)==0) {
    $response = array('mensagem' => "codigo conta incorreto ou não pertence ao usuario logado");
    $responseJson = json_encode($response);
    http_response_code(400);
    echo $responseJson;
    exit;
}
?>