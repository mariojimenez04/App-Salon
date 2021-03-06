<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia sesión con tus datos</p>

<?php include_once __DIR__ . "/../templates/alertas.php"; ?>

<form action="" method="POST" class="formulario">
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Tu e-mail" required/>
    </div>

    <div class="campo">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Tu password" required>
    </div>

    <input type="submit" class="btn-primary" value="Iniciar Sesión">

    <div class="acciones">
        <a href="/register">Registrate con nosotros</a>
        <a href="/forgot">¿Olvidaste tu contraseña?</a>
    </div>
</form>