<?php

include 'conexao.php';

try{
    $id = $_GET['id'];

    $sql = "DELETE FROM tb_usuarios FROM id = '$id' ";

    $quary = $con -> prepare($sql);

    $quary -> execute();
}catch(PDOException $erro){
    $retorno = array(
        'retorno' => 'erro',
        'Mensagem'=> $erro->getMessage());
        $json = json_encode($retorno, JSON_UNESCAPED_UNICODE);


        echo $json;
}
?>