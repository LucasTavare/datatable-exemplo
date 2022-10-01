<?php

include 'function.php';

try{
    $id = $_POST['id'];

    $sql = "DELETE FROM tb_login WHERE id = $id ";

    $msg = "usario deletado";

    addUpdDel($sql,$msg);

}catch(PDOException $erro){

    pdocatch($erro);
}
?>