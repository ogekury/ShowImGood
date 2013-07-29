<?php

namespace Admin\Model;

use Zend\Db\TableGateway\TableGateway;

class AdminTable
{
	protected $tableGateway;

	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}
}
