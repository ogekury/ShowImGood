<?php

class UsersController extends AdminController {
    
    protected $module_active = 'users';
    protected $model_set    = 'user';    
    
    public function main()
    {
        if(!$this->setEssentials()){
            return Redirect::to("/");
        }
        $data = array("module_active" => $this->module_active,
                      "model_set" => $this->model_set);
        
        $data["users"] = User::all(array("id","username","email"));
        
        
        $data += $this->perm_data;
        return View::make('modules.users')->with("data",$data);
    }
    
    public function edit()
    {
        if(!$this->setEssentials()){
            return Redirect::to("/");
        }
        $data = array("module_active"=>$this->module_active);
        
        
        
        $data += $this->perm_data;
        return View::make('modules.users')->with("data",$data);
        
    }
    
    
    
}
