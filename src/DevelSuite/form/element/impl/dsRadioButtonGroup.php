<?php
/*
 * This file is part of the DevelSuite
 * Copyright (C) 2012 Georg Henkel <info@develman.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace DevelSuite\form\element\impl;

use DevelSuite\form\element\dsACompositeElement;
use DevelSuite\form\element\dsAElement;

/**
 * Represents a radio button group element.
 *
 * @package DevelSuite\form\element\impl
 * @author  Georg Henkel <info@develman.de>
 * @version 1.0
 */
class dsRadioButtonGroup extends dsACompositeElement {
	/**
	 * Set this element readOnly
	 * @var bool
	 */
	private $readOnly;
	
	/**
	 * Count of all radio buttons checked state
	 * @var int
	 */
	private $checkCount = 0;

	/**
	 * Constructor
	 *
	 * @param string $caption
	 * 		Caption for this element
	 * @param string $name
	 * 		Name for this element
	 */
	public function __construct($caption, $name) {
		parent::__construct($caption, $name);

		$this->allowedElements = array("dsRadioButton");
	}

	/*
	 * (non-PHPdoc)
	 * @see DevelSuite\form\element.dsACompositeElement::addChild()
	 */
	public function addChild(dsAElement $child) {
		if ($child instanceof dsRadioButton) {
			if ($child->isChecked() && $this->checkCount < 1) {
				$this->checkCount++;
			} else {
				# FIXME: add logging!
				$child->setChecked(FALSE);
			}

			$child->setGroup($this);

			// set readonly if group is set to readonly
			if ($this->readOnly) {
				$child->setReadOnly($this->readOnly);
			}

			parent::addChild($child);
		}
	}

	/*
	 * (non-PHPdoc)
	 * @see DevelSuite\form\element.dsAElement::buildHTML()
	 */
	public function buildHTML() {
		// generate HTML
		$html = "<div class='dsform-radioGrp'";

		// set CSS class
		if (!empty($this->cssClasses)) {
			$html .= " " . implode(" ", $this->cssClasses);
		}

		$html .= ">\n";
		$html .= "<p>" . $this->caption;

		// set mandatory
		if ($this->mandatory) {
			$html .= "<em>*</em>";
		}

		$html .= "</p>\n";

		// add html of childElements
		foreach ($this->childElements as $child) {
			$html .= $child->buildHTML();
		}

		$html .= "</div>\n";
		return $html;
	}
}