<?php
namespace Modules\Administration\Controllers;
use Resources, Models, Libraries;

class Auth extends Resources\Controller {
	public function __construct(){
		parent::__construct();
		$this->session = new Resources\Session;
		$this->request = new Resources\Request;
		
		$this->auth = new Libraries\Auth;
		$this->template = new Libraries\Template;

		$this->WebConfig = Resources\Config::website();

		$this->auth->allow(
			array('login','register')
			);

	}

	public function login(){
		if($this->auth->islogged()){
			$this->redirect($this->WebConfig['customadminuri'].'/');
		}

		$data['title'] = "Login";

		if( $this->request->post('btnlogin') ) {
			//print($this->session->getValue( 'postSignature'));exit();
			if( $this->auth->login(
				$this->request->post('username'),
				$this->request->post('password'),
				$this->request->post('loginSignature')
				) ){

				if( ! $redirect=$this->request->post('redirect') )
					$this->redirect($this->WebConfig['customadminuri'].'/');

				$this->redirect( $redirect );
			}else{
				$data['error'] = "Wrong Account!";
			}
		}

		$data['signature'] = $this->generateSignature();
		$this->template->render('admin','login', $data);
	}

	public function logout(){
		$this->session->destroy();
		$this->redirect($this->WebConfig['customadminuri'].'/');
	}

	public function register(){
		if($this->auth->islogged()){
			$this->redirect($this->WebConfig['customadminuri'].'/');
		}

		$data['title'] = "Register";

		if( $this->request->post('btnregister') ) {
			
			if( !$this->auth->isUsernameExists( $this->request->post('username') ) || !$this->auth->isEmailExists( $this->request->post('email') )  ){

				if( !$this->auth->register(
					$this->request->post('username'), 
					$this->request->post('email'), 
					$this->request->post('regSignature') ) ) { 
					$data['error'] = "Sorry, register failed!";
				}else{
					//exit();
					if( !$redirect=$this->request->post('redirect') )
						$this->redirect($this->WebConfig['customadminuri'].'/auth/login');

					$this->redirect( $redirect );
				}
				
			}else{
				$data['error'] = "Sorry, username or email already exists!";
			}
		}

		$data['signature'] = $this->generateSignature();
		$this->template->render('admin','register', $data);
	}

	private function generateSignature(){
		$this->signature = new Libraries\RequestSignature;
		return $this->signature->generate();
	}
}
