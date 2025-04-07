<?php

/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Flex
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */


namespace Twilio\Rest\FlexApi\V1;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Options;
use Twilio\Values;
use Twilio\Version;


/**
 * @property string|null $accountSid
 * @property string|null $assessmentSid
 * @property string|null $offset
 * @property bool|null $report
 * @property string|null $weight
 * @property string|null $agentId
 * @property string|null $segmentId
 * @property string|null $userName
 * @property string|null $userEmail
 * @property string|null $answerText
 * @property string|null $answerId
 * @property array|null $assessment
 * @property string|null $timestamp
 * @property string|null $url
 */
class AssessmentsInstance extends InstanceResource
{
    /**
     * Initialize the AssessmentsInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $assessmentSid The SID of the assessment to be modified
     */
    public function __construct(Version $version, array $payload, ?string $assessmentSid = null)
    {
        parent::__construct($version);

        // Marshaled Properties
        $this->properties = [
            'accountSid' => Values::array_get($payload, 'account_sid'),
            'assessmentSid' => Values::array_get($payload, 'assessment_sid'),
            'offset' => Values::array_get($payload, 'offset'),
            'report' => Values::array_get($payload, 'report'),
            'weight' => Values::array_get($payload, 'weight'),
            'agentId' => Values::array_get($payload, 'agent_id'),
            'segmentId' => Values::array_get($payload, 'segment_id'),
            'userName' => Values::array_get($payload, 'user_name'),
            'userEmail' => Values::array_get($payload, 'user_email'),
            'answerText' => Values::array_get($payload, 'answer_text'),
            'answerId' => Values::array_get($payload, 'answer_id'),
            'assessment' => Values::array_get($payload, 'assessment'),
            'timestamp' => Values::array_get($payload, 'timestamp'),
            'url' => Values::array_get($payload, 'url'),
        ];

        $this->solution = ['assessmentSid' => $assessmentSid ?: $this->properties['assessmentSid'], ];
    }

    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return AssessmentsContext Context for this AssessmentsInstance
     */
    protected function proxy(): AssessmentsContext
    {
        if (!$this->context) {
            $this->context = new AssessmentsContext(
                $this->version,
                $this->solution['assessmentSid']
            );
        }

        return $this->context;
    }

    /**
     * Update the AssessmentsInstance
     *
     * @param string $offset The offset of the conversation
     * @param string $answerText The answer text selected by user
     * @param string $answerId The id of the answer selected by user
     * @param array|Options $options Optional Arguments
     * @return AssessmentsInstance Updated AssessmentsInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(string $offset, string $answerText, string $answerId, array $options = []): AssessmentsInstance
    {

        return $this->proxy()->update($offset, $answerText, $answerId, $options);
    }

    /**
     * Magic getter to access properties
     *
     * @param string $name Property to access
     * @return mixed The requested property
     * @throws TwilioException For unknown properties
     */
    public function __get(string $name)
    {
        if (\array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        }

        if (\property_exists($this, '_' . $name)) {
            $method = 'get' . \ucfirst($name);
            return $this->$method();
        }

        throw new TwilioException('Unknown property: ' . $name);
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string
    {
        $context = [];
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.FlexApi.V1.AssessmentsInstance ' . \implode(' ', $context) . ']';
    }
}

