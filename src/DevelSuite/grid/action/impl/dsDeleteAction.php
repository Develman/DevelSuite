<?php
/*
 * This file is part of the DevelSuite
 * Copyright (C) 2012 Georg Henkel <info@develman.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace DevelSuite\grid\action\impl;

use DevelSuite\grid\action\dsFlexiAction;

/**
 * Calls the delete function.
 *
 * @package DevelSuite\action\impl
 * @author  Georg Henkel <info@develman.de>
 * @version 1.0
 */
class dsDeleteAction extends dsFlexiAction {
	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct("Löschen", "delete");

		$this->setRequestColumns(array("ID"));
	}
}