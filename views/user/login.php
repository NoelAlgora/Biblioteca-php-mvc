
<!DOCTYPE html>
<html lang="es">

<head>
  <title>
    Login
  </title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class="fondo">
  <div id="container">
    <div class="container_login">
      <p class="font_log"> Log in </p>
      <span class="form_error_span">
          <?php foreach ($formErrors as $formError): ?>
          <p><?= $formError ?></p>
          <?php endforeach; ?>
      </span>
      <form class="login_box" method="post" action="<?= $helper->url('user','login');?>" method="post">
        <div class="row">
          <div class="col-25">
            <label class="font_log" for="email">Email</label>
          </div>
          <div class="col-75">
            <input type="text" id="email" name="email" placeholder="Nombre de usuario" required>
          </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label class="font_log" for="password">Contraseña</label>
          </div>
          <div class="col-75">
            <input type="text" id="password" name="password" placeholder="Contraseña" required>
          </div>
        </div>
        <div class="row">
          <input type="submit" value="Entrar">
        </div>
        <p class="font_log">Aun no te has registrado?<a href="<?= $helper->url('user','register');?>"> Registrarme!</a></p>
      </form>
    </div>
  </div>
</body>

</html>
