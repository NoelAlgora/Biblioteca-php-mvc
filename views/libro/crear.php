<!DOCTYPE html>
<html lang="es">

<head>
  <title>Crear libro!</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class="fondo">
  <div class="container">
    <div class="container_register">
      <p class="font_log">Crea un nuevo libro!</p>
      <span class="form_error_span">
          <?php foreach ($formErrors as $formError): ?>
          <p><?= $formError ?></p>
          <?php endforeach; ?>
      </span>
      <form id="create_libro_form" action="<?= $helper->url('libro','crear');?>" method="post">
        <div class="row">
          <div class="col-25">
            <label class="font_log" for="name">Titulo *</label>
          </div>
          <div class="col-75">
            <input type="text" id="name" name="name" placeholder="Titulo..." required>
          </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label class="font_log" for="author">Autor *</label>
          </div>
          <div class="col-75">
            <input type="text" id="author" name="author" placeholder="Autor..." required>
          </div>
        </div>
         <div class="row">
          <div class="col-25">
            <label class="font_log" for="genre">Genero *</label>
          </div>
          <div class="col-75">
            <input type="text" id="genre" name="genre" placeholder="Genero..." required>
          </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label class="font_log" for="year">Año *</label>
          </div>
          <div class="col-75">
            <input type="text" id="year" name="year" placeholder="Año..." required>
          </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label class="font_log" for="resume">Resumen *</label>
          </div>
          <div class="col-75">
            <textarea  class="font_log" id="resume" name="resume" placeholder="Resumen del libro..."></textarea>
          </div>
        </div>
        <div class="row">
          <input type="submit" value="Crear">
        </div>
      </form>
    </div>
  </div>
</body>
</html>


  