<?php
/*
 * This file is part of the DevelSuite
 * Copyright (C) 2012 Georg Henkel <info@develman.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace DevelSuite\view\impl;

use Monolog\Handler\StreamHandler;

use Monolog\Logger;

use DevelSuite\dsApp;
use DevelSuite\view\dsAView;

/**
 * View for rendering content as JSON.
 *
 * @package DevelSuite\view\impl
 * @author  Georg Henkel <info@develman.de>
 * @version 1.0
 */
class dsJsonView extends dsAView {
	private $log;
	
	/**
	 * Constructor
	 *
	 * @param dsPageController $pageCtrl
	 * 		The PageController
	 */
	public function __construct() {
		dsApp::getResponse()->setContentType("application/json");
		
		$this->log = new Logger("JsonView");
		$this->log->pushHandler(new StreamHandler(LOG_PATH . DS . "server.log"));
	}

	/**
	 * (non-PHPdoc)
	 * @see DevelSuite\view.dsAView::render()
	 */
	public function render() {
		$encode = json_encode($this->data);
		
		$this->log->debug("Sending encoded string: " . $encode);
		
		echo $encode;
	}
}