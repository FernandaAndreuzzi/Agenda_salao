<?php
session_start(); 


if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    header("Location: home.php"); 
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
   
</head>
<body>
<div class='container row col-md-offset-4 col-md-4'>
    <h2>Login</h2>
    <form action="login.php" method="POST">
        <div class="form-group">
            <label for="email">Email:</label>
            <input class="form-control" type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Senha:</label>
            <input class="form-control" type="password" id="password" name="password" required>
        </div>
        <button type="submit">Entrar</button>
    </form>
</div>
</body>
</html>

<?php
include('config.php'); 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    $sql = "SELECT * FROM Pessoas WHERE Email = '$email' LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        
        if (password_verify($password, $user['Senha'])) {        
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $user['IdPessoa'];
            $_SESSION['email'] = $user['Email'];
            $_SESSION['tipoUsuario'] = $user['TipoPessoa'];
            $dataHoraAtual = date('Y-m-d H:i:s'); 

            $idUsuario = $user['IdPessoa'];
            $sql = "INSERT INTO acesso (DataInicioSessao, IdPessoa) VALUES ('$dataHoraAtual',$idUsuario)";
            $conn->query($sql);
            $_SESSION['idSessao'] = $conn->insert_id;
            header("Location: home.php");
        } else {
            echo "Senha incorreta!";
        }
    } else {
        echo "Usuário não encontrado!";
    }
}
?>
