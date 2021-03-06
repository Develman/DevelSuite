<?php
/*
 * This file is part of the DevelSuite
 * Copyright (C) 2012 Georg Henkel <info@develman.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace DevelSuite\form\element\impl;

use DevelSuite\form\element\dsAElement;

/**
 * Represents a checkbox element.
 *
 * @package DevelSuite\form\element\impl
 * @author  Georg Henkel <info@develman.de>
 * @version 1.0
 */
class dsCheckbox extends dsAElement {
	private $value;
	private $group;
	private $checked = FALSE;

	/**
	 * Class constructor
	 *
	 * @param string $caption
	 * 			Caption of the element
	 * @param string $name
	 * 			Name of the element
	 * @param string $value
	 * 			Content of the element
	 * @param bool $mandatory
	 * 			TRUE if element should be mandatory [optional]
	 * @param bool $readOnly
	 * 			TRUE if element should be readOnly [optional]
	 */
	public function __construct($caption, $name, $value = NULL) {
		parent::__construct($caption, $name);

		if (isset($value)) {
			$this->value = $value;
		} else {
			$this->value = $name;
		}
	}

	/**
	 * Set the name of the checkbox.
	 * In case of a checkbox group this is set
	 * by the surrounding group element.
	 *
	 * @param string $name
	 * 			The name of the checkbox
	 */
	public function setGroup(dsCheckboxGroup $group) {
		$this->group = $group;
	}

	/**
	 * Set the checkbox checked
	 *
	 * @param bool $checked
	 * 			TRUE if checkbox should be checked (must be bool)
	 */
	public function setChecked($checked = TRUE) {
		$this->checked = $checked;
	}

	/* (non-PHPdoc)
	 * @see DevelSuite\form\element.dsAElement::refillValues()
	 */
	public function refillValues() {
		$value = $this->getValue();
		if (isset($value)) {
			$this->setChecked();
		}
	}

	/* (non-PHPdoc)
	 * @see DevelSuite\form\element.dsAElement::getHTML()
	 */
	public function getHTML() {
		// generate HTML
		$html = "<input type='checkbox'";

		// set CSS class
		if (!empty($this->cssClass)) {
			$html .= " class='" . implode(" ", $this->cssClass) . "'";
		}
		$html .= " id='" . $this->name . "'";

		// set name of group
		if (isset($this->group)) {
			$html .= " name='" . $this->group->getName() . "[]'";
		} else {
			$html .= " name='" . $this->name . "'";
		}

		// set value
		if (isset($this->value)) {
			$html .= " value='" . $this->value . "'";
		}

		// set checked
		if ($this->checked) {
			$html .= " checked='checked'";
		}

		// set checked
		if ($this->disabled) {
			$html .= " disabled='disabled'";
		}
		$html .= "/>\n";

		return "<div class='dsform-type-check'>" . $this->addLabel($html) . "</div>\n";
	}
}