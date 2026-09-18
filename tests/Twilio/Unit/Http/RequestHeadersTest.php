<?php


namespace Twilio\Tests\Unit\Http;


use Twilio\Http\RequestHeaders;
use Twilio\Tests\Unit\UnitTest;

final class RequestHeadersTest extends UnitTest {
    public function testValidatesStringHeaderValues(): void {
        $headers = ['X-Test' => 'value'];

        $this->assertSame($headers, RequestHeaders::validate($headers));
    }

    public function testRejectsEmptyHeaderName(): void {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Header names must be non-empty strings.');

        RequestHeaders::validate(['' => 'value']);
    }
}
