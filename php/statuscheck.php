<?php
session_start();
require_once('conn.php');
// buscando o tipo de usuario no bando de dados !
if ($_SESSION['email'] == True) {
    $emails_cliente = $_SESSION['email'];
    $buscar_email = "SELECT * FROM login WHERE email = '$emails_cliente'";
    $resultado_busca = mysqli_query($conn, $buscar_email);
    $result = mysqli_num_rows($resultado_busca);
    // fazendo  uma busca e retornando o tipo do usuario e outras informações para restringir a pagina de adm.
    while ($dados_user = mysqli_fetch_array($resultado_busca)) {
        $id_user = $dados_user['id'];
        $email_cliente = $dados_user['email'];
        $senha_cliente = $dados_user['senha'];
        $nome_cliente = $dados_user['nome'];
        $tipo_cliente = $dados_user['tipo'];

        if ($tipo_cliente == 1) {
            header("Location: index.php"); // caso caso o usuario não seja adm e force entra na adm sera redirecinado !
        }
    }

} else {
    $_SESSION['msg'] = "<div class='shadow p-3 mb-5 bg-body-tertiary rounded'><div class='alert alert-danger'> Você não está logado ou não tem permissão ! </div></div>";
    header("Location: ./login.php");
}

$adm = 0;

?>
<?php
$id_usuario = $_POST['id_usuario'];
$status = $_POST['status'];

$sql = "UPDATE login SET status = '$status' WHERE id='$id_usuario'";
$query = mysqli_query($conn,$sql);
if(!$query){
    echo "não foi possivel !";
}else{
    header("Location: ../admin.php");

}



?>