<?php
declare(strict_types=1);

namespace Work\Tests;

use PHPUnit\Framework\TestCase;
use Work\Common\GetDataByCurl;

class ExchangeRatesControllerTest extends TestCase
{
    /**
     * Тестируем контроллер ExchangeRates
     */
    public function testControllerSuccessOnExchangeRates()
    {
        // Получаем данные с помощью CURL
        $curl = new GetDataByCurl();
        if ($curl->get('http://localhost/index.php/api/v1/ruble', 3)) {
            $data = json_decode($curl->getData());
            // Проверяем утверждения
            $this->assertLessThan(93.5, $data->USD);
            $this->assertGreaterThan(50, $data->USD);
            $this->assertLessThan(100, $data->EUR);
            $this->assertGreaterThan(70, $data->EUR);
        } else echo 'Невозможно подключиться к серверу';

    }
}
