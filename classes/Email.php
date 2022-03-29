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
            $mail->SMTPSecure = 'tls';
            $mail->Port = '2525';
            $mail->Username = '3c59f516c507f5';
            $mail->Password = '29dedf28e4cc9c';


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

        public function enviarInstrucciones() {
             //crear instancia de PHPMailer
             $mail = new PHPMailer();

             //Configurar SMTP
             $mail->isSMTP();
             $mail->Host = 'smtp.mailtrap.io';
             $mail->SMTPAuth = true;
             $mail->SMTPSecure = 'tls';
             $mail->Port = '2525';
             $mail->Username = '3c59f516c507f5';
             $mail->Password = '29dedf28e4cc9c';
 
 
             $mail->setFrom('appsalon@noreply.com');
             $mail->addAddress('appsalon@noreply.com', 'appsalon.com');
             $mail->Subject = 'Restablecer tu password';
 
             //Set HTML
             $mail->isHTML(true);
             $mail->CharSet = 'UTF-8';
 
             $contenido = '<html>';
             $contenido .= "<p><strong>Hola " . $this->nombre . "</strong>, haz solicitado restablecer tu password, por favor restablece tu password en el siguiente enlace.</p>";
             $contenido .= "<p>Presiona aqui: <a style='font-weight: 600;' href='http://localhost:3000/recover-password?token=" . $this->token . "'>Confirmar cuenta</a> </p>";
             $contenido .= "<p>Si tu no solicitaste crear una cuenta, puedes ignorar el mensaje</p>";
             $contenido .= '</html>';
 
             $mail->Body = $contenido;
             $mail->AltBody = 'Esto es un texto alternativo sin HTML';
             
             //Enviar el email
             $mail->send();
 
             
        }
    }