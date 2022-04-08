<?php

    namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController {

    public static function login(Router $router) {
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST' ) {
            $auth = new Usuario($_POST);

            $alertas = $auth->validarLogin();

            if( empty( $alertas ) ) {
                //Comprobar que exista el usuario
                $usuario = Usuario::where('email', $auth->email);

                if ($usuario) {
                    //Verificar el password
                    if( $usuario->comprobarPassword($auth->password) ) {
                        //autenticar el usuario
                        session_start();

                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                        //Redireccionamiento
                        if( $usuario->admin === "1"){
                            $_SESSION['admin'] = $usuario->admin ?? null;

                            header('Location: /admin');
                        }else{
                            header('Location: /cita');
                        }
                        
                    }
                }else {
                    Usuario::setAlerta('error', 'Usuario no encontrado');
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/login',[
            'alertas' => $alertas
        ]);
    }

    public static function logout(Router $router) {

    }

    public static function forgot(Router $router) {
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarEmail();

            if( empty( $alertas )) {
                //Enviar email para corregir contraseña
                $usuario = Usuario::where('email', $auth->email);

                if( $usuario && $usuario->confirmado === "1" ) {
                    //Generar un nuevo token
                    $usuario->crearToken();
                    $usuario->guardar();

                    //Enviar el email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarInstrucciones();

                    //Alerta de exito
                    Usuario::setAlerta('exito', 'Revisa tu e-mail para poder restablecer tu password');
                }else {
                    Usuario::setAlerta('error', 'El usuario no existe o no esta confirmado');
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/olvide-password', [
            'alertas' => $alertas
        ]);
    }

    public static function recover(Router $router) {
        $alertas = [];

        $error = false;

        $token = s($_GET['token']);

        $usuario = Usuario::where('token', $token);

        if(empty($usuario)){
            Usuario::setAlerta('error', 'Token no valido');
            $error = true;
        }

        if ( $_SERVER['REQUEST_METHOD'] === 'POST'){
            $password = new Usuario($_POST);
            $alertas = $password->validarPassword();

            if(empty($alertas)){
                
            }
        }

        Usuario::getAlertas();
        $router->render('auth/recover',[
            'alertas' => $alertas,
            'error' => $error
        ]);

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