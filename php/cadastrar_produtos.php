<?php
session_start();
require_once('conn.php');
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
        #### formas de pagamento 
        $dinheiro_cliente = $dados_user['dinheiro'];
        $pix_cliente = $dados_user['dinheiro'];
        $cartao_cliente = $dados_user['dinheiro'];
        $caderneta_cliente = $dados_user['dinheiro'];

    }


} else {
    $_SESSION['msg'] = "<div class='shadow p-3 mb-5 bg-body-tertiary rounded'><div class='alert alert-danger'> Você não está logado ou não tem permissão ! </div></div>";
    header("Location: ./login.php");

}

$adm = 0;

print_r($_REQUEST);


?>

<?php

$nome_produto = addslashes($_POST['nome_produto']);
$quantidade_produto = addslashes($_POST['quantidade_produto']);
$valor_produto = addslashes($_POST['valor_produto']);

if (empty($nome_produto) || empty($quantidade_produto) || empty($valor_produto)) {  //verifianco de os campos estão vazios e redirecionando !
    $_SESSION['msg_produto'] = "<div class='shadow p-3 mb-5 bg-body-tertiary rounded'><div class='alert alert-danger'> Não deixe os campos vazios ! </div></div>";
    header("Location: ../produtos.php");

} else {
    //fazendo uma query no DB para cadastrar novos produtos.
    $sql = "INSERT INTO produtos (id_usuario,nome_produto,quantidade_produto,valor) VALUES ('$id_usuario','$nome_produto','$quantidade_produto','R$: $valor_produto')";
    $query = mysqli_query($conn, $sql);
    $_SESSION['msg_produto'] = "<div class='shadow p-3 mb-5 bg-body-tertiary rounded'><div class='alert alert-success'> Produto cadastrado com sucesso ! </div></div>";
    header("Location: ../produtos.php");
}


?>