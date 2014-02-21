<?php
namespace Controllers;
use Resources, Models;

class Homeo extends Resources\Controller
{
    public function index()
    {
        $data['title'] = 'Hello world!';

        $this->output('home', $data);
    }
}
