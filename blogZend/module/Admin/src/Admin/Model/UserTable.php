<?php

namespace Admin\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;

class UserTable
{
	protected $tableGateway;

        protected $salt = '89a87fb&';
        
        protected $db;
        
	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
                $this->db = new Sql($tableGateway->getAdapter());
	}
        
        public function fetchAll()
        {
            $resultSet = $this->tableGateway->select();
            (array)$resultSet;
            return $resultSet;
        }
        
        public function getUser($username, $password)
        {
            $rowset = $this->tableGateway->select(array('username' => $username,
                                                        'password' => $this->_getSecuredPassword($password)));
            $row = $rowset->current();
            
            if($row){
                $row->modules = $this->getUserModules($row->id);
                return $row;
            }
            
            return false;
            
        }
        
        protected function getUserModules($id)
        {
            $sql = $this->db->select()
                            ->from('user_module')
                            ->join('module', 'user_module.module = module.id')
                            ->where(array('user'=>$id))
                            ->order(array("module.order"=>'asc'));
            
            $state = $this->db->prepareStatementForSqlObject($sql);
            $result = $state->execute();

            
            //check count
            if(count($result->count())>0){
                $user_modules =array();
                foreach($result as $res){
                	$user_modules[] = $res;
                }
                return json_encode($user_modules);
            }
            
            return false;
            
        }
        
        protected function _getSecuredPassword($password)
        {
            $halfpass = substr($password, 0,ceil(strlen($password)/2));
            
            return md5($password.$this->salt.$halfpass);
        }
        
        
}
