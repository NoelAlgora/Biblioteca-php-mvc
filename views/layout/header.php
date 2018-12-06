<header>
  <div class="container">
    <h1 class="text-center title">BIBLIOTECA ABD</h1>
    <div class="saludo">
      <?php if ( $helper->isUserLogged() ): ?>
        <p>Usuario: <?= $helper->getLoggedUser()['name']  ?></p>
        <p><a href="<?= $helper->url('user','logout')?>">Log out</a></p>
      <?php else: ?>
        <p>Usuario desconocido</p>
        <p><a href="<?=$helper->url('user','login')?>">Login</a></p>
      <?php endif;?>
    </div>
  </div>
</header>
