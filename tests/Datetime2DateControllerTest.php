<?php
declare(strict_types=1);

namespace Work\Tests;

use PHPUnit\Framework\TestCase;
use Work\Common\GetDataByCurl;

class Datetime2DateControllerTest extends TestCase
{
    public function addDataProvider(): array
    {
        return [
            ['2014-01-01 12:48:15', '{"date":"2014-01-01","timezone":"Europe\/Moscow"}', true],
            ['2014-01-02 12:48:15', '{"date":"2014-01-01","timezone":"Europe\/Moscow"}', false],
            ['2014-01-03 12:48:15', '{"date":"2014-01-01","timezone":"Europe\/Moscow"}', false],
            ['abc', '', false],
        ];
    }

    /**
     * @dataProvider addDataProvider
     * Тестируем контроллер Datetime2Date
     * @param string $testValue
     * @param string $expectedValue
     * @param bool $equals
     */
    public function testControllerSuccessOnDatetime2Date(string $testValue, string $expectedValue, bool $equals)
    {
        $controller = new \Work\Controllers\Datetime2Date(['datetime' => $testValue]);
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
     * Тестируем контроллер Datetime2Date через http
     * @param string $testValue
     * @param string $expectedValue
     * @param bool $equals
     */
    public function testControllerHttpSuccessOnDatetime2Date(string $testValue)
    {
        // Получаем данные с помощью CURL
        $curl = new GetDataByCurl();
        if ($curl->get('http://localhost/index.php/api/v1/convert/datetime2date?datetime=' . $testValue, 3)) {
            // Парсим Json
            if (isset($obj)) unset($obj);
            $obj = json_decode($curl->getData());
            $this->assertTrue(isset($obj->date) && isset($obj->timezone));
        } else {
            echo 'Невозможно подключиться к серверу';
        }
    }
}
