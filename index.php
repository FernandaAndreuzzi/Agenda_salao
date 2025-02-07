<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cabeleleila Leila</title>
    <link rel="stylesheet" href="style/style.css">


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
   
   
</head>

<body>

    <ul>
       <li><a href="index.php">Início</a></li>
    </ul>
    <div class='container row col-md-offset-4 col-md-4'>
    <form action="cliente_edit.php?id=0" method="POST">
                <div class="form-group">
                    <label for="Nome">Nome:</label>
                    <input class="form-control" type="text" name="Nome" value="<?php echo $row['Nome'] ?? ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="Telefone">Telefone:</label>
                    <input class="form-control" type="text" name="Telefone" value="<?php echo $row['Telefone'] ?? ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="Cpf">CPF:</label>
                    <input class="form-control" type="text" name="Cpf" value="<?php echo $row['Cpf'] ?? ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="DataNascimento">Data de Nascimento:</label>
                    <input class="form-control" type="date" name="DataNascimento" value="<?php echo $row['DataNascimento'] ?? ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">E-mail:</label> 
                    <input class="form-control" type="email" name="email" value="<?php echo $row['email'] ?? ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="Logradouro">Logradouro:</label>
                    <input class="form-control" type="text" name="Logradouro" value="<?php echo $row['Logradouro'] ?? ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="Numero">Número:</label>
                    <input class="form-control" type="text" name="Numero" value="<?php echo $row['Numero'] ?? ''; ?>" required>
                </div>
                <div class="form-group">
                <label for="TipoPessoa">Tipo de Usuário:</label>
                    <select class="form-control" name="TipoPessoa" id="TipoPessoa" required>
                        <option value="0" <?php echo (isset($row['TipoPessoa']) && $row['TipoPessoa'] == 0) ? 'selected' : ''; ?>>Administração</option>$row['TipoPessoa'] ?? ''; ?>" required>
                        <option value="1" <?php echo (isset($row['TipoPessoa']) && $row['TipoPessoa'] == 1) ? 'selected' : ''; ?>>Cliente</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Senha">Senha: </label>
                    <input class="form-control" type="password" name="Senha" required>
                </div>
                <div class="form-group">
                    <label for="Situacao">Status do agendamento:</label>
                    <select class="form-control" name="Situacao" id="Situacao" required>
                        <option value="0" <?php echo (isset($row['Situacao']) && $row['Situacao'] == 0) ? 'selected' : ''; ?>>Pendente</option>$row['Situacao'] ?? ''; ?>" required>
                        <option value="1" <?php echo (isset($row['Situacao']) && $row['Situacao'] == 1) ? 'selected' : ''; ?>>Confirmado</option>
                        <option value="2" <?php echo (isset($row['Situacao']) && $row['Situacao'] == 2) ? 'selected' : ''; ?>>Concluido</option>
                        <option value="1" <?php echo (isset($row['Situacao']) && $row['Situacao'] == 3) ? 'selected' : ''; ?>>Cancelado</option>
                    </select>
                </div>
                <button class="btn btn-primary" type="submit">Salvar</button>
                <button class="btn btn-primary" type="submit" onclick="redirecionar()">Login</button>
            </form>

    <script>
    function redirecionar() {
        window.location.href = "login.php";
    }
    </script>
    </div>
    <footer class="text-center">
        <p>&copy; 2025 Cabeleleila Leila. All rights reserved.</p>
    </footer>

</body>

</html>