<?php
namespace Mezon\Transport\Tests;

use PHPUnit\Framework\TestCase;
use Mezon\Transport\Request;

class RequestUnitTest extends TestCase
{

    /**
     * Testing get parameter fetchind
     */
    public function testGetParameter(): void
    {
        // setup
        $_GET['get-param'] = 'get-value';
        
        // test body and assertions
        $this->assertEquals('get-value', Request::getParam('get-param'));
    }
}
