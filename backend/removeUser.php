<?php

include 'conexao.php';

try{
    $id = $_POST['id'];

    $sql = "DELETE FROM tb_login WHERE id = $id ";

    $comando = $con -> prepare($sql);

        $comando -> execute();

        $retorno = array(
            'retorno'=> 'ok',
            'Mensagem'=>'Usuario deletad com sucesso!!!'
        );

        $json = json_encode($retorno, JSON_UNESCAPED_UNICODE);

        echo $json;

}catch(PDOException $erro){

    $retorno = array(
        'retorno' => 'erro',
        'Mensagem'=> $erro->getMessage());
        $json = json_encode($retorno, JSON_UNESCAPED_UNICODE);


        echo $json;
}
?>