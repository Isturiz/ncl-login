<?php

  require 'database.php';

  $message = '';
      
  if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])) {
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);

    if ($stmt->execute()) {
      $message = 'Successfully created new user';
    } else {
      $message = 'Sorry there must have been an issue creating your account';
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>SignUp</title>
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>

    <?php require 'complementos/header.php' ?>
  
    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>SignUp</h1>
    <span>or <a href="login.php">Login</a></span> 

    <form action="signup.php" method="POST">
      <input name="email" type="text" placeholder="Enter your email" required>
      <input name="password" type="password" placeholder="Enter your Password" required>
      <input name="confirm_password" type="password" placeholder="Confirm Password" required>
      <input type="submit" value="Submit">
    </form>

  </body>
</html>
