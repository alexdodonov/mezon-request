<?php
namespace Mezon\Transport\Tests;

use PHPUnit\Framework\TestCase;
use Mezon\Transport\Request;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class GetParameterAsStringUnitTest extends TestCase
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
