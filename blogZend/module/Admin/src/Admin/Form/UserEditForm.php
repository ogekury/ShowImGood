<?php
namespace Admin\Form;

use Zend\Form\Form;

class UserEditForm extends Form
{
    public function __construct($name = null,$fields)
    {
    	
    	parent::__construct($name);
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
    	$btn_val = ($name=='user_new')? 'Submit': 'Change';
    	$this->add(array(
    			'name' => 'submit',
    			'attributes' => array(
    					'type'  => 'submit',
    					'value' => $btn_val,
    					'id' => 'submitbutton',
    			),
    	));
    }
}