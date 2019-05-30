<?php


namespace Twilio\Tests\Unit\Http;


use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Twilio\Http\GuzzleClient;
use Twilio\Tests\Unit\UnitTest;

final class GuzzleClientTest extends UnitTest
{
    /**
     * @var GuzzleClient
     */
    private $client;

    /**
     * @var MockHandler
     */
    private $mockHandler;

    public function setUp()
    {
        parent::setUp();
        $this->mockHandler = new MockHandler();
        $this->client = new GuzzleClient(new Client([
            'handler' => HandlerStack::create($this->mockHandler),
        ]));
    }

    public function testPostMethod()
    {
        $this->mockHandler->append(new Response());
        $response = $this->client->request('post', 'https://www.whatever.com', ['myquerykey' => 'myqueryvalue'], ['myparamkey' => 'myparamvalue']);
        $this->assertSame(null, $response->getContent());
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame([], $response->getHeaders());

        $request = $this->mockHandler->getLastRequest();

        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('myparamkey=myparamvalue', $request->getBody()->getContents());
        $this->assertSame('https://www.whatever.com?myquerykey=myqueryvalue', (string)$request->getUri());
    }
}
