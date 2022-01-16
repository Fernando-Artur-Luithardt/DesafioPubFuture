<?php
require('./../../auth.php');
require('./../../banco.php');
require('./../../constantes.php');
require('./../../contaVsUsuario.php');

$tipoReceita = isset($_POST['tipoReceita'])? $_POST['tipoReceita']: "";
$codConta = isset($_POST['codConta'])? $_POST['codConta']: "";
$dataEntrada = isset($_POST['dataEntrada'])? $_POST['dataEntrada']: "";
$dataPrevista = isset($_POST['dataPrevista'])? $_POST['dataPrevista']: NULL;
$descricao = isset($_POST['descricao'])? $_POST['descricao']: "";
$valor = isset($_POST['valor'])? $_POST['valor']: "";
$ativo = ""; //controlado pelo sistema, se não receber data, a data tera valor de data e hora atual,
            //sendo assim o valor será cadastrado no saldo da conta automaticamente, caso a data venha diferente
            //da data atual, é necessário um sistema para que o valor caia no dia correto
            //no momento não tive tempo para este sistema, mas será feito posteriormente para estudos
$userId = $_SESSION['usuario']['id']; //$contaId = 'userId';

//validação não nulo
if(empty($valor) || empty($descricao) || empty($userId) || empty($codConta)) {
    $response = array('mensagem' => "campos obrigatórios faltando");
    $responseJson = json_encode($response);
    http_response_code(400);
    echo $responseJson;
    exit;
}

//garante valor da receita positiva
$valor = +abs($valor);

//se a data estiver vazia será lançada como data e hora atual
if (empty($dataEntrada)) {
    $dataEntrada = date("Y-m-d H:i:s");
    $ativo = 1;
    $sql = "UPDATE `conta` SET saldo=saldo+$valor WHERE codConta = $codConta AND userId = $userId";
    $update = mysqli_query($conn, $sql);
}
if (empty($ativo)) {
    $ativo = 0;
}
//passando valores para o banco
$sql = "INSERT INTO `receitas` (`tipoReceita`,`contaId`,`dataPrevista`,`dataEntrada`,`descricao`,`valor`,`ativo`,`codConta`) VALUES ('$tipoReceita','$userId','$dataPrevista','$dataEntrada','$descricao','$valor','$ativo','$codConta')";
$resultado = mysqli_query($conn, $sql);

if (!$resultado) {
    $response = array('mensagem' => "Erro do servidor");
    $responseJson = json_encode($response);
    http_response_code(500);
    echo $responseJson;
    exit;
}

// retornando a nova despesa
$idConta = mysqli_insert_id($conn);
$sql = "SELECT * FROM `receitas` WHERE id = $idConta";
$novaConta = mysqli_query($conn, $sql);

$response = array(
    'conta' => mysqli_fetch_object($novaConta)
);
$responseJson = json_encode($response);
echo $responseJson;

?>