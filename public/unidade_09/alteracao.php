<?php require_once("../../conexao/conexao.php"); ?>

<?php 
    if (isset($_POST["cidade"])) {
        $nome     = $_POST["nometransportadora"];
        $endereco = $_POST["endereco"];
        $cidade   = $_POST["cidade"];
        $estado   = $_POST["estados"];
        $cep      = $_POST["cep"];
        $cnpj     = $_POST["cnpj"];
        $telefone = $_POST["telefone"];
        $tid      = $_POST["transportadoraID"];


        // obj de alteração
        $alterar  = "UPDATE transportadoras ";
        $alterar .= "SET ";
        $alterar .= " nometransportadora = '{$nome}', ";
        $alterar .= " endereco = '{$endereco}', ";
        $alterar .= " cidade = '{$cidade}', ";
        $alterar .= "estadoID = {$estado}, ";
        $alterar .= "cep = '{$cep}', ";
        $alterar .= "cnpj = '{$cnpj}', ";
        $alterar .= "telefone = '{$telefone}'";
        $alterar .= "WHERE transportadoraID = {$tid}";

        $operacao_alteracao = mysqli_query($conecta,$alterar);
        if (! $operacao_alteracao) {
            die("erro no banco");
        } else {
            header("location:listagem.php");
        }
    }



    // Consulta na tabela transportadora
    $transp = "SELECT *  FROM transportadoras ";

    if ( isset($_GET["codigo"]) )
    {
        $id =  $_GET["codigo"];
        $transp .= "WHERE transportadoraID = {$id}";
    } else {
        $transp .= "WHERE transportadoraID = 1";
    }


    $con_transp = mysqli_query($conecta,$transp);
    if(!$con_transp) {
        die("Falha no banco de dados");
    } else {
        $info_transp = mysqli_fetch_assoc($con_transp);
    }

    // consulta na tabela de estados

    $estado = "SELECT estadoID, nome FROM estados";
    $lista_estados = mysqli_query($conecta,$estado);

    if(!$lista_estados) {
        die("Falha no banco ");
    }

?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Curso PHP Integração com MySQL</title>
        
        <!-- estilo -->
        <link href="_css/estilo.css" rel="stylesheet">
        <link href="_css/alteracao.css" rel="stylesheet">
    </head>

    <body>
        <?php include_once("../_incluir/topo.php"); ?>
        <?php include_once("../_incluir/funcoes.php"); ?> 
        
        <main>  
           <div id="janela_formulario">
            <form action="alteracao.php" method="post">
                <h2>Alteração de transportadora</h2>

                <label for="nometransportadora">Nome da transportadora</label>
                <input type="text" value="<?php echo $info_transp["nometransportadora"] ?> " name="nometransportadora">

                <label for="endereco">Endereço</label>
                <input type="text" value="<?php echo $info_transp["endereco"] ?> " name="endereco">

                <label for="cidade">Cidade</label>
                <input type="text" value="<?php echo $info_transp["cidade"] ?> " name="cidade">

                <label for="estados">Estados</label>
                <select id="estados" value="" name="estados">
                    <?php
                        $meuestado = $info_transp["estadoID"];
                        while($linha = mysqli_fetch_assoc($lista_estados)) {
                            $estado_momento = $linha["estadoID"];
                            if ($meuestado == $estado_momento) {
                    ?>
                    <option value="<?php echo $info_transp["estadoID"]; ?>" selected >
                        <?php echo $linha["nome"];?>
                    </option>
                    <?php
                        } else {
                    ?>
                    <option value="<?php echo $info_transp["estadoID"]; ?>">
                        <?php echo $linha["nome"];?>
                    </option>
                    <?php
                        }
                       } 
                    ?>
                </select>

                <label for="cep">CEP</label>
                <input type="text" value="<?php echo $info_transp["cep"] ?> " name="cep">

                <label for="telefone">Telefone</label>
                <input type="text" value="<?php echo $info_transp["telefone"] ?> " name="telefone">

                <label for="cnpj">CNPJ</label>
                <input type="text" value="<?php echo $info_transp["cnpj"] ?> " name="cnpj">

                <input type="hidden" name="transportadoraID" value="<?php echo $info_transp["transportadoraID"] ?> ">

                <input type="submit" value="Confirmar Alteração">
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