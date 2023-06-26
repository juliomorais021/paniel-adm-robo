<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <title>CADASTRO USUARIO</title>

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
      <form action="php/cadastro_user.php" method="post" class="login-form" onsubmit="return verificaSenhas() ">
        <input type="text" placeholder="NOME" name="nome" />
        <input type="password" id="senha" name="senha" placeholder="SENHA" required>
        <input type="password" id="confirmar_senha" placeholder="CONFIRMAR SENHA" name="confirmar_senha" required>
        <input type="text" placeholder="EMAIL" name="email" />
        <button>Criar Conta</button>
        <p class="message">Já é registrado <a href="login.php">entre aqui</a></p>
      </form>

      <script>
        function verificaSenhas() {
          var senha = document.getElementById("senha").value;
          var confirmar_senha = document.getElementById("confirmar_senha").value;

          if (senha != confirmar_senha) {
            alert("As senhas não são iguais!");
            return false;
          }

          return true;
        }
      </script>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script>