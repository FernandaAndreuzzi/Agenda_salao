<?php

session_start();
include('config.php');

            $idAcesso = $_SESSION['idSessao'] ;
            $dataHoraAtual = date('Y-m-d H:i:s'); 
            $sql = "update acesso set DataTerminoSessao = '$dataHoraAtual' where IdAcesso = $idAcesso"; 
            $conn->query($sql);
session_start();
session_unset();  
session_destroy(); 
header("Location: index.php"); 
exit;
?>
