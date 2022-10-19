<?php

include 'conexao.php';

try{
    $token = $_GET['token'];

    $sql = "
    UPDATE 
        tb_login u 
    INNER JOIN
        tb_usuarios_token t
    ON
        t.fk_id_login = u.id
    SET
        u.ativo = 1
    WHERE
        t.token = '$token'
    ";

    $comando = $con->prepare($sql);

    $comando -> execute();
    $retorno = $comando->rowCount();

}catch(PDOException $erro){
    $retorno = 0;
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ativação de cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
        
</head>
<body>

    <div class="container- mt-4">
        <div class="alert alert-<?php echo $retorno != 0 ? 'success' : 'danger'?>" role="alert">
            <?php echo $retorno != 0 ?  "Cadastro ativado com sucesso" :  "erro em ativar cadastro";?>

        <a href="../index.html"><button type="button" class="btn-primary">Acessar Sistema</button></a>    
        </div>
    </div>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
        crossorigin="anonymous"></script>
</body>
</html>