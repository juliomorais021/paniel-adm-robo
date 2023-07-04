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
  <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <link rel="stylesheet" href="css/ie.css">
    <![endif]-->
  <script src="js/responsive-nav.js"></script>
</head>

<body>
  <!--
  <header>
    <a href="index.php" class="logo" data-scroll>DELIVERY</a>
    <nav class="nav-collapse">
      <ul>
        <li class="menu-item "><a href="index.php" data-scroll>VENDAS</a></li>
        <li class="menu-item "><a href="produtos.php" data-scroll>PRODUTOS</a></li>
        <li class="menu-item active"><a href="pedidos.php" data-scroll>PEDIDOS</a></li>
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
      -->
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


  <section id="home">

    <body>
      <div align='center'>
        <form id="form1" name="form1" method="post" action="">
          <table width="80%" border="0">
            <tr>
              <td colspan="2">
                <div align="center">
                  <H1>NOVO PEDIDO</H1>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <div align="center"><b>PRODUTO</b></div>
              </td>
              <td>
                <div align="center"><b>QUANTIDADE</b></div>
              </td>
            </tr>
            <tr>
              <td><br>
                <div align="center">GÁS</div>
              </td>
              <td>
                <div align="center">1</div>
              </td>
            </tr>
            <tr>
              <td><br>
                <div align="center">ÁGUA</div>
              </td>
              <td>
                <div align="center">1</div>
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <div align="center"><b>CLIENTE:</b></div>
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <div align="center">31 984767330 - Victor</div>
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <div align="center"><b>ENDEREÇO<b></div>
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <div align="center">RUA ENDEREÇO EXEMPO....</div>
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <div align="center"><b>FORMA DE PAGAMENTO<b></div>
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <div align="center">PAGAMENTO MODELO</div>
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>
                <label>
                  <div align="center">
                    <input type="submit" name="button" id="button" value="ACEITAR" formaction="aceitar.php" />
                  </div>
                </label>
              </td>
              <td>
                <label>
                  <div align="center">
                    <button style="background-color: red;">
                      <a href="recusar.php" style="text-decoration: none; color: white;">
                        <h2>Recusar</h2>
                      </a>
                    </button>
                  </div>
                </label>
              </td>
            </tr>
          </table>
        </form>

      </div>
  </section>



  <script src="js/fastclick.js"></script>
  <script src="js/scroll.js"></script>
  <script src="https://kit.fontawesome.com/a7134b8cde.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script>
  <script src="js/fixed-responsive-nav.js"></script>
</body>

</html>