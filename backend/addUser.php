<?php

include 'backend/conexao.php';

try{
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirma = $_POST['confirmar'];

    if($senha != $confirma) {

       $retorno = array('Mensagem'=>'Senhas não conferem, tente novamente');
       $json = json_encode($json, JSON_UNESCAPED_UNICODE);

       echo $json;
       exit()

    } else {
        $sql = "INSERT INTO tb_login(`nome`, `email`, `senha`) values ('$nome', '$email', '$senha')";

        $comando = $con -> prepare($sql);

        $comando -> execute();

        $null;
    }

    


}catch(PDOException $erro) {
    echo $erro -> getMessage();

}

?>