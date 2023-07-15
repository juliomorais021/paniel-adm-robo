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

<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }


  form {
    background-color: #8b8b8b;
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

  tr:nth-child(odd) {
    background-color: #f2f2f2;
  }

  tr:nth-child(even) {
    background-color: #d9d9d9;
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

  .recusar-btn {
    background-color: #ff0000;
    color: #fff;
  }
</style>
<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="utf-8">
  <title>DELIVERY</title>
  <meta name="author" content="Adtile">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="css/styles.css">
  <script src="js/responsive-nav.js"></script>
</head>

<body class="d-flex justify-content-around align-items-center flex-wrap">
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
              <a class="nav-link active" href="pedidos.php">PEDIDOS</a>
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
              <a class="nav-link " href="config.php">CONFIGURAÇÕES</a>
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




  <?php
  $buscar_pedidos = "SELECT * FROM pedidos WHERE sataus_pedido = 'aguardando' AND email__painel = '$emails_cliente' ";
  $resultado_pedidos = mysqli_query($conn, $buscar_pedidos);
  $result_pedidos = mysqli_num_rows($resultado_pedidos);
  while ($dados_pedido = mysqli_fetch_array($resultado_pedidos)) {
    $id_pedido = $dados_pedido['id_pedidos'];
    $forma_pagamento = $dados_pedido['forma_pagamento'];
    $produto = $dados_pedido['produto'];
    // $quantidade = $dados_pedido['quantidade_produto'];
    $cliente = $dados_pedido['nome_cliente'];
    $endereco = $dados_pedido['endereco'];
    $pagamento = $dados_pedido['forma_pagamento'];
    $telefone = $dados_pedido['telefone'];


    ?>
    <form method="post" action="">
      <div class="card" style="width: 18rem;">
        <img
          src="https://copias.supermidiapf.com.br/wp-content/uploads/sites/4/bloco-de-pedidos-passo-fundo-super-copias-grafica-digital/Bloco-de-Pedidos-Gr%C3%A1fica-Digital-Passo-Fundo-Super-C%C3%B3pias-300x225-2.png"
          class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Novo Pedido !</h5>
          <h5 class="card-title">Pedido:</h5>
          <p class="card-text">
            <?php echo $produto; ?>
          </p>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Cliente:
            <?php echo $cliente; ?>
          </li>
          <li class="list-group-item">Endereço:
            <?php echo $endereco; ?>
          </li>
          <li class="list-group-item">Pagamento:
            <?php echo $pagamento; ?>
          </li>
          <li class="list-group-item">Telefone:
            <?php echo $telefone; ?>
          </li>
        </ul>
        <div class="card-body ">
          <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $id_pedido;?>">
            <button name="aceitar" class="btn btn-success"  value="aceitar"" formaction="php/aceitar.php">Aceitar
              </but<button>
              <button name="recusar" class="btn btn-danger" value="recusar" formaction="php/recusar.php">Recusar</button>
          </form>

        </div>
      </div>
    </form>


    <!--
    <form id="form1" name="form1" method="post" action="">
      <h1> Novo pedido !</h1>
      <div>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Produto</th>
              <th scope="col">Cliente</th>
              <th scope="col">Endereço</th>
              <th scope="col">Pagamento</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>
                <?php echo $produto ?>
              </td>
              <td>
                <?php echo $cliente ?>
              </td>
              <td>
                <?php echo $endereco ?>
              </td>
              <td>
                <?php echo $pagamento ?>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="d-flex flex-column  gap-2">
        <button type="button" class="btn btn-success">Aceitar</but<button>
          <button type="button" class="btn btn-danger">Recusar</button>
      </div>
    </form>
  -->

    <?php
  }

  ?>





  <script src="https://kit.fontawesome.com/a7134b8cde.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script>

</body>

</html>