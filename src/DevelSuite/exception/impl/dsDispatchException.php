<?php
/*
 * This file is part of the DevelSuite
 * Copyright (C) 2012 Georg Henkel <info@develman.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace DevelSuite\exception\impl;

use DevelSuite\exception\dsErrorCode;
use DevelSuite\exception\dsErrorCodeException;

/**
 * Signals that an exception during dispatchign of the
 * request has occured.
 *
 * @package DevelSuite\exception
 * @author  Georg Henkel <info@develman.de>
 * @version 1.0
 */
class dsDispatchException extends dsErrorCodeException {
	const ID = "DispatchException";

	const CONTROLLER_INVALID  	= 100;
	const ACTION_NOT_CALLABLE 	= 200;
	const WRONG_ACTIONRESULT  	= 300;
	const ROUTE_NOT_FOUND		= 400;
	const NAMED_ROUTE_NOT_FOUND = 500;

	/**
	 * Constructor
	 *
	 * @param int $errorKey
	 * 		Key of the error
	 * @param array $args
	 * 		Array with arguments to set in the error message
	 * @param Exception $prevException
	 * 		Cause for this exception
	 */
	public function __construct($errorKey, array $args = array(), $prevException = NULL) {
		$path = dirname(__FILE__);

		parent::__construct(new dsErrorCode($path, self::ID, $errorKey), $args, $prevException);
	}
}