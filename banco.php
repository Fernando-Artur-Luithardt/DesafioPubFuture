<?php

    //conectar banco de dados
    $host = "localhost"; //onde está
    $user = "root"; // usuario
    $pass = ""; // qual a senha
    $base = "fernando_pubfuture"; // qual a base de dados
    
    $conn = mysqli_connect($host, $user, $pass, $base);
    
    if (mysqli_connect_errno()) {
        $response = array('mensagem' => mysqli_connect_error());
        $responseJson = json_encode($response);
        http_response_code(400);
        echo $responseJson;
        exit();
    }
?>
