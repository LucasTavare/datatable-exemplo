<?php


function validaCampoVazio($campo,$nomedocampo){

    if($campo == ''){
        $retorno = array(
            'retorno'=>'erro',
            'Mensagem'=>'Preencha o campo'.$nomedocampo.'!');
            $json = json_encode($retorno, JSON_UNESCAPED_UNICODE);
    
           echo $json;
           exit();
    }
}

function addUpdDel($sql,$mensagemre){
    include 'conexao.php';

    $comando = $con -> prepare($sql);

        $comando -> execute();

        $retorno = array(
            'retorno'=>'ok',
            'Mensagem'=>$mensagemre
        );
        $json = json_encode($retorno, JSON_UNESCAPED_UNICODE);

        echo $json;
}

function pdocatch($erro){
    $retorno = array(
        'retorno' => 'erro',
        'Mensagem'=> $erro->getMessage());
        $json = json_encode($retorno, JSON_UNESCAPED_UNICODE);


        echo $json;

}
?>