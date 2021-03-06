<?php
/*
 * This file is part of the DevelSuite
 * Copyright (C) 2012 Georg Henkel <info@develman.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace DevelSuite\form\element;

use DevelSuite\core\i18n\dsResourceBundle;

/**
 * Abstract superclass for all button elements.
 *
 * @package DevelSuite\form\element
 * @author  Georg Henkel <info@develman.de>
 * @version 1.0
 */
abstract class dsAButtonElement {
	protected $name;
	protected $value;
	protected $cssClass = array();

	/**
	 * Class constructor
	 *
	 * @param string $name
	 * 			Name of the button
	 * @param int $buttonKey
	 * 			ButtonKey, which sets the value of this button [not used if value is set]
	 * @param string $value
	 * 			Value of this button [optional]
	 */
	public function __construct($name, $buttonKey = NULL, $value = NULL) {
		$this->name = $name;

		if (!isset($buttonKey) && !isset($value)) {
			# FIXME
			# throw exception
		}

		if (isset($value)) {
			$tmpVal = $this->getButtonValue($value);
			if ($tmpVal !== NULL) {
				$this->value = $tmpVal;
			} else {
				$this->value = $value;
			}
		} else {
			$this->value = $this->getButtonValue($buttonKey);
		}
	}

	/**
	 * @return name
	 * 			Name of the button
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Returns the i18n value for this button
	 *
	 * @param int $buttonKey
	 * 			Key for the button text (e.g. OK)
	 * @return The i18n text for the button
	 */
	protected function getButtonValue($buttonKey) {
		$iniArr = dsResourceBundle::getBundle(dirname(__FILE__) . DS . "buttonText");

		$result = NULL;
		if(array_key_exists($buttonKey, $iniArr)) {
			$result =  $iniArr[$buttonKey];
		}

		return $result;
	}
	
	/**
	 * Set a CSS class for this button.
	 *
	 * @param string $class
	 * 			CSS class name for this button
	 */
	public function addCssClass($class) {
		$this->cssClass[] = $class;
		return $this;
	}

	/**
	 * Generates the HTML of the button element
	 *
	 * @return HTML of the button element
	 */
	abstract public function getHTML();
}