<?php
include('../accueil/header.php');
$file_name = '../traitement/quiz_resultat.csv';
$file = fopen($file_name,'r');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../quiz/score.css">
    <title>Score</title>
</head>
<body>
    <div class="score">
        <h1>Félicitations !</h1>
        <?php
        while (($line = fgetcsv($file)) !== false) {
            if (isset($line[1]) && $line[1] == $_SESSION['id']){
                echo"<h2>Bravo  $line[1] . Voici votre score est de $line[3] au quizz : $line[2] </h2>";
            }
        }
        ?>
    </div>
</body>
</html>
