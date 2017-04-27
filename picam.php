<?php


class Model
{	
	public $menu;
	public $photo;
	public $main_title;
	public $device_type;

	public function __construct(){

                $this->photo = array (
                'iphone' => array ('width' => 300, 'height' => 200),
                'other'  => array ('width' => 900, 'height' => 600)
                );


                $browser = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
                if ($browser == true){
                    $this->model->device_type = 'iphone';
                }
                else {
                    $this->model->device_type = 'other';

                }

                $width = $this->photo [$this->model->device_type]['width'];
                $height = $this->photo [$this->model->device_type]['height'];

		$this->menu = array (	
	'clear'	=> array ('linkname' => 'Clear','message' => 'Welcome to PiCam!','title' => 'PiCam Home Page', 'onclick' => ''),
	'photo'	=> array ('linkname' => 'Photo','message' => 'Here is your photo','title' => 'Photo Page',
        'basename' => '/var/www/html','filename' => '/img/picam.' . date('m-d-Y_H:i:s') . '.jpg', 'onclick' => "getPhotoRequest($width, $height); return false;"));
		
		$this->main_title = "Welcome To PiCam!";

	}
}

class View
{
	private $model;
	private $controller;
	
	public function __construct($controller,$model) {
		$this->controller = $controller;
		$this->model = $model;
	}
	
	public function display_html_headerinfo() {
                echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">';
		echo '<html>';
	
		echo '<head>';
                echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
		echo '<title>' . $this->model->menu[$_GET['action']]['title'] . '</title>';
		echo '<link rel="stylesheet" type="text/css" href="css/picam.css">';
                echo '<script type="text/javascript " src="picam.js"></script>';
		echo '</head>';
	
		echo '<body>';
		echo '<div id="wrap">';
	}
	
	public function display_title() {
		echo '<h1>' . $this->model->main_title . '</h1>';
	}


	public function display_menubar() {
		echo '<ul id="nav">';
		foreach ($this->model->menu as $key => $details) {
			echo '<li><a href="' . basename(__FILE__) . '?action=' .$key . '" onclick="' . $details['onclick']  . '">' . $details['linkname']  . '</a></li>';
		}
		echo '</ul>';

	}
	
	public function display_mainscreen() {
		echo '<div id="content" style="display: block">';


              /*  $width = $this->model->photo [$this->model->device_type]['width'];
                $height = $this->model->photo [$this->model->device_type]['height']; */

		echo '<p>' . $this->model->menu[$_GET['action']]['message'] . '</p>';
		echo '</div>';
	}

	public function display_loader() {
            echo '<div id="loader" style="display:none;">';
            echo '<img src="/img/picam_loader.gif" style="margin:auto;display:block">'; 
            echo '</div>';
        }
	
	public function display_html_footerinfo() {
		echo '</div>';
		echo '</body>';
		echo '</html>';
	}

   
	public function output() {
		$this->display_html_headerinfo();
		$this->display_title();
		$this->display_menubar();
		$this->display_loader();
		$this->display_mainscreen();
		$this->display_html_footerinfo();
	}
}

class Controller
{
	private $model;

	public function __construct($model){
		
		$this->model = $model;	
		if(!isset($_GET['action']) || empty($_GET['action'])) { 	# if no action then default to 'clear'
			
			$_GET['action'] = 'clear';

		}

	}
	
}

$model = new Model();						# create all 3 mvc object instances
$controller = new Controller($model);
$view = new View($controller, $model);

$view->output();

?>
