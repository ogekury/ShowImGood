<?php


class Zend_Controller_Action_Helper_GeneralHelper 
    extends Zend_Controller_Action_Helper_Abstract 
{

    function pre($toprint)
    {
        echo "<pre>";
        print_r($toprint);
        echo "</pre>";
    }
}

?>
