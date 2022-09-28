<!DOCTYPE html>
<html lang="pt-BR">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sistema CRUD no PHP</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        
        <?php 
            require "config.php";
            $lista = [];
            $sql = $pdo->query("SELECT * FROM usuarios");
            if($sql->rowCount() > 0) {
                $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
            }
        ?>

    </head>
    <body>

        <table class="styled-table">
            <thead>
                <tr>
                    <th>
                        ID
                    </th>
                    <th>
                        Nome
                    </th>
                    <th>
                        Email
                    </th>
                    <th>
                        Ações
                    </th>
                </tr>
            </thead>
            <?php foreach($lista as $usuario): ?>
            <tbody>
                <tr>
                    <td>
                        <?=$usuario['id']; ?>
                    </td>
                    <td>
                        <?=$usuario['nome']; ?>
                    </td>
                    <td>
                        <?=$usuario['email']; ?>
                    </td>

                    <td>
                        <a href="editar.php?id=<?=$usuario['id'];?>">[ Editar ]</a>
                        <a href="excluir.php?id=<?=$usuario['id'];?>" onclick="return confirm('Tem certeza que deseja excluir?')"> [ Excluir ]</a>
                    </td>
                </tr>
            </tbody>
            <?php endforeach; ?>
        </table> 
        <a href="adicionar.php">Adicionar usuário</a>
        
    </body>

</html>

