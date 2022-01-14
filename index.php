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
    <form id="form">
        <div id="container">
            <div>
                <h1>login</h1>
            </div>
            <div type="input" >
                <input name="usuario" type="text" id="usuario">
            </div>

            <div type="input">
                <input name="senha" type="password" id="senha">
            </div>

            <div>
                <input type="submit">
            </div>
        </div>
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>

    // function chamar(){
    // let dados = new FormData();

//     dados.append('usuario', 'fedsadarnando');
//     dados.append('senha', '1234');

// $.ajax({
//     type: "POST",
//     url: 'http://localhost/DesafioPubFuture/usuario/login/',
//     data: dados,
//     processData: false,
//     contentType: false,
//     success: function(resposta){
//     window.location.replace('http://localhost/desafioPubFuture/controle.php');
//     console.log(resposta)
//     }
// })  }

$(document).ready(function () {
  $("form").submit(function (event) {
    var formData = {
        usuario: $("#usuario").val(),
        senha: $("#senha").val(),
    };

    console.log(formData);

    $.ajax({
      type: "POST",
      url: "http://localhost/DesafioPubFuture/usuario/login/",
      data: formData,
      dataType: "json",
      encode: true,
    }).done(function (data) {
      window.location.replace('http://localhost/desafioPubFuture/controle.php');
      console.log(data);
    });

    event.preventDefault();
  });
});


</script>
</body>
</html>