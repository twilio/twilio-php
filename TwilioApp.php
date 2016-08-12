// this line loads the library require('/path/to/twilio-php/Services/Twilio.php');
<?php
    require('/path/to/twilio-php/Services/Twilio.php');

    $account_sid = '<AccountSid>';
    $auth_token = '<AuthToken>';
    $client = new Services_Twilio($account_sid, $auth_token);

    $client->account->messages->create(
        array(
            'To' => '<ToNumber>',
            'From' => '<FromNumber>',
            'Body' => '<BodyText>',
        )
    );
?>