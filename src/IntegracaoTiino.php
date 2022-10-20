<?php

namespace App;
use App\Models\Cliente;
use GuzzleHttp\Client;

class IntegracaoTiino
{

    public const URL_TIINO = "https://api.sta.tiino.com.br/api/";
    public const ENDPONT_PEDIDOS = 'pedidos';
    public const ENDPONT_PRE_ANALISE = 'pre-analises';



    public function enviarPreAnalise(Cliente $cliente) {
        return $this->enviarDados($cliente,self::ENDPONT_PRE_ANALISE);
    }

    public function enviarPedido(Cliente $cliente) {
        return $this->enviarDados($cliente,self::ENDPONT_PEDIDOS);
    }
    /**
     * Ciente $cliente
     * string $endpoint
     * Endpoint pode ser pedidos ou pre-analise
     */
    private function enviarDados(Cliente $cliente, string $endpoint)
    {

        $token = new Token();
        $client = new Client(['verify' => false, 'http_errors' => false]);
        $parametros = [
            'headers' => [
                'Authorization' => "Bearer {$token->getAccessToken()}",
                'content-type' => 'application/json',
            ],
        ];
        

        
        $parametros['body'] = json_encode($cliente->toArrayClietePrincipal());

        $res = $client->request('POST', self::URL_TIINO.$endpoint, $parametros);
        $body = $res->getBody();
        $retorno = json_decode($body->getContents());
        if($res->getStatusCode() > 201) {
            throw new \Exception("StatusCode: {$res->getStatusCode()} Houve algum ao enviar os dados!". print_r($retorno, true));
        }

        /**
         * stdClass Object
            (
                [data] => 2022-10-11T17:50:01.6746175Z
                [ticket] => 01000000-8590-ea96-4aa6-08daabb1057f
            )
         */
        return $retorno;

    }
}
