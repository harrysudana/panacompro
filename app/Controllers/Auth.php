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
		$this->template = new Libraries\Template;

		//$this->template->setType = "admin";

		$this->auth->allow(
			array('login')
			);

	}

	public function login(){
		//$this->template->setType = "admin";
		$this->template->render('admin','login');
	}

}
