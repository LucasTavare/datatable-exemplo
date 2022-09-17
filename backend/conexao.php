<?php


try{
    
define('SERVIDOR','localhost');
define('USUARIO', 'root');
define('SENHA','');
define('BANCO', 'tb_login');

$con = new PDO("mysql:host=".SERVIDOR.";dbname=".BANCO.";charset=utf8", USUARIO, SENHA);
// set the PDO error mode to exception
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// echo "Conexão foi bem sucedida! ";
} catch(PDOException $erro){
    echo 'Erro ao conectar!'.$erro -> getMessage();
}

?>