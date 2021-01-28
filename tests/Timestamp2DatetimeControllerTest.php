<?php
declare(strict_types=1);

namespace Work\Tests;

use PHPUnit\Framework\TestCase;
use Work\Common\GetDataByCurl;

class Timestamp2DatetimeControllerTest extends TestCase
{
    /**
     * Тестируем контроллер Timestamp2Datetime
     */
    public function testControllerSuccessOnTimestamp2Datetime()
    {
        $controller = new \Work\Controllers\Timestamp2Datetime(['timestamp' => '1000000']);
        $response = $controller->process();
        $this->assertEquals('{"datetime":"1970-01-12 04:46:40","timezone":"Europe\/Moscow"}', $response->getResult());
    }

    public function addDataProvider(): array
    {
        return [
            ['abc', 'timestamp', '{"result":"error","message":"Call to a member function getTimestamp() on bool"}'],
            ['1234567', '1timestamp', '{"result":"error","message":"Переменная [timestamp] не найдена"}'],
        ];
    }

    /**
     * @dataProvider addDataProvider
     * Тестируем контроллер Timestamp2Datetime
     * @param string $testValue
     * @param string $paramName
     * @param string $expectedValue
     */
    public function testControllerFailureOnTimestamp2Datetime(string $testValue, string $paramName, string $expectedValue)
    {
        $controller = new \Work\Controllers\Timestamp2Datetime([$paramName => $testValue]);
        $response = $controller->process();
        $this->assertInstanceOf('\Work\Response\Error', $response);
        $this->assertEquals($expectedValue, $response->getResult());
    }

    public function addHttpDataProvider(): array
    {
        return [
            ['567890'],
            ['12345678'],
            ['987654321'],
        ];
    }

    /**
     * @dataProvider addHttpDataProvider
     * Тестируем контроллер Timestamp2Datetime через http
     * @param string $testValue
     * @param string $expectedValue
     * @param bool $equals
     */
    public function testControllerHttpSuccessOnTimestamp2Datetime(string $testValue)
    {
        // Получаем данные с помощью CURL
        $curl = new GetDataByCurl();
        $res = $curl->get('http://localhost/index.php/api/v1/convert/timestamp2datetime?timestamp=' . $testValue, 3);
        $this->assertTrue($res);
        if ($res) {
            // Парсим Json
            $obj = json_decode($curl->getData());
            $this->assertTrue(isset($obj->datetime) && isset($obj->timezone));
        }
    }
}
