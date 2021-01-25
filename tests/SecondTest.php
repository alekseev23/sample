<?php
declare(strict_types=1);

namespace Work\Tests;

require_once('test_bootstrap.php');

use PHPUnit\Framework\TestCase;

class SecondTest extends TestCase
{
    /**
     * Примитивный тест
     */
    public function testXXX()
    {
        $this->assertTrue(true);
    }

    /**
     * Тестируем контроллер Timestamp2Datetime
     */
    public function testTimestamp2Datetime()
    {
        $_REQUEST['timestamp'] = '123456789';
        $controller = new \Work\Controllers\Timestamp2Datetime($_REQUEST);
        $response = $controller->process();
        $str = $response->getResult();
        $this->assertEquals(
            '{"datetime":"1973-11-30 12:33:09","timezone":"Europe\/Moscow"}',
            $str,
            'Test Timestamp2Datetime failed!');
    }

    /**
     * Тестируем контроллер Datetime2Date
     */
    public function testDatetime2Date()
    {
        $_REQUEST['datetime'] = '2014-01-01 12:48:15';
        $controller = new \Work\Controllers\Datetime2Date($_REQUEST);
        $response = $controller->process();
        $str = $response->getResult();
        $this->assertEquals(
            '{"date":"2014-01-01","timezone":"Europe\/Moscow"}',
            $str,
            'Test Datetime2Date failed!');
    }

    /**
     * Тестируем контроллер Datetime2Timestamp
     */
    public function testDatetime2Timestamp()
    {
        $_REQUEST['timestamp'] = '123456789';
        $controller = new \Work\Controllers\Datetime2Timestamp($_REQUEST);
        $response = $controller->process();
        $str = $response->getResult();
        $this->assertEquals(
            '{"timestamp":1388566095}',
            $str,
            'Test Datetime2Timestamp failed!');
    }

}
