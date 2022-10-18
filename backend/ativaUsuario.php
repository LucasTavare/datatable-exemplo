<?php

try{
    $token = $_GET['token'];

    $sql = "
    UPDATE 
        tb_login u 
    INNER JOIN
        tb_usuarios_token t
    ON
        t.fk_id_usuarios = u.id
    SET
        u.ativo = 1
    WHERE
        t.token = ''
    ";
}catch(PDOException $erro){
    pdocatch($erro);
}

?>