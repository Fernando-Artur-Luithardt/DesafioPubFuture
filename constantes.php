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
    '8' => 'imposto',
    '9' => 'lazer',
    '10' => 'transporte'
];
$tiposReceitas = [
    '1' => 'salário',
    '2' => 'investimento',
    '3' => 'presente'
];

//validar se os código digitados são validos
$nomeBanco = isset($_POST['nomeBanco'])? $_POST['nomeBanco']: "";
$tipoDeConta = isset($_POST['tipoDeConta'])? $_POST['tipoDeConta']: "";
$tipoDespesa = isset($_POST['tipoDespesa'])? $_POST['tipoDespesa']: "";
$tipoReceita = isset($_POST['tipoReceita'])? $_POST['tipoReceita']: "";

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

if (!empty($tipoDespesa)) {
    if (!array_key_exists($tipoDespesa, $tiposDespesas)) {
        $response = array('mensagem' => "o código categoria da despesa está incorreto");
        $responseJson = json_encode($response);
        http_response_code(400);
        echo $responseJson;
        exit;
    }
}

if (!empty($tipoReceita)) {
    if (!array_key_exists($tipoReceita, $tiposReceitas)) {
        $response = array('mensagem' => "o código categoria da receita está incorreto");
        $responseJson = json_encode($response);
        http_response_code(400);
        echo $responseJson;
        exit;
    }
}
?>