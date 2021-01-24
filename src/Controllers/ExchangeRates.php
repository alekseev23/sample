<?php
declare(strict_types=1);

namespace Work\Controllers;

use Throwable;
use Work\Interfaces\ResponseInterface;
use Work\Response\Data;
use Work\Response\Error;

/**
 * Получаем курс доллара и евро к рублю и отдаём в виде объекта
 * @package Work\Controllers
 */
class ExchangeRates extends BaseController
{
    /**
     * @return ResponseInterface
     */
    public function process(): ResponseInterface
    {
        try {
            // Получаем данные с помощью CURL
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://www.cbr-xml-daily.ru/daily_json.js');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);
            // Из строки получаем объект
            $data = json_decode($output);
            // Создаём новый объект с евро и доллараом
            return new Data((object)['USD' => $data->Valute->USD->Value, 'EUR' => $data->Valute->EUR->Value]);
        } catch (Throwable $t) { // Если есть проблема, то ругаемся
            return new Error('Невозможно подключиться к серверу');
        }
    }
}
