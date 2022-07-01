<?php
namespace Mezon\Transport\Tests;

use Mezon\Transport\Request;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
class GetParameterUnitTest extends RequestBaseTests
{

    /**
     * Testing get parameter fetching
     */
    public function testGetParameter(): void
    {
        // setup
        $_GET['get-param'] = 'get-value';
        
        // test body and assertions
        $this->assertEquals('get-value', Request::getParam('get-param'));
    }
}
