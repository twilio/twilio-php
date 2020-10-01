<?php


namespace Twilio\Tests\Unit\Http;


use Twilio\Http\CurlClient;
use Twilio\Http\File;
use Twilio\Tests\Unit\UnitTest;

class CurlClientTest extends UnitTest {

    public function testPreemptiveAuthorization(): void {
        $client = new CurlClient();

        $options = $client->options(
            'GET',
            'http://api.twilio.com',
            [],
            [],
            [],
            'test-user',
            'test-password'
        );

        $this->assertArrayHasKey(CURLOPT_HTTPHEADER, $options);

        $headers = $options[CURLOPT_HTTPHEADER];

        $authorization = null;
        foreach ($headers as $header) {
            $parse = \explode(':', $header);
            $headerKey = $parse[0];
            if ($headerKey === 'Authorization') {
                $authorization = $header;
                break;
            }
        }

        $this->assertNotNull($authorization);

        $authorizationPayload = \explode(' ', $authorization);
        $encodedAuthorization = \array_pop($authorizationPayload);
        $decodedAuthorization = \base64_decode($encodedAuthorization);

        $this->assertEquals('test-user:test-password', $decodedAuthorization);
    }


    /**
     * @param string $message Failure Message
     * @param mixed[] $params Params with which to build the query
     * @param string $expected Expected query string
     * @dataProvider buildQueryProvider
     */
    public function testBuildQuery(string $message, ?array $params, string $expected): void {
        $client = new CurlClient();
        $actual = $client->buildQuery($params);
        $this->assertEquals($expected, $actual, $message);
    }

    public function buildQueryProvider(): array {
        return [
            [
                'Null Params',
                null,
                ''
            ],
            [
                'Empty Params',
                [],
                '',
            ],
            [
                'Single Scalar',
                ['a' => 'z'],
                'a=z',
            ],
            [
                'Multiple Scalars',
                [
                    'a' => 'z',
                    'b' => 'y',
                ],
                'a=z&b=y',
            ],
            [
                'Type Coercion: Booleans',
                [
                    'a' => true,
                    'b' => false,
                ],
                'a=1&b=',
            ],
            [
                'Type Coercion: Integers',
                [
                    'a' => 7,
                    'b' => -14,
                    'c' => 0,
                ],
                'a=7&b=-14&c=0',
            ],
            [
                'Nested Arrays',
                [
                    'a' => [1, 2, 3],
                    'b' => ['x', 'y', 'z'],
                ],
                'a=1&a=2&a=3&b=x&b=y&b=z',
            ],
            [
                'URL Safety',
                [
                    'a' => 'un$afe:// value!',
                ],
                'a=un%24afe%3A%2F%2F+value%21',
            ],
            [
                'Encoded Key',
                [
                    'StartTime>' => '2012-06-14',
                ],
                'StartTime%3E=2012-06-14',
            ]
        ];
    }

    /**
     * @param $method
     * @param $params
     * @param $expected
     * @dataProvider queryStringProvider
     * @throws \Twilio\Exceptions\EnvironmentException
     */
    public function testQueryString(string $method, array $params, string $expected): void {
        $client = new CurlClient();

        $actual = $client->options($method, 'url', $params);

        $this->assertEquals($expected, $actual[CURLOPT_URL]);
    }

    public function queryStringProvider(): array {
        $methods = ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS', 'HEAD', 'CUSTOM'];
        $cases = [];

        foreach ($methods as $method) {
            $cases[] = [
                $method,
                [],
                'url',
            ];

            $cases[] = [
                $method,
                [
                    'a' => '$z',
                    'b' => 7,
                    'c' => [1, 'x', 2],
                ],
                'url?a=%24z&b=7&c=1&c=x&c=2',
            ];
        }

        return $cases;
    }

    /**
     * @param array|string $params Parameters to post
     * @param array|string $data Data to post
     * @param string $expectedContentType Excpected Content-Type header
     * @param string $expectedBody Expected POSTFIELDS
     * @dataProvider postFieldsProvider
     * @throws \Twilio\Exceptions\EnvironmentException
     */
    public function testPostFields($params, $data, string $expectedContentType, string $expectedBody): void {
        $client = new CurlClient();

        $actual = $client->options('POST', 'url', $params, $data);
        foreach ($actual[CURLOPT_HTTPHEADER] as $header) {
            if (strpos($header, 'Content-Type: ') === 0) {
                $this->assertStringMatchesFormat($expectedContentType, substr($header, 14));
                break;
            }
        }

        $this->assertStringMatchesFormat($expectedBody, $actual[CURLOPT_POSTFIELDS]);
    }

    public function postFieldsProvider(): array {
        return [
            [
                [],
                [],
                'application/x-www-form-urlencoded',
                '',
            ],
            [
                ['a' => 'x'],
                ['a' => 'b'],
                'application/x-www-form-urlencoded',
                'a=b',
            ],
            [
                ['a' => 'x'],
                ['a' => 'x'],
                'application/x-www-form-urlencoded',
                'a=x',
            ],
            [
                ['a' => 'x'],
                [
                    'a' => 'z',
                    'b' => 7,
                    'c' => [1, 2, 3],
                ],
                'application/x-www-form-urlencoded',
                'a=z&b=7&c=1&c=2&c=3',
            ],
            'file by its path' => [
                [],
                [
                    'key' => 'value',
                    'file' => new File(__DIR__ . '/file.txt'),
                ],
                'multipart/form-data; boundary=-------------%s',
                "---------------%s\r\nContent-Disposition: form-data; name=\"key\"\r\n\r\nvalue\r\n---------------%s\r\nContent-Disposition: form-data; name=\"file\"; filename=\"file.txt\"\r\n\r\nMock contents\n\r\n---------------%s--\r\n",
            ],
            'file as a resource' => [
                [],
                [
                    'key' => 'value',
                    'file' => new File('file.txt', fopen(__DIR__ . '/file.txt', 'rb')),
                ],
                'multipart/form-data; boundary=-------------%s',
                "---------------%s\r\nContent-Disposition: form-data; name=\"key\"\r\n\r\nvalue\r\n---------------%s\r\nContent-Disposition: form-data; name=\"file\"; filename=\"file.txt\"\r\n\r\nMock contents\n\r\n---------------%s--\r\n",
            ],
            'file as a string' => [
                [],
                [
                    'key' => 'value',
                    'file' => new File('file.txt', file_get_contents(__DIR__ . '/file.txt', 'rb'), 'custom/content'),
                ],
                'multipart/form-data; boundary=-------------%s',
                "---------------%s\r\nContent-Disposition: form-data; name=\"key\"\r\n\r\nvalue\r\n---------------%s\r\nContent-Disposition: form-data; name=\"file\"; filename=\"file.txt\"\r\nContent-Type: custom/content\r\n\r\nMock contents\n\r\n---------------%s--\r\n",
            ],
        ];
    }

    public function testPutFile(): void {
        $client = new CurlClient();
        $actual = $client->options('PUT', 'url', [], ['a' => 1, 'b' => 2]);
        $this->assertNotNull($actual[CURLOPT_INFILE]);
        $this->assertEquals('a=1&b=2', \fread($actual[CURLOPT_INFILE], $actual[CURLOPT_INFILESIZE]));
        $this->assertEquals(7, $actual[CURLOPT_INFILESIZE]);
    }

    /**
     * @param string $message Case message, displayed on assertion error
     * @param mixed[] $options Options to inject
     * @param mixed[] $expected Partial array to expect
     * @dataProvider userInjectedOptionsProvider
     * @throws \Twilio\Exceptions\EnvironmentException
     */
    public function testUserInjectedOptions(string $message, array $options, array $expected): void {
        $client = new CurlClient($options);
        $actual = $client->options(
            'GET',
            'url',
            ['param-key' => 'param-value'],
            ['data-key' => 'data-value'],
            ['header-key' => 'header-value'],
            'user',
            'password',
            20
        );
        foreach ($expected as $key => $value) {
            $this->assertEquals($value, $actual[$key], $message);
        }
    }

    public function userInjectedOptionsProvider(): array {
        return [
            [
                'No Conflict Options',
                [CURLOPT_VERBOSE => true],
                [CURLOPT_VERBOSE => true],
            ],
            [
                'Options preferred over Defaults',
                [CURLOPT_TIMEOUT => 1000],
                [CURLOPT_TIMEOUT => 1000],
            ],
            [
                'Required Options can not be injected',
                [CURLOPT_HTTPGET => false],
                [CURLOPT_HTTPGET => true],
            ],
            [
                'Injected URL decorated with Query String',
                [CURLOPT_URL => 'user-provided-url'],
                [CURLOPT_URL => 'user-provided-url?param-key=param-value'],
            ],
            [
                'Injected Headers are additive',
                [
                    CURLOPT_HTTPHEADER => [
                        'injected-key: injected-value',
                    ],
                ],
                [
                    CURLOPT_HTTPHEADER => [
                        'injected-key: injected-value',
                        'header-key: header-value',
                        'Authorization: Basic ' . \base64_encode('user:password'),
                    ],
                ],
            ],
        ];
    }
}
