<?php

namespace Twilio\TwiML\Voice;

use Twilio\TwiML\TwiML;

class Comment extends TwiML {
    /**
     * Comment constructor.
     *
     * @param string $message Message to comment
     */
    public function __construct($message) {

        // "--" is not allowed in xml comments
        while (strpos($message, "--") !== false) {
            $message = str_replace("--", "-", $message);
        }

        parent::__construct('Comment', $message);
    }
}
