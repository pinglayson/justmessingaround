<?php

namespace Api;

use GuzzleHttp;
use GuzzleHttp\Exception\ClientException;
use Api\BaseApi;

class Currency extends BaseApi
{
    public static function convert()
    {
        $return = "";

        // GUARD
        if(!is_numeric($_GET['amount'])){
            self::returnFailed("Amount should be numeric");
        }
        
        if(isset($_GET['from']) && isset($_GET['to']) && isset($_GET['amount'])){

            $client = new \GuzzleHttp\Client(['http_errors' => false]);
            
            $response = $client->request('GET', 'https://api.exchangeratesapi.io/latest?base='.strtoupper($_GET['from']));
            $data = json_decode($response->getBody(), true);

            if(isset($data['error'])){
                // Server returned error
                self::returnFailed($data['error']);
            } else if(isset($data['rates'][strtoupper($_GET['to'])])) {
                $return = $data['rates'][strtoupper($_GET['to'])] * $_GET['amount'];
            }

        } else {
            $return = 'Required fields: from, to, amount ';
        }

        self::returnSuccess($return);
        
    }

}