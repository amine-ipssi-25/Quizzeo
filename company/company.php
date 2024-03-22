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
        <h1>Data Company</h1>
        <?php
        while (($line = fgetcsv($file)) !== false) {
            if (isset($line[0]) && $line !== 'School'){
                echo"<h2>L'utilisateur $line[1] à fait le quiz $line[2] et à obtenu le score de $line[3]</h2>";
            }
        }
        ?>
    </div>
</body>
</html>
