<!-- Cabecera al iniciar sesión -->

<nav>
	<?php

	session_start(); 
	echo "Usuario: ".$user['email']; 

  ?>

	<a class="nav-link" href="logout.php">Salir</a>
</nav>