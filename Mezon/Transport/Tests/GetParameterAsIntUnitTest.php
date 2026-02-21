<?php
namespace Mezon\Transport\Tests;

use Mezon\Transport\Request;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class GetParameterAsIntUnitTest extends RequestBaseTests
{

    /**
     * Testing get parameter fetching
     */
    public function testGetParameterAsString(): void
    {
        // setup
        $_GET['get-param'] = 1;

        // test body and assertions
        $this->assertEquals(1, Request::getParamAsInt('get-param'));
    }
}
