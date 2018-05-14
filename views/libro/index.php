<!DOCTYPE html>
<html lang="es">

<head>
  <title>
    Inicio
  </title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <?php require('views/layout/header.php'); ?>
  <?php include('views/layout/nav.php'); ?>
  <div class="container">
    <div id="contenido">
    	<h1>Libros disponibles</h1>
      	<!--Table-->
		<table class="table table-bordered">

		    <!--Table head-->
		    <thead>
		        <tr>
		        	<th>#</th>
		            <th>Nombre</th>
		            <th>Autor</th>
		            <th>Genero</th>
		            <th>Año</th>
		            <th>Resumen</th>
		            <th>Acciones</th>
		        </tr>
		    </thead>
		  	<!--Table head-->

		    <!--Table body-->
		    <tbody>
		    	
		    	<?php foreach ($libros as $key => $libro): ?>

		        <tr class="success">
		        	<th scope="row"><?= $key ?></th>
		            <td><?= $libro['name'] ?></td>
		            <td><?= $libro['author'] ?></td>
		            <td><?= $libro['genre'] ?></td>
		            <td><?= $libro['year'] ?></td>
		            <td><?= $libro['resume'] ?></td>
		            <td class="text-center">
		            	<form method="POST" action="<?= $helper->url('libro','reservar');?>">
		            		<input type="hidden" name="libro_id" value="<?= $libro['id'] ?>">
		            		<button class="btn btn-success" type="submit">Reservar</button>
		            	</form>
		            </td>
		        </tr>

		    	<?php endforeach; ?>
		    </tbody>
		    <!--Table body-->

		</table>
		<!--Table-->
  </div>
</body>
</html>
