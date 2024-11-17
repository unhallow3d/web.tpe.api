<?php

require_once 'libs/router.php';
require_once 'config.php';
require_once 'app/controllers/BibliotecaApiController.php';
require_once 'app/controllers/user.api.controller.php';
require_once 'app/middlewares/jwt.auth.middleware.php';
$router = new Router();

$router->addMiddleware(new JWTAuthMiddleware());

#                 endpoint        verbo      controller              metodo
$router->addRoute('autores',            'GET',     'BibliotecaApiController',   'obtenerAutores');
$router->addRoute('autores/:id',            'GET',     'BibliotecaApiController',   'obtenerAutor');
$router->addRoute('autores/:id',            'DELETE',  'BibliotecaApiController',   'eliminarAutor');
$router->addRoute('autores',                'POST',    'BibliotecaApiController',   'agregarAutor');
$router->addRoute('autores/:id',            'PUT',     'BibliotecaApiController',   'editarAutor');


$router->addRoute('usuarios/token',            'GET',     'UserApiController',   'getToken');

$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
