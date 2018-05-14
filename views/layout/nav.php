<nav>
   <ul>
	  	<li><a href="<?= $helper->url('libro','index');?>">LIBROS DISPONIBLES</a></li>
	  	<li><a href="<?= $helper->url('libro','todos');?>">TODOS LOS LIBROS</a></li>
	  	<li><a href="<?= $helper->url('libro','mis_prestamos');?>">MIS PRESTAMOS</a></li>
	  	<?php if($helper->isAdmin()): ?>
	  		<li><a href="<?= $helper->url('libro','reservados');?>">LIBROS RESERVADOS</a></li>
	  		<li><a href="<?= $helper->url('libro','todos_prestamos');?>">TODOS LOS PRESTAMOS</a></li>
	  		<li><a href="<?= $helper->url('libro','crear');?>">AÑADIR LIBRO</a></li>
		<?php endif; ?>
	</ul>
</nav>
