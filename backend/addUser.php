<?php

include 'conexao.php';

try{
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirma = $_POST['confirmar'];

    if($senha != $confirma) {

       $retorno = array(
        'retorno'=>'erro',
        'Mensagem'=>'Senhas não conferem, tente novamente');
        $json = json_encode($retorno, JSON_UNESCAPED_UNICODE);

       echo $json;
       exit();

    } 
        $sql = "INSERT INTO tb_login (`nome`, `email`, `senha`) values ('$nome', '$email', '$senha')";

        $comando = $con -> prepare($sql);

        $comando -> execute();

        $retorno = array(
            'retorno'=>'ok',
            'Mensagem'=>'Usuario adc com sucesso!!!'
        );
        $json = json_encode($retorno, JSON_UNESCAPED_UNICODE);

        echo $json;


}catch(PDOException $erro) {
    $retorno = array(
        'retorno' => 'erro',
        'Mensagem'=> $erro->getMessage());
        $json = json_encode($retorno, JSON_UNESCAPED_UNICODE);


        echo $json;
}

?>