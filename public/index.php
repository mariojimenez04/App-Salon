<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\LoginController;
use Controllers\NotFoundController;
use MVC\Router;

$router = new Router();

//Iniciar sesion
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);

//Cerrar sesion
$router->get('/logout', [LoginController::class, 'logout']);

//Olvide el password
$router->get('/forgot', [LoginController::class, 'forgot']);
$router->post('/forgot', [LoginController::class, 'forgot']);

//Recuperar el password
$router->get('/recover-password', [LoginController::class, 'recover']);
$router->post('/recover-password', [LoginController::class, 'recover']);

//Crear cuenta
$router->get('/register', [LoginController::class, 'register']);
$router->post('/register', [LoginController::class, 'register']);

//Confirmar cuenta
$router->get('/confirm-account', [LoginController::class, 'confirm']);

$router->get('/message', [LoginController::class, 'message']);

//Ruta de pagina no encontrada
$router->get('/notfound', [NotFoundController::class, 'index']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();