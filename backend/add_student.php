<?php

include 'function.php';

try{

    $nome = 'YONE';
    $curso = 'LOL';
    $periodo = 'Madrugada';


        $sql = "INSERT INTO tb_aluno(`nome`,`curso`,`periodo`) values ('$nome', '$curso', '$periodo')";

        $msg = "Aluno Cadastrado com sucesso";

        addUpdDel($sql,$msg)
        ;
}catch(PDOException $erro) {
    pdocatch($erro);
}

?>