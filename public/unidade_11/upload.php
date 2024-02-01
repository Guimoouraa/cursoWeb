<?php require_once("../../conexao/conexao.php"); ?>

<?php 
    if( isset($_POST["enviar"])) {
      $pasta_temporaria = $_FILES["upload_file"]["tmp_name"];
      $arquivo          = $_FILES["upload_file"]["name"];
      $pasta            = "uploads";  

     if (move_uploaded_file($pasta_temporaria, $pasta . "/" . $arquivo)) {
        $mensagem = "Arquivo publicado com sucesso.";
     } else {
        $mensagem = "Erro na publicação";
     }
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
        <style>
            input {
                display:block;
                margin-bottom:15px;
            }
        </style>
    </head>

    <body>
        <?php include_once("../_incluir/topo.php"); ?>
        <?php include_once("../_incluir/funcoes.php"); ?>  
        
            <main>  
                <div id="janela_formulario">
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        <input type="file" name="upload_file">
                        <input type="submit" name="enviar">
                    </form>
                    <?php 
                        if ( isset($mensagem)){
                            echo $mensagem;
                        }
                    
                    ?>
                </div>
            </main>

        <?php include_once("../_incluir/rodape.php"); ?>  
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>