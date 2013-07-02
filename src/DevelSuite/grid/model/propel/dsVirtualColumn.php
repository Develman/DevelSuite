<?php
/*
 * This file is part of the DevelSuite
 * Copyright (C) 2012 Georg Henkel <info@develman.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace DevelSuite\grid\model\propel;

use DevelSuite\grid\model\dsColumn;

/**
 * Represents a virtual column (Propel) to add dynamically to the column model
 *
 * @package DevelSuite\grid\model\propel
 * @author  Georg Henkel <info@develman.de>
 * @version 1.0
 */
class dsVirtualColumn extends dsColumn {
	/**
	 * The entity to join
	 * @var string
	 */
	private $joinEntity = NULL;

	/**
	 * The type of joining (LEFT JOIN, ...)
	 * @var string
	 */
	private $joinType = NULL;
	
	/**
	 * The entity for grouping (class or alias)
	 * @var string 
	 */
	private $groupEntity = NULL;

	/**
	 * Query used in the virtual column
	 * @var string
	 */
	private $query;

	/**
	 * Constructor
	 *
	 * @param string $identifier
	 * 		Identifier of this column
	 * @param string $query
	 * 		Query to use in this column
	 * @param int $type
	 * 		PDO type of this column
	 * @param string $caption
	 * 		Caption of this column (if not set, identifier is used)
	 */
	public function __construct($identifier, $query, $type, $caption = NULL) {
		parent::__construct($identifier, $type, $caption);

		$this->query = $query;
	}

	/**
	 * Join another column (creates a joinWith in the Query)
	 * 
	 * @param string $entity
	 * 		The entity to join
	 * @param string $joinType
	 * 		The type of the join (e.g. LEFT JOIN, ...)
	 */
	public function join($entity, $joinType = "INNER JOIN") {
		$this->joinEntity = $entity;
		$this->joinType = $joinType;
	}
	
	/**
	 * Group by an entity
	 *
	 * @param string $entity
	 * 		The entity to group by (class name or alias)
	 */
	public function groupBy($entity) {
		$this->groupEntity = $entity;
	}

	/**
	 * Return the query of this column
	 */
	public function getQuery() {
		return $this->query;
	}

	/**
	 * Return the joining entity
	 */
	public function getJoin() {
		return $this->joinEntity;
	}

	/**
	 * Return the type of join
	 */
	public function getJoinType() {
		return $this->joinType;
	}
	
	/**
	 * Return the group by entity
	 */
	public function getGroupBy() {
		return $this->groupEntity;
	}
}