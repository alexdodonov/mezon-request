<?php
namespace Mezon\Transport\Tests;

use Mezon\Transport\Request;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class GetParameterAsStringUnitTest extends RequestBaseTest
{

    /**
     * Testing get parameter fetching
     */
    public function testGetParameterAsString(): void
    {
        // setup
        $_GET['get-param'] = 1;

        // test body and assertions
        $this->assertEquals(1, Request::getParamAsString('get-param'));
    }
}
