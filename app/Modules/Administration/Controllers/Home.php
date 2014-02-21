<?php
namespace Modules\Administration\Controllers;
use Resources, Libraries;

class Home extends Resources\Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->auth = new Libraries\Auth;

        $this->auth->allow();
    }

    public function index()
    {
        echo 'Hello world!';
    }
}
