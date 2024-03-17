<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Docita - Iniciar sesión</title>
    <link rel="stylesheet" href="css/estilos.css" />
  </head>

  <body id="body-login">
    <form action="login.php" method="post">
      <h2 class="form-title">Iniciar sesión</h2>

      <div class="form-input input">
        <label for="email">Correo electrónico</label>
        <input
          type="email"
          name="email"
          id="email"
          placeholder="example@email.com"
          required
        />
      </div>

      <div class="form-input input">
        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password" required />
        <a href="#" class="form-text">He olvidado mi contraseña</a>
      </div>

      <div class="form-btn">
        <button type="submit" class="btn">Iniciar sesión</button>
        <?php
      session_start();
      if(isset($_SESSION['error'])) {
          echo '<span id="error" style="font-weight:100; color:red; font-size:12px; display: block; text-align:center; margin-top:10px;">'.$_SESSION['error'].'</span>';
          unset($_SESSION['error']);
      } else {
          echo '<span id="error"  style="display: none; color: red">Usuario o contraseña incorrectos.</span>';
      }
      ?>
        <a href="crear-cuenta.html" class="form-text">Registrar una cuenta</a>
      </div>

    </form>
  </body>
</html>
