# Twilio Content API Guide

The Twilio Content API allows you to create, manage, and send rich content templates for messaging. This guide provides comprehensive examples and best practices for using the Content API with the Twilio PHP SDK.

## Table of Contents

- [Getting Started](#getting-started)
- [Content Types](#content-types)
- [API Versions](#api-versions)
- [Basic Operations](#basic-operations)
- [Advanced Features](#advanced-features)
- [Best Practices](#best-practices)
- [Error Handling](#error-handling)

## Getting Started

First, ensure you have the Twilio PHP SDK installed and your credentials configured:

```php
<?php
require_once './vendor/autoload.php';
use Twilio\Rest\Client;
use Twilio\Rest\Content\V1\ContentModels;

$client = new Client('ACXXXXXX', 'your_auth_token');
```

## Content Types

The Content API supports various content types for different messaging scenarios:

### 1. Text Content

Simple text messages with variable placeholders.

```php
$textContent = ContentModels::createTwilioText([
    'body' => 'Hello {{name}}, your order {{order_id}} is ready!'
]);

$contentRequest = ContentModels::createContentCreateRequest([
    'friendly_name' => 'Order Ready Notification',
    'language' => 'en',
    'variables' => [
        'name' => 'Customer Name',
        'order_id' => 'Order ID'
    ],
    'types' => ContentModels::createTypes([
        'twilio/text' => $textContent
    ])
]);

$content = $client->content->v1->contents->create($contentRequest);
```

### 2. Media Content

Text messages with media attachments (images, videos, documents).

```php
$mediaContent = ContentModels::createTwilioMedia([
    'body' => 'Check out our new {{product_type}}!',
    'media' => [
        'https://example.com/product-image.jpg',
        'https://example.com/product-video.mp4'
    ]
]);

$mediaRequest = ContentModels::createContentCreateRequest([
    'friendly_name' => 'Product Showcase',
    'language' => 'en',
    'variables' => [
        'product_type' => 'Product Category'
    ],
    'types' => ContentModels::createTypes([
        'twilio/media' => $mediaContent
    ])
]);

$mediaContent = $client->content->v1->contents->create($mediaRequest);
```

### 3. Interactive Content

#### List Picker

Allow users to select from a list of options.

```php
$listItems = [
    ContentModels::createListItem([
        'id' => 'size_small',
        'item' => 'Small',
        'description' => 'Size: Small'
    ]),
    ContentModels::createListItem([
        'id' => 'size_medium',
        'item' => 'Medium',
        'description' => 'Size: Medium'
    ]),
    ContentModels::createListItem([
        'id' => 'size_large',
        'item' => 'Large',
        'description' => 'Size: Large'
    ])
];

$listPicker = ContentModels::createTwilioListPicker([
    'body' => 'Please select your preferred size:',
    'button' => 'Choose Size',
    'items' => $listItems
]);
```

#### Call-to-Action Buttons

Provide clickable buttons for different actions.

```php
$callToActionContent = ContentModels::createTwilioCallToAction([
    'body' => 'Your appointment is confirmed. What would you like to do?',
    'actions' => [
        ContentModels::createCallToActionAction([
            'type' => 'URL',
            'title' => 'View Details',
            'url' => 'https://example.com/appointment/{{appointment_id}}'
        ]),
        ContentModels::createCallToActionAction([
            'type' => 'PHONE_NUMBER',
            'title' => 'Call Support',
            'phone' => '+1234567890'
        ]),
        ContentModels::createCallToActionAction([
            'type' => 'URL',
            'title' => 'Reschedule',
            'url' => 'https://example.com/reschedule/{{appointment_id}}'
        ])
    ]
]);
```

#### Quick Reply

Fast response options for users.

```php
$quickReplyActions = [
    ContentModels::createQuickReplyAction([
        'type' => 'text',
        'title' => 'Yes, confirm',
        'id' => 'confirm_yes'
    ]),
    ContentModels::createQuickReplyAction([
        'type' => 'text',
        'title' => 'No, cancel',
        'id' => 'confirm_no'
    ]),
    ContentModels::createQuickReplyAction([
        'type' => 'text',
        'title' => 'Ask me later',
        'id' => 'confirm_later'
    ])
];

$quickReply = ContentModels::createTwilioQuickReply([
    'body' => 'Would you like to confirm your booking for {{date}} at {{time}}?',
    'actions' => $quickReplyActions
]);
```

### 4. Location Content

Share location information.

```php
$locationContent = ContentModels::createTwilioLocation([
    'latitude' => '40.7128',
    'longitude' => '-74.0060',
    'label' => 'New York Office',
    'id' => 'ny_office',
    'address' => '123 Broadway, New York, NY 10001'
]);

$locationRequest = ContentModels::createContentCreateRequest([
    'friendly_name' => 'Office Location',
    'language' => 'en',
    'types' => ContentModels::createTypes([
        'twilio/location' => $locationContent
    ])
]);
```

### 5. Rich Cards

Rich media cards with images and actions.

```php
$cardContent = ContentModels::createTwilioCard([
    'title' => '{{event_name}}',
    'subtitle' => 'Join us for an amazing experience!',
    'media' => ['https://example.com/event-image.jpg'],
    'actions' => [
        ContentModels::createCallToActionAction([
            'type' => 'URL',
            'title' => 'Register Now',
            'url' => 'https://example.com/register/{{event_id}}'
        ]),
        ContentModels::createCallToActionAction([
            'type' => 'URL',
            'title' => 'Learn More',
            'url' => 'https://example.com/event/{{event_id}}'
        ])
    ]
]);
```

## API Versions

The Content API has two versions with different capabilities:

### V1 API
- Full CRUD operations (Create, Read, Update, Delete)
- Content approval management
- Legacy content support
- Primary API for content creation

```php
// Create content
$content = $client->content->v1->contents->create($contentRequest);

// Read content
$contentList = $client->content->v1->contents->read();

// Fetch specific content
$specificContent = $client->content->v1->contents($contentSid)->fetch();

// Delete content
$deleted = $client->content->v1->contents($contentSid)->delete();

// Content and approvals
$contentWithApprovals = $client->content->v1->contentAndApprovals->read();
```

### V2 API
- Enhanced read operations
- Improved filtering capabilities
- Optimized for content discovery

```php
// Read content with V2
$v2Contents = $client->content->v2->contents->read();

// Content and approvals with V2
$v2ContentAndApprovals = $client->content->v2->contentAndApprovals->read();
```

## Basic Operations

### Creating Content

```php
// Define content type
$textContent = ContentModels::createTwilioText([
    'body' => 'Welcome {{name}} to {{service_name}}!'
]);

// Create content request
$request = ContentModels::createContentCreateRequest([
    'friendly_name' => 'Welcome Message',
    'language' => 'en',
    'variables' => [
        'name' => 'User Name',
        'service_name' => 'Service Name'
    ],
    'types' => ContentModels::createTypes([
        'twilio/text' => $textContent
    ])
]);

// Create the content
$content = $client->content->v1->contents->create($request);
echo "Created content with SID: " . $content->sid;
```

### Listing Content

```php
// List all content
$allContent = $client->content->v1->contents->read();

// List with pagination
$limitedContent = $client->content->v1->contents->read([], 10);

// Stream through content efficiently
$contentStream = $client->content->v1->contents->stream();
foreach ($contentStream as $content) {
    echo "Content: " . $content->friendlyName . "\n";
}
```

### Retrieving Content

```php
// Fetch specific content by SID
$content = $client->content->v1->contents('CTXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX')->fetch();

echo "Name: " . $content->friendlyName . "\n";
echo "Language: " . $content->language . "\n";
echo "Variables: " . json_encode($content->variables) . "\n";
echo "Created: " . $content->dateCreated->format('Y-m-d H:i:s') . "\n";
```

### Deleting Content

```php
// Delete content
$deleted = $client->content->v1->contents('CTXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX')->delete();

if ($deleted) {
    echo "Content deleted successfully\n";
} else {
    echo "Failed to delete content\n";
}
```

## Advanced Features

### Content Approval Management

```php
// Get content with approval information
$contentAndApprovals = $client->content->v1->contentAndApprovals->read();

foreach ($contentAndApprovals as $item) {
    echo "Content: " . $item->friendlyName . "\n";
    echo "Status: " . $item->status . "\n";
    // Additional approval-related properties
}
```

### Working with Variables

```php
// Content with multiple variables
$content = ContentModels::createTwilioText([
    'body' => 'Hi {{first_name}} {{last_name}}, your {{item_type}} order #{{order_number}} worth ${{total_amount}} has been {{status}}.'
]);

$request = ContentModels::createContentCreateRequest([
    'friendly_name' => 'Order Status Update',
    'language' => 'en',
    'variables' => [
        'first_name' => 'First Name',
        'last_name' => 'Last Name',
        'item_type' => 'Item Type',
        'order_number' => 'Order Number',
        'total_amount' => 'Total Amount',
        'status' => 'Order Status'
    ],
    'types' => ContentModels::createTypes([
        'twilio/text' => $content
    ])
]);
```

### Multi-language Support

```php
// English version
$englishContent = ContentModels::createContentCreateRequest([
    'friendly_name' => 'Welcome Message - English',
    'language' => 'en',
    'variables' => ['name' => 'Name'],
    'types' => ContentModels::createTypes([
        'twilio/text' => ContentModels::createTwilioText([
            'body' => 'Welcome {{name}} to our service!'
        ])
    ])
]);

// Spanish version
$spanishContent = ContentModels::createContentCreateRequest([
    'friendly_name' => 'Welcome Message - Spanish',
    'language' => 'es',
    'variables' => ['name' => 'Name'],
    'types' => ContentModels::createTypes([
        'twilio/text' => ContentModels::createTwilioText([
            'body' => '¡Bienvenido {{name}} a nuestro servicio!'
        ])
    ])
]);

$englishContentInstance = $client->content->v1->contents->create($englishContent);
$spanishContentInstance = $client->content->v1->contents->create($spanishContent);
```

## Best Practices

### 1. Content Organization

- Use descriptive friendly names for easy identification
- Organize content by purpose (notifications, marketing, support)
- Include language codes in content names for multi-language support

```php
// Good naming conventions
'friendly_name' => 'Order_Confirmation_SMS_EN'
'friendly_name' => 'Welcome_Message_WhatsApp_ES'
'friendly_name' => 'Support_CTA_Card_FR'
```

### 2. Variable Management

- Use clear, descriptive variable names
- Document expected variable formats
- Validate variables before content creation

```php
$variables = [
    'customer_first_name' => 'Customer First Name',
    'order_date' => 'Order Date (YYYY-MM-DD)',
    'total_amount' => 'Total Amount (with currency)',
    'tracking_number' => 'Tracking Number'
];
```

### 3. Error Handling

Always implement proper error handling when working with the Content API:

```php
try {
    $content = $client->content->v1->contents->create($contentRequest);
    echo "Content created successfully: " . $content->sid;
} catch (Twilio\Exceptions\TwilioException $e) {
    echo "Error creating content: " . $e->getMessage();
    echo "Error code: " . $e->getCode();
} catch (Exception $e) {
    echo "Unexpected error: " . $e->getMessage();
}
```

### 4. Content Validation

- Test content with sample variables
- Validate media URLs are accessible
- Check character limits for different channels

### 5. Performance Optimization

- Use streaming for large content lists
- Implement pagination for better user experience
- Cache frequently accessed content locally

```php
// Efficient content streaming
$contentStream = $client->content->v1->contents->stream([], 100, 20);
foreach ($contentStream as $content) {
    // Process each content item
    processContent($content);
}
```

## Error Handling

### Common Error Scenarios

1. **Authentication Errors**
```php
try {
    $content = $client->content->v1->contents->create($request);
} catch (Twilio\Exceptions\RestException $e) {
    if ($e->getStatusCode() === 401) {
        echo "Authentication failed. Check your credentials.";
    }
}
```

2. **Validation Errors**
```php
try {
    $content = $client->content->v1->contents->create($request);
} catch (Twilio\Exceptions\RestException $e) {
    if ($e->getStatusCode() === 400) {
        echo "Validation error: " . $e->getMessage();
        // Check required fields, variable formats, etc.
    }
}
```

3. **Rate Limiting**
```php
try {
    $content = $client->content->v1->contents->create($request);
} catch (Twilio\Exceptions\RestException $e) {
    if ($e->getStatusCode() === 429) {
        echo "Rate limit exceeded. Please retry later.";
        // Implement exponential backoff
    }
}
```

### Complete Error Handling Example

```php
function createContentSafely($client, $contentRequest) {
    try {
        $content = $client->content->v1->contents->create($contentRequest);
        return [
            'success' => true,
            'content' => $content,
            'message' => 'Content created successfully'
        ];
    } catch (Twilio\Exceptions\RestException $e) {
        $errorCode = $e->getStatusCode();
        $errorMessage = $e->getMessage();
        
        switch ($errorCode) {
            case 400:
                $message = "Validation error: {$errorMessage}";
                break;
            case 401:
                $message = "Authentication failed. Check credentials.";
                break;
            case 403:
                $message = "Insufficient permissions.";
                break;
            case 429:
                $message = "Rate limit exceeded. Retry later.";
                break;
            default:
                $message = "API error ({$errorCode}): {$errorMessage}";
        }
        
        return [
            'success' => false,
            'error_code' => $errorCode,
            'message' => $message
        ];
    } catch (Exception $e) {
        return [
            'success' => false,
            'error_code' => null,
            'message' => 'Unexpected error: ' . $e->getMessage()
        ];
    }
}

// Usage
$result = createContentSafely($client, $contentRequest);
if ($result['success']) {
    echo "Content SID: " . $result['content']->sid;
} else {
    echo "Error: " . $result['message'];
}
```

## Examples

For complete working examples, see:

- [Basic Content API Examples](../example/content.php)
- [Advanced Content Features](../example/content_advanced.php)
- [Content Management Operations](../example/content_management.php)

## Additional Resources

- [Twilio Content API Documentation](https://www.twilio.com/docs/content)
- [Twilio PHP SDK Documentation](https://www.twilio.com/docs/libraries/php)
- [Content API REST Reference](https://www.twilio.com/docs/content/api)