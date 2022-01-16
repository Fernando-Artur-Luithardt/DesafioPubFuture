<?php

$tiposConta = [
    '1' => 'Conta Corrente',
    '13' => 'Poupança'
];

$nomeBancos = [
    '1' => 'Banco do Brasil S.A.',
    '33' => 'Banco Santander (Brasil) S.A',
    '104' => 'Caixa Econômica Federal',
    '260' => 'nuBank',
    '341' => 'Banco Itaú S.A.'
];

$tiposDespesas = [
    '1' => 'conta água ou energia',
    '2' => 'aluguel',
    '3' => 'condominio',
    '4' => 'internet',
    '5' => 'telefone',
    '6' => 'estudo',
    '7' => 'alimentação',
    '8' => 'cimposto',
    '9' => 'lazer',
    '10' => 'transporte'
];
$tiposReceitas = [
    '1' => 'salário',
    '2' => 'investimento',
    '3' => 'presente',
];

//validar se os código digitados são validos
$nomeBanco = isset($_POST['nomeBanco'])? $_POST['nomeBanco']: "";
$tipoDeConta = isset($_POST['tipoDeConta'])? $_POST['tipoDeConta']: "";
$categoriaDespesa = isset($_POST['categoria'])? $_POST['categoria']: "";
$categoriaReceita = isset($_POST['categoria'])? $_POST['categoria']: "";

if (!empty($nomeBanco)) {
    if (!array_key_exists($nomeBanco, $nomeBancos)) {
        $response = array('mensagem' => "o código do banco está incorreto");
        $responseJson = json_encode($response);
        http_response_code(400);
        echo $responseJson;
        exit;
    }
}

if (!empty($tipoDeConta)) {
    if (!array_key_exists($tipoDeConta, $tiposConta)) {
        $response = array('mensagem' => "o código do tipo de conta está incorreto");
        $responseJson = json_encode($response);
        http_response_code(400);
        echo $responseJson;
        exit;
    }
}

if (!empty($categoriaDespesa)) {
    if (!array_key_exists($categoriaDespesa, $tiposDespesas)) {
        $response = array('mensagem' => "o código categoria da está incorreto");
        $responseJson = json_encode($response);
        http_response_code(400);
        echo $responseJson;
        exit;
    }
}

if (!empty($categoriaReceita)) {
    if (!array_key_exists($categoriaReceita, $tiposReceitas)) {
        $response = array('mensagem' => "o código categoria da despesa está incorreto");
        $responseJson = json_encode($response);
        http_response_code(400);
        echo $responseJson;
        exit;
    }
}
?>