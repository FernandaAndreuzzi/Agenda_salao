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
    <div class='container row col-md-offset-4 col-md-4'>
<?php
include('config.php'); 


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    
    $sql = "DELETE FROM Agenda WHERE IdAgenda = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color:green;'>Agendamento excluído com sucesso!✅</p>";
    } else {
         echo "<p style='color:red;'>Erro ao excluir❌: " . $conn->error . "</p>";
    }

    $conn->close();
}
?>

<a href="agendamento_index.php">Voltar para a lista de agendamentos</a>
    </div>
<footer class="text-center">
        <p>&copy; 2025 Cabeleleila Leila. All rights reserved.</p>
    </footer>

</body>

</html>
