<?php
require('auth.php');
require('banco.php');
require('constantes.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>controleFinanceiro</title>
</head>
<body> 
<h1></h1>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" defer></script>
<script defer>

fetch('http://localhost/DesafioPubFuture/conta/listar/')
.then(function(respostaDoServidor) {
	return respostaDoServidor.json()
})
.then(function(dadosContas) {
    console.log(dadosContas)
})
</script>
</body>
</html>