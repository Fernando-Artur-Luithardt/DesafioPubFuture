<?php

require('./../../auth.php');
require('./../../banco.php');
require('./../../constantes.php');

$contas = array();
$id = $_SESSION['usuario']['id'];

$sql = "SELECT codConta, nomeBanco, saldo, tipoDeConta FROM `conta` WHERE userId = $id";

$consultaUsuarios = mysqli_query($conn,$sql);

while ($contasBancarias = mysqli_fetch_array($consultaUsuarios)) {
    $contas[] = [
        'codConta' => $contasBancarias['codConta'],
        'nomeBanco' => $nomeBancos[$contasBancarias['nomeBanco']],
        'saldo' => $contasBancarias['saldo'],
        'tipoDeConta' => $tiposConta[$contasBancarias['tipoDeConta']],
    ];
}

echo json_encode($contas);

?>