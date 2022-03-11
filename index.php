<!-- 1. An instroductory article: https://codigofacilito.com/articulos/mvc-model-view-controller-explicado

2. MVC in PHP: https://victorroblesweb.es/2013/11/18/tutorial-mvc-en-php-nativo/

3. MInimal PHP router: https://www.taniarascia.com/the-simplest-php-router/ -->



<!-- Aquesta pàgina és el router de l'aplicació. Aqui es declara on es troba el controlador de cada vista -->

<?php
define('CONTEXT','P35MVC');

$request = $_SERVER['REQUEST_URI'];
$baserequest = basename($request);
// echo "<p>$request</p>";
// echo "<p>$baserequest</p>";


switch ($baserequest) {
    case CONTEXT :
    case 'comunidades' : // En cas de que la URL sigui: https://localhost/comunidades, anirà al controlador de comunidades el qual ens dirigeix a la vista de comunidades
        require './controllers/comunidadesController.php';
        break;
    case 'provincias' :
        require './controllers/provinciasController.php';
        break;
    case 'localidades' :
        require './controllers/localidadesController.php';
        break;
    case 'summary' :
        require './controllers/summaryController.php';
        break;
    case 'comunidad' :
        require './views/comunidad.php';
        break;
    case 'comunidad_new' :
        require './controllers/comunidad_newController.php';
        break;
    default:
        http_response_code(404);
        require './views/404.php';
        break;
}
