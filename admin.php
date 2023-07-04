<?php
session_start();
require_once('./php/conn.php');
// buscando o tipo de usuario no bando de dados !
if ($_SESSION['email'] == True) {
  $emails_cliente = $_SESSION['email'];
  $buscar_email = "SELECT * FROM login WHERE email = '$emails_cliente'";
  $resultado_busca = mysqli_query($conn, $buscar_email);
  $result = mysqli_num_rows($resultado_busca);
  // fazendo  uma busca e retornando o tipo do usuario e outras informações para restringir a pagina de adm.
  while ($dados_user = mysqli_fetch_array($resultado_busca)) {
    $email_cliente = $dados_user['email'];
    $senha_cliente = $dados_user['senha'];
    $nome_cliente = $dados_user['nome'];
    $tipo_cliente = $dados_user['tipo'];

    if ($tipo_cliente == 1) {
      header("Location: index.php"); // caso caso o usuario não seja adm e force entra na adm sera redirecinado !
    }
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

  <title>PAINEL ADMINISTRATIVO</title>
  <meta charset="utf-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <meta name="author" content="Adtile">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="css/navstyle.css">

  <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <link rel="stylesheet" href="css/ie.css">
    <![endif]-->
  <script src="js/responsive-nav.js"></script>
</head>

<body class="d-flex flex-row justify-content-around align-items-center  flex-lg-row flex-sm-column ">
  <!--- 
  <header>
    <a href="index.php" class="logo" data-scroll>DELIVERY</a>
    <nav class="nav-collapse">
      <ul>
        <li class="menu-item "><a href="index.php" data-scroll>VENDAS</a></li>
        <li class="menu-item"><a href="produtos.php" data-scroll>PRODUTOS</a></li>
        <li class="menu-item"><a href="pedidos.php" data-scroll>PEDIDOS</a></li>
        <li class="menu-item "><a href="config.php" data-scroll>CONFIGURAÇÕES</a></li>
        <li class="menu-item active"><a href="admin.php" data-scroll>ADMIN</a></li>
        <li class="menu-item"><a href="sair.php" data-scroll>SAIR</a></li>

      </ul>
    </nav>
  </header>
  --->

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
              <a class="nav-link " href="index.php">VENDAS</a>
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
              <a class="nav-link active" href="admin.php">ADM</a>
            </li>
            <?php
            }
            ?>

            <li class="nav-item d-flex align-items-center gap-2">
              <i class="fa-solid fa-gear"></i>
              <a class="nav-link" href="config.php">CONFIGURAÇÕES</a>
            </li>
            <li class="nav-item d-flex align-items-center gap-2">
              <i class="fa-solid fa-gear"></i>
              <a class="nav-link" href="sair.php">SAIR</a>
            </li>

            </form>
        </div>
      </div>
    </div>
  </nav>


  <section id="home">
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
      }

      form {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        max-width: 500px;
        margin: 0 auto;
      }

      label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
      }

      input[type="password"] {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        width: 100%;
        margin-top: 5px;
      }

      input[type="submit"] {
        padding: 10px;
        background-color: #4CAF50;
        border: none;
        color: #fff;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 10px;
      }

      input[type="submit"]:hover {
        background-color: #3e8e41;
      }
    </style>

    <style type="text/css">
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body {
        font-family: sans-serif;
        border: solid 1px green;
        height: 100vh;
      }

      .container {
        width: 80%;
        margin: 0 auto;
      }

      /* Mobile first queries */
      @media (max-width: 600px) {
        .container {
          width: 100%;
        }
      }
    </style>
    </head>

    <div class="d-flex  gap-5 ">
      <form method="post" action="">
        <h1>Buscar Usuário</h1>
        <input type="radio" id="opcao_nome" name="opcao_busca" value="nome" checked>
        <label for="opcao_nome">Buscar por nome:</label>
        <input type="text" id="nome_usuario" name="nome_usuario">
        <br>
        <input type="radio" id="opcao_todos" name="opcao_busca" value="todos">
        <label for="opcao_todos">Listar todos:</label>
        <br>
        <input type="submit" value="Buscar">
      </form>
      <br>




      <!-- Formulário de habilitar e desabilitar -->
      <form method="post" action="">
        <h2>Usuário encontrado:</h2>
        <p>Nome: Fulano de Tal</p>
        <p>Email: fulano@example.com</p>
        <p>Status: Ativo</p>
        <label>
          <input type="radio" name="status" value="ativo" checked> Ativar
        </label>
        <label>
          <input type="radio" name="status" value="inativo"> Desativar
        </label>
        <input type="submit" value="Salvar">
      </form>
    </div>



</html>
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



<script src="js/fastclick.js"></script>
<script src="js/scroll.js"></script>
<script src="js/fixed-responsive-nav.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/a7134b8cde.js" crossorigin="anonymous"></script>
</body>

</html>