<?php

require('./../../auth.php');
require('./../../banco.php');
require('./../../constantes.php');

$usuarios = array();
$id = $_SESSION['usuario']['id'];

$sql = "SELECT codConta, nomeBanco, saldo, tipoDeConta FROM `conta` WHERE userId = $id";

$consultaUsuarios = mysqli_query($conn,$sql);

while ($contasBancarias = mysqli_fetch_array($consultaUsuarios)) {
    $usuarios[] = [
        'codConta' => $contasBancarias['codConta'],
        'nomeBanco' => $contasBancarias['nomeBanco'],
        'saldo' => $contasBancarias['saldo'],
        'tipoDeConta' => $contasBancarias['tipoDeConta'],
    ];
}

echo json_encode($usuarios);

?>