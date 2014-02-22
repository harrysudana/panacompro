<?php
namespace Modules\Administration\Controllers;
use Resources, Libraries;

class Home extends Resources\Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->auth = new Libraries\Auth;
        $this->template = new Libraries\Template;

        $this->auth->disallow();
    }

    public function index()
    {
        $data=array();

        $data['title'] = "Dashboard";
        $this->template->render('admin','index',$data);
        //echo 'Hello world!';
    }
}
