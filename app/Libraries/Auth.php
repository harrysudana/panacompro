<?php
namespace Libraries;
use Resources, Models;

class Auth {

	public function __construct(){
		$this->session      = new Resources\Session;
        $this->request      = new Resources\Request;
        $this->user         = new Models\Users;
	}

	public function islogged(){
		$sess_auth = $this->session->getValue( 'auth');

		$user = $this->user->getOne( array('username' => $sess_auth['uid']) );
		if( $user && md5($sess_auth['pwd']) == $user->password ){
			return true;
		}
		return false;
	}

	public function generate(){
		$signature = md5( uniqid(rand(), true) );
		$this->session->setValue( 'postSignature', $signature );
		return $signature;
	}

	public function validate($signature){
		if($signature == $this->session->getValue( 'postSignature') )
			return true;
		return false;
	}
}