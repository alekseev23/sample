<?php
declare(strict_types=1);

namespace Work\Tests;

use PHPUnit\Framework\TestCase;
use Work\Common\GetDataByCurl;

class Datetime2TimestampControllerTest extends TestCase
{
    public function addDataProvider(): array
    {
        return [
            ['2014-01-01 12:48:15', '{"timestamp":1388566095}', true],
            ['2025-01-01 12:48:15', '{"timestamp":1735724895}', true],
            ['2014-01-03 12:48:15', '{"timestamp":1735724895}', false],
            ['', '', false],
        ];
    }

    /**
     * @dataProvider addDataProvider
     * Тестируем контроллер Datetime2Timestamp
     * @param string $testValue
     * @param string $expectedValue
     * @param bool $equals
     */
    public function testControllerSuccessOnDatetime2Timestamp(string $testValue, string $expectedValue, bool $equals)
    {
        $controller = new \Work\Controllers\Datetime2Timestamp(['datetime' => $testValue]);
        $response = $controller->process();
        if ($response instanceof \Work\Response\Error) {
            $this->assertFalse($equals);
        } else {
            $str = $response->getResult();
            if ($equals) {
                $this->assertEquals($expectedValue, $str);
            } else {
                $this->assertNotEquals($expectedValue, $str);
            }
        }
    }

    public function addHttpDataProvider(): array
    {
        return [
            ['2014-01-01 12:48:15'],
            ['1999-11-22 02:34:19'],
            ['2021-09-13 09:18:38'],
        ];
    }

    /**
     * @dataProvider addHttpDataProvider
     * Тестируем контроллер Datetime2Timestamp через http
     * @param string $testValue
     * @param string $expectedValue
     * @param bool $equals
     */
    public function testControllerHttpSuccessOnDatetime2Timestamp(string $testValue)
    {
        // Получаем данные с помощью CURL
        $curl = new GetDataByCurl();
        if ($curl->get('http://localhost/index.php/api/v1/convert/datetime2timestamp?datetime=' . $testValue, 3)) {
            // Парсим Json
            if (isset($obj)) unset($obj);
            $obj = json_decode($curl->getData());
            $this->assertTrue(isset($obj->timestamp));
        } else {
            echo 'Невозможно подключиться к серверу';
        }
    }
}
