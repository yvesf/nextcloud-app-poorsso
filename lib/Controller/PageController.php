<?php
namespace OCA\PoorSso\Controller;

use OCP\AppFramework\Controller;
use OCP\AppFramework\Http;
use OCP\AppFramework\Http\DataResponse;
use OCP\IRequest;

class PageController extends Controller {
	private $userId;

	public function __construct($AppName, IRequest $request, $UserId){
		parent::__construct($AppName, $request);
		$this->userId = $UserId;
	}

	/**
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 * @PublicPage
	 */
	public function testlogin(string $allowedUserIds) {
		$userIds = explode(',', $allowedUserIds);
		if ($this->userId != '' && in_array($this->userId, $userIds)) {
			return new DataResponse('OK', Http::STATUS_OK);
		} else {
			return new DataResponse('NO', Http::STATUS_UNAUTHORIZED);
		}
	}
}
