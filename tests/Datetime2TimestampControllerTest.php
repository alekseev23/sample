<?php
declare(strict_types=1);

namespace Work\Tests;

use PHPUnit\Framework\TestCase;

class Datetime2TimestampControllerTest extends TestCase
{
    public function addDataProvider(): array
    {
        return array(
            array('2014-01-01 12:48:15','{"timestamp":1388566095}', true),
            array('2025-01-01 12:48:15','{"timestamp":1735724895}', true),
            array('2014-01-03 12:48:15','{"timestamp":1735724895}', false),
        );
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
        $str = $response->getResult();
        if ($equals) $this->assertEquals($expectedValue, $str);
        else $this->assertNotEquals($expectedValue, $str);
    }
}
