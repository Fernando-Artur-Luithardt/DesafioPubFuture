<?php

require 'banco.php';

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banco</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action='chamar()'>
        <div id="container">
            <div>
                <h1>login</h1>
            </div>
            <div class="input" id="nome">
                <input type="text">
            </div>

            <div class="input" id="senha">
                <input type="password">
            </div>

            <div>
                <input onclick="chamar()" type="submit">
            </div>
        </div>
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>

    function chamar(){
        let dados = new FormData();

dados.append('usuario', 'fedsadarnando');
dados.append('senha', '1234');

$.ajax({
    type: "POST",
    url: 'http://localhost/DesafioPubFuture/usuario/login/',
    data: dados,
    processData: false,
    contentType: false,
    success: function(resposta){
    window.location.replace('http://localhost/desafioPubFuture/controle.php');
    console.log(resposta)
    }
})  }


</script>
</body>
</html>