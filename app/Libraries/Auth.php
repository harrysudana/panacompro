<?php
namespace Libraries;
use Resources, Models;

class Auth {

	public function __construct(){
		$this->session = new Resources\Session;
		$this->route = new Route;
		$this->user = new Models\Users;
		$this->WebConfig = Resources\Config::website();
	}

	public function allow($method="*"){
		if($method=="*"){
			return true;
		}

		if(is_array($method)){
			if(!in_array($this->route->getMethod(), $method)){
				if(!$this->islogged()){
					$controller = new Resources\Controller;
					$controller->redirect($this->WebConfig['customadminuri'].'/auth/login');
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
				if(!in_array($this->route->getMethod(), $method)){
					if(!$this->islogged()){
						$controller = new Resources\Controller;
						$controller->redirect($this->WebConfig['customadminuri'].'/auth/login');
					}
				}
			}
		}
	}

	public function register($username, $email, $signature){
		if(!$this->validateSignature($signature))
			return false;

		$salt = md5(uniqid(rand(), true));
		$temp_pwd = substr($salt, rand(1,5), 5);
		$uid = $this->user->insert( 
			array(
				'username' => $username, 
				'email' => $email, 
				'password' => crypt($temp_pwd, $salt),
				'salt' => $salt
				) 
			);

		return true;
	}

	public function isUsernameExists($username){
		if( $this->user->getOne( array('username' => $username) ) )
			return true;

		return false;
	}

	public function isEmailExists($email){
		if( $this->user->getOne( array('email' => $email) ) )
			return true;

		return false;
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

	private function validateSignature($signature){
		$this->signature = new RequestSignature;
		if($this->signature->validate($signature))
			return true;
		return false;
	}

}