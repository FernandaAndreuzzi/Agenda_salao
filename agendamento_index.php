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

        $idPessoa = $_SESSION['user_id'];
        $sql = "SELECT * FROM agenda where IdPessoa = $idPessoa";
        $result = $conn->query($sql);

        echo "<h2>Histórico dos seus agendamentos ✂️</h2>";
        echo "<p><a href='agendamento_edit.php?id=0'>+ Novo agendamento 📅</a></p>";

        if ($result->num_rows > 0) {
            echo "<table class='table' border='1'>
                    <tr>
                        <th>Agendamento</th>
                        <th>Corte</th>
                        <th>Coloração</th>
                        <th>Luzes</th>
                        <th>Hidratacao</th>
                        <th>Reconstrução Capilar</th>
                        <th>Nutrição Capilar</th>
                        <th>Manicure</th>
                        <th>Pedicure</th>

                    </tr>";

            
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["DataAgendamento"] . "</td>
                        <td>" . ($row["FlagCorte"] == 1?"Sim":"Não") . "</td>
                        <td>" . ($row["FlagColoracao"] == 1?"Sim":"Não") . "</td>
                        <td>" . ($row["FlagLuzes"] == 1?"Sim":"Não") . "</td>
                        <td>" . ($row["FlagHidratacao"] == 1?"Sim":"Não") . "</td>
                        <td>" . ($row["FlagReconstrucaoCapilar"] == 1?"Sim":"Não") . "</td>
                        <td>" . ($row["FlagNutricaoCapilar"] == 1?"Sim":"Não") . "</td>
                        <td>" . ($row["FlagManicure"] == 1?"Sim":"Não") . "</td>
                        <td>" . ($row["FlagPedicure"] == 1?"Sim":"Não") . "</td>
                        
                        <td>
                            <a href='agendamento_edit.php?id=" . $row["IdAgenda"] . "'>Editar</a> | 
                            <a href='agendamento_delete.php?id=" . $row["IdAgenda"] . "'>Excluir</a>
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
