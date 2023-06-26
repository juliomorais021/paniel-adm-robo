<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <title>DELIVERY</title>
  <meta charset="utf-8">


  <meta name="author" content="Adtile">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">

  <div class="login-page">
    <?php
    if (isset($_SESSION['msg'])) {
      echo $_SESSION['msg'];
      unset($_SESSION['msg']);
    }
    if (isset($_SESSION['msgcad'])) {
      echo $_SESSION['msgcad'];
      unset($_SESSION['msgcad']);
    }
    ?>
    <div class="form">
      <div align="center"><img src="insta.png" height="150" width="150"></div>
      <br>

      <form class="login-form"  action='php/auth.php' method="post" >
        <input type="text" name="email" placeholder="Seu email" required/>
        <input type="password" name="senha"" placeholder="senha" required />
        <button>ENTRAR</button>
        <p class="message">Não tenho conta <a href="cadastro.php">Clica aqui</a></p>
      </form>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script>