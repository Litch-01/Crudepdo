<?php
require_once './class-Pessoa.php';
$p = new Pessoa("crudepdo","localhost","root","");
?>

<!DOCTYPE html>
<tml lang="pt-br">
<ead>
   <meta charset="utf-8">
   <title>Cadastro de Pessoa</title>
   <link rel="stylesheet" href="estilo.css">
</head>     
<body>
    <?php
    if(isset($_POST['nome']))
    {
        if(isset($_GET['id_up']) && !empty($_GET['id_up']))
        {
            $id_upd = addslashes($_GET['id_up']);
            $nome = addslashes($_POST['nome']);
            $telefone = addslashes($_POST['telefone']);
            $email = addslashes($_POST['email']);
            if(!empty($nome) && !empty($telefone) && !empty($email))
            {
    
            $p->atualizarDados($id_upd, $nome, $telefone, $email);
            header("location: index.php");

            }
            else
            {
            echo "Preencha todos os campos";
            }
        

        }
        else
        {
            $nome = addslashes($_POST['nome']);
                $telefone = addslashes($_POST['telefone']);
                $email = addslashes($_POST['email']);
                if (!empty($nome) && !empty($telefone) && !empty($email)) { // se não estiver vazio
                    //cadrastar
                    if (!$p->cadastrarPessoa($nome, $telefone, $email)){ // se o retorno for false, executa esse if
                        echo"Email já está cadrastado!";
                    }
                }else {
                    echo "Preencha todos os campos";
                }
            
        
          
        }
    }
    ?>
    <?php
        if(isset($_GET['id_up']))
        {
            $id_update = addslashes($_GET['id_up']);
            $res = $p->buscarDadosPessoas($id_update);
        }
?>
    <section id="esquerda">
        <form method="POST">
            <h2>CADASTRAR PESSOA</h2>
            <label for="Nome">Nome</label>
            <input type="texte" name="nome" id="Nome" value="<?php if(isset($res)){echo $res['nome'];}?>">
            <label for="Telefone">Telefone</label>
            <input type="text" name="telefone" id="telefone"value="<?php if(isset($res)){echo $res['telefone'];}?>">
            <label for="Email">Email</label>
            <input type="texte" name="email" id="email"value="<?php if(isset($res)){echo $res['email'];}?>">
            <input type="submit" value="<?php if(isset($res)){echo "Atualizar";}else{ echo "Cadastrar";} ?>">
        </form>    
    </section>
    <section id="direita"> 
    <table>
            <tr id="Titulo">
                <td>NOME</td>
                <td>TELEFONE</td>
                <td colspan="2">EMAIL</td>
            </tr>    
        <?php
        $dados = $p->buscarDados();
        if(count($dados) > 0)
        {
          for ($i=0; $i < count($dados); $i++)  {
            echo "<tr>";
            foreach ($dados[$i] as $k => $v){
                if($k != "id"){
                    echo "<td>".$v."</td>";
                }
            }
            ?>
            <td>
                <?php echo $dados[$i]['id']; ?>
                <a href="index.php?id_up=<?php echo $dados[$i]['id'];?>">Editar</a>
                <a href="index.php?id=<?php echo $dados[$i]['id'];?>">Excluir</a></td><?php
            echo "</tr>";
          }

        }
        else
        {
            echo "Sem registros";
        }
        ?>
               
        </table>

    </section>

</body>
</html>

<?php

   if(isset($_GET['id']))
   {
    $id_pessoa = addslashes($_GET['id']);
    $p->excluirPessoa($id_pessoa);
    header("location: index.php");
   }




?>
