<?php
declare(strict_types=1);

namespace Work\Controllers;

use \Work\Interfaces\ResponseInterface;
use \Work\Interfaces\ControllerInterface;
use \Work\Response\Error;
use \Work\Response\Success;
use \Work\Response\Data;

class ExchangeRates extends BaseController implements ControllerInterface
{
    public function process(): ResponseInterface
    {
        try {
            // create curl resource
            $ch = curl_init();

            // set url
            curl_setopt($ch, CURLOPT_URL, "https://www.cbr-xml-daily.ru/daily_json.js");

            //return the transfer as a string
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            // $output contains the output string
            $output = curl_exec($ch);

            // close curl resource to free up system resources
            curl_close($ch);

            //
            $data = json_decode($output);
            $response = new Data((object)['USD' => $data->Valute->USD->Value, 'EUR' => $data->Valute->EUR->Value]);
            return $response;
        }
        catch (Throwable $t) { // Если есть проблема, то ругаемся
            $response = new Error('Can\'t connect to server');
            return $response;
        }
        $response = new Success('OK',1);
        return $response;
    }
}
