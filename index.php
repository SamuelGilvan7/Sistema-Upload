<?php  
$mensagem = '';
$tipo = '';

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    if (empty($_FILES['arquivo']['name'])){

        $mensagem = "Nenhum arquivo enviado!";
        $tipo = "erro";

    } else {

        $formatos = ["png","jpeg","jpg","gif"];  
        $extensao = strtolower(pathinfo($_FILES['arquivo']['name'],PATHINFO_EXTENSION));

        if (in_array($extensao,$formatos)) {

            $pasta = "files/";
            $temporario = $_FILES["arquivo"]["tmp_name"];
            $novoNome = uniqid().".$extensao";

            if(move_uploaded_file($temporario, $pasta . $novoNome)){

                $mensagem = "Upload feito com sucesso!";
                $tipo = "sucesso";

            }else {

                $mensagem = "Erro, não foi possível fazer o upload!";
                $tipo = "erro";

            }

        }else {

            $mensagem = "Formato inválido!";
            $tipo = "erro";

        }
    }
}
?>
 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Sistema-Upload</title>
</head>
<body>
<div class="card">
    <div class="alerta <?php echo $tipo; ?>">
        <?php echo $mensagem; ?>
    </div>
    <h2>Upload de Arquivo</h2>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" enctype="multipart/form-data">
        
        <label class="label-file">
            Escolher arquivo
            <input type="file" name="arquivo">
        </label>

        <div class="info">Formatos: PNG, JPG, JPEG, GIF</div>

        <button type="submit" name="enviar_formulario">Enviar</button>
    </form>
</div>
</body>
</html>