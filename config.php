<?php

$servername = "localhost"; 
$username = "root";        
$password = "154525";            
$dbname = "agenda_salao"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Conexão falhou." . $conn->connect_error);
}



?> 