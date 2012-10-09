<?php

class Application_Model_UserMapper
{
    protected $_dbTable;
    
    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }
 
    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Users');
        }
        return $this->_dbTable;
    }
 
    public function save(Application_Model_User $user)
    {
        $data = array(
            'username'   => $user->getUsername(),
            'password' => $user->getPassword(),
        );
 
        if (null === ($id = $user->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }
 
    public function find($id, Application_Model_User $user)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        
        $user->setId($row->id)->setUsername($row->username);
                  
    }
    
    public function authUser(Application_Model_User $user)
    {
//        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
//        $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
//        $authAdapter->setTableName('users')->setCredentialColumn('password')->setIdentityColumn("username");
//        $authAdapter->setIdentity($user->getUsername())->setCredential(md5($user->getPassword()));
//        return $authAdapter->authenticate();
          $select = $this->getDbTable()->select()
                                       ->where('username = ?', (string) $user->getUsername())
                                       ->where('password =?',md5($user->getPassword()));
          $row = $this->getDbTable()->fetchRow($select);
          if($row["id"])
          {
              $user->setId($row["id"]);
          }
          
    }
    
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Guestbook();
            $entry->setId($row->id)
                  ->setUsername($row->username)
                  ->setPassword($row->comment);
            $entries[] = $entry;
        }
        return $entries;
    }
}

