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
  <link rel="stylesheet" href="css/styles.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <link rel="stylesheet" href="css/ie.css">
    <![endif]-->
  <script src="js/responsive-nav.js"></script>
</head>

<body>

  <header>
    <a href="index.php" class="logo" data-scroll>DELIVERY</a>
    <nav class="nav-collapse">
      <ul>
        <li class="menu-item "><a href="index.php" data-scroll>VENDAS</a></li>
        <li class="menu-item active"><a href="produtos.php" data-scroll>PRODUTOS</a></li>
        <li class="menu-item"><a href="pedidos.php" data-scroll>PEDIDOS</a></li>
        <li class="menu-item"><a href="config.php" data-scroll>CONFIGURAÇÕES</a></li>
        <?php
        if ($tipo_cliente == 2) {
          ?>
          <li class="menu-item"><a href="admin.php" data-scroll>ADMIN</a></li>
          <?php
        }
        ?>
        <li class="menu-item"><a href="sair.php" data-scroll>SAIR</a></li>

      </ul>
    </nav>
  </header>

  <section class="d-flex justify-content-around ">
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

   <div class="d-flex">
   <h1 class="display-6 p-5 ">Seus produtos</h1>

   </div>

  </section>
  



  <script src="js/fastclick.js"></script>
  <script src="js/scroll.js"></script>
  <script src="https://kit.fontawesome.com/a7134b8cde.js" crossorigin="anonymous"></script>
  <script src="js/fixed-responsive-nav.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script>
</body>

</html>