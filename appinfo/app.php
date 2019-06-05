<?php
use \OCP\AppFramework\App;

class Application extends App {
    public function __construct(array $urlParams=array()){
        parent::__construct('poorsso', $urlParams);
	OC_Hook::connect('OC', 'initSession', $this, 'initSession');
    }

    public function initSession($data) {
	    # init session cookie path on whole site
	    ini_set('session.cookie_path', '/');
    }
}

$app = new Application();

