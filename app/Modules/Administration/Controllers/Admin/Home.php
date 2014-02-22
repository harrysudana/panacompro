<?php
namespace Modules\Administration\Controllers\Admin;
use Resources, Libraries;

class Home extends Resources\Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->auth = new Libraries\Auth;
        $this->auth->allow(
            array('login')
            );
    }

    public function index()
    {
        echo 'Hello world!';
    }

    public function login(){

    }

}
