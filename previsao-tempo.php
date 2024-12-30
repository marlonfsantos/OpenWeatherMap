<?php

require __DIR__.'/vendor/autoload.php';

use \App\WebService\OpenWeatherMap;

$openWeatherMap = new OpenWeatherMap("0921cdb676c60de39157ca711c5f3664");

if(!isset($argv[2])){
    die('UF e Cidade são obrigatorios');
}

$cidade = $argv[1];
$uf = $argv[2];

$dadosPrevisao = $openWeatherMap->consultarPrevisaoTempo($cidade,$uf);

echo 'Cidade: '.$cidade.' '.$uf."\n";


foreach($dadosPrevisao['list']  as $dados){
    // MOntando dados de Impressão
    $output[] = [
        $dados['dt_txt'],
        number_format( $dados['main']['temp'],2,'.',''),
        number_format( $dados['main']['feels_like'],2,'.',''),
        $dados['weather'][0]['description']
    ];
}

print_r($output);

