<?php
include('../accueil/header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../quiz/quiz.css"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer votre quiz</title>
    <script>
    var nombreDeQuestions = 0; // Variable globale pour suivre le nombre de questions ajoutées
    var questions = []; // Tableau pour stocker les références de chaque question ajoutée

    // Fonction pour ajouter dynamiquement une nouvelle question
    function ajouterQuestion() {
        if (nombreDeQuestions < 5) { // Vérifier si le nombre de questions est inférieur à 5
            nombreDeQuestions++;
            var newDiv = document.createElement('div');
            newDiv.className = 'question';
            newDiv.id = 'question' + nombreDeQuestions;
            newDiv.innerHTML = '<h2>Question ' + nombreDeQuestions + '</h2>' +
                '<label>Question:</label><br>' +
                '<input type="text" name="question' + nombreDeQuestions + '" required><br>' +
                '<label>Choix n°1:</label><br>' +
                '<input type="text" name="question' + nombreDeQuestions + '_1" required><br>' +
                '<label>Choix n°2:</label><br>' +
                '<input type="text" name="question' + nombreDeQuestions + '_2" required><br>' +
                '<label>Choix n°3:</label><br>' +
                '<input type="text" name="question' + nombreDeQuestions + '_3" required><br>' +
                '<label>Choix n°4:</label><br>' +
                '<input type="text" name="question' + nombreDeQuestions + '_4" required><br>' +
                '<label>Réponse correcte:</label><br>' +
                '<select name="reponse_correcte' + nombreDeQuestions + '" required>' +
                '<option value="">Choisir</option>' +
                '<option value="question' + nombreDeQuestions + '_1">Choix n°1</option>' +
                '<option value="question' + nombreDeQuestions + '_2">Choix n°2</option>' +
                '<option value="question' + nombreDeQuestions + '_3">Choix n°3</option>' +
                '<option value="question' + nombreDeQuestions + '_4">Choix n°4</option>' +
                '</select><br>';
            if (nombreDeQuestions > 1) {
                var supprimerButton = document.createElement('button');
                supprimerButton.textContent = "Supprimer la question précédente";
                supprimerButton.type = "button";
                supprimerButton.onclick = function() {
                    supprimerDerniereQuestion();
                };
                newDiv.appendChild(supprimerButton);
            }
            document.getElementById('questionsContainer').appendChild(newDiv);
            questions.push(newDiv); // Ajouter la nouvelle question au tableau
        } else {
            alert("Vous avez atteint le maximum de 5 questions.");
        }
    }

    // Fonction pour supprimer la dernière question ajoutée
    function supprimerDerniereQuestion() {
        if (nombreDeQuestions > 1) {
            var derniereQuestion = questions.pop(); // Retirer la dernière question du tableau
            derniereQuestion.remove(); // Supprimer la dernière question du DOM
            nombreDeQuestions--;
        }
    }
</script>

</script>


</head>
<body>
    <div class='quizz'>
        <h1>Créer votre quiz</h1>
        <form action="../traitement/traitement_quiz.php" method="post" id="quizForm">
            <label class="titre">Titre du quiz:</label><br>
            <input type="text" name="titre_quiz" required><br> 
            <div id="questionsContainer">
                
            </div>
            <button type="button" onclick="ajouterQuestion()">Ajouter une question</button><br>
            <input id="valide" type="submit" value="VALIDER"> 
        </form>
    </div>
</body>
</html>
