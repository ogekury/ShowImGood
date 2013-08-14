<?php

namespace Admin\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;

class ContentTable
{
	protected $tableGateway;

        protected $db;
        
		public function __construct(TableGateway $tableGateway)
		{
			$this->tableGateway = $tableGateway;
	        $this->db = new Sql($tableGateway->getAdapter());
		}
        
        public function fetchAll()
        {
        	$sql = "SELECT content.id,content.title,DATE_FORMAT(date,'%d-%m-%Y') as date,user.username as author
        			FROM content
            		JOIN user ON user.id = content.author";
        	
        	$adp = $this->db->getAdapter();
            
        	$resultSet = $adp->query($sql,\Zend\Db\Adapter\Adapter::QUERY_MODE_EXECUTE);
        	
        	return $resultSet;
        }
        
        public function getContent($id)
        {
            $rowset = $this->tableGateway->select(array('id' => $id));
            return $rowset->current();
        }

        
        public function saveContent(Content $content)
        {
        	$data = array(
        			'title' => $content->title,
        			'content'  => $content->content,
        			'date'		=>$content->email,
        			'author'	=>$content->author
        		   	);
        	
        	$id = (int)$content->id;
        	if ($id == 0) {
        		$this->tableGateway->insert($data);
        	} 
        	else {
        		if ($this->getContent($id)) {
        			$this->tableGateway->update($data, array('id' => $id));
        		} 
        		else {
        			throw new \Exception('Form id does not exist');
        		}
        	}
        }
        
        public function deleteContent($id)
        {
        	$this->tableGateway->delete(array('id' => $id));
        }
        
        
        
        
}

