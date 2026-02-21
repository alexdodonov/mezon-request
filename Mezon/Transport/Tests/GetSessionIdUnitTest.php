<?php
namespace Mezon\Transport\Tests;

use Mezon\Transport\Request;
use Mezon\Headers\Layer;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class GetSessionIdUnitTest extends RequestBaseTests
{

    /**
     * Testing get parameter fetching
     */
    public function testGetSessionIdFromAuthentication(): void
    {
        // setup
        Layer::setAllHeaders([
            'Authentication' => 'Basic session-hash'
        ]);

        // test body and assertions
        $this->assertEquals('session-hash', Request::getParamAsString('session_id'));
    }

    /**
     * Testing get parameter fetching
     */
    public function testGetSessionIdFromAuthorization(): void
    {
        // setup
        Layer::setAllHeaders([
            'Authorization' => 'Basic session-hash'
        ]);

        // test body and assertions
        $this->assertEquals('session-hash', Request::getParamAsString('session_id'));
    }

    /**
     * Testing get parameter fetching
     */
    public function testGetSessionIdFromCgiAuthorization(): void
    {
        // setup
        Layer::setAllHeaders([
            'Cgi-Authorization' => 'Basic session-hash'
        ]);

        // test body and assertions
        $this->assertEquals('session-hash', Request::getParamAsString('session_id'));
    }

    /**
     * Testing exception throwing
     */
    public function testGteSessionIdException(): void
    {
        // setup
        Layer::setAllHeaders([]);

        // assertions
        $this->expectException(\Exception::class);
        $this->expectExceptionCode(2);
        $this->expectExceptionMessage('Invalid session token');

        // test body
        Request::getParamAsString('session_id');
    }
}
