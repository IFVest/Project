<?php
    require_once(__DIR__ . "/../util/config.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Criar módulo</h1>

    <form method="POST" action="<?= BASE_URL?>/controller/ModuleController.php?action=save">
        Nome:<input type="text" name="module_name">
        <br>
        Descricao: <input type="text" name="module_desc">
        <br>
        <select name="module_subject">
            <option></option>
            <option value="1">Matemática</option>
            <option value="2">Português</option>
            <option value="3">Redação</option>
            <option value="4">História</option>
            <option value="5">Geografia</option>
            <option value="6">Ciências</option>
        </select>

        <button type="submit">Gravar</button>
    </form>
    
    
</body>
</html>