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




?>
<?php
$id = addslashes($_POST['id']);
$sql = "UPDATE pedidos SET  sataus_pedido = 'recusado'  WHERE  id_pedidos = '$id' ";
$query = mysqli_query($conn, $sql);
if(!$query){
    echo "não foi possivel aceitar o pedido !";
}else{
    
    header("Location: ../pedidos.php");
}


?>