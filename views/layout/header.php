<header>
  <div class="container">
    <h1 class="text-center title">BIBLIOTECA ABD</h1>
    <div class="saludo">
      <?php
        if ( $helper->isUserLogged() ){
          echo "<p>Usuario: " . $helper->getLoggedUser()['name'] ."</p>";
          echo "<p><a href=" . $helper->url('user','logout') .">Log out</a></p>";
        }
        else {
          echo "<p>Usuario desconocido</p>";
          echo "<p><a href=".$helper->url('user','login').">Login</a></p>";
        }
      ?>
    </div>
  </div>
</header>
