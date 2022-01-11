<?php

    namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController {

    public static function login(Router $router) {

        $router->render('auth/login');
    }

    public static function logout(Router $router) {

    }

    public static function forgot(Router $router) {


        $router->render('auth/olvide-password', []);
    }

    public static function recover(Router $router) {

    }

    public static function register(Router $router) {
        $usuario = new Usuario($_POST);
        $alertas = [];
        
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            //REvisar que alertas este vacio

            if( empty( $alertas )) {
                //Verificar si ya esta registrado
                $resultado = $usuario->existeUsuario();

                if ($resultado->num_rows) {
                    $alertas = Usuario::getAlertas();
                }else {
                    //No esta registrado
                    $usuario->hashPassword();

                    //Generar un token unico para validar correo
                    $usuario->crearToken();

                    //Enviar el email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);

                    $email->enviarConfirmacion();

                    $resultado = $usuario->guardar();

                    if($resultado){
                        header('Location: /message');
                    }
                }
            }
        }

        $router->render('auth/crear-cuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas,
        ]);
    }

    public static function message(Router $router){


        $router->render('auth/mensaje' );
    }

    public static function confirm(Router $router){

        $alertas = [];

        $token = s($_GET['token']);

        $usuario = Usuario::where('token', $token);

        if( empty($usuario) ){
            //Mostrar mensaje de error
            Usuario::setAlerta('error', 'Token no valido');
        }else {
            //Modificar al usuario a confirmado
            $usuario->confirmado = "1";
            $usuario->token = null;
            $usuario->guardar();

            Usuario::setAlerta('exito', 'Cuenta verificada correctamente');
        }

        //Obtener alertas
        $alertas = Usuario::getAlertas();

        //Renderizar la vista
        $router->render('auth/confirmar-cuenta', [
            'alertas' => $alertas
        ]);
    }

}