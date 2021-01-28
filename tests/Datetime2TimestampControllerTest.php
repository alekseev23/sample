<?php
declare(strict_types=1);

namespace Work\Tests;

use PHPUnit\Framework\TestCase;
use Work\Common\GetDataByCurl;

class Datetime2TimestampControllerTest extends TestCase
{
    /**
     * Тестируем контроллер Datetime2Date
     */
    public function testControllerSuccessOnDatetime2Timestamp()
    {
        $controller = new \Work\Controllers\Datetime2Timestamp(['datetime' => '2021-01-01 12:48:15']);
        $response = $controller->process();
        $this->assertEquals('{"timestamp":1609494495}', $response->getResult());
    }

    public function addDataProvider(): array
    {
        return [
            ['200', 'datetime', '{"result":"error","message":"Call to a member function getTimestamp() on bool"}'],
            ['abc', 'datetime1', '{"result":"error","message":"Переменная [datetime] не найдена"}'],
        ];
    }

    /**
     * @dataProvider addDataProvider
     * Тестируем контроллер Datetime2Timestamp
     * @param string $testValue
     * @param string $paramName
     * @param string $expectedValue
     */
    public function testControllerFailureOnDatetime2Timestamp(string $testValue, string $paramName, string $expectedValue)
    {
        $controller = new \Work\Controllers\Datetime2Timestamp([$paramName => $testValue]);
        $response = $controller->process();
        $this->assertInstanceOf('\Work\Response\Error', $response);
        $this->assertEquals($expectedValue, $response->getResult());
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
        $res = $curl->get('http://localhost/index.php/api/v1/convert/datetime2timestamp?datetime=' . $testValue, 3);
        $this->assertTrue($res);
        if ($res) {
            // Парсим Json
            $obj = json_decode($curl->getData());
            $this->assertTrue(isset($obj->timestamp));
        }
    }
}
