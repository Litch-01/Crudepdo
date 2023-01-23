<?php 
try
{
    $pdo = new PDO("mysql:dbname=crudepdo;local=localhost","root","" );
}
catch (PDOException $e) {
   echo "Erro com banco de dados: ".$e->getMessage(); 
}
catch(Exception $e)
{
    echo "Erro generico: ".$e->getMessage();;
}

$res = $pdo->query("INSERT INTO pessoa(nome, telefone, email) VALUES (:n, :t, :e)");
$res->bindValue(":n","Luiz");
$res->bindValue(":t","15654515");
$res->bindValue(":e","luiz@gmail.com");
$res->execute();

$cmd = $pdo->query("DELETE FROM pessoa WHERE id = :id");
$id = 2;
$cmd->bindValue(":id",$id);
$cmd->execute();

$cmd = $pdo->query("UPDATE pessoa SET email = :e WHERE id = :id");
$cmd->bindValue(":e", "And@gmail.com");
$cmd->bindValue(":id",1);
$cmd->execute();

$cmd = $pdo->query("SELECT * FROM pessoa WHERE id = :id");
$cmd->bindvalue(":id",1);
$cmd->execute();
$resultado = $cmd->fetch(PDO::FETCH_ASSOC);
echo "<pre>";
 print_r($resultado);
 echo "</pre>"; 





?>




