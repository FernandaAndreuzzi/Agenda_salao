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



<main>
  <h2><black>Olá, sou a Leila! A sua cabeleleila 🖤✂️</black></h2>

  <br>
  <h3><italic> Sobre mim </italic></h3>
  <p>Com 13 anos de experiência em cuidar da estética e da saúde dos seus cabelos, tenho
      como missão te ensinar que é possível ter um cabelo bonito e saudável
      de forma descomplicada e fácil de cuidar. Meu atendimento é personalizado
      e utilizo as mais novas tecnologias dos salões de beleza para cuidar de você
      e te ajudar a alcançar o resultado que você sempre sonhou!
   </p>
   
</main>

<footer class="text-center">
    <p>&copy; 2025 Cabeleleila Leila. All rights reserved.</p>
</footer>
</body>
</html>
