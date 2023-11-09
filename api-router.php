<?php
require_once './libs/Router.php';
require_once './app/controllers/seccion-api.controller.php';
require_once './app/controllers/auth-api.controller.php';
require_once './app/controllers/apiComentarioController.php';

//creo el router
$router= new router();
$router -> addRoute ('secciones', 'GET', 'SeccionApiController', 'getSecciones');
$router -> addRoute ('secciones/:ID', 'GET', 'SeccionApiController', 'getSeccion');
$router -> addRoute ('secciones/:ID', 'DELETE', 'SeccionApiController', 'deleteSeccion');
$router -> addRoute ('secciones', 'POST', 'SeccionApiController', 'insertSeccion');
$router -> addRoute ('secciones', 'PUT', 'SeccionApiController', 'modificarSeccion');
$router -> addRoute ('auth/token', 'GET', 'AuthApiController', 'getToken');


$router -> addRoute ('comentarios', 'GET', 'ComentarioApiController', 'getComentarios');
$router -> addRoute ('comentarios/:ID', 'GET', 'ComentarioApiController', 'getComentario');
$router -> addRoute ('comentarios/:ID', 'DELETE', 'ComentarioApiController', 'deleteComentario');
$router -> addRoute ('comentarios', 'POST', 'ComentarioApiController', 'insertComentario');

//ejecuto la ruta
$router -> route($_GET["resource"], $_SERVER['REQUEST_METHOD']);




