<?php

include ('conexao.php');
try{
    $sql = "SELECT * from tblos";
    $qry = $con->query($sql);
    $os = $qry->fetchAll(PDO::FETCH_OBJ);
   
} catch(PDOException $e){
    echo $e->getMessage();

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar OS</title>
</head>
<body>
    <?php include ('cabecalho.php'); ?>

<div class="container">
    
    <h1>Listar OS</h1>
    <hr>
        <a href="index.php" class="btn btn-dark">Menu</a>
    <hr>
        <a href="frmcadastraros.php"  class="btn btn-primary">Novo Cadastro</a>
    <hr>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
               <th>id</th> 
               <th>Cliente</th>
               <th>Email</th>
               <th>Telefone</th>
               <th>Tipo de Equipamento</th>
               <th>Técnico</th>
               <th>Serviço</th>
               <th>Data da OS</th>
               <th>Descrição do Serviço</th>
               <th colspan=3>Ações</th>
               
            </tr>
        </thead>
        <tbody>
            <?php foreach( $os as $os) { ?>
            <tr>
                <td><?php echo $os->idos ?></td>
                <td><?php echo $os->cliente ?></td>
                <td><?php echo $os->email ?></td>
                <td><?php echo $os->tel ?></td>
                <td><?php echo $os->tpequipamento ?></td>
                <td><?php echo $os->tecnico ?></td>
                <td><?php echo $os->servico ?></td>
                <td><?php echo date ("d/m/Y", strtotime($os->dtos)) ?></td>
                <td><?php echo $os->descricaoserv ?></td>
    
                <td><a href="frmcadastraros.php?idos=<?php echo $os->idos ?>" class="btn btn-success">Editar</a></td>
                <td><a href="frmcadastraros.php?op=del&idos=<?php echo $os->idos ?>" class="btn btn-danger">Excluir</a></td>
                <td><a href="statusos.php?idos=<?php echo $os->idos ?>" class="btn btn-primary">Status</a></td>

            </tr>
            <?php } ?>
        </tbody>
    </table>
    
    
    <?php include ('rodape.php'); ?>
    </body>
    </html>

    <?php

    include ('conexao.php');
    try{
        $sql = "SELECT * from tblos";
        $qry = $con->query($sql);
        $os = $qry->fetchAll(PDO::FETCH_OBJ);
       
    } catch(PDOException $e){
        echo $e->getMessage();
    
    }
    ?>