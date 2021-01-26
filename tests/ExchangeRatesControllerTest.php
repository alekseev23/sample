<?php
declare(strict_types=1);

namespace Work\Tests;

use PHPUnit\Framework\TestCase;
use Work\Response\Error;

class ExchangeRatesControllerTest extends TestCase
{
    /**
     * Тестируем контроллер ExchangeRates
     */
    public function testControllerSuccessOnExchangeRates()
    {
        try {
            // Получаем данные с помощью CURL
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_TIMEOUT, '3');
            curl_setopt($ch, CURLOPT_URL, 'http://localhost/index.php/api/v1/ruble');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);
            // Из строки получаем объект
            $data = json_decode($output);
            // Проверяем утверждения
            $this->assertLessThan(73.5, $data->USD);
            $this->assertGreaterThan(50, $data->USD);
            $this->assertLessThan(100, $data->EUR);
            $this->assertGreaterThan(70, $data->EUR);
        } catch (Throwable $t) { // Если есть проблема, то ругаемся
            return new Error('Невозможно подключиться к серверу');
        }
    }
}
