<?php

namespace App\WebService;

class OpenWeatherMap{

    /**
     * URL BASE DA API
     * @var String
     */
    const BASE_URL = "https://api.openweathermap.org";

    /**
     * Chave de acesso API do OpenWeatherMap
     * @var string
     */

    private $api_key;

    
    /**
     * Método responsável por construir a classe
     * @param string $api_key
     */

    public function __construct($api_key)
    {
        $this->api_key = $api_key;
    }

    /**
     * Metodo responsavel por obter o clima atual da cidade 
     * @param string $cidade
     * @param string $uf
     * @return array 
     */
    
     public function consultarClimaAtual($cidade, $uf){
        return $this->get('/data/2.5/weather',[
            'q' => $cidade.',BR-'.$uf.',BRA'
        ]);
    }

    /**
     * Método responsável por executar a consulta GET na API do OpenWeatherMap
     * @param string $resource
     * @param array $params
     * @return array
     */
    private function get($resource,$params){
       // Parametros adicionais 
       $params['units'] = 'metric';
       $params['lang'] = 'pt_br';
       $params['appid'] = $this->api_key;

       //endpoint
       $endpoint = self::BASE_URL.$resource.'?'.http_build_query($params);

       // Iniciar o CURL
        $curl = curl_init();

        // Configurações do CURL
        curl_setopt_array($curl,[
            CURLOPT_URL => $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_SSL_VERIFYPEER => false
        ]);

        // Recebe a resposta 
        $response = curl_exec($curl);

        if($response === false) {
            $error = curl_error($curl);
            curl_close($curl);
            throw new \Exception('Erro na requisição CURL: ' . $error);
        }

        // Fercha a conexão
        curl_close($curl);

        // Retorna a requisição em array 
        return json_decode($response,true);
    }


}