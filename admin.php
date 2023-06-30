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

    if($tipo_cliente == 1){
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

  <title>DELIVERY</title>
  <meta charset="utf-8">


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
        <li class="menu-item "><a href="index.php" data-scroll>VENDAS</a></li>
        <li class="menu-item"><a href="produtos.php" data-scroll>PRODUTOS</a></li>
        <li class="menu-item"><a href="pedidos.php" data-scroll>PEDIDOS</a></li>
        <li class="menu-item "><a href="config.php" data-scroll>CONFIGURAÇÕES</a></li>
        <li class="menu-item active"><a href="admin.php" data-scroll>ADMIN</a></li>
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

    <body>
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

    </body>

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
</body>

</html>