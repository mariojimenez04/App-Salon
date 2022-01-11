<?php 

    namespace Controllers;

    use MVC\Router;

    class NotFoundController {

        public static function index(Router $router) {

            $router->render('notfound', []);
        }

    }