<?php
require_once('../php/conn.php');
#########################################################################
#######  VARIAVEIS NECESSARIAS
$numero_get = $_GET['telefone'];
$usuario_get = $_GET['usuario'];
$msg_usuario = $_GET['msg'];
####################################################################
####################### FUNÇÕES


##### DATA E HORA

date_default_timezone_set('America/Sao_Paulo');
$now = time();

$data_hora = date('Y-m-d H:i:s', $now);
#echo $data_hora;

##### FUNÇÃO PRA IDENTIFICAR NUMEROS
function ehNumero($texto)
{
    return is_numeric($texto);
}
##############################################
########## FUNÇÃO LETRA MAIUSCULA

function primeiraLetraMaiuscula($texto)
{
    $primeiraLetra = mb_strtoupper(mb_substr($texto, 0, 1));
    $restante = mb_strtolower(mb_substr($texto, 1));
    return $primeiraLetra . $restante;
}
###########################################################################################

$busca_cliente = "SELECT * FROM clientes WHERE telefone = '$numero_get' AND email_painel = '$usuario_get'";
$cliente = mysqli_query($conn, $busca_cliente);
$total_cliente = mysqli_num_rows($cliente);


while ($dados_cliente = mysqli_fetch_array($cliente)) {
    $id_cliente = $dados_cliente['id_cliente'];
    $telefone_cliente = $dados_cliente['telefone'];
    $nome_cliente = $dados_cliente['nome'];
    $endereco_cliente = $dados_cliente['endereco'];
    $email_painel_cliente = $dados_cliente['email_painel'];
    $situacao_cliente = $dados_cliente['situacao'];


}


## Buscar Login 
<<<<<<< HEAD
$buscar_login = "SELECT * FROM  login WHERE email = '$usuario_get'";
$query = mysqli_query($conn, $buscar_login);
while ($dados_login = mysqli_fetch_array($query)) {
    $id_painel = $dados_login['id'];
    $email_painel = $dados_login['email'];
=======
$buscar_login =  "SELECT * FROM  login WHERE email = '$usuario_get'";
$query = mysqli_query($conn, $buscar_login);
while($dados_login = mysqli_fetch_array($query)) {
    $id_painel = $dados_login['id'];
    $email_painel =  $dados_login['email'];
>>>>>>> 72467b11c510bd13ef988c3d79132eae77167bb3
    $nome_painel = $dados_login['nome'];
    $dinheiro_painel = $dados_login['dinheiro'];
    $pix_painel = $dados_login['pix'];
    $cartao_painel = $dados_login['cartao'];
<<<<<<< HEAD
    $status_painel = $dados_login['status'];

=======
    $status_painel =  $dados_login['status'];
    
>>>>>>> 72467b11c510bd13ef988c3d79132eae77167bb3

}
## FIM BUSCAR LOGIN

## Buscar produtos da tabela produtos
$buscar_produtos = "SELECT * FROM produtos WHERE id_usuario = '$id_painel' ";
<<<<<<< HEAD
$query_buscar_produtos = mysqli_query($conn, $buscar_produtos);
while ($dados_produtos = mysqli_fetch_array($query_buscar_produtos)) {
=======
$query_buscar_produtos = mysqli_query($conn,$buscar_produtos);
while($dados_produtos = mysqli_fetch_array($query_buscar_produtos)){
>>>>>>> 72467b11c510bd13ef988c3d79132eae77167bb3
    $id_produto = $dados_produtos['id_produtos'];
    $nome_produto = $dados_produtos['nome_produto'];
    $quantidade_produto = $dados_produtos['quantidade_produto'];
    $valor_produto = $dados_produtos['valor'];
}


## FIM BUSCAR PRODUTOS 





# Condição para saber se é a primeira vez de contato do cliente com o bot 
if ($total_cliente == 0) {
    $sql = "INSERT INTO clientes (telefone, email_painel )  VALUES ('$numero_get','$usuario_get')";
    $query = mysqli_query($conn, $sql);
    if ($query) {


        $msg = 'Para começar, me diga seu nome 😊';
        $sql = "INSERT INTO envios (telefone, msg , status , usuario) VALUES ('$numero_get','$msg', '1' ,'$usuario_get')";
        $query = mysqli_query($conn, $sql);

    }




}
## FIM PRIMEIRO CONTATO COM CLIENTE

### PREENCHENDO O NOME DO CLINETE

if ($total_cliente == 1 && $nome_cliente == NULL) {

    ## Formatando o nome do usuario 
    $msg_usuario = primeiraLetraMaiuscula($msg_usuario);
    ## Fazendo a querry pra o banco de dados 
    $sql = "UPDATE clientes SET nome = '$msg_usuario '  WHERE  email_painel = '$usuario_get' AND telefone = '$numero_get' ";
    $query = mysqli_query($conn, $sql);
    $msg = "
    Olá! *$msg_usuario* escolha algumas opções abaixo: 
    *(1)* $nome_produto : 
    *(2)* $valor_produto :
    
    ";
    $sql_env = "INSERT INTO envios (telefone, msg, status, usuario) VALUES ('$numero_get', '$msg', '1', '$usuario_get')";
    $query_env = mysqli_query($conn, $sql_env);


}

<<<<<<< HEAD
### FIM PREENCHENDO NOME DO CLIENTE 



if ($total_cliente == 1 && $nome_cliente == True && $situacao_cliente == null) {
    if (ehNumero($msg_usuario)) {
        ##colocando o pedido no carrinho
        switch (ehNumero($msg_usuario)) {
            case 1:
                $status = $nome_produto;
                $sql = "INSERT INTO pedidos ()  VALUES()";
                $query = mysqli_query($conn, $sql);
                if ($query) {
                    $msg = "Quantas quantidades voce deseja ?
                    Por exemplo digite *1* *2* ou *3*, de acordo com a quantidade.
                    ";
                    $sql_env = "INSERT INTO pedidos (id_cliente,nome_cliente, telefone, endereco, email_painel, status) VALUES ('$id_cliente', '$nome_cliente', '$telefone_cliente', '$endereco_cliente', '$email_painel_cliente','$status')";
                    $query_env = mysqli_query($conn, $sql_env);
                }
                if ($query) {
                    $sql = "UPDATE clientes SET situacao = '$status'  WHERE  email_painel = '$usuario_get' AND telefone = '$numero_get' ";
                    $query = mysqli_query($conn, $sql);
                }
                break;
            case 2:
                $status = $nome_produto;
                $sql = "INSERT INTO pedidos ()  VALUES()";
                $query = mysqli_query($conn, $sql);
                if ($query) {
                    $msg = "Quantas quantidades voce deseja ?
                    Por exemplo digite *1* *2* ou *3*, de acordo com a quantidade.
                    ";
                    $sql_env = "INSERT INTO envios (telefone, msg, status, usuario) VALUES ('$numero_get', '$msg', '1', '$usuario_get')";
                    $query_env = mysqli_query($conn, $sql_env);
                }
                if ($query) {
                    $sql = "UPDATE clientes SET situacao = '$status'  WHERE  email_painel = '$usuario_get' AND telefone = '$numero_get' ";
                    $query = mysqli_query($conn, $sql);
                }
                break;
            case !ehNumero($msg_usuario):
                $msg = "
                escolha algumas opções abaixo: 
                *(1)* $nome_produto : 
                *(2)* $valor_produto :

                ";
                $sql_env = "INSERT INTO envios (telefone, msg, status, usuario) VALUES ('$numero_get', '$msg', '1', '$usuario_get')";
                $query_env = mysqli_query($conn, $sql_env);    

                break;
        }
    } 

}
;
=======
### FIM PREENCHENDO NOME DO CLIENTE 
>>>>>>> 72467b11c510bd13ef988c3d79132eae77167bb3
