<?php
session_start();

include 'menu.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php"); 
    exit;
}

?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salão da Cabeleleila Leila</title>
    <link rel="stylesheet" href="style/style.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
   
   
</head>

<body>

    <?php renderMenu('about.php'); ?>
    <div class='container row col-md-offset-1 col-md-10'>
        <?php
        include('config.php'); 


        $sql = "SELECT * FROM pessoas";
        $result = $conn->query($sql);

        echo "<h2>Lista de Clientes👥</h2>";
        echo "<p><a href='cliente_edit.php?id=0'>+ Novo Cliente</a></p>";

        if ($result->num_rows > 0) {
            echo "<table class='table' border='1'>
                    <tr>
                        <th>IdPessoa</th>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>Cpf</th>
                        <th>Data de Nascimento</th>
                        <th>E-mail</th>
                        <th>Logradouro</th>
                        <th>Número</th>
                        <th>Tipo Pessoa</th>
                        <th>Situação</th>
                        <th>Criado Em</th>
                    </tr>";

            
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["IdPessoa"] . "</td>
                        <td>" . $row["Nome"] . "</td>
                        <td>" . $row["Telefone"] . "</td>
                        <td>" . $row["Cpf"] . "</td>
                        <td>" . $row["DataNascimento"] . "</td>
                        <td>" . $row["Email"] . "</td>
                        <td>" . $row["Logradouro"] . "</td>
                        <td>" . $row["Numero"] . "</td>
                        <td>" . $row["TipoPessoa"] . "</td>
                        <td>" . $row["Situacao"] . "</td>
                        <td>" . $row["CriadoEm"] . "</td>
                        
                        <td>
                            <a href='cliente_edit.php?id=" . $row["IdPessoa"] . "'>Editar</a> 
                        </td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "0 resultados";
        }

        $conn->close();
        ?>
    </div>
    <footer class="text-center">
        <p>&copy; 2025 Cabeleleila Leila. All rights reserved.</p>
    </footer>

</body>

</html>
