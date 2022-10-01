<?php

include 'function.php';

try{

    $id = $_POST['id'];

        $sql = "UPDATE tb_login SET ativo = NOT ativo WHERE id = $id";

        $msg = "Usuario alterado com sucesso";

        addUpdDel($sql,$msg);
}catch(PDOException $erro) {
    pdocatch($erro);
}

?>