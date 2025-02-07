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
    <?php
        include('config.php'); 
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            
        $sql = "SELECT * FROM Agenda WHERE IdAgenda = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } 
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $FlagCorte = isset($_POST['Corte'])?1:0;
            $FlagColoracao = isset($_POST['Coloracao'])?1:0;
            $FlagLuzes = isset($_POST['Luzes'])?1:0;
            $FlagHidratacao = isset($_POST['Hidratacao'])?1:0;
            $FlagReconstrucaoCapilar = isset($_POST['ReconstrucaoCapilar'])?1:0; 
            $FlagNutricaoCapilar = isset($_POST['NutricaoCapilar'])?1:0;
            $FlagManicure = isset($_POST['Manicure'])?1:0;
            $FlagPedicure = isset($_POST['Pedicure'])?1:0; 
            $DataAgendamento = $_POST['DataAgendamento'];
            
            if($id!=0)
            {
                $sqlUpdate = "UPDATE Agenda SET FlagCorte = '$FlagCorte', 
                FlagColoracao = '$FlagColoracao', 
                FlagLuzes = '$FlagLuzes',
                FlagHidratacao = '$FlagHidratacao',
                FlagReconstrucaoCapilar = '$FlagReconstrucaoCapilar',
                FlagNutricaoCapilar = '$FlagNutricaoCapilar',
                FlagManicure = '$FlagManicure',
                FlagPedicure = '$FlagPedicure',
                DataAgendamento = '$DataAgendamento'
                
                WHERE IdAgenda = $id";
                
                if ($conn->query($sqlUpdate) === TRUE){
                    echo "<p style='color:green;'>Agendamento atualizado com sucesso!✅</p>";
                } else {
                    echo "<p style='color:red;'>Erro ao atualizar❌: " . $conn->error . "</p>";
                }
            }
            else{
                
                
                
                $sql = "SELECT COUNT(*) AS TotalAgendamentos
                        FROM 
                            agenda
                        WHERE 
                            DataAgendamento BETWEEN DATE_ADD('$DataAgendamento', INTERVAL -1 HOUR) 
                        AND DATE_ADD('$DataAgendamento', INTERVAL 1 HOUR);";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
    
                if ($row['TotalAgendamentos'] > 0) {
                    echo "<p style='color:red;'>Já existe um agendamento neste horário. Por favor, escolha outro horário❌: " . $conn->error . "</p>";
                } 
                else 
                {
                    $sqlInsert = "INSERT INTO agenda 
                    (DataAgendamento, FlagCorte, FlagColoracao, FlagLuzes, FlagHidratacao, FlagReconstrucaoCapilar, FlagNutricaoCapilar, FlagManicure, FlagPedicure, FlagStatus, IdPessoa) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 0, ?)";
    
                    
                    $stmt = $conn->prepare($sqlInsert);
    
                    
                    if ($stmt === false) {
                    die('Erro na preparação da consulta: ' . $conn->error);
                    }
    
                    
                    $stmt->bind_param('sssssssssi', 
                    $DataAgendamento, 
                    $FlagCorte, 
                    $FlagColoracao, 
                    $FlagLuzes, 
                    $FlagHidratacao, 
                    $FlagReconstrucaoCapilar, 
                    $FlagNutricaoCapilar, 
                    $FlagManicure, 
                    $FlagPedicure, 
                    $_SESSION['user_id']
                    );
    
                    
                    if ($stmt->execute()) {
                        echo "<p style='color:green;'>Agendamento realizado com sucesso!✅</p>";
                    } else {
                    echo "<p style='color:red;'>Erro ao agendar❌: " . $conn->error . "</p>";
                    }
                }
                $conn->close();
            }
            
        }
    ?>
    <p><h1><black>Agendamentos</black></h1></p>
    <h2>Deseja agendar os nossos serviços? Preencha os campos abaixo:</h2>
    <br>
        
        <form method="POST" >
        <label for="services">Selecione os serviços:</label><br><input type="checkbox" name="Corte[]" value="1" <?php echo (($row['FlagCorte'] ?? 0) == 1) ? 'checked' : ''; ?>>Corte<br>
        <input type="checkbox" name="Coloracao" value="true" <?php echo (($row['FlagColoracao']?? 0) == 1) ? 'checked' : ''; ?>> Coloração<br>
        <input type="checkbox" name="Luzes" value="true" <?php echo (($row['FlagLuzes']?? 0) == 1) ? 'checked' : ''; ?>> Luzes<br>
        <input type="checkbox" name="Hidratacao" value="true" <?php echo (($row['FlagHidratacao'] ?? 0) == 1) ? 'checked' : ''; ?>> Hidratação<br>
        <input type="checkbox" name="ReconstrucaoCapilar" value="true" <?php echo (($row['FlagReconstrucaoCapilar']?? 0) == 1) ? 'checked' : ''; ?>> Reconstrução Capilar<br>
        <input type="checkbox" name="NutricaoCapilar" value="true" <?php echo (($row['FlagNutricaoCapilar']?? 0) == 1) ? 'checked' : ''; ?>> Nutrição Capilar<br>
        <input type="checkbox" name="Manicure" value="true" <?php echo (($row['FlagManicure']?? 0) == 1) ? 'checked' : ''; ?>> Manicure<br>
        <input type="checkbox" name="Pedicure" value="true" <?php echo (($row['FlagPedicure']?? 0) == 1) ? 'checked' : ''; ?> > Pedicure<br><br>

        <label for="appointment_date">Data e Hora:</label>
        <input type="datetime-local" name="DataAgendamento" value="<?php echo (($row['DataAgendamento']?? ""));?>">
        <br>
        <input type="submit" value="Agendar">
    </form>

    
</body>

</html>

