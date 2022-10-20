<?php
namespace App;

use GuzzleHttp\Client;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

class Token {

    public const URL = "https://tuneauth.com.br/auth";
    public const REALM = "tiino-dev";
    public const CLIENT_ID = "CLIENT_ID";
    public const CLIENT_SECRET = "CLIENT_SECRET";
    public const NOME_ITEM_CACHE = "token";

    private $token;
    
    /**
     *
     * @var FilesystemAdapter
     */
    private $cache;

    public function __construct() {
        $this->cache = new FilesystemAdapter();
    }

    public function limparCache() : self
    {
        $token =$this->cache->deleteItem(self::NOME_ITEM_CACHE);
        return $this;
    }


    public function gerar() {
        $this->limparCache();
        $item = $this->cache->getItem(self::NOME_ITEM_CACHE);
        // Quando isHint é falso isso significa que não existe cache criado
        if(!$item->isHit()) {
            
            $cliente = new Client(['verify' => false, 'http_errors' => false]);
            $parametros = [
                'headers' => [
                    'content-type' => 'application/x-www-form-urlencoded'
                ],
                'form_params' => [
                    "grant_type" => 'client_credentials',
                    "client_id" => self::CLIENT_ID,
                    "client_secret" => self::CLIENT_SECRET
                ]
            ];

            $url = self::URL."/realms/".self::REALM."/protocol/openid-connect/token";
            $response = $cliente->request("POST",$url, $parametros);

            $body = $response->getBody();
            $token = json_decode($body->getContents());
            
            if($response->getStatusCode() >= 400) {
                throw new \Exception("Houve um problema para buscar o token ".print_r($token, true));
            }


            $item->set($token);
            $item->expiresAfter(intval($token->expires_in));
            $this->cache->save($item);
        }
        return $item->get();
    }

    public function getAccessToken(){
        $token = $this->gerar();
        return $token->access_token;
    }

}