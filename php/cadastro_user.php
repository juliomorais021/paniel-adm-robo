<?php
session_start();
require_once('conn.php');
$nome_cliente = addslashes($_POST['nome']);
$senha_cliente = addslashes($_POST['senha']);
$emails_cliente = addslashes($_POST['email']);
$options = [
    'cost' => 10,
];

//verificação se os campos estão nulos.
if (empty($nome_cliente) || empty($senha_cliente) || empty($emails_cliente)) {
    $_SESSION['msg'] = "<div class='alert alert-danger'> por favor, preencha os campos obrigatórios. </div>";
    header("Location: ../cadastro.php");

} else {
      $password_hs = password_hash($senha_cliente, PASSWORD_DEFAULT, $options); // adicionando hash na senha para cadastra no DB.
     // verificar se ja existe email e senha  cadastrado no banco de dados
    // linha 8 > buscar se tem email e nome ja cadastrado no banco de dados
    $buscar = "SELECT * FROM login  WHERE  email = '$emails_cliente' OR nome = '$nome_cliente'  "; // buscando no DB se já existe um email ou uma senha cadastrada.
    $resultado_buscar = mysqli_query($conn, $buscar);
    $total_clientes = mysqli_num_rows($resultado_buscar);

    if ($total_clientes > 0) {
        //fazendo a verificação e retornando algum erro.
        $_SESSION['msg'] = "<div class='alert alert-danger'> Email ou nome já cadastrado</div>";
        header("Location: ../cadastro.php");

    } else {
        //caso não tenha cadastra no DB e redirecinar o usuario.
        $sql = "INSERT INTO login (nome,senha,email,tipo) VALUES ('$nome_cliente','$password_hs','$emails_cliente','1')";
        $query = mysqli_query($conn, $sql);
        $_SESSION['msg'] = "<div class='alert alert-success'> Usuario cadastrado com sucesso !</div>";
        header("Location: ../login.php");
        die();

    }
}



?>