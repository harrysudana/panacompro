<?php
namespace Libraries;
use Resources;

class Route
{    
    public
    $directory, $class, $method;
    
    public function __construct() {
        $this->uri = new Resources\Uri;
        $this->config['main'] = Resources\Config::main();
        $this->buildRoute();
    }


    public function buildRoute(){
        $segment = $this->uri->path();
        $i=0;
        $controller_path = APP;
        $module_path = $this->config['main']['module']['path'] . 'Modules/';
        $capptest = $segment[$i];

        do{
            if(is_dir($controller_path.$capptest)){
                $this->setDirectory($controller_path.$capptest);
                $this->setClass( isset($segment[$i+1])? $segment[$i+1] : $this->config['main']['defaultController'] ) ;
                $this->setMethod( isset($segment[$i+2])? $segment[$i+2]:'index' );
                
                break;
            }elseif(is_dir($module_path.$capptest)){
                $this->setDirectory($module_path.$capptest);
                $this->setClass( isset($segment[$i+1])? $segment[$i+1] : $this->config['main']['defaultController'] );
                $this->setMethod( isset($segment[$i+2])? $segment[$i+2]:'index' );
                
                break;
            }

            $i = $i +1;
            $capptest = $capptest .'/'. $segment[$i];

        }while ($i<count($segment));

    }

    public function setClass($class){
        $this->class = $class;
    }

    public function getClass(){
        return $this->class;
    }

    public function setMethod($method){
        $this->method = $method;
    }
    
    public function getMethod(){
        return $this->method;
    }

    public function setDirectory($dir){
        $this->directory = $dir;
    }

}