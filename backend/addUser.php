<?php

include 'function.php';

try{
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirma = $_POST['confirmar'];

    validaCampoVazio($nome,'nome');
    validaCampoVazio($email,'email');
    validaCampoVazio($senha,'senha');
    validaCampoVazio($confirma,'confirma');


    if($senha != $confirma) {

       $retorno = array(
        'retorno'=>'erro',
        'Mensagem'=>'Senhas não conferem, tente novamente');
        $json = json_encode($retorno, JSON_UNESCAPED_UNICODE);

       echo $json;
       exit();

    } 
        $sql = "INSERT INTO tb_login (`nome`, `email`, `senha`) values ('$nome', '$email', '$senha')";
        
        $msg = "usuario adc";

        addUpdDel($sql,$msg);

}catch(PDOException $erro) {
    pdocatch($erro);
}

?>