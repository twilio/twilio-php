<?php
require(__DIR__.'/../src/Twilio/autoload.php');

use Twilio\Rest\Client;
use Twilio\Rest\Content\V1\ContentModels;

$sid = getenv('TWILIO_ACCOUNT_SID');
$token = getenv('TWILIO_AUTH_TOKEN');
$client = new Client($sid, $token);

echo "Content Management Examples\n";
echo "==========================\n\n";

// Example 1: Create content for management operations
echo "1. Creating sample content for management operations...\n";

$sampleContent = ContentModels::createTwilioText([
    'body' => 'This is a sample message for {{customer_name}} about {{topic}}'
]);

$contentRequest = ContentModels::createContentCreateRequest([
    'friendly_name' => 'Sample Management Content',
    'language' => 'en',
    'variables' => [
        'customer_name' => 'Customer Name',
        'topic' => 'Topic'
    ],
    'types' => ContentModels::createTypes([
        'twilio/text' => $sampleContent
    ])
]);

$createdContent = $client->content->v1->contents->create($contentRequest);
$contentSid = $createdContent->sid;
echo "   Created content with SID: " . $contentSid . "\n\n";

// Example 2: Fetch content details
echo "2. Fetching content details...\n";

$fetchedContent = $client->content->v1->contents($contentSid)->fetch();
echo "   Content SID: " . $fetchedContent->sid . "\n";
echo "   Friendly Name: " . $fetchedContent->friendlyName . "\n";
echo "   Language: " . $fetchedContent->language . "\n";
echo "   Date Created: " . $fetchedContent->dateCreated->format('Y-m-d H:i:s') . "\n";
echo "   Date Updated: " . $fetchedContent->dateUpdated->format('Y-m-d H:i:s') . "\n";
echo "   Variables: " . json_encode($fetchedContent->variables, JSON_PRETTY_PRINT) . "\n";
echo "   Account SID: " . $fetchedContent->accountSid . "\n\n";

// Example 3: List all content with pagination
echo "3. Listing content with pagination...\n";

// Get first page of content (limit to 5 items)
$firstPage = $client->content->v1->contents->read([], 5);
echo "   First page contains " . count($firstPage) . " items:\n";

foreach ($firstPage as $index => $content) {
    echo "   " . ($index + 1) . ". " . $content->friendlyName . " (SID: " . $content->sid . ")\n";
}

// Example 4: Stream through all content efficiently
echo "\n4. Streaming through all content...\n";

$totalCount = 0;
$contentStream = $client->content->v1->contents->stream();

foreach ($contentStream as $content) {
    $totalCount++;
    if ($totalCount <= 3) { // Show first 3 for demo
        echo "   Content #{$totalCount}: " . $content->friendlyName . "\n";
    }
}
echo "   Total content items found: " . $totalCount . "\n\n";

// Example 5: Working with Legacy Content (if available)
echo "5. Working with legacy content...\n";

try {
    $legacyContent = $client->content->v1->legacyContents->read([], 3);
    echo "   Legacy content items found: " . count($legacyContent) . "\n";
    
    foreach ($legacyContent as $index => $legacy) {
        echo "   Legacy #" . ($index + 1) . ": " . $legacy->friendlyName . "\n";
    }
} catch (Exception $e) {
    echo "   No legacy content found or error: " . $e->getMessage() . "\n";
}

// Example 6: Content Approval Management
echo "\n6. Content approval management...\n";

try {
    // Check if content has approval create capability
    $contentContext = $client->content->v1->contents($contentSid);
    
    // Try to create an approval request (this might require specific permissions)
    echo "   Content context created for approval management\n";
    echo "   Content SID for approval: " . $contentSid . "\n";
    
    // Note: Actual approval creation might require additional parameters
    // and proper permissions in your Twilio account
    
} catch (Exception $e) {
    echo "   Approval management error: " . $e->getMessage() . "\n";
}

// Example 7: Error handling and validation
echo "\n7. Error handling examples...\n";

try {
    // Try to fetch non-existent content
    $nonExistentContent = $client->content->v1->contents('CT00000000000000000000000000000000')->fetch();
} catch (Exception $e) {
    echo "   Expected error for non-existent content: " . get_class($e) . "\n";
    echo "   Error message: " . $e->getMessage() . "\n";
}

try {
    // Try to create content with invalid data
    $invalidRequest = ContentModels::createContentCreateRequest([
        'friendly_name' => '', // Empty name should cause validation error
        'language' => 'invalid_lang',
        'types' => null
    ]);
    
    $invalidContent = $client->content->v1->contents->create($invalidRequest);
} catch (Exception $e) {
    echo "   Expected error for invalid content: " . get_class($e) . "\n";
    echo "   Error message: " . $e->getMessage() . "\n";
}

// Example 8: Cleanup - Delete the created content
echo "\n8. Cleanup - Deleting created content...\n";

try {
    $deleteResult = $client->content->v1->contents($contentSid)->delete();
    echo "   Content deletion successful: " . ($deleteResult ? "Yes" : "No") . "\n";
    
    // Verify deletion by trying to fetch
    try {
        $deletedContent = $client->content->v1->contents($contentSid)->fetch();
        echo "   Unexpected: Content still exists after deletion\n";
    } catch (Exception $e) {
        echo "   Confirmed: Content successfully deleted (fetch failed as expected)\n";
    }
    
} catch (Exception $e) {
    echo "   Delete operation failed: " . $e->getMessage() . "\n";
}

echo "\nContent management examples completed!\n";
echo "\nBest Practices:\n";
echo "- Always handle exceptions when working with the Content API\n";
echo "- Use pagination when listing large numbers of content items\n";
echo "- Store content SIDs for future reference and management\n";
echo "- Validate content data before creation\n";
echo "- Use meaningful friendly names for easy identification\n";
echo "- Consider content approval workflows for production use\n";