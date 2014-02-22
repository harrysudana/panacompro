<?php
namespace Libraries;
use Resources, Models;

class Template {
	private $type, $viewFile, $viewData;
	public function __construct(){
		$this->session = new Resources\Session;
        $this->request = new Resources\Request;
        $this->controller = new Resources\Controller;
        $this->uri = new Resources\Uri;

        $this->WebConfig = Resources\Config::website();
        $config = Resources\Config::main();

	}

	public function the_header( $view = 'header'){
		if($view!="header")
			$view = "header_".$view;
		$this->render($this->type, $view);
	}

	public function the_footer( $view = 'footer'){
		if($view!="footer")
			$view = "footer_".$view;
		$this->render($this->type, $view);
	}

	public function render($type, $view, $data=array()){
		$this->type = $type;
		$filePath = APP . '../themes/'. $this->WebConfig['theme'][$this->type] . '/' . $view;

		try{
            if( ! file_exists($this->viewFile = $filePath.'.php') )
                throw new Resources\RunException('Template file in '.$this->WebConfig['theme'][$this->type].'/'.$view.'.php does not exits');
        }
        catch(RunException $e){
            $arr = $e->getTrace();
            Resources\RunException::outputError($e->getMessage());
        }

        if( ! empty($data) )
        	$this->viewData = array("data"=>$data);

        if(!empty($this->viewData))
        	extract( $this->viewData['data'], EXTR_SKIP );

		include $this->viewFile;
	}

	public function get_theme_directory(){

	}

	public function get_theme_uri(){
		return $this->uri->getBaseUri().'themes/'.$this->WebConfig['theme'][$this->type].'/';
	}

	public function get_home_uri(){
		return $this->uri->getBaseUri();
	}

}
