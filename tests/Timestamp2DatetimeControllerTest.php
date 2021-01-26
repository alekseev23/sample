<?php
declare(strict_types=1);

namespace Work\Tests;

use PHPUnit\Framework\TestCase;

class Timestamp2DatetimeControllerTest extends TestCase
{
    public function addDataProvider(): array
    {
        return array(
            array('123456789','{"datetime":"1973-11-30 12:33:09","timezone":"Europe\/Moscow"}', true),
            array('1000000','{"datetime":"1970-01-12 04:46:40","timezone":"Europe\/Moscow"}', true),
            array('100','{"datetime":"1970-01-12 04:46:40","timezone":"Europe\/Moscow"}', false),
        );
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
        $str = $response->getResult();
        if ($equals) $this->assertEquals($expectedValue, $str);
        else $this->assertNotEquals($expectedValue, $str);
    }
}
