<?php

require __DIR__.'/vendor/autoload.php';

use \App\WebService\OpenWeatherMap;

$openWeatherMap = new OpenWeatherMap("0921cdb676c60de39157ca711c5f3664");

if(!isset($argv[2])){
    die('UF e Cidade são obrigatorios');
}

$cidade = $argv[1];
$uf = $argv[2];

$dadosClima = $openWeatherMap->consultarClimaAtual($cidade,$uf);

echo 'Cidade: '.$cidade.' '.$uf."\n";

echo 'Temperatura: '.($dadosClima['main']['temp'] ?? 'Desconhecido')."\n";
echo 'Sensação Termica: '.($dadosClima['main']['feels_like'] ?? 'Desconhecido').' '.$uf."\n";

// Clima
echo 'Clima: '.($dadosClima['weather'][0]['description'] ?? 'Desconhecido')."\n";
