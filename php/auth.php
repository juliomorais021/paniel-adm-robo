<?php
session_start();
require_once('conn.php');
$email_cliente = addslashes($_POST['email']);
$senha_cliente = addslashes($_POST['senha']);
// verificar se os campos estão nulos
if (empty($email_cliente) || empty($senha_cliente)) {
    $_SESSION['msg'] = "<div class='alert alert-danger'> por favor, preencha os campos obrigatórios. </div>";
    header("Location: ../login.php");
} else {

    //verificar se já existe um usuario no banco de dados 

    $buscar = "SELECT * FROM login  WHERE  email = '$email_cliente'"; // buscando no DB se já existe um email ou uma senha cadastrada.
    $resultado_busca = mysqli_query($conn, $buscar);
    $total_clientes = mysqli_num_rows($resultado_busca);
    if ($total_clientes == 1) {
        $row = mysqli_fetch_assoc($resultado_busca);
        $senha_db = $row['senha'];
        if (password_verify($senha_cliente, $senha_db)) {
            
            header("Location: ../index.php");
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'> Email ou senha incorretas ou não cadastradas ! </div>";
            header("Location: ../login.php");
        }

    } else {
        $_SESSION['msg'] = "<div class='alert alert-danger'> usuario nao encontrado ou não cadastrado ! </div>";
        header("Location: ../login.php");
        die();
    }


}


?>