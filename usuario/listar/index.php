<?php

require('./../../banco.php');

$sql = "SELECT * FROM `usuario` WHERE 0";

$resultadosql = mysqli_query($conn, $sql);

var_dump($resultadosql);

?>