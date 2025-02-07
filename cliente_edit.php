<?php
session_start();
include 'menu.php';
/*
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php"); 
    exit;
}*/

function validarCPF($cpf) {
   
    $cpf = preg_replace('/\D/', '', $cpf);

    if (strlen($cpf) != 11) {
        return false;
    }
   
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    for ($t = 9; $t < 11; $t++) {
        $d = 0;
        for ($c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$t] != $d) {
            return false;
        }
    }

    return true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $telefone = $_POST["Telefone"];
    $telefone = preg_replace('/\D/', '', $telefone); 
}
   
function validarEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}




?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salão da Cabeleleila Leila</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    <?php renderMenu('cliente_edit.php'); ?>
    <?php
    include('config.php'); 
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM Pessoas WHERE IdPessoa = $id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        }
    }
    ?>

    <div class="container">
        <div class="row col-md-offset-4 col-md-4">
            <h2>Editar Usuário</h2>
            <form method="POST">
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
                    <label for="TipoPessoa">Tipo de usuário:</label>
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
                    <label for="Situacao">Situação:</label>
                    <select class="form-control" name="Situacao" id="Situacao" required>
                        <option value="0" <?php echo (isset($row['Situacao']) && $row['Situacao'] == 0) ? 'selected' : ''; ?>>Pendente</option>$row['Situacao'] ?? ''; ?>" required>
                        <option value="1" <?php echo (isset($row['Situacao']) && $row['Situacao'] == 1) ? 'selected' : ''; ?>>Confirmado</option>
                        <option value="2" <?php echo (isset($row['Situacao']) && $row['Situacao'] == 2) ? 'selected' : ''; ?>>Concluido</option>
                        <option value="1" <?php echo (isset($row['Situacao']) && $row['Situacao'] == 3) ? 'selected' : ''; ?>>Cancelado</option>
                    </select>
                </div>
                <button class="btn btn-primary" type="submit">Salvar</button>
            </form>

            <?php 
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $nome = $_POST['Nome'];
                $telefone = $_POST['Telefone'];
                $cpf = $_POST['Cpf'];
                $dataNascimento = $_POST['DataNascimento'];
                $email = $_POST['email'];
                $logradouro = $_POST['Logradouro'];
                $numero = $_POST['Numero'];
                $tipoPessoa = $_POST['TipoPessoa'];
                $senha = password_hash($_POST['Senha'], PASSWORD_DEFAULT); 
                $situacao = $_POST['Situacao'];
                $dataConvertida = DateTime::createFromFormat('Y-m-d', $dataNascimento)->format('Y/m/d');

                
                if (!validarCPF($cpf)) {
                    echo "<p style='color:red;'>CPF inválido! Tente novamente❌</p>";
                } else {
                    if ($id != 0) {
                        $sql = "UPDATE Pessoas SET 
                                Nome = '$nome', 
                                Email = '$email', 
                                Telefone = '$telefone',
                                Cpf = '$cpf',
                                DataNascimento = '$dataConvertida',
                                Logradouro = '$logradouro',
                                Numero = '$numero',
                                TipoPessoa = '$tipoPessoa',
                                Senha = '$senha',
                                Situacao = '$situacao'
                                WHERE IdPessoa = $id";

                        if ($conn->query($sql) === TRUE) {
                            echo "<p style='color:green;'>Usuário(a) atualizado(a) com sucesso!✅</p>";
                        } else {
                            echo "<p style='color:red;'>Erro ao atualizar❌: " . $conn->error . "</p>";
                        }
                    } else {
                        $sql = "INSERT INTO Pessoas 
                                (Nome, Email, Telefone, Cpf, DataNascimento, Logradouro, Numero, TipoPessoa, Senha, Situacao) 
                                VALUES ('$nome', '$email', '$telefone', '$cpf', '$dataConvertida', '$logradouro', '$numero', '$tipoPessoa', '$senha', '$situacao')";

                        if ($conn->query($sql) === TRUE) {
                            echo "<p style='color:green;'>Cadastrado(a) com sucesso!✅</p>";
                        } else {
                            echo "<p style='color:red;'>Erro no cadastro❌: " . $conn->error . "</p>";
                        }
                    }
                }
                $conn->close();
            }
            ?>
            <a href="cliente_index.php">Voltar para a lista de clientes!</a>
        </div>
    </div>
</body>
</html>
