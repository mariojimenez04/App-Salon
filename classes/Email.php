<?php

    namespace Classes;

    use PHPMailer\PHPMailer\PHPMailer;


    class Email {

        public $email;
        public $nombre;
        public $token;

        public function __construct( $email, $nombre, $token )
        {
            $this->email = $email;
            $this->nombre = $nombre;
            $this->token = $token;
        }

        public function enviarConfirmacion()
        {
            //crear instancia de PHPMailer
            $mail = new PHPMailer();

            //Configurar SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = '2208655e74f273';
            $mail->Password = '1e6b401d6415ff';
            $mail->SMTPSecure = 'tls';
            $mail->Port = '2525';


            $mail->setFrom('appsalon@noreply.com');
            $mail->addAddress('appsalon@noreply.com', 'appsalon.com');
            $mail->Subject = 'Confirma tu cuenta de App Salon';

            //Set HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            $contenido = '<html>';
            $contenido .= "<p><strong>Hola " . $this->nombre . "</strong>, gracias por crear tu cuenta en AppSalon.com, por favor confirma tu cuenta en el siguiente enlace.</p>";
            $contenido .= "<p>Presiona aqui: <a style='font-weight: 600;' href='http://localhost:3000/confirm-account?token=" . $this->token . "'>Confirmar cuenta</a> </p>";
            $contenido .= "<p>Si tu no solicitaste crear una cuenta, puedes ignorar el mensaje</p>";
            $contenido .= '</html>';

            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es un texto alternativo sin HTML';
            
            //Enviar el email
            $mail->send();

            
        }
    }