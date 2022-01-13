<?php

require('./../../auth.php');
require('./../../banco.php');

$usuarios = array();

$sql = "SELECT usuario, id FROM `usuario`";

$consultaUsuarios = mysqli_query($conn,$sql);

while ($arrUsuario = mysqli_fetch_array($consultaUsuarios)) {
    $usuarios[] = [
        'id' => $arrUsuario['id'],
        'usuario' => $arrUsuario['usuario']
    ];
}

echo json_encode($usuarios);

?>