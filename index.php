<?php

require_once __DIR__ . '/vendor/autoload.php';

/**
 * Routers dict
 * */
$routes = [
    '' => 'App\\Controllers\\HomeController@index',
    'upload' => 'App\\Controllers\\UploadController@index',
];

$url = $_GET['url'] ?? '';
if (array_key_exists($url, $routes)) {
    $route = explode('@', $routes[$url]);
    $controller = $route[0];
    $method = $route[1];
    $controllerInstance = new $controller();
    $data = $controllerInstance->$method();
    if ($data) {
        extract($data);
    }
    if (empty($url)) {
        $url = 'home';
    }
    @include_once __DIR__ . '/App/Views/' . $url . '.php';
} else {
    echo <<<HTML
        <h1>404 Page Not Found</h1>
        <p>You are trying to reach the page that does not exist in the system.</p>
        <hr>
    HTML;
}