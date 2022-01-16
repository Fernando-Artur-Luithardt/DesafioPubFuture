<?php
require('./../../auth.php');
require('./../../banco.php');
require('./../../constantes.php');

$categoria = isset($_POST['categoria'])? $_POST['categoria']: "";
$codConta = isset($_POST['codConta'])? $_POST['codConta']: "";
$dataEntrada = isset($_POST['dataEntrada'])? $_POST['dataEntrada']: "";
$dataPrevista = isset($_POST['dataPrevista'])? $_POST['dataPrevista']: NULL;
$descricao = isset($_POST['descricao'])? $_POST['descricao']: "";
$valor = isset($_POST['valor'])? $_POST['valor']: "";
$ativo = ""; //controlado pelo sistema, se não receber data, a data tera valor de data e hora atual,
            //sendo assim o valor será cadastrado no saldo da conta automaticamente, caso a data venha diferente
            //da data atual, é necessário um sistema para que o valor caia no dia correto
            //no momento não tive tempo para este sistema, mas será feito posteriormente para estudos

$userId = $_SESSION['usuario']['id'];
$contaId = $userId;

//validação não nulo
if(empty($valor) || empty($descricao) || empty($userId) || empty($codConta)) {
    $response = array('mensagem' => "campos obrigatórios faltando");
    $responseJson = json_encode($response);
    http_response_code(400);
    echo $responseJson;
    exit;
}
//validar se categoria existe como código de tipo dedespesa

if (!array_key_exists($categoria, $tiposDespesas)) {
    $response = array('mensagem' => "o código categoria da despesa está incorreto");
    $responseJson = json_encode($response);
    http_response_code(400);
    echo $responseJson;
    exit;
}

//validar se conta pertence ao usuario logado
$sql = "SELECT * FROM `conta` WHERE userId = '$userId' AND codConta = $codConta";

$contaVsUsuario = mysqli_query($conn, $sql);

if (mysqli_num_rows($contaVsUsuario)==0) {
    $response = array('mensagem' => "codido conta incorreto ou não pertence ao usuario logado");
    $responseJson = json_encode($response);
    http_response_code(400);
    echo $responseJson;
    exit;
}
//garante o valor da despesa como negativo
$valor = -abs($valor);

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
//cadastro no banco
$sql = "INSERT INTO `despesas` (`categoria`,`contaId`,`dataPrevista`,`dataEntrada`,`descricao`,`valor`,`codConta`,`ativo`) VALUES ('$categoria','$contaId','$dataPrevista','$dataEntrada','$descricao','$valor','$codConta','$ativo')";

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
$sql = "SELECT * FROM `despesas` WHERE id = $idConta";
$novaConta = mysqli_query($conn, $sql);

$response = array(
    mysqli_fetch_object($novaConta)
);
$responseJson = json_encode($response);
echo $responseJson;

?>