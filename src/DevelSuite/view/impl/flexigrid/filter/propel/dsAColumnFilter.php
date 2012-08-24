<?php
/*
 * This file is part of the DevelSuite
 * Copyright (C) 2012 Georg Henkel <info@develman.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace DevelSuite\view\impl\flexigrid\filter\propel;

/**
 * Abstract superclass for all user defined ColumnFilter
 *
 * @package DevelSuite\view\impl\flexigrid\filter\propel
 * @author  Georg Henkel <info@develman.de>
 * @version 1.0
 */
abstract class dsAColumnFilter implements dsIPropelFilter {
	abstract public function getColumn();
	abstract public function getValue();

	abstract public function getComparisonType() {
		return "=";
	}

	public function buildQuery($queryClass) {
		$column = $this->getColumn();
		if (strpos($column, ".") !== FALSE) {
			list($relation, $searchBy) = explode(".", $column);

			$useQueryString = "use" . $relation . "Query";
			$queryClass->{$useQueryString}()
			->filterBy($searchBy, $this->getValue(), $this->getComparisonType())
			->endUse();
		} else {
			call_user_func_array(array($queryClass, 'filterBy' . $column), array($this->getValue(), $this->getComparisonType()));
		}
	}
}