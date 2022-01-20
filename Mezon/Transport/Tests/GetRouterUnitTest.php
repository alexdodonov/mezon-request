<?php
namespace Mezon\Transport\Tests;

use PHPUnit\Framework\TestCase;
use Mezon\Transport\Request;
use Mezon\Router\Router;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class GetRouterUnitTest extends TestCase
{

    /**
     * Testing method getRouter
     */
    public function testGetRouter(): void
    {
        // setup
        $router = new Router();

        // test body
        Request::registerRouter($router);

        // assertions
        $this->assertInstanceOf(Router::class, Request::getRouter());
    }

    /**
     * Testing exception
     */
    public function testException(): void
    {
        // assertions
        $this->expectException(\Exception::class);
        $this->expectExceptionCode(- 1);
        $this->expectExceptionMessage('Router was not setup');

        // setup
        $router = null;
        Request::registerRouter($router);

        // test body
        Request::getRouter();
    }
}
