<?php
namespace Mezon\Transport\Tests;

use Mezon\Transport\Request;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class GetCheckedUnitTest extends RequestBaseTest
{

    /**
     * Testing was parameter checked
     */
    public function testGetChecked(): void
    {
        // setup
        $_GET['get-param'] = 'get-value';

        // test body and assertions
        $this->assertEquals(1, Request::getChecked('get-param', [
            1,
            0
        ]));
    }

    /**
     * Testing was parameter checked
     */
    public function testWasNotChecked(): void
    {
        // setup
        unset($_GET['get-param']);

        // test body and assertions
        $this->assertEquals(0, Request::getChecked('get-param', [
            1,
            0
        ]));
    }
}
