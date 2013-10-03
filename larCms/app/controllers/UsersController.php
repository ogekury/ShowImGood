<?php

class UsersController extends AdminController {
    
    protected $module_active = 'users';
    
    
    
    public function main()
    {
        if(!$this->setEssentials()){
            return Redirect::to("/");
        }
        $data = array("module_active"=>$this->module_active);
        
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
