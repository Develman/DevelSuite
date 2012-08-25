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

/**
 * Represents a optgroup element.
 *
 * @package DevelSuite\form\element\impl
 * @author  Georg Henkel <info@develman.de>
 * @version 1.0
 */
class dsOptGroup extends dsACompositeElement {
	/**
	 * Constructor
	 *
	 * @param string $caption
	 * 		Caption for this element
	 */
	public function __construct($caption) {
		parent::__construct($caption, NULL);
		
		$this->allowedElements = array("dsOption");
	}

	/*
	 * (non-PHPdoc)
	 * @see DevelSuite\form\element.dsAElement::buildHTML()
	 */
	public function buildHTML() {
		// generate HTML
		$html = "<optgroup";

		// set CSS class
		if (!empty($this->cssClass)) {
			$html .= " class='" . implode(" ", $this->cssClass) . "'";
		}

		$html .= " label='" . $this->caption . "'>\n";

		// add html of childElements
		foreach ($this->childElements as $child) {
			$html .= $child->buildHTML();
		}
		
		$html .= "</optgroup>\n";
		return $html;
	}
}