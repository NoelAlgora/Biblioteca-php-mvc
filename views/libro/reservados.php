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
    	<h1>Libros reservados</h1>
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
		            <th>Fecha Inicio</th>
		            <th>Fecha Fin</th>
		            <th>Estado</th>
		            <th>Usuario</th>
		            <th>Acciones</th>
		        </tr>
		    </thead>
		  	<!--Table head-->

		    <!--Table body-->
		    <tbody>
		    	
		    	<?php foreach ($libros as $key => $libro): ?>

		        <tr class="danger">
		        	<th scope="row"><?= $key ?></th>
		            <td><?= $libro['name'] ?></td>
		            <td><?= $libro['author'] ?></td>
		            <td><?= $libro['genre'] ?></td>
		            <td><?= $libro['year'] ?></td>
		            <td><?= $libro['date_start'] ?></td>
		            <td><?= $libro['date_end'] ?></td>
		            <td><?= ($libro['status'] == 0) ? "RESERVADO" : "DISPONIBLE" ?></td>
					<td><?= DaoUsuario::getInstance()->getById($libro['user_id'])['email'] ?></td>
		            <td class="text-center">
		            	<?php if($libro['status'] == 0): ?>
		            	<form method="POST" action="<?= $helper->url('libro','devolver');?>">
		            		<input type="hidden" name="prestamo_id" value="<?= $libro['prestamo_id'] ?>">
		            		<button class="btn btn-success" type="submit">Devolver</button>
		            	</form>
		            	<?php endif; ?>
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
