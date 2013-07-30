<?php

namespace Admin\Model;

use Zend\Db\TableGateway\TableGateway;

class UserTable
{
	protected $tableGateway;

	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}
        
        public function fetchAll()
        {
            $resultSet = $this->tableGateway->select();
            return $resultSet;
        }
        
        public function getUser($username, $password)
        {
            $rowset = $this->tableGateway->select(array('username' => $username,
                                                        'password' => $password));
            $row = $rowset->current();
            
            if($row){
                return $row;
            }
            
            return false;
            
        }
}
