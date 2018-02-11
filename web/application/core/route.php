<?php
class Route{

	static function start($db){
        //default
		$controller_name = 'Tasks';

		$action_name = 'index';


		$uri = parse_url($_SERVER['REQUEST_URI']);

		$routes = explode('/', $uri[path]);


		// controller name
		if ( !empty($routes[1]) )
			$controller_name = $routes[1];

		// action name
		if ( !empty($routes[2]) )
			$action_name = $routes[2];


		// prefixes
		$model_name = 'Model_'.$controller_name;

		$controller_name = 'Controller_'.$controller_name;

		$action_name = 'action_'.$action_name;

		
		// echo "Model: $model_name <br>";
		// echo "Controller: $controller_name <br>";
		// echo "Action: $action_name <br>";
		

        //checking model
		$model_file = strtolower($model_name).'.php';

		$model_path = "./web/application/models/".$model_file;

		if(file_exists($model_path))
		    include "./web/application/models/".$model_file;


        //checking controller
		$controller_file = strtolower($controller_name).'.php';

		$controller_path = "./web/application/controllers/".$controller_file;

		if(file_exists($controller_path))
			include "./web/application/controllers/".$controller_file;
		else
			 Route::ErrorPage404();

		
		// creating controller
		$controller = new $controller_name($db);
		$action = $action_name;
		
		if(method_exists($controller, $action))
			$controller->$action();
		else
			 Route::ErrorPage404();

	
	}


	static function ErrorPage404(){
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:'.$host.'404');
    }
    
}
