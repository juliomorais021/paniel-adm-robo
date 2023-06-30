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
  <link rel="stylesheet" href="css/styles.css">
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
        <li class="menu-item active"><a href="index.php" data-scroll>VENDAS</a></li>
        <li class="menu-item"><a href="produtos.php" data-scroll>PRODUTOS</a></li>
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

    <body>
      <form>
        <h1>Detalhes da venda</h1>
        <table>
          <tr>
            <td>Produto:</td>
            <td>Produto A</td>
          </tr>
          <tr>
            <td>Data:</td>
            <td>01/01/2022</td>
          </tr>
          <tr>
            <td>Hora:</td>
            <td>14:30</td>
          </tr>
          <tr>
            <td>Valor:</td>
            <td>R$ 50,00</td>
          </tr>
        </table>
      </form>
    </body>

</html>
</section>



<script src="js/fastclick.js"></script>
<script src="js/scroll.js"></script>
<script src="js/fixed-responsive-nav.js"></script>
</body>

</html>