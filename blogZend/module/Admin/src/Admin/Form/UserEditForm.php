<?php
namespace Admin\Form;

use Zend\Form\Form;

class UserEditForm extends Form
{
    public function __construct($name = null,$fields)
    {
    	parent::__construct('edit');
    	$this->setAttribute('method', 'post');
        
    	
    	
    	foreach($fields as $field_name =>$field){
	        switch($field_name){
	        	case 'id':
		        	$this->add(array(
			            'name' => $field_name,
			            'value'  =>$field,	
			            'attributes' => array(
			                'type'  => "hidden",
			            ),
			            'options' => array(
			                'id'	=>"id_".$field_name,
			            ),
			        ));
	        	break;
	        	case 'password':
	        		$this->add(array(
	        				'name' => $field_name,
	        				'value'  =>$field,
	        				'attributes' => array(
	        						'type'  => "password",
	        				),
	        				'options' => array(
	        						'id'	=>"id_".$field_name,
	        						'value'  =>$field
	        				),
	        		));
	        	break;
	        	default:
	        		$this->add(array(
	        				'name' => $field_name,
	        				'value'  =>$field,
	        				'attributes' => array(
	        						'type'  => "text",
	        				),
	        				'options' => array(
	        						'id'	=>"id_".$field_name,
	        						'value'  =>$field
	        				),
	        		));
	        	break;
	        }
    	}
    	$this->add(array(
    			'name' => 'submit',
    			'attributes' => array(
    					'type'  => 'submit',
    					'value' => 'Change',
    					'id' => 'submitbutton',
    			),
    	));
    }
}