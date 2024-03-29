<?php require_once("../../conexao/conexao.php"); ?>

<?php 
    // inserção no banco
    if (isset( $_POST["cidade"] )) {
        $nome     = $_POST["nometransportadora"];
        $endereco = $_POST["endereco"];
        $cidade   = $_POST["cidade"];
        $estado  = $_POST["estado"];
        $telefone = $_POST["telefone"];
        $cep      = $_POST["cep"];
        $cnpj     = $_POST["cnpj"];


        $inserir = "INSERT INTO transportadoras (nometransportadora, endereco, telefone, cidade, estadoID, cep, cnpj) VALUES ('$nome','$endereco','$telefone','$cidade',$estado,'$cep','$cnpj')";
        $operacao_inserir = mysqli_query($conecta,$inserir);
        if (!$operacao_inserir) {
            die("Falha na inserção");
        } else {
            header("location:listagem.php");
        }
    }

    //Seleção de estador 
    $estados = "SELECT nome, estadoID FROM estados";
    $linha_estados = mysqli_query($conecta,$estados);
    if ( !$linha_estados ) {
        die("erro no banco");
    }

?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Curso PHP Integração com MySQL</title>
        
        <!-- estilo -->
        <link href="_css/estilo.css" rel="stylesheet">
        <link href="_css/crud.css" rel="stylesheet">
    </head>

    <body>
        <?php include_once("../_incluir/topo.php"); ?>
        <?php include_once("../_incluir/funcoes.php"); ?> 
        
        <main>  
            <div id="janela_formulario">
                <form action="inserir.php" method="post">
                    <input type="text" name="nometransportadora" placeholder="Nome">
                    <input type="text" name="endereco" placeholder="Endereço">
                    <input type="text" name="cidade" placeholder="Cidade">
                    <select name="estado">
                        <?php while($linha = mysqli_fetch_assoc($linha_estados)) { ?>
                        <option value="<?php echo $linha["estadoID"]; ?>">
                            <?php echo $linha["nome"]; ?>
                        </option>
                        <?php } ?>
                    </select>
                    <input type="text" name="telefone" placeholder="Telefone">
                    <input type="text" name="cep" placeholder="CEP">
                    <input type="text" name="cnpj" placeholder="CNPJ">
                    <input type="submit" value="Inserir">
                </form>
            </div>
        </main>

        <?php include_once("../_incluir/rodape.php"); ?>  
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>