<?php
namespace Mezon\Transport\Tests;

use PHPUnit\Framework\TestCase;
use Mezon\Transport\Request;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class WasSubmittedUnitTest extends TestCase
{

    /**
     * Testing was parameter submitted
     */
    public function testWasSubmitted(): void
    {
        // setup
        $_GET['get-param'] = 'get-value';

        // test body and assertions
        $this->assertTrue(Request::wasSubmitted('get-param'));
    }

    /**
     * Testing was parameter submitted
     */
    public function testWasNotSubmitted(): void
    {
        // setup
        unset($_GET['get-param']);

        // test body and assertions
        $this->assertFalse(Request::wasSubmitted('get-param'));
    }
}
