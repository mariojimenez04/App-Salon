<h2 class="nombre-pagina">Registrate</h2>
<h3 class="nombre-pagina">Es rápido y fácil</h3>

<?php include_once __DIR__ . "/../templates/alertas.php"; ?>

<form action="" method="POST" class="formulario">

    <div class="campo">
        <label for="nombre">Nomre</label>
        <input type="text" name="nombre" id="nombre" placeholder="Tu nombre" value="<?php echo s($usuario->nombre); ?>">
    </div>

    <div class="campo">
        <label for="apellido">Apellido</label>
        <input type="text" name="apellido" id="apellido" placeholder="Tu apellido" value="<?php echo s($usuario->apellido); ?>">
    </div>

    <div class="campo">
        <label for="telefono">Teléfono</label>
        <input type="tel" name="telefono" id="telefono" placeholder="Tu teléfono" value="<?php echo s($usuario->telefono); ?>">
    </div>

    <div class="campo">
        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" placeholder="Tu e-mail" value="<?php echo s($usuario->email); ?>">
    </div>

    <div class="campo">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Tu password">
    </div>

    <input type="submit" value="Registrarte" class="btn-primary">

    <div class="acciones">
        <a href="/">Ya tienes cuenta, inicia sesión</a>
        <a href="/forgot">¿Olvidaste tu contraseña?</a>
    </div>

</form>