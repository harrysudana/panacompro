<?php
namespace Modules\Administration\Controllers;
use Resources, Libraries, Models;

class Post extends Resources\Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->auth = new Libraries\Auth;
        $this->template = new Libraries\Template;

        $this->posts = new Models\Posts;

        $this->auth->disallow();
    }

    public function index()
    {
        $data=array();

        $data['title'] = "Dashboard : All Posts";
        $this->template->render('admin','index',$data);
        //echo 'Hello world!';
    }

    public function add()
    {
        $data=array();

        $data['title'] = "Dashboard : Post Add";
        $this->template->render('admin','postadd',$data);
        //echo 'Hello world!';
    }

}
