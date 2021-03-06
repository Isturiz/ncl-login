<?php

  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: /ncl-login');
  }
  require 'database.php';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
      $_SESSION['user_id'] = $results['id'];
      header("Location: /ncl-login");
    } else {
      $message = 'Sorry, those credentials do not match';
    }
  } 
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Niños Cantores de Lara</title>
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
    <?php require 'complementos/header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Iniciar sesión</h1>
    <span>o <a href="signup.php">Registrar</a></span>

    <form action="login.php" method="POST">
      <input name="email" type="text" placeholder="Correo electrónico">
      <input name="password" type="password" placeholder="Contraseña">
      <input type="submit" value="Ingresar">
    </form>
  </body>
</html>
