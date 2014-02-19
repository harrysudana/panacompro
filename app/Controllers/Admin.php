<?php
namespace Controllers;
use Resources, Models, Libraries;

class Admin extends Resources\Controller {
	public function __construct(){
		parent::__construct();
		$this->session = new Resources\Session;
		$this->request = new Resources\Request;
		$this->auth = new Libraries\Auth;

		if($this->auth->islogged()){
			echo "Failed";
		}

	}
}
