<?php

include_once 'conexao.php';


function validaCampoVazio($campo,$nomedocampo){

    if($campo == ''){
        $retorno = array(
            'retorno'=>'erro',
            'Mensagem'=>'Preencha o campo '.$nomedocampo.'!');
            $json = json_encode($retorno, JSON_UNESCAPED_UNICODE);
    
           echo $json;
           exit();
    }
}

function addUpdDel($sql,$mensagemre){



    $comando = $GLOBALS['con'] -> prepare($sql);

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

function checkEmailUser($email){

    $sql = "SELECT email FROM tb_login WHERE email = '$email'";

    $comando = $GLOBALS['con'] -> prepare($sql);

    $comando-> execute();

    $validaEmail = $comando -> fetchAll(PDO::FETCH_ASSOC);

    if($validaEmail !=  null){
        $retorno = array(
            'retorno'=>'error  ',
            'Mensagem'=>'Email ja cadastrado!!!'
        );
        $json = json_encode($retorno, JSON_UNESCAPED_UNICODE);

        echo $json;
        exit;
    }
}

function checkCpfUser($cpf){

    $sql = "SELECT cpf FROM tb_login WHERE cpf = '$cpf'";

    $comando = $GLOBALS['con'] -> prepare($sql);

    $comando-> execute();

    $validaEmail = $comando -> fetchAll(PDO::FETCH_ASSOC);

    if($validaEmail !=  null){
        $retorno = array(
            'retorno'=>'error  ',
            'Mensagem'=>'CPF ja cadastrado!!!'
        );
        $json = json_encode($retorno, JSON_UNESCAPED_UNICODE);

        echo $json;
        exit;
    }

}

function geraTokenUsuario($email){

    $sql = "SELECT id FROM tb_login WHERE email='$email'";

    $comando=$GLOBALS['con']->prepare($sql);

    $comando->execute();

    $dados = $comando->fetchAll(PDO::FETCH_ASSOC);

    $idUsuario = $dados[0]['id'];

    $token = md5(uniqid($email));

    $sql = "INSERT INTO tb_usuarios_token(token,fk_id_login) VALUES ('$token',$idUsuario)";

    $comando=$GLOBALS['con']->prepare($sql);

    $comando->execute();

    return $token;
}

function apagatoken($id){

    $id = $_POST['id'];

    $sql = "DELETE FROM tb_usuarios_token WHERE id = $id ";

}
?>