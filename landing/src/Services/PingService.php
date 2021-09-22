<?php
namespace App\Services;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class PingService
{
  private $client;

  public function __construct(HttpClientInterface $client){
    $this->client = $client;
  }

  public function send(){

    try {
      $response = $this->client->request('POST', 'http://'.$_SERVER['REMOTE_ADDR'].':6543/json-rpc', [
        'json' => [
          "jsonrpc" => "2.0",
          "method" => "ping",
          "params" => [
            "url"=>$_SERVER['REQUEST_URI'],
            "key"=>"wowItsSoSecret"
          ],
          "id" => 1
        ]
      ]);

    } catch (\Exception $e) {
      //Как-то обрабатываем
      //Например восстанавливаемся или отправляем отчет о сбое
    }

    return TRUE;

  }

  public function get(){

    try {
      $response = $this->client->request('POST', 'http://'.$_SERVER['REMOTE_ADDR'].':6543/json-rpc', [
        'json' => [
          "jsonrpc" => "2.0",
          "method" => "get",
          "params" => [
            "key"=>"wowItsSoSecret"
          ],
          "id" => 1
        ]
      ]);

    } catch (\Exception $e) {
      //Как-то обрабатываем
      //Например восстанавливаемся или отправляем отчет о сбое
      $response = $e;
    }

    return $response->getContent();

  }

}
