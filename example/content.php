<?php
require(__DIR__.'/../src/Twilio/autoload.php');

use Twilio\Rest\Client;
use Twilio\Rest\Content\V1\ContentModels;

$sid = getenv('TWILIO_ACCOUNT_SID');
$token = getenv('TWILIO_AUTH_TOKEN');
$client = new Client($sid, $token);

// Example 1: Create a simple text content
echo "Creating text content...\n";

$textContent = ContentModels::createTwilioText([
    'body' => 'Hello {{name}}, welcome to our service!'
]);

$contentRequest = ContentModels::createContentCreateRequest([
    'friendly_name' => 'Welcome Message',
    'language' => 'en',
    'variables' => [
        'name' => 'Customer Name'
    ],
    'types' => ContentModels::createTypes([
        'twilio/text' => $textContent
    ])
]);

$content = $client->content->v1->contents->create($contentRequest);
echo "Text content created with SID: " . $content->sid . "\n";

// Example 2: Create a media content with image
echo "\nCreating media content...\n";

$mediaContent = ContentModels::createTwilioMedia([
    'body' => 'Check out our latest product: {{product_name}}',
    'media' => ['https://example.com/product-image.jpg']
]);

$mediaContentRequest = ContentModels::createContentCreateRequest([
    'friendly_name' => 'Product Announcement',
    'language' => 'en',
    'variables' => [
        'product_name' => 'Product Name'
    ],
    'types' => ContentModels::createTypes([
        'twilio/media' => $mediaContent
    ])
]);

$mediaContentInstance = $client->content->v1->contents->create($mediaContentRequest);
echo "Media content created with SID: " . $mediaContentInstance->sid . "\n";

// Example 3: Create a call-to-action content
echo "\nCreating call-to-action content...\n";

$callToActionContent = ContentModels::createTwilioCallToAction([
    'body' => 'Ready to get started? Choose an option below:',
    'actions' => [
        ContentModels::createCallToActionAction([
            'type' => 'URL',
            'title' => 'Visit Website',
            'url' => 'https://example.com'
        ]),
        ContentModels::createCallToActionAction([
            'type' => 'PHONE_NUMBER',
            'title' => 'Call Support',
            'phone' => '+1234567890'
        ])
    ]
]);

$ctaContentRequest = ContentModels::createContentCreateRequest([
    'friendly_name' => 'Get Started CTA',
    'language' => 'en',
    'types' => ContentModels::createTypes([
        'twilio/call-to-action' => $callToActionContent
    ])
]);

$ctaContent = $client->content->v1->contents->create($ctaContentRequest);
echo "Call-to-action content created with SID: " . $ctaContent->sid . "\n";

// Example 4: List all content
echo "\nListing all content...\n";

$contentList = $client->content->v1->contents->read();
foreach ($contentList as $content) {
    echo "SID: " . $content->sid . " | Name: " . $content->friendlyName . " | Language: " . $content->language . "\n";
}

// Example 5: Retrieve a specific content
if (!empty($contentList)) {
    $firstContent = $contentList[0];
    echo "\nRetrieving content details for SID: " . $firstContent->sid . "\n";
    
    $retrievedContent = $client->content->v1->contents($firstContent->sid)->fetch();
    echo "Content Name: " . $retrievedContent->friendlyName . "\n";
    echo "Content Language: " . $retrievedContent->language . "\n";
    echo "Content Variables: " . json_encode($retrievedContent->variables) . "\n";
    echo "Content Types: " . json_encode($retrievedContent->types) . "\n";
}

// Example 6: Delete a content (uncomment to use)
// echo "\nDeleting content...\n";
// $deleted = $client->content->v1->contents($content->sid)->delete();
// echo "Content deleted: " . ($deleted ? "Yes" : "No") . "\n";

echo "\nContent API examples completed!\n";