<?php
session_start();
require_once('./php/conn.php');
//verificar se o usuario está logado na sessao caso não esteja redirecionar para a pagina de login navamente.
if ($_SESSION['email'] == True) {
  $emails_cliente = $_SESSION['email'];
  $buscar_email = "SELECT * FROM login WHERE email = '$emails_cliente'";
  $resultado_busca = mysqli_query($conn, $buscar_email);
  $result = mysqli_num_rows($resultado_busca);

  while ($dados_user = mysqli_fetch_array($resultado_busca)) {
    $email_cliente = $dados_user['email'];
    $senha_cliente = $dados_user['senha'];
    $nome_cliente = $dados_user['nome'];
    $tipo_cliente = $dados_user['tipo'];
  }

} else {
  $_SESSION['msg'] = "<div class='shadow p-3 mb-5 bg-body-tertiary rounded'><div class='alert alert-danger'> Você não está logado ou não tem permissão ! </div></div>";
  header("Location: ./login.php");
}


$adm = 0;

?>

<!DOCTYPE html>
<html lang="pt">

<head>
  <meta name="author" content="Adtile">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body class="d-flex flex-row justify-content-around gap-4">

  <nav class="navbar navbar-dark  fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">PAINEL ADM</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar"
        aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
        aria-labelledby="offcanvasDarkNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Menu</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item d-flex align-items-center gap-2 ">
              <i class="fa-solid fa-cart-shopping"></i>
              <a class="nav-link active" href="index.php">VENDAS</a>
            </li>
            <li class="nav-item d-flex align-items-center gap-2">
              <i class="fa-solid fa-box"></i>
              <a class="nav-link" href="produtos.php">PRODUTOS</a>
            </li>
            <li class="nav-item d-flex align-items-center gap-2 ">
              <i class="fa-regular fa-clipboard"></i>
              <a class="nav-link" href="pedidos.php">PEDIDOS</a>
            </li>
            <?php
            if ($tipo_cliente == 2) {
              ?>
            <li class="nav-item d-flex align-items-center gap-2">
              <i class="fa-solid fa-user"></i>
              <a class="nav-link " href="admin.php">ADM</a>
            </li>
            <?php
            }
            ?>

            <li class="nav-item d-flex align-items-center gap-2">
              <i class="fa-solid fa-gear"></i>
              <a class="nav-link" href="config.php">CONFIGURAÇÕES</a>
            </li>
            <li class="nav-item d-flex align-items-center gap-2">
              <i class="fa-solid fa-right-from-bracket"></i>
              <a class="nav-link" href="sair.php">SAIR</a>
            </li>

            </form>
        </div>
      </div>
    </div>
  </nav>


  <section class="d-flex flex-row justify-content-around gap-4 mt-5 flex-wrap mb-5" id="home">

    <style>
      @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      nav {
        background-color: #253a44;
      }

      body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        min-height: 100vh;
        margin-top: 80px;
        font-family: 'Poppins', sans-serif;
      }

      form {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        max-width: 500px;

      }

      h1 {
        margin-bottom: 10px;
      }

      table {
        width: 100%;
        margin-top: 10px;
        border-collapse: collapse;
      }

      th,
      td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
      }

      th {
        background-color: #eee;
      }

      td:first-child {
        font-weight: bold;
      }
    </style>
    </head>


    <?php

    $buscar_pedidos = "SELECT * FROM pedidos WHERE sataus_pedido = 'recusado' AND email_painel = '$emails_cliente' ";
    $resultado_pedidos = mysqli_query($conn, $buscar_pedidos);
    $result_pedidos = mysqli_num_rows($resultado_pedidos);

    while ($dados_pedidos = mysqli_fetch_array($resultado_pedidos)) {
      $nome = $dados_pedidos['nome_cliente'];
      $produto = $dados_pedidos['produto'];
      $data_hora = $dados_pedidos['data_hora'];
      $valor = $dados_pedidos['valor'];
      $telefone = $dados_pedidos['telefone'];
      $pagamento = $dados_pedidos['forma_pagamento'];

      ?>
    <div>
    <form>
      <h1>Detalhes da venda</h1>
      <table>
        <tr>
          <td>Nome cliente</td>
          <td>
            <?php echo $nome; ?>
          </td>
        </tr>
        <tr>
          <td>Telefone</td>
          <td>
            <?php echo $telefone; ?>
          </td>
        </tr>
        <tr>
          <td>Produto:</td>
          <td>
            <?php echo $produto; ?>
          </td>
        </tr>
        <tr>
          <td>Data:</td>
          <td>
            <?php echo $data_brasil = date('d/m/Y', strtotime($data_hora)); ?>
          </td>
        </tr>
        <tr>
          <td>Hora:</td>
          <td> <?php echo $data_brasil = date('H:i:s', strtotime($data_hora)); ?></td>
        </tr>
        <tr>
          <td>Valor:</td>
          <td>
            <?php echo $valor; ?>
         
          </td>
        </tr>
        <tr>
          <td>Pagamento:</td>
          <td>
            <?php echo $pagamento; ?>
          </td>
        </tr>
      </table>
    </form>
    </div>
    
    <?php
    }

    ?>


</html>
</section>



<script src="https://kit.fontawesome.com/a7134b8cde.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>