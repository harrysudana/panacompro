<?php
namespace Libraries;
use Resources, Models;

class Auth {

	public function __construct(){
		$this->session = new Resources\Session;
        $this->request = new Resources\Request;
        $this->uri = new Resources\Uri;
        $this->route = new Route;
        $this->user = new Models\Users;

        $this->WebConfig = Resources\Config::website();

	}

	public function allow($method="*"){
		if(is_array($method)){
			foreach($method as $row){
				if($row != $this->route->getMethod()){
					if(!$this->islogged()){
						$controller = new Resources\Controller;
						$controller->redirect($this->WebConfig['customadminuri'].'/auth/login');
					}
				}
			}
		}
	}

	public function disallow($method="*"){
		if($method=="*"){
			if(!$this->islogged()){
				$controller = new Resources\Controller;
				$controller->redirect($this->WebConfig['customadminuri'].'/auth/login');
			}
		}

		if(is_array($method)){
			foreach($method as $row){
				if($row == $this->route->getMethod()){
					if(!$this->islogged()){
						$controller = new Resources\Controller;
						$controller->redirect($this->WebConfig['customadminuri'].'/auth/login');
					}
				}
			}
		}
	}

	public function islogged(){
		$sess_auth = $this->session->getValue('auth');
		if($sess_auth){
			$user = $this->user->getOne( array('username' => $sess_auth['uid']) );
			if( $user && $sess_auth['pwd'] == $user->password ){
				return true;
			}
		}
		return false;
	}

	public function login($username, $password, $signature){
		if(!$this->validateSignature($signature))
			return false;
		
		$user = $this->user->getOne( array('username' => $username) );
		if( $user && crypt($password, $user->salt) == $user->password ){
            $this->session->setValue(
            	array('auth' =>
	                array(
	                    'uid' => $user->username,
	                    'pwd' => $user->password
	                )
                )
            );
            return true;
        }

        return false;
	}

	public function generateSignature(){
		$signature = md5( uniqid(rand(), true) );
		$this->session->setValue( 'postSignature', $signature );
		return $signature;
	}

	public function validateSignature($signature){
		if($signature == $this->session->getValue( 'postSignature') )
			return true;
		return false;
	}
}