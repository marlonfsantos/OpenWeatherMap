<?php

require __DIR__.'/vendor/autoload.php';

use \App\WebService\OpenWeatherMap;

$openWeatherMap = new OpenWeatherMap("0921cdb676c60de39157ca711c5f3664");

$dadosClima = $openWeatherMap->consultarClimaAtual('Juazeiro do Norte','CE');

echo "<pre>";
print_r($dadosClima);
exit;