<?php

class Application_Form_Login extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');
        $this->setOptions(array("class"=>"loginform"));
        // Add an email element
        $this->addElement('text', 'username', array(
            'label'      => 'Username:',
            'required'   => true,
            'filters'    => array('StringTrim'),
            'validators' => array(
            array('validator' => 'StringLength', 'options' => array(4, 20))
            )
        ));

            // Add the comment element
        $this->addElement('password', 'password', array(
            'label'      => 'Password:',
            'required'   => true,
            'validators' => array(
            array('validator' => 'StringLength', 'options' => array(4, 20))
            )
        ));

        // Add the submit button
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Login',
            'class' =>'login_button'
        ));
    }
}


