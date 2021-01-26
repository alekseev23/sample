<?php
declare(strict_types=1);

namespace Work\Tests;

use PHPUnit\Framework\TestCase;

class Datetime2DateControllerTest extends TestCase
{
    public function addDataProvider(): array
    {
        return array(
            array('2014-01-01 12:48:15','{"date":"2014-01-01","timezone":"Europe\/Moscow"}', true),
            array('2014-01-02 12:48:15','{"date":"2014-01-01","timezone":"Europe\/Moscow"}', false),
            array('2014-01-03 12:48:15','{"date":"2014-01-01","timezone":"Europe\/Moscow"}', false),
        );
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
        $str = $response->getResult();
        if ($equals) $this->assertEquals($expectedValue, $str);
        else $this->assertNotEquals($expectedValue, $str);
    }
}
