<?php
declare(strict_types=1);

namespace Work\Controllers;

use Work\Common\GetDataByCurl;
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
        $curl = new GetDataByCurl();
        if ($curl->get('https://www.cbr-xml-daily.ru/daily_json.js', 3)) {
            $data = json_decode($curl->getData());
            // Создаём новый объект с евро и доллараом
            return new Data((object)['USD' => $data->Valute->USD->Value, 'EUR' => $data->Valute->EUR->Value]);
        } else return new Error($curl->getError(), 500);
    }
}
