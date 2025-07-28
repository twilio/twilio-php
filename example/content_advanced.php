<?php
require(__DIR__.'/../src/Twilio/autoload.php');

use Twilio\Rest\Client;
use Twilio\Rest\Content\V1\ContentModels;

$sid = getenv('TWILIO_ACCOUNT_SID');
$token = getenv('TWILIO_AUTH_TOKEN');
$client = new Client($sid, $token);

echo "Advanced Content API Examples\n";
echo "=============================\n\n";

// Example 1: Create a list picker content
echo "1. Creating list picker content...\n";

$listItems = [
    ContentModels::createListItem([
        'id' => 'option_1',
        'item' => 'Option 1',
        'description' => 'First option description'
    ]),
    ContentModels::createListItem([
        'id' => 'option_2', 
        'item' => 'Option 2',
        'description' => 'Second option description'
    ]),
    ContentModels::createListItem([
        'id' => 'option_3',
        'item' => 'Option 3', 
        'description' => 'Third option description'
    ])
];

$listPickerContent = ContentModels::createTwilioListPicker([
    'body' => 'Please select an option from the list below:',
    'button' => 'Select Option',
    'items' => $listItems
]);

$listContentRequest = ContentModels::createContentCreateRequest([
    'friendly_name' => 'Selection Menu',
    'language' => 'en',
    'types' => ContentModels::createTypes([
        'twilio/list-picker' => $listPickerContent
    ])
]);

$listContent = $client->content->v1->contents->create($listContentRequest);
echo "   List picker content created with SID: " . $listContent->sid . "\n\n";

// Example 2: Create a quick reply content
echo "2. Creating quick reply content...\n";

$quickReplyActions = [
    ContentModels::createQuickReplyAction([
        'type' => 'text',
        'title' => 'Yes',
        'id' => 'yes_response'
    ]),
    ContentModels::createQuickReplyAction([
        'type' => 'text',
        'title' => 'No',
        'id' => 'no_response'
    ]),
    ContentModels::createQuickReplyAction([
        'type' => 'text',
        'title' => 'Maybe',
        'id' => 'maybe_response'
    ])
];

$quickReplyContent = ContentModels::createTwilioQuickReply([
    'body' => 'Are you interested in learning more about our services?',
    'actions' => $quickReplyActions
]);

$quickReplyRequest = ContentModels::createContentCreateRequest([
    'friendly_name' => 'Interest Survey',
    'language' => 'en',
    'types' => ContentModels::createTypes([
        'twilio/quick-reply' => $quickReplyContent
    ])
]);

$qrContent = $client->content->v1->contents->create($quickReplyRequest);
echo "   Quick reply content created with SID: " . $qrContent->sid . "\n\n";

// Example 3: Create a location content
echo "3. Creating location content...\n";

$locationContent = ContentModels::createTwilioLocation([
    'latitude' => '37.7749',
    'longitude' => '-122.4194',
    'label' => 'San Francisco Office',
    'id' => 'sf_office',
    'address' => '123 Market St, San Francisco, CA 94105'
]);

$locationRequest = ContentModels::createContentCreateRequest([
    'friendly_name' => 'Office Location',
    'language' => 'en',
    'types' => ContentModels::createTypes([
        'twilio/location' => $locationContent
    ])
]);

$locContent = $client->content->v1->contents->create($locationRequest);
echo "   Location content created with SID: " . $locContent->sid . "\n\n";

// Example 4: Create a card content (rich media)
echo "4. Creating card content...\n";

$cardContent = ContentModels::createTwilioCard([
    'title' => '{{product_name}}',
    'subtitle' => 'Premium quality at affordable prices',
    'media' => ['https://example.com/product-image.jpg'],
    'actions' => [
        ContentModels::createCallToActionAction([
            'type' => 'URL',
            'title' => 'Buy Now',
            'url' => 'https://example.com/buy/{{product_id}}'
        ]),
        ContentModels::createCallToActionAction([
            'type' => 'URL',
            'title' => 'Learn More',
            'url' => 'https://example.com/product/{{product_id}}'
        ])
    ]
]);

$cardRequest = ContentModels::createContentCreateRequest([
    'friendly_name' => 'Product Card',
    'language' => 'en',
    'variables' => [
        'product_name' => 'Product Name',
        'product_id' => 'Product ID'
    ],
    'types' => ContentModels::createTypes([
        'twilio/card' => $cardContent
    ])
]);

$cardContentInstance = $client->content->v1->contents->create($cardRequest);
echo "   Card content created with SID: " . $cardContentInstance->sid . "\n\n";

// Example 5: Using Content API V2 to list content with filtering
echo "5. Using Content API V2 to list content...\n";

// List all content using V2 API
$v2ContentList = $client->content->v2->contents->read();
echo "   Total content items found (V2): " . count($v2ContentList) . "\n";

// List content with filtering (if supported)
try {
    $filteredContent = $client->content->v2->contents->read([
        // Add filter options here based on V2 API capabilities
    ]);
    echo "   Filtered content items: " . count($filteredContent) . "\n";
} catch (Exception $e) {
    echo "   Filtering not available or error occurred: " . $e->getMessage() . "\n";
}

// Example 6: Content and Approvals
echo "\n6. Working with content approvals...\n";

try {
    // List content and approvals using V1
    $contentAndApprovals = $client->content->v1->contentAndApprovals->read();
    echo "   Content with approval status: " . count($contentAndApprovals) . "\n";
    
    // Display first few items with approval status
    $displayCount = min(3, count($contentAndApprovals));
    for ($i = 0; $i < $displayCount; $i++) {
        $item = $contentAndApprovals[$i];
        echo "   - " . $item->friendlyName . " (SID: " . $item->sid . ")\n";
    }
} catch (Exception $e) {
    echo "   Content approvals error: " . $e->getMessage() . "\n";
}

echo "\nAdvanced Content API examples completed!\n";
echo "\nNote: Remember to set your TWILIO_ACCOUNT_SID and TWILIO_AUTH_TOKEN environment variables.\n";