<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desconto Técnico</title>
</head>
<body>
<?php include ('cabecalho.php');
      include ('conexao.php');
?>
<div class="container">
<h1>Desconto do Técnico</h1>
<hr>
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

$id = filter_input(INPUT_GET, "vlr_id", FILTER_SANITIZE_NUMBER_INT);
//var_dump($id);
$query_vlr ="SELECT idos, preco FROM tblos WHERE idos=$id LIMIT 1";
$result_vlr = $con->prepare($query_vlr);
$result_vlr->execute();

$row_vlr = $result_vlr->fetch(PDO::FETCH_ASSOC);
//var_dump($row_vlr);

echo "VALOR DO SERVIÇO R$". number_format($row_vlr['preco'], 2, ",","."). "<br><br>";

 $dados = 40;

 //$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    //if (!empty($dados['SendPorcentagem']))
 if($dados){
     //var_dump($dados);
     $vlr_desc = $row_vlr['preco'] / 100 * $dados; //['porcentagem'];

     echo "MÃO DE OBRA TECNICA(40%) -R$ ". number_format($vlr_desc, 2, ",","."). "<br><br>";

     $serv_com_desc = $row_vlr['preco'] - $vlr_desc ;
     echo "LUCRO DA EMPRESA  R$". number_format($serv_com_desc, 2, ",","."). "<br><br>";

    }
?>
<!--<form action="" method="POST">
        <label>Procentagem do Técnico</label>
        <input type="number" name="porcentagem" placeholder="Porcentagem"  /><br><br>

        <input type="submit" value="Calcular" nema="SendPorcentagem"/>

            
</form>
-->
<div class="col">

      <div class="mb-3">

       <a href="statusos.php"  class="btn btn-outline-primary">volta</a>

    </div>   

<?php include ('rodape.php'); ?>
    
</body>
</html>