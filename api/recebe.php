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

echo $total_cliente;

while ($dados_cliente = mysqli_fetch_array($cliente)) {
    $id_cliente = $dados_cliente['id_cliente'];
    $telefone_cliente = $dados_cliente['telefone'];
    $nome_cliente = $dados_cliente['nome'];
    $endereco_cliente = $dados_cliente['endereco'];
    $email_painel_cliente = $dados_cliente['email_painel'];
    $situacao_cliente = $dados_cliente['situacao'];


}


## Buscar Login 

$buscar_login =  "SELECT * FROM  login WHERE email = '$usuario_get'";
$query = mysqli_query($conn, $buscar_login);
while($dados_login = mysqli_fetch_array($query)) {
    $email_painel =  $dados_login['email'];
    $nome_painel = $dados_login['nome'];
    $dinheiro_painel = $dados_login['dinheiro'];
    $pix_painel = $dados_login['pix'];
    $cartao_painel = $dados_login['cartao'];
    $status_painel =  $dados_login['status'];



}



## FIM BUSCAR LOGIN



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
    Olá! *$msg_usuario* Bem-vindo ao serviço de atendimento ao cliente de Morais e Advogados Associados. Como podemos ajudar você hoje? Por favor, selecione uma das opções abaixo:
    *(1)*. Consulta jurídica gratuita:: 📚
    *(2)*. Agendar uma reunião com um advogado: 📅
    *(3)*. Informações sobre nossos serviços legais: ℹ️
    *(4)*. Falar com um representante de atendimento ao cliente: 💬
    *(5)*. Nossos escritórios e localizações: 🏢
    *(6*). Horário de funcionamento: 🕒

    Para selecionar uma opção, basta responder com o número correspondente. Se você deseja voltar ao menu principal, basta digitar  a qualquer momento. Obrigado por escolher Morais e Advogados Associados.";

    $sql_env = "INSERT INTO envios (telefone, msg, status, usuario) VALUES ('$numero_get', '$msg', '1', '$usuario_get')";
    $query_env = mysqli_query($conn, $sql_env);


}

### FIM PREENCHENDO NOME DO CLIENTE 