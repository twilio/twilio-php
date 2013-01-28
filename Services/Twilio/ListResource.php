<?php

/**
 * Abstraction of a list resource from the Twilio API.
 *
 * @category Services
 * @package	Services_Twilio
 * @author	 Neuman Vong <neuman@twilio.com>
 * @license	http://creativecommons.org/licenses/MIT/ MIT
 * @link		 http://pear.php.net/package/Services_Twilio
 */
abstract class Services_Twilio_ListResource
		extends Services_Twilio_Resource
		implements IteratorAggregate, Countable
{

		public function __construct($client, $uri) {
				$name = $this->getResourceName(true);
				/*
				 * By default trim the 's' from the end of the list name to get the
				 * instance name (ex Accounts -> Account). This behavior can be
				 * overridden by child classes if the rule doesn't work.
				 */
				if (!isset($this->instance_name)) {
						$this->instance_name = "Services_Twilio_Rest_" . rtrim($name, 's');
				}
				parent::__construct($client, $uri);
		}

		/**
		 * Gets a resource from this list.
		 *
		 * @param string $sid The resource SID
		 * @return Services_Twilio_InstanceResource The resource
		 */
		public function get($sid)
		{
				$instance = new $this->instance_name(
						$this->client, $this->uri . "/$sid"
				);
				// XXX check if this is actually a sid in all cases.
				$instance->sid = $sid;
				return $instance;
		}

		/*
		 * Construct an InstanceResource with the specified params.
		 *
		 * @param array params usually a JSON HTTP response from the API
		 * @return Services_Twilio_InstanceResource An instance with properties
		 *			initialized to the values in the params array.
		 */
		public function getObjectFromJson($params, $idParam = "sid")
		{
				if (isset($params->{$idParam})) {
						$uri = $this->uri . "/" . $params->{$idParam};
				} else {
						$uri = $this->uri;
				}
				return new $this->instance_name($this->client, $uri, $params);
		}

		/**
		 * Deletes a resource from this list.
		 *
		 * @param string $sid The resource SID
		 * @return null
		 */
		public function delete($sid, array $params = array())
		{
				$this->client->deleteData($this->uri . '/' . $sid, $params);
		}

		/**
		 * Create a resource on the list and then return its representation as an
		 * InstanceResource.
		 *
		 * @param array $params The parameters with which to create the resource
		 *
		 * @return Services_Twilio_InstanceResource The created resource
		 */
		protected function _create(array $params)
		{
				$params = $this->client->createData($this->uri, $params);
				/* Some methods like verified caller ID don't return sids. */
				if (isset($params->sid)) {
						$resource_uri = $this->uri . '/' . $params->sid;
				} else {
						$resource_uri = $this->uri;
				}
				return new $this->instance_name($this->client, $resource_uri, $params);
		}

		/**
		 * Returns a page of InstanceResources from this list.
		 *
		 * @param int		$page The start page
		 * @param int		$size Number of items per page
		 * @param array	$filters Optional filters
		 * @param string $deep_paging_uri if provided, the $page and $size
		 *			parameters will be ignored and this URI will be requested directly.
		 *
		 * @return Services_Twilio_Page A page
		 */
		public function getPage(
				$page = 0, $size = 50, array $filters = array(),
				$deep_paging_uri = null
		) {
				$list_name = $this->getResourceName();
				if ($deep_paging_uri !== null) {
						$page = $this->client->retrieveData($deep_paging_uri, array(), true);
				} else {
						$page = $this->client->retrieveData($this->uri, array(
								'Page' => $page,
								'PageSize' => $size,
						) + $filters);
				}

				/* create a new PHP object for each json obj in the api response. */
				$page->$list_name = array_map(
						array($this, 'getObjectFromJson'),
						$page->$list_name
				);
				if (isset($page->next_page_uri)) {
						$next_page_uri = $page->next_page_uri;
				} else {
						$next_page_uri = null;
				}
				return new Services_Twilio_Page($page, $list_name, $next_page_uri);
		}

		/**
		 * Get the total number of instance members. Note this will make one small
		 * HTTP request to retrieve the total, every time this method is called.
		 *
		 * If the total is not set or an Exception was thrown, returns 0
		 *
		 * @return integer
		 *
		 */
		public function count() {
				try {
						$page = $this->getPage(0, 1);
						return $page ? (int)$page->total : 0;
				} catch (Exception $e) {
						return 0;
				}
		}


		/**
		 * Returns an iterable list of InstanceResources
		 *
		 * @param int	 $page The start page
		 * @param int	 $size Number of items per page
		 * @param array $size Optional filters
		 *
		 * The filter array can accept full datetimes when StartTime or DateCreated
		 * are used. Inequalities should be within the key portion of the array and
		 * multiple filter parameters can be combined for more specific searches.
		 *
		 * eg.
		 *	 array('DateCreated>' => '2011-07-05 08:00:00', 'DateCreated<' => '2011-08-01')
		 * or
		 *	 array('StartTime<' => '2011-07-05 08:00:00')
		 *
		 * @return Services_Twilio_AutoPagingIterator An iterator
		 */
		public function getIterator(
				$page = 0, $size = 50, array $filters = array()
		) {
				return new Services_Twilio_AutoPagingIterator(
						array($this, 'getPageGenerator'), $page, $size, $filters
				);
		}

		/*
		 * Retrieve a new page of API results, and update iterator parameters.
		 */
		public function getPageGenerator(
				$page, $size, array $filters = array(), $deep_paging_uri = null
		) {
				return $this->getPage($page, $size, $filters, $deep_paging_uri);
		}
}
