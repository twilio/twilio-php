<?php


namespace Twilio\Jwt\TaskRouter;


/**
 * Twilio API Policy constructor
 *
 * @author Justin Witz <justin.witz@twilio.com>
 * @license  http://creativecommons.org/licenses/MIT/ MIT
 */
class Policy {
    private $url;
    private $method;
    private $queryFilter;
    private $postFilter;
    private $allow;

    public function __construct(string $url, string $method, ?array $queryFilter = [], ?array $postFilter = [], bool $allow = true) {
        $this->url = $url;
        $this->method = $method;
        $this->queryFilter = $queryFilter;
        $this->postFilter = $postFilter;
        $this->allow = $allow;
    }

    public function addQueryFilter($queryFilter): void {
        $this->queryFilter[] = $queryFilter;
    }

    public function addPostFilter($postFilter): void {
        $this->postFilter[] = $postFilter;
    }

    public function toArray(): array {
        $policy_array = ['url' => $this->url, 'method' => $this->method, 'allow' => $this->allow];
        if ($this->queryFilter !== null) {
            if (\count($this->queryFilter) > 0) {
                $policy_array['query_filter'] = $this->queryFilter;
            } else {
                $policy_array['query_filter'] = new \stdClass();
            }
        }
        if ($this->postFilter !== null) {
            if (\count($this->postFilter) > 0) {
                $policy_array['post_filter'] = $this->postFilter;
            } else {
                $policy_array['post_filter'] = new \stdClass();
            }
        }
        return $policy_array;
    }
}
