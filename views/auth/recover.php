<h1 class="nombre-pagina">Recuperar cuenta</h1>

<?php include_once __DIR__ . "/../templates/alertas.php"; ?>

<?php if ( $error === false) : ?>
    <p class="descripcion-pagina">Coloca tu nuevo password a continuacion</p>
    <form action="" class="formulario">

        <div class="campo">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
        </div>

        <input type="submit" class="btn-primary" value="Registrar nuevo password">

    </form>
<?php endif; ?>
<div class="acciones">
    <a href="/">Ya tienes cuenta, inicia sesión</a>
    <a href="/register">Registrate con nosotros</a>
</div> 