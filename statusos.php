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
<html lang="tp-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status OS</title>
</head>
<body>
<?php include('cabecalho.php'); ?>

<div class="container">
    
    <h1>Status OS</h1>
    <hr>
        <a href="index.php" class="btn btn-dark">Menu</a>
    <hr>
        <a href="frmcadastraros.php"  class="btn btn-primary">Novo Cadastro</a>
    <hr>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
               <th>id</th> 
             
               
                <th>Técnico</th>
               <th>Tipo de Equipamento</th>
             
               <th>Serviço</th>
               <th>Data da OS</th>
               <th>Descrição do Serviço</th>
               <th>Preço</th>
               <th>Status do Serviço</th>
               <th colspan=2>Ações</th>
              
               
            </tr>
        </thead>
        <tbody>
            <?php foreach( $os as $os) { ?>
            <tr>
                <td><?php echo $os->idos ?></td>
                <td><?php echo $os->tecnico ?></td>
                <td><?php echo $os->tpequipamento ?></td>
                <td><?php echo $os->servico ?></td>
                <td><?php echo date ("d/m/Y", strtotime($os->dtos)) ?></td>
                <td><?php echo $os->descricaoserv ?></td>
                <td><?php echo $os->preco ?></td>
                <td><?php echo $os->statusos ?></td>
                
               
               
    
                <td><a href="editstatus.php?idos=<?php echo $os->idos ?>" class="btn btn-success">Editar</a></td>
                <td><a href="frmcadastraros.php?op=del&idos=<?php echo $os->idos ?>" class="btn btn-danger">Excluir</a></td>

            </tr>
            <?php } ?>
        </tbody>
    </table>
    
<h1>Mão de obra Técnica</h1>

<?php

 $query_vlr = "SELECT idos, preco FROM tblos";
 $result_vlr = $con->prepare($query_vlr);
 $result_vlr->execute();

    while($row_vlr = $result_vlr->fetch(PDO::FETCH_ASSOC)){
    // var_dump($row_vlr);
        extract($row_vlr);
        echo "ID: $idos <br>";
        echo "Preço:" .number_format($preco, 2, ",", "."). "<br>";
        echo "<a href='desc_tecnico.php?vlr_id=$idos'>Calcular desconto</a><br>";
        echo "<hr>";
    }
  
include ('rodape.php'); ?>
  
</body>
</html>