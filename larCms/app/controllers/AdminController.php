<?php


class AdminController extends BaseController {

	protected $layout = 'layouts.master';
        
        protected $user;
    
        protected $user_modules;
        
        protected $perm_data;
        
        public function showHome()
	{
            
            if(!$this->setEssentials()){
                return Redirect::to("login");
            }
            
            
            
            return Redirect::to("/admin/".$this->user_modules->first()->name);
            
        }

        public function loginCms()
        {
            if(Session::get("user")){
                return Redirect::to('/');
            }
            $data = array();
            if(Request::is("login")){
                Common::global_xss_clean();
                $input = Input::only('username', 'password');
                //check if user posted
                if($input["username"]!="" && $input["password"]!=""){
                    $user = User::getUserPassword($input["username"],$input["password"])->get();
                    if($user->first()){
                        Session::put('user', $user->first()->id);
                        return Redirect::to('/');
                    }
                    else{
                        $data["error"] = 1;
                    }
                }
                
            }
            
            
            return View::make('login')->with("data",$data);
        }
        
        
        public function logoutCms()
        {
            Session::flush();
            return Redirect::to('/login');
        }
        
        protected function setEssentials()
        {
            if(Session::get("user")){
                $this->user = User::find((int)Session::get("user"))->first();
                //get ids for the query
                $mods = Common::getIntForInQuery($this->user->modules()->get()->toArray(), "module");
                $this->user_modules = Module::whereRaw("id IN ".$mods)->get();
                $this->perm_data = array("user_name" => ucfirst($this->user->username),
                                         "logout_url" => URL::to('logout'),
                                         "user_modules" => $this->user_modules);
                
                return true;
            }
            
        }
        
}