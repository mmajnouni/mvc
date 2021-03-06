<?php
spl_autoload_register(function ($class){
	$root = dirname(__DIR__); //get the parent directory
	$file = $root . '/' . str_replace('\\', '/', $class) . '.php';
	if (is_readable($file)) {
		require $root . '/' . str_replace('\\', '/', $class) . '.php' ;
	}
});

// $url = $_SERVER['QUERY_STRING'];

//require '../App/Controllers/Posts.php';
//require '../Core/Router.php';
$router = new Core\Router();
//echo get_class($router);

$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('posts', ['controller' => 'Posts', 'action' => 'index']);
$router->add('posts/new', ['controller' => 'Posts', 'action' => 'new']);
$router->add('{controller}/{action}');
$router->add('admin/{action}/{controller}');
$router->add('{controller}/{id:\d+}/{action}');

// echo '<pre>';
// echo htmlspecialchars(print_r($router->getRoutes(), true));
// echo '</pre>';

// if ($router->match($url)) {
// 	echo '<pre>';
// 	var_dump($router->getParams());
// 	echo '</pre>';
// } else{
// 	echo "No route found for address:  '$url' ";
// }

$router->dispatch($_SERVER['QUERY_STRING']);
?>