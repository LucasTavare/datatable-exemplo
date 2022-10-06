<?php

include 'function.php';

try{

    $carac = array('(',')','-',' ','.');

    $nome = $_POST['edita-nome'];
    $email = $_POST['edita-email'];
    $senha = $_POST['edita-senha'];
    $confirma = $_POST['edita-confirmar'];
    $telefone = str_replace($carac,"",$_POST['edita-telefone']);
    $cpf = str_replace($carac,"",$_POST['edita-cpf']);

    validaCampoVazio($nome,'nome');
    validaCampoVazio($email,'email');
    validaCampoVazio($senha,'senha');
    validaCampoVazio($confirma,'confirma');
    validaCampoVazio($cpf,'cpf');
    validaCampoVazio($telefone,'telefone');

    if($senha != $confirma) {

       $retorno = array(
        'retorno'=>'erro',
        'Mensagem'=>'Senhas não conferem, tente novamente');
        $json = json_encode($retorno, JSON_UNESCAPED_UNICODE);

       echo $json;
       exit();

    } 

    $senha_cripto = sha1($senha);
    


        $sql = "UPDATE tb_login (`nome`, `email`, `senha`,`telefone`,`cpf`) values ('$nome', '$email', '$senha_cripto','$telefone','$cpf')";
        
        $msg = "usuario adc";

        addUpdDel($sql,$msg);

}catch(PDOException $erro) {
    pdocatch($erro);
}

?>