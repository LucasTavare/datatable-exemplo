<?php

include 'conexao.php';

try{

    $id = $_POST['id'];

        $sql = "UPDATE tb_login SET ativo = NOT ativo WHERE id = $id";

        $comando = $con -> prepare($sql);

        $comando -> execute();

        $retorno = array(
            'retorno'=>'ok',
            'Mensagem'=>'Usuario alterado com sucesso!!!'
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