<h1 class="nombre-pagina">Recuperar contraseña</h1>
<p class="descripcion-pagina">Restablece tu password, escribe tu e-mail a continuación</p>
<p class="descripcion-pagina">Te enviaremos un e-mail para restablecer tu contraseña</p>


<form action="" method="POST" class="formulario">

<?php include_once __DIR__ . "/../templates/alertas.php"; ?>

    <div class="campo">
        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" placeholder="Tu e-mail">
    </div>

    <div class="d-flex align-center">
        <a href="/" class="btn-secondary">Cancelar</a>
        <input type="submit" class="btn-primary" value="Enviar correo">
    </div>

    <div class="acciones">
        <a href="/">Ya tienes cuenta, inicia sesión</a>
        <a href="/register">Registrate con nosotros</a>
    </div>

</form>