<?php
 $idos = isset($_GET["idos"]) ? $_GET["idos"]: null;
 $op = isset($_GET["op"]) ? $_GET["op"]: null;
  
 
     try {
         $servidor = "localhost";
         $usuario = "root";
         $senha = "";
         $bd = "bdsisos";
         $con = new PDO("mysql:host=$servidor;dbname=$bd",$usuario,$senha); 

         //estou deletando os dados no BD
         if($op=="del"){
             $sql = "delete  FROM  tblos where idos= :idos";
             $stmt = $con->prepare($sql);
             $stmt->bindValue(":idos",$idos);
             $stmt->execute();
             header("Location:listaros.php");
         }
 
 
         if($idos){
             //estou buscando os dados do cliente no BD
             $sql = "SELECT * FROM  tblos where idos= :idos";
             $stmt = $con->prepare($sql);
             $stmt->bindValue(":idos",$idos);
             $stmt->execute();
             $os = $stmt->fetch(PDO::FETCH_OBJ);
             //var_dump($cliente);
         }
            // estou atualizando os dados no BD
         if($_POST){
             if($_POST["idos"]){
                 $sql = "UPDATE tblos SET  tpequipamento=:tpequipamento, tecnico=:tecnico, servico=:servico, dtos=:dtos, descricaoserv=:descricaoserv, statusos=:statusos, preco=:preco  WHERE idos =:idos";
                 $stmt = $con->prepare($sql);
                
                 $stmt->bindValue(":tpequipamento", $_POST["tpequipamento"]);  
                 $stmt->bindValue(":tecnico", $_POST["tecnico"]);
                 $stmt->bindValue(":servico", $_POST["servico"]);
                 $stmt->bindValue(":dtos", $_POST["dtos"]);
                 $stmt->bindValue(":descricaoserv", $_POST["descricaoserv"]);
                 $stmt->bindValue(":statusos", $_POST["statusos"]);
                 $stmt->bindValue(":preco", $_POST["preco"]);
                 $stmt->bindValue(":idos", $_POST["idos"]);
                 $stmt->execute(); 

                 //comando para inserir os dados no BD
             } else {
                 $sql = "INSERT INTO tblos (tpequipamento,tecnico,servico,dtos,descricaoserv,statusos,preco) VALUES (:cliente,:email,:tel,:tpequipamento,:tecnico,:servico,:dtos,:descricaoserv,:statusos,:preco)";
                 $stmt = $con->prepare($sql);
                 
                 $stmt->bindValue(":tpequipamento", $_POST["tpequipamento"]);  
                 $stmt->bindValue(":tecnico", $_POST["tecnico"]);
                 $stmt->bindValue(":servico", $_POST["servico"]);
                 $stmt->bindValue(":dtos", $_POST["dtos"]);
                 $stmt->bindValue(":descricaoserv", $_POST["descricaoserv"]);
                 $stmt->bindValue(":statusos", $_POST["statusos"]);
                 $stmt->bindValue(":preco", $_POST["preco"]);
                 $stmt->execute(); 
             }
             header("Location:statusos.php");
         } 
     } catch(PDOException $e){
          echo "erro".$e->getMessage;
         }
 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=s, initial-scale=1.0">
    <title>Editar Status</title>
</head>
<body>
<?php
include('cabecalho.php'); 
?>
<div class="container">
<h1>Editar Status</h1>
<hr>

<form method="POST">
   
    <div class="row">

        <div class="col">

            <div class="mb-3">

                <label for="exampleInputEmail1" class="form-label">Técnico</label>

                <input type="text" class="form-control" required name="tecnico" value="<?php echo isset($os) ? $os->tecnico : null ?>"><br>

             </div>      

        </div>

    <div class="col">

        <div class="mb-3">

            <label for="exampleInputPassword1" class="form-label">Tipo de Equipamento</label>

            <input type="text" class="form-control" required name="tpequipamento" value="<?php echo isset($os) ? $os->tpequipamento : null ?>"><br>

        </div>

    </div>
    
   

        <div class="col">

        <div class="mb-3">

            <label for="exampleInputEmail1" class="form-label">Serviço</label>

             <input type="text" class="form-control" required name="servico" value="<?php echo isset($os) ? $os->servico : null ?>"><br>

               

        </div>

    </div>
    

        <div class="col">

        <div class="mb-3">

            <label for="exampleInputEmail1" class="form-label">Data da OS</label>

             <input type="date" class="form-control" required name="dtos" value="<?php echo isset($os) ? $os->dtos : null ?>"><br>

               

        </div>

    </div>
    <div class="row">

        <div class="col">

        <div class="mb-3">

            <label for="exampleInputEmail1" class="form-label">status</label>

             <input type="text" class="form-control" required name="statusos" value="<?php echo isset($os) ? $os->statusos : null ?>"><br>

               

        </div>

    </div>
    <div class="col">

        <div class="mb-3">

            <label for="exampleInputEmail1" class="form-label">Preço</label>

             <input type="text" class="form-control" required name="preco" value="<?php echo isset($os) ? $os->preco : null ?>"><br>

               

        </div>

    </div>

     

    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Descrição do serviço</label>
        <input type="text" class="form-control"  required name="descricaoserv" value="<?php echo isset($os) ? $os->descricaoserv : null ?>"><br>

        <input type="hidden"     name="idos"   value="<?php echo isset($os) ? $os->idos : null ?>">   
    </div>

    <div class="row">

      <div class="col">

        <div class="mb-3">        

        <button type="submit" class="btn btn-primary">Cadastrar</button>

    </div>


   

</form>    

    <div class="col">

      <div class="mb-3">

       <a href="statusos.php"  class="btn btn-outline-primary">volta</a>

    </div>   




<?php include ('rodape.php')?>
</body>
</html>