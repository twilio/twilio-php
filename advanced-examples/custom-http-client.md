# Custom HTTP Clients for the Twilio PHP Helper Library

If you are working with the Twilio PHP Helper Library and need to modify the HTTP requests that the library makes to the Twilio servers you’re in the right place. The most common place you'll need to alter the HTTP request is to connect and authenticate with an enterprise’s proxy server. We’ll provide sample code that you can drop right into your app to handle this use case.

## Connect and authenticate with a proxy server

To connect and provide credentials to a proxy server between your app and Twilio, you need a way to modify the HTTP requests that the Twilio helper library makes to invoke the Twilio REST API.

In PHP, the Twilio helper library uses the [cURL](http://php.net/manual/en/book.curl.php) library under the hood to make HTTP requests. The Twilio Helper Library allows you to provide your own `HttpClient` for making API requests.

How do we apply this to a typical Twilio REST API example?

```php
<?php

$twilio = new Client($sid, $token);

$message = $twilio->messages
    ->create(
        "+15558675310",
        array(
            'body' => "Hey there!",
            'from' => "+15017122661"
        )
    );
```

Where does `HttpClient` get created and used?

Out of the box, the helper library is creating a default `RequestClient` for you, using the Twilio credentials you pass to the `init` method. However, there’s nothing stopping you from creating your own `RequestClient`.

Once you have your own `RequestClient`, you can pass it to any Twilio REST API resource action you want. Here’s an example of sending an SMS message with a custom client:

```php
<?php
// Update the path below to your autoload.php,
// see https://getcomposer.org/doc/01-basic-usage.md
require_once "./vendor/autoload.php";
require_once "./MyRequestClass.php";

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

use Twilio\Rest\Client;

// Your Account Sid and Auth Token from twilio.com/console
$sid = getenv('ACCOUNT_SID');
$token = getenv('AUTH_TOKEN');
$proxy = getenv('PROXY');

$httpClient = new MyRequestClass($proxy);
$twilio = new Client($sid, $token, null, null, $httpClient);

$message = $twilio->messages
    ->create(
        "+15558675310",
        array(
            'body' => "Hey there!",
            'from' => "+15017122661"
        )
    );

print("Message SID: {$message->sid}");
```

## Call Twilio through a proxy server

Now that we understand how all the components fit together we can create our own `HttpClient` that can connect through a proxy server. To make this reusable, here’s a class that you can use to create this `HttpClient` whenever you need one.

```php
<?php

use Twilio\Http\CurlClient;
use Twilio\Http\Response;

class MyRequestClass extends CurlClient
{
    protected $http = null;
    protected $proxy = null;


    /**
     * MyRequestClass constructor.
     * @param $proxy Proxy Server
     * @param $cainfo CA Info for the proxy
     */
    public function __construct($proxy = null, $cainfo = null)
    {
        $this->proxy = $proxy;
        $this->cainfo = $cainfo;
        $this->http = new CurlClient();
    }

    public function request(
        $method,
        $url,
        $params = array(), $data = array(), $headers = array(), $user = null, $password = null, $timeout = null): Response
    {
        // Here you can change the URL, headers and other request parameters
        $options = $this->options(
            $method,
            $url,
            $params,
            $data,
            $headers,
            $user,
            $password,
            $timeout
        );

        $curl = curl_init($url);
        curl_setopt_array($curl, $options);
        if (!empty($this->proxy))
            curl_setopt($curl, CURLOPT_PROXY, $this->proxy);

        if (!empty($this->cainfo))
            curl_setopt($curl, CURLOPT_CAINFO, $this->cainfo);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_HTTPPROXYTUNNEL, true);
        $response = curl_exec($curl);

        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $headerSize = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $head = substr($response, 0, $headerSize);
        $body = substr($response, $headerSize);

        $responseHeaders = array();
        $headerLines = preg_split("/\r?\n/", $head);
        foreach ($headerLines as $line) {
            if (!preg_match("/:/", $line))
                continue;
            list($key, $value) = explode(':', $line, 2);
            $responseHeaders[trim($key)] = trim($value);
        }

        curl_close($curl);

        if (isset($buffer) && is_resource($buffer)) {
            fclose($buffer);
        }
        return new Response($statusCode, $body, $responseHeaders);
    }
}
```

In this example, we are using some environment variables loaded at the program startup to retrieve various configuration settings:

- Your Twilio Account Sid and Auth Token ([found here, in the Twilio console](https://console.twilio.com))
- A proxy address in IP:Port form, e.g. `127.0.0.1:8888`

Place these setting in an `.env` file like so:

```env
ACCOUNT_SID=ACxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
AUTH_TOKEN= your_auth_token

PROXY=127.0.0.1:8888
```

Here’s the full console program that loads the `.env` file and sends a text message to show everything fitting together.

```php
<?php
// Update the path below to your autoload.php,
// see https://getcomposer.org/doc/01-basic-usage.md
require_once "./vendor/autoload.php";
require_once "./MyRequestClass.php";

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

use Twilio\Rest\Client;

// Your Account Sid and Auth Token from twilio.com/console
$sid = getenv('ACCOUNT_SID');
$token = getenv('AUTH_TOKEN');
$proxy = getenv('PROXY');

$httpClient = new MyRequestClass($proxy);
$twilio = new Client($sid, $token, null, null, $httpClient);

$message = $twilio->messages
    ->create(
        "+15558675310",
        array(
            'body' => "Hey there!",
            'from' => "+15017122661"
        )
    );

print("Message SID: {$message->sid}");
```

## What else can this technique be used for?

Now that you know how to inject your own httpClient into the Twilio API request pipeline, you could use this technique to add custom HTTP headers and authorization to the requests (perhaps as required by an upstream proxy server).

You could also implement your own httpClient to mock the Twilio API responses so your unit and integration tests can run without the need to make a connection to Twilio. In fact, there’s already an example online showing [how to do exactly that with Node.js and Prism](https://www.twilio.com/docs/openapi/mock-api-generation-with-twilio-openapi-spec).

We can’t wait to see what you build!
