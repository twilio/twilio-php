<?php


class NextGenListResource extends ListResource {

	public function getPage($page = 0, $size = 50, $filters = array(), $deep_paging_uri = null) {
		if ($deep_paging_uri !== null) {
			$page = $this->client->retrieveData($deep_paging_uri, array(), true);
		} else {
			$page = $this->client->retrieveData($this->uri, array('Page' => $page, 'PageSize' => $size) + $filters);
		}

		$list_name = $page->meta->key;
		if (!isset($list_name) || $list_name === '') {
			throw new Services_Twilio_HttpException("Couldn't find list key in response");
		}

		$page->$list_name = array_map(
			array($this, 'getObjectFromJson'),
			$page->$list_name
		);
		$page->page = $page->meta->page;
		$page->page_size = $page->meta->page_size;
		$page->next_page_uri = $page->meta->next_page_url;

		return new Services_Twilio_Page($page, $list_name, $page->meta->next_page_url);
	}

	public function count() {
		throw new BadMethodCallException("Counting is not supported by this resource");
	}

	public function getIterator($page = 0, $size = 50, $filters = array()) {
		if ($page !== 0) {
			throw new InvalidArgumentException("Absolute paging is not supported for this resource. Start from page 0.");
		}
		return parent::getIterator($page, $size, $filters);
	}
}
