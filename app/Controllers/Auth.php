<?php
namespace Controllers;
use Resources, Models, Libraries;

class Auth extends Resources\Controller {
	public function __construct(){
		parent::__construct();
		$this->session = new Resources\Session;
		$this->request = new Resources\Request;
		$this->uri = new Resources\Uri;
		$this->auth = new Libraries\Auth;

		$this->auth->allow(
			array('login')
			);

	}

	public function login(){

	}
	
}
