<?php


namespace Twilio\Tests\Unit\Http;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use Twilio\Exceptions\HttpException;
use Twilio\Http\File;
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
        $response = $this->client->request('POST', 'https://www.whatever.com', ['myquerykey' => 'myqueryvalue'], ['myparamkey' => 'myparamvalue']);
        $this->assertNull($response->getContent());
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame([], $response->getHeaders());

        $request = $this->mockHandler->getLastRequest();

        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('myparamkey=myparamvalue', $request->getBody()->getContents());
        $this->assertSame('https://www.whatever.com?myquerykey=myqueryvalue', (string)$request->getUri());
        $this->assertStringMatchesFormat('application/x-www-form-urlencoded', $request->getHeaderLine('Content-Type'));

        $options = $this->mockHandler->getLastOptions();
      
        $this->assertFalse($options['allow_redirects']);
    }

    public function testPostMethodArray(): void {
        $this->mockHandler->append(new Response());
        $response = $this->client->request('POST', 'https://www.whatever.com', [], ['key' => ['value1', 'value2']]);
        $this->assertNull($response->getContent());
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame([], $response->getHeaders());

        $request = $this->mockHandler->getLastRequest();

        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('key=value1&key=value2', $request->getBody()->getContents());
        $this->assertSame('https://www.whatever.com', (string)$request->getUri());
    }

    public function testPostMethodMultipart(): void {
        $this->mockHandler->append(new Response());
        $response = $this->client->request('POST', 'https://www.whatever.com', [], [
            'key' => 'value',
            'fileAsPath' => new File(__DIR__ . '/file.txt'),
            'fileAsResource' => new File('file.txt', fopen(__DIR__ . '/file.txt', 'rb')),
            'fileAsString' => new File('file.txt', file_get_contents(__DIR__ . '/file.txt')),
            'fileAsStream' => new File('file.txt', Utils::streamFor(fopen(__DIR__ . '/file.txt', 'rb'))),
        ]);
        $this->assertNull($response->getContent());
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame([], $response->getHeaders());

        $request = $this->mockHandler->getLastRequest();

        $this->assertSame('POST', $request->getMethod());
        $this->assertStringMatchesFormat("--%s\r\nContent-Disposition: form-data; name=\"key\"\r\nContent-Length: 5\r\n\r\nvalue\r\n--%s\r\nContent-Disposition: form-data; name=\"fileAsPath\"; filename=\"file.txt\"\r\nContent-Length: 14\r\nContent-Type: text/plain\r\n\r\nMock contents\n\r\n--%s\r\nContent-Disposition: form-data; name=\"fileAsResource\"; filename=\"file.txt\"\r\nContent-Length: 14\r\nContent-Type: text/plain\r\n\r\nMock contents\n\r\n--%s\r\nContent-Disposition: form-data; name=\"fileAsString\"; filename=\"file.txt\"\r\nContent-Length: 14\r\nContent-Type: text/plain\r\n\r\nMock contents\n\r\n--%s\r\nContent-Disposition: form-data; name=\"fileAsStream\"; filename=\"file.txt\"\r\nContent-Length: 14\r\nContent-Type: text/plain\r\n\r\nMock contents\n\r\n--%s--\r\n", $request->getBody()->getContents());
        $this->assertStringMatchesFormat('multipart/form-data; boundary=%s', $request->getHeaderLine('Content-Type'));
    }

    public function testPostMethodThatThrowsBadResponseException(): void {
        $this->mockHandler->append(new BadResponseException('Not found', new Request('get', 'https://www.whatever.com'), new Response(404)));
        $response = $this->client->request('POST', 'https://www.whatever.com', ['myquerykey' => 'myqueryvalue'], ['myparamkey' => 'myparamvalue']);
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
        $this->client->request('POST', 'https://www.whatever.com', ['myquerykey' => 'myqueryvalue'], ['myparamkey' => 'myparamvalue']);
    }

    public function testQueryParams(): void {
        $this->mockHandler->append(new Response());
        $this->client->request('get', 'https://www.whatever.com?foo=bar');
        $request = $this->mockHandler->getLastRequest();

        $this->assertSame('https://www.whatever.com?foo=bar', (string)$request->getUri());
    }

    public function testGetMethodArray(): void {
        $this->mockHandler->append(new Response());
        $response = $this->client->request('GET', 'https://www.whatever.com', ['key' => ['value1']]);
        $this->assertNull($response->getContent());
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame([], $response->getHeaders());

        $request = $this->mockHandler->getLastRequest();

        $this->assertSame('GET', $request->getMethod());
        $this->assertSame('https://www.whatever.com?key=value1', (string)$request->getUri());
    }
}
