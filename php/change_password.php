<?php 
session_start();
require_once('conn.php');
$new_senha_cliente = addslashes($_POST['senha']); 
$confirm_Password = addslashes($_POST['confirmar_senha']); 
$options = [
    'cost' => 10,
];


if(empty($new_senha_cliente)){
    $_SESSION['msg'] = "<div class='shadow p-3 mb-5 bg-body-tertiary rounded'><div class='alert alert-danger'> Não deixe os campos vazios ! </div></div>";  //verificação dos campos se não estão vazios !
    header("Location: ../config.php");
}else{
    $password_hs = password_hash($new_senha_cliente, PASSWORD_DEFAULT, $options);  //cadastras nova senha com hash no banco de dados .
    $sql = "UPDATE login SET senha = '$password_hs'";
    $query = mysqli_query($conn,$sql);  
    $_SESSION['msg'] = "<div class='shadow p-3 mb-5 bg-body-tertiary rounded'><div class='alert alert-success'> Senha alterada com sucesso !. </div></div>";
    
    header("Location: ../config.php");
}

?>