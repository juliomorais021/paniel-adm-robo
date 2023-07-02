<?php 
session_start();
require_once('conn.php');
//verificar se o usuario está logado na sessao caso não esteja redirecionar para a pagina de login navamente.
if ($_SESSION['email'] == True) {
    $emails_cliente = $_SESSION['email'];
    $buscar_email = "SELECT * FROM login WHERE email = '$emails_cliente'";
    $resultado_busca = mysqli_query($conn, $buscar_email);
    $result = mysqli_num_rows($resultado_busca);

} else {
    $_SESSION['msg'] = "<div class='shadow p-3 mb-5 bg-body-tertiary rounded'><div class='alert alert-danger'> Você não está logado ou não tem permissão ! </div></div>";
    header("Location: ../login.php");

}

$adm = 0;
?>
<?php 
  // pegando o id na ulr de cada  produto e deletando no DB.
 $id_produto = $_GET['id']; 
 $sql = "DELETE  FROM produtos WHERE id_produtos = '$id_produto' ";
 $query = mysqli_query($conn, $sql);
 header("Location: ../produtos.php");

?>
