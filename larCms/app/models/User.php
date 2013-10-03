<?php

class User extends Eloquent
{
	protected $table = "user";
	
        public $timestamps = false;

        protected $salt = '89a87fb&';
        
	public function scopeGetUserPassword($query,$username,$password)
        {
            return $query->where("username", "=", $username)
                         ->where("password", "=", $this->getSecuredPassword($password));
        }
        
        protected function getSecuredPassword($password)
        {
            $halfpass = substr($password, 0,ceil(strlen($password)/2));
            
            return md5($password.$this->salt.$halfpass);
        }
        
        public function modules()
	{
		return $this->hasMany('UserModules','user');
	}
        
}