<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Tests\Integration\Verify\V2\Service;

use Twilio\Exceptions\DeserializeException;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\Response;
use Twilio\Tests\HolodeckTestCase;
use Twilio\Tests\Request;

class AccessTokenTest extends HolodeckTestCase {
    public function testCreateRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->verify->v2->services("VAXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                     ->accessTokens->create("identity", "push");
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $values = ['Identity' => "identity", 'FactorType' => "push", ];

        $this->assertRequest(new Request(
            'post',
            'https://verify.twilio.com/v2/Services/VAXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/AccessTokens',
            null,
            $values
        ));
    }

    public function testCreateResponse(): void {
        $this->holodeck->mock(new Response(
            201,
            '
            {
                "token": "eyJ6aXAiOiJERUYiLCJraWQiOiJTQVNfUzNfX19LTVNfdjEiLCJjdHkiOiJ0d2lsaW8tZnBhO3Y9MSIsImVuYyI6IkEyNTZHQ00iLCJhbGciOiJkaXIifQ..qjltWfIgQaTwp2De.81Z_6W4kR-hdlAUvJQCbwS8CQ7QAoFRkOvNMoySEj8zEB4BAY3MXhPARfaK4Lnr4YceA2cXEmrzPKQ7bPm0XZMGYm1fqLYzAR8YAqUetI9WEdQLFytg1h4XnJnXhgd99eNXsLkpKHhsCnFkchV9eGpRrdrfB0STR5Xq0fdakomb98iuIFt1XtP0_iqxvxQZKe1O4035XhK_ELVwQBz_qdI77XRZBFM0REAzlnEOe61nOcQxkaIM9Qel9L7RPhcndcCPFAyYjxo6Ri5c4vOnszLDiHmeK9Ep9fRE5-Oz0px0ZEg_FgTUEPFPo2OHQj076H1plJnFr-qPINDJkUL_i7loqG1IlapOi1JSlflPH-Ebj4hhpBdMIcs-OX7jhqzmVqkIKWkpPyPEmfvY2-eA5Zpoo08YpqAJ3G1l_xEcHl28Ijkefj1mdb6E8POx41skAwXCpdfIbzWzV_VjFpmwhacS3JZNt9C4hVG4Yp-RGPEl1C7aJHRIUavAmoRHaXbfG20zzv5Zu0P5PcopDszzoqVfZpzc.GCt35DWTurtP-QaIL5aBSQ"
            }
            '
        ));

        $actual = $this->twilio->verify->v2->services("VAXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                           ->accessTokens->create("identity", "push");

        $this->assertNotNull($actual);
    }
}