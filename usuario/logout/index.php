<?php
session_start();
session_destroy();

$response = array('mensagem' => "OK");
$responseJson = json_encode($response);
echo $responseJson;

?>