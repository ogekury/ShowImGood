<?php

class AjaxController extends BaseController {

    protected $action;
    
    public function __construct()
    {
        if(!Session::get("user")){
            exit();
        }
    }
    
    public function dispatcher()
    {
        if (Request::ajax())
        {
               $input = Input::all();
               switch(Request::getMethod()){
                   case 'DELETE':
                       $this->action = "delete";
                       return $this->deletes($input);
                   break;
                   case 'POST':
//                       return $this->posts($input);
                   break;
                   case 'GET':
//                       return $this->gets($input);
                   break;
               }
        }
    }
    
    protected function deletes($input)
    {
        $response = array("response"=>false);
        if(array_key_exists("req", $input)){
            //simple deleting trough the model
            if($input["req"] == "simple"){
                $cls = ucfirst($input["model"]);
                $delete_row = $cls::find((int)$input["id"]);
                if($delete_row){
                    $delete_row->delete();
                    $response = array("response"=>true,
                                      "action"=>$this->action,
                                       "id" => $input["id"]);
                }
            }
        }
        return $response;
    }
    
    protected function posts($input)
    {
        
    }

    protected function gets($input)
    {
        
    }
    
}

