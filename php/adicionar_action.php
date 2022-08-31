<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CRUD</title>
    </head>
    <?php
        require 'config.php';
        $name = filter_input(INPUT_POST, 'name');
        $email = filter_input(INPUT_POST, 'email');
        if($name && $email) {
            $sql = $pdo->prepare("INSERT INTO usuarios(name, email, VALUES)");
        } else {
            header("location: adicionar.php");
            exit;
        }

    
</html>