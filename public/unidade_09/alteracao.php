<?php require_once("../../conexao/conexao.php"); ?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Curso PHP Integração com MySQL</title>
        
        <!-- estilo -->
        <link href="_css/estilo.css" rel="stylesheet">
    </head>

    <body>
        <?php include_once("../_incluir/topo.php"); ?>
        <?php include_once("../_incluir/funcoes.php"); ?> 
        
        <main>  
           <div id="janela_formulario">
            <form action="alteracao.php" method="post">
                <h2>Alteração de transportadora</h2>

                <label for="nometransportadora">Nome da transportadora</label>
                <input type="text" value="" name="nometransportadora">

                <label for="endereco">Endereço</label>
                <input type="text" value="" name="endereco">

                <label for="cidade">Cidade</label>
                <input type="text" value="" name="cidade">

                <label for="estados">Estado</label>
                <input type="text" value="" name="estado">

                <label for="cep">CEP</label>
                <input type="text" value="" name="cep">

                <label for="telefone">Telefone</label>
                <input type="text" value="" name="telefone">

                <label for="cnpj">CNPJ</label>
                <input type="text" value="" name="cnpj">

                <input type="hidden">

                <input type="submit">
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