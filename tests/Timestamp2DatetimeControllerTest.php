<?php
declare(strict_types=1);

namespace Work\Tests;

use PHPUnit\Framework\TestCase;
use Work\Common\GetDataByCurl;

class Timestamp2DatetimeControllerTest extends TestCase
{
    public function addDataProvider(): array
    {
        return [
            ['123456789', '{"datetime":"1973-11-30 12:33:09","timezone":"Europe\/Moscow"}', true],
            ['1000000', '{"datetime":"1970-01-12 04:46:40","timezone":"Europe\/Moscow"}', true],
            ['100', '{"datetime":"1970-01-12 04:46:40","timezone":"Europe\/Moscow"}', false],
            ['abc', '', false],
        ];
    }

    /**
     * @dataProvider addDataProvider
     * Тестируем контроллер Timestamp2Datetime
     * @param string $testValue
     * @param string $expectedValue
     * @param bool $equals
     */
    public function testControllerSuccessOnTimestamp2Datetime(string $testValue, string $expectedValue, bool $equals)
    {
        $controller = new \Work\Controllers\Timestamp2Datetime(['timestamp' => $testValue]);
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
        if ($curl->get('http://localhost/index.php/api/v1/convert/timestamp2datetime?timestamp=' . $testValue, 3)) {
            // Парсим Json
            if (isset($obj)) unset($obj);
            $obj = json_decode($curl->getData());
            $this->assertTrue(isset($obj->datetime) && isset($obj->timezone));
        } else {
            echo 'Невозможно подключиться к серверу';
        }
    }
}
