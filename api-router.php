<?php
require_once './libs/Router.php';
require_once './app/controllers/noticia-api.controller.php';
require_once './app/controllers/auth-api.controller.php';
require_once './app/controllers/apiComentarioController.php';

//creo el router
$router= new router();
$router -> addRoute ('noticias', 'GET', 'NoticiaApiController', 'getNoticias');
$router -> addRoute ('noticias/:ID', 'GET', 'NoticiaApiController', 'getNoticia');
$router -> addRoute ('noticias/:ID', 'DELETE', 'NoticiaApiController', 'deleteNoticia');
$router -> addRoute ('noticias', 'POST', 'NoticiaApiController', 'insertNoticia');
$router -> addRoute ('noticias/:ID', 'PUT', 'NoticiaApiController', 'modificarNoticia');
$router -> addRoute ('auth/token', 'GET', 'AuthApiController', 'getToken');


$router -> addRoute ('comentarios', 'GET', 'ComentarioApiController', 'getComentarios');
$router -> addRoute ('comentarios/:ID', 'GET', 'ComentarioApiController', 'getComentario');
$router -> addRoute ('comentarios/:ID', 'DELETE', 'ComentarioApiController', 'deleteComentario');
$router -> addRoute ('comentarios', 'POST', 'ComentarioApiController', 'insertComentario');

//ejecuto la ruta
$router -> route($_GET["resource"], $_SERVER['REQUEST_METHOD']);




