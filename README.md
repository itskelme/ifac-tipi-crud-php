# CRUD de usuários em PHP com PDO

> Cadastro, listagem, edição e exclusão de usuários (nome e e-mail) em PHP, usando PDO e MySQL.

**Contexto:** IFAC · Técnico em Informática para Internet (TIPI) · Programação Web · 2º ano · 2022

## Sobre

Primeiro contato com CRUD (Create, Read, Update, Delete) na disciplina. O sistema guarda usuários numa tabela `usuarios` e permite listar, adicionar, editar e excluir registros.

O repositório tem três versões do mesmo exercício:

- `php-corrigido/`: a versão que funciona. É a que deve ser executada.
- `php-incorreto/`: o mesmo código com erros de digitação e de lógica, usado como exercício de encontrar e corrigir bugs.
- `php/`: a primeira tentativa, com uma tabela estilizada no `index.php`, mas incompleta.

O objetivo foi praticar conexão com banco via PDO, consultas preparadas com `prepare`/`bindValue`/`execute`, leitura de dados com `filter_input` e redirecionamento com `header("Location: ...")`.

## Funcionalidades

Na versão `php-corrigido/`:

- **Listar:** `index.php` busca todos os registros de `usuarios` e mostra numa tabela com links de editar e excluir.
- **Adicionar:** `adicionar.php` tem o formulário; `adicionar_action.php` valida o e-mail com `FILTER_VALIDATE_EMAIL`, verifica se ele já existe e só então insere. Se o e-mail já estiver cadastrado ou algum campo estiver vazio, volta para o formulário.
- **Editar:** `editar.php` carrega o usuário pelo `id` da URL e preenche o formulário; `editar_action.php` grava as alterações com `UPDATE`.
- **Excluir:** `excluir.php` apaga o registro pelo `id`, depois de uma confirmação em JavaScript (`confirm`) na listagem.

## Tecnologias

- PHP 7.4+ com PDO (`pdo_mysql`)
- MySQL ou MariaDB
- HTML; CSS apenas na versão `php/` (`style.css`)

## Estrutura do projeto

| Caminho | Descrição |
|---|---|
| `php-corrigido/config.php` | Cria a conexão PDO com o banco `test` em `localhost`. |
| `php-corrigido/index.php` | Listagem dos usuários. |
| `php-corrigido/adicionar.php` | Formulário de cadastro. |
| `php-corrigido/adicionar_action.php` | Valida e insere o novo usuário. |
| `php-corrigido/editar.php` | Formulário de edição preenchido com os dados atuais. |
| `php-corrigido/editar_action.php` | Atualiza o usuário. |
| `php-corrigido/excluir.php` | Exclui o usuário. |
| `php-incorreto/` | Mesmos sete arquivos, com erros propositais para correção. |
| `php/` | Primeira versão, incompleta (ver abaixo). |
| `.vscode/settings.json` | Idiomas do corretor ortográfico do VS Code. |

### Erros da pasta `php-incorreto/`

Comparando com `php-corrigido/`, alguns dos erros que o exercício pedia para encontrar:

- Constantes e métodos com nome errado: `INPUTS_POST`, `FILTER_VALIDADE_EMAIL`, `rewCount()`, `rowCout()`.
- SQL com erro: coluna `none` no lugar de `nome`, tabela `usuariois`, `SELECT = FROM`.
- Parâmetros que não batem com o SQL: `':eid'`, `'>id'`.
- `header ("Location index.php")` sem os dois-pontos.
- No `index.php`, o laço usa `$usuarios` e o corpo usa `$usuario`.
- No `editar.php`, `<?-` em vez de `<?=` e o campo nome com `type="email"` e `name="email"`.
- No `adicionar.php`, o atributo `typt="email"` em vez de `type`.

### Estado da pasta `php/`

É a primeira tentativa e não funciona: o formulário envia `nome`, mas o script lê `name`; o primeiro `INSERT` tem SQL inválido; `editar.php` para na consulta; `editar_action.php` e `excluir.php` estão vazios. Ficou no repositório pelo `index.php` com a tabela estilizada.

## Como rodar

### Pré-requisitos

- PHP 7.4 ou superior com a extensão `pdo_mysql`, **ou** o XAMPP.
- MySQL ou MariaDB rodando em `localhost`.

### Passo a passo

1. Clone o repositório:

   ```bash
   git clone https://github.com/itskelme/ifac-tipi-crud-php.git
   cd ifac-tipi-crud-php
   ```

2. Crie o banco e a tabela. O `config.php` conecta no banco `test` com usuário `root` e senha vazia (padrão do XAMPP). Se o seu MySQL usa outra senha, altere `php-corrigido/config.php`.

   ```sql
   CREATE DATABASE IF NOT EXISTS test
     CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

   USE test;

   CREATE TABLE usuarios (
     id    INT AUTO_INCREMENT PRIMARY KEY,
     nome  VARCHAR(100) NOT NULL,
     email VARCHAR(150) NOT NULL UNIQUE
   );
   ```

   Dá para rodar esse SQL no phpMyAdmin (http://localhost/phpmyadmin) ou no terminal com `mysql -u root -p`.

3. Inicie o servidor apontando para a versão corrigida:

   ```bash
   php -S localhost:8000 -t php-corrigido
   ```

   Abra http://localhost:8000

   No XAMPP, copie o repositório para `C:\xampp\htdocs\`, inicie Apache e MySQL e acesse http://localhost/ifac-tipi-crud-php/php-corrigido/

## Como usar

1. Na listagem, clique em **ADICIONAR USUÁRIO**, preencha nome e e-mail e clique em **Adicionar**.
2. O usuário aparece na tabela. Clique em **[ Editar ]** para alterar os dados e em **Salvar** para gravar.
3. Clique em **[ Excluir ]** e confirme para apagar o registro.

## Observações

Pontos do código corrigido que vale saber:

- As consultas usam parâmetros (`:id`, `:email`), então não há SQL injection, mas os dados são impressos na tabela sem `htmlspecialchars()`.
- Em `editar.php`, os redirecionamentos de erro usam `header("Localhost: index.php")`, que não é um cabeçalho válido. Se o `id` não for informado ou não existir, a página fica em branco em vez de voltar para a listagem. O título dessa página também diz "Adicionar Usuário".
- `editar.php` consulta a tabela como `USUARIOS`. Funciona no Windows, mas em MySQL no Linux os nomes de tabela diferenciam maiúsculas e a consulta falha.
- A exclusão é feita por `GET`, sem token de confirmação no servidor.

## Referências

- [PHP: PDO](https://www.php.net/manual/pt_BR/book.pdo.php)
- [PHP: `PDO::prepare`](https://www.php.net/manual/pt_BR/pdo.prepare.php) e [`PDOStatement::bindValue`](https://www.php.net/manual/pt_BR/pdostatement.bindvalue.php)
- [PHP: `filter_input`](https://www.php.net/manual/pt_BR/function.filter-input.php) e [filtros de validação](https://www.php.net/manual/pt_BR/filter.filters.validate.php)
- [PHP: `header`](https://www.php.net/manual/pt_BR/function.header.php)
- [MySQL: `CREATE TABLE`](https://dev.mysql.com/doc/refman/8.0/en/create-table.html)

## Autores

- Diego Kelme Santos da Silva — [@itskelme](https://github.com/itskelme)

## Licença

Este projeto está sob a licença [CC BY-NC 4.0](LICENSE): uso pessoal e modificação permitidos com atribuição; uso comercial proibido.
