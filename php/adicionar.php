<!DOCTYPE html>
<html lang="pt-BR">
    <head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sistema CRUD no PHP</title>
    </head>

    <body>
        <h1>Adicionar usuário</h1>

        <form method="post" action="adicionar_action.php">

            <label>
                Nome: 
            </label> <br>
            <input type="text" name="nome">

            <br><br>

            <label>
                Email: 
            </label> <br>
            <input type="email" name="email">

            <br><br>
            <input type="submit" value="adicionar">

        </form>
    </body>
</html>