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
    $id_usuario = $dados_user['id'];
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

<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

  span {
    font-family: 'Poppins', sans-serif;
  }

  th {
    font-family: 'Poppins', sans-serif;
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

  .backgound-div-table {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    max-width: 500px;

  }

  table {
    width: 100%;
  }

  th,
  td {
    padding: 10px;
    text-align: left;
  }

  th {
    background-color: #eee;
  }

  input[type="text"] {
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

<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="utf-8">
  <title>DELIVERY</title>
  <meta name="author" content="Adtile">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body class="d-flex  align-items-center justify-content-around gap-4 " >

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
              <a class="nav-link active" href="produtos.php">PRODUTOS</a>
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



  <section class="d-flex    gap-5  ">
    <div class="d-flex">
    <form method="post" action="php/cadastrar_produtos.php" class="">
      <?php
      if (isset($_SESSION['msg_produto'])) {
        echo $_SESSION['msg_produto'];
        unset($_SESSION['msg_produto']);
      }
      if (isset($_SESSION['msg_produto'])) {
        echo $_SESSION['msg_produto'];
        unset($_SESSION['msg_produto']);
      }
      ?>
      <h1 class="display-6 p-5 ">Cadastrar Produtos</h1>
      <div class="d-flex flex-column p-3 gap-2 ">
        <i class="fa-solid fa-box" style="color: #6f6d6d;"></i>
        <span class="">Nome produto</span>
        <input type="text" name="nome_produto">
        <i class="fa-solid fa-boxes-stacked" style="color: #6f6d6d;"></i>
        <span>Quantidade </span>
        <input type="text" name="quantidade_produto">
        <i class="fa-solid fa-hand-holding-dollar" style="color: #6f6d6d;"></i>
        <span>Valor</span>
        <input type="text" name="valor_produto">
        <div class=" d-flex gap-2 flex-column mb-3 ">
          <i class="fa-regular fa-image" style="color: #6f6d6d;"></i>
          <span>Imagem do produto</span>
          <input class="form-control" type="file" id="formFile">
        </div>
        <button class="btn btn-primary">Cadastrar</button>
      </div>
    </form>
    </div>
    <?php
    // buscar produtos
    $buscar_produtos = "SELECT * FROM produtos  WHERE id_usuario = '$id_usuario' ";
    $resultado_busca_produtos = mysqli_query($conn, $buscar_produtos);
    // listar produtos 
    while ($dados_user_produtos = mysqli_fetch_array($resultado_busca_produtos)) {
      $id_produto = $dados_user_produtos['id_produtos'];
      $db_id_user = $dados_user_produtos['id_usuario'];
      $nome_produto = $dados_user_produtos['nome_produto'];
      $quantidade_produto = $dados_user_produtos['quantidade_produto'];
      $valor = $dados_user_produtos['valor'];
    }
    ?>
   <div class="d-flex"">
    <div class="d-flex flex-column backgound-div-table">
      <h1 class="display-6 p-5 ">Seus produtos</h1>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">id produto</th>
            <th scope="col">Nome</th>
            <th scope="col">Quantidade</th>
            <th scope="col">Preço</th>
            <th scope="col">....</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql_table = "SELECT * FROM produtos  WHERE id_usuario = '$id_usuario' ";
          $resultado = mysqli_query($conn, $sql_table);
          while ($dados = mysqli_fetch_assoc($resultado)) { // usando o while para renderizar em tempo real os dados da tabela.
            echo "<tr>";
            echo "<td>" . $dados['id_produtos'] . "</td>";
            echo "<td>" . $dados['nome_produto'] . "</td>";
            echo "<td>" . $dados['quantidade_produto'] . "</td>";
            echo "<td>" . $dados['valor'] . "</td>";
            //colocando para renderizar o icone de delete.
            echo "<td> 
            <a class='btn btn-sm btn-danger' href='./php/delete.php?id=$dados[id_produtos]'> 
            <i class='fa-solid fa-trash-can'></i> 
            </a>
            </td>";
            echo "</tr>";
          }

          ?>
        </tbody>
      </table>

    </div>
    </div>

  </section>

  <script src="https://kit.fontawesome.com/a7134b8cde.js" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/a7134b8cde.js" crossorigin="anonymous"></script>
  <script src="js/fixed-responsive-nav.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script>
</body>

</html>