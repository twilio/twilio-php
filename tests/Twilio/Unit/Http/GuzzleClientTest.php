<?php


namespace Twilio\Tests\Unit\Http;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Twilio\Exceptions\HttpException;
use Twilio\Http\GuzzleClient;
use Twilio\Tests\Unit\UnitTest;

final class GuzzleClientTest extends UnitTest {
    /**
     * @var GuzzleClient
     */
    private $client;

    /**
     * @var MockHandler
     */
    private $mockHandler;

    public function setUp(): void {
        parent::setUp();
        $this->mockHandler = new MockHandler();
        $this->client = new GuzzleClient(new Client([
            'handler' => HandlerStack::create($this->mockHandler),
        ]));
    }

    public function testPostMethod(): void {
        $this->mockHandler->append(new Response());
        $response = $this->client->request('post', 'https://www.whatever.com', ['myquerykey' => 'myqueryvalue'], ['myparamkey' => 'myparamvalue']);
        $this->assertNull($response->getContent());
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame([], $response->getHeaders());

        $request = $this->mockHandler->getLastRequest();

        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('myparamkey=myparamvalue', $request->getBody()->getContents());
        $this->assertSame('https://www.whatever.com?myquerykey=myqueryvalue', (string)$request->getUri());
    }

    public function testPostMethodArray(): void {
        $this->mockHandler->append(new Response());
        $response = $this->client->request('post', 'https://www.whatever.com', [], ['key' => ['value1', 'value2']]);
        $this->assertNull($response->getContent());
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame([], $response->getHeaders());

        $request = $this->mockHandler->getLastRequest();

        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('key=value1&key=value2', $request->getBody()->getContents());
        $this->assertSame('https://www.whatever.com', (string)$request->getUri());
    }

    public function testPostMethodThatThrowsBadResponseException(): void {
        $this->mockHandler->append(new BadResponseException('Not found', new Request('get', 'https://www.whatever.com'), new Response(404)));
        $response = $this->client->request('post', 'https://www.whatever.com', ['myquerykey' => 'myqueryvalue'], ['myparamkey' => 'myparamvalue']);
        $this->assertNull($response->getContent());
        $this->assertSame(404, $response->getStatusCode());
        $this->assertSame([], $response->getHeaders());

        $request = $this->mockHandler->getLastRequest();

        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('myparamkey=myparamvalue', $request->getBody()->getContents());
        $this->assertSame('https://www.whatever.com?myquerykey=myqueryvalue', (string)$request->getUri());
    }

    public function testPostMethodThatThrowsException(): void {
        $this->mockHandler->append(new RequestException('Not found', new Request('get', 'https://www.whatever.com')));
        $this->expectException(HttpException::class, 'Unable to complete the HTTP request');
        $this->client->request('post', 'https://www.whatever.com', ['myquerykey' => 'myqueryvalue'], ['myparamkey' => 'myparamvalue']);
    }

    public function testQueryParams(): void {
        $this->mockHandler->append(new Response());
        $this->client->request('get', 'https://www.whatever.com?foo=bar');
        $request = $this->mockHandler->getLastRequest();

        $this->assertSame('https://www.whatever.com?foo=bar', (string)$request->getUri());
    }
}
