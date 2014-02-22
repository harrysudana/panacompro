<?php
namespace Modules\Administration\Controllers;
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

		if( $this->request->post('btnlogin') ) {
			
			if( $this->auth->login(
				$this->request->post('username'),
				$this->request->post('password'),
				$this->request->post('signature')
				) ){

				if( ! $redirect=$this->request->post('redirect') )
					$this->redirect( $redirect );

				$this->redirect('home');
			}else{
				$data['error'] = "Wrong Account!";
			}
		}

		$data['signature'] = $this->auth->generateSignature();
		$this->template->render('admin','login', $data);
	}

}
