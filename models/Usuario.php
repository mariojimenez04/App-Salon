<?php 

    namespace Model;

    class Usuario extends ActiveRecord {
        //Base de datos
        protected static $tabla = 'usuarios';
        protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono', 'email',  'password', 'admin', 'confirmado', 'token'];

        public $id;
        public $nombre;
        public $apellido;
        public $telefono;
        public $email;
        public $password;
        public $admin;
        public $confirmado;
        public $token;

        public function __construct($args = [])
        {
            $this->id = $args['id'] ?? null;
            $this->nombre = $args['nombre'] ?? '';
            $this->apellido = $args['apellido'] ?? '';
            $this->telefono = $args['telefono'] ?? '';
            $this->email = $args['email'] ?? '';
            $this->password = $args['password'] ?? '';
            $this->admin = $args['admin'] ?? '0';
            $this->confirmado = $args['confirmado'] ?? '0';
            $this->token = $args['token'] ?? '';
        }

        //Mensajes de validacion para crear la cuenta

        public function validarNuevaCuenta()
        {
            if(!$this->nombre){
                self::$alertas['error'][] = 'El nombre es obligatorio';
            }

            if(!$this->apellido){
                self::$alertas['error'][] = 'El apellido es obligatorio';
            }

            if(!$this->telefono){
                self::$alertas['error'][] = 'El telefono es obligatorio';
            }

            if(!$this->email){
                self::$alertas['error'][] = 'El email es obligatorio';
            }

            if(!$this->password){
                self::$alertas['error'][] = 'El password es obligatorio';
            }

            if(strlen( $this->password ) < 7 ){
                self::$alertas['error'][] = 'El password debe contener minimo 6 caracteres';
            }

            return self::$alertas;
        }

        public function existeUsuario(){
            $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1"; 

            $resultado = self::$db->query($query);

            if ($resultado->num_rows) {
                self::$alertas['error'][] = 'Usuario ya registrado';
            }

            return $resultado;
        }

        public function hashPassword()
        {
            $this->password = password_hash($this->password, PASSWORD_BCRYPT);
        }

        public function crearToken()
        {
            $this->token = uniqid();
        }
    }