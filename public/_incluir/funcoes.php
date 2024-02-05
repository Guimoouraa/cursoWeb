    <?php
        function real_format($valor) {
            $valor  = number_format($valor,2,",",".");
            return "R$ " . $valor;
        }

        function mostrarAviso($numero) {
            $array_erro = array(
                UPLOAD_ERR_OK => "Arquivo publicado com sucesso.",
                UPLOAD_ERR_INI_SIZE => "O arquivo enviado excede o limite definido na diretiva upload_max_filesize do php.ini.",
                UPLOAD_ERR_FORM_SIZE => "O arquivo excede o limite definido em 45KB no formulário HTML",
                UPLOAD_ERR_PARTIAL => "O upload do arquivo foi feito parcialmente.",
                UPLOAD_ERR_NO_FILE => "Nenhum arquivo foi enviado.",
                UPLOAD_ERR_NO_TMP_DIR => "Pasta temporária ausente.",
                UPLOAD_ERR_CANT_WRITE => "Falha em escrever o arquivo em disco.",
                UPLOAD_ERR_EXTENSION => "Uma extensão do PHP interrompeu o upload do arquivo."
            ); 

            return $array_erro[$numero];
        }

        function uploadArquivo($arquivo_publicado, $minha_pasta) {
            if($arquivo_publicado["error"] == 0) {
                $pasta_temporaria = $arquivo_publicado["tmp_name"];
                $arquivo                 = $arquivo_publicado["name"];
                $pasta                    = $minha_pasta;
                $tipo                      = $arquivo_publicado["type"];
                $extensao              = strrchr($arquivo, ".");

            if ( $tipo == "image/jpeg" ||  $tipo =="image/png" )  {
                if (move_uploaded_file($pasta_temporaria, $pasta . "/" . $arquivo)) {
                    $mensagem = mostrarAviso($arquivo_publicado["error"]);
                } else {
                    $mensagem = "Erro na publicação";
                }
            } else {
                    $mensagem = "Erro:  Aquivo não pode ter a extensão" . $extensao;
            }
            } else {
                $mensagem = mostrarAviso($arquivo_publicado["error"]);
                } 
                return $mensagem;
        }
    ?>