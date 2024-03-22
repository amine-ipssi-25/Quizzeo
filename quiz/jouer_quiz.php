<?php
include ('../accueil/header.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['id']) || !isset($_SESSION['rôle'])) {
    // Redirection si l'utilisateur n'est pas connecté ou si les informations de session sont absentes
    header('Location: ../chemin/vers/la/page/de/connexion.php');
    exit();
}

if (!isset($_GET['quiz'])) {
    // Redirection si le paramètre 'quiz' est absent dans l'URL
    header('Location: ../chemin/vers/la/page/de/sélection-du-quiz.php');
    exit();
}

$quizSelectionne = $_GET['quiz'];
$score = 0;
$note = 0;

$quizDataFile = fopen("../traitement/quiz_data.csv", "r");

if ($quizDataFile) {
    fgetcsv($quizDataFile); // Ignorer la première ligne (en-têtes)

    while (($quizData = fgetcsv($quizDataFile)) !== false) {
        if ($quizData[1] === $quizSelectionne) {
            $titreQuiz = $quizData[1];
            echo "<h2>Titre du quiz : $titreQuiz</h2>";

            $questionsFile = fopen("../traitement/quiz_question.csv", "r");

            if ($questionsFile) {
                fgetcsv($questionsFile); // Ignorer la première ligne (en-têtes)
                $i = 0;

                while (($questionsData = fgetcsv($questionsFile)) !== false) {
                    if ($questionsData[0] === $titreQuiz) {
                        echo "<p>Question : {$questionsData[1]}</p>";
                        $reponsesFile = fopen("../traitement/quiz_reponse.csv", "r");

                        if ($reponsesFile) {
                            fgetcsv($reponsesFile); // Ignorer la première ligne (en-têtes)
                            $reponseSelectionnee = false;

                            while (($reponsesData = fgetcsv($reponsesFile)) !== false) {
                                if ($reponsesData[0] === $titreQuiz && $reponsesData[1] === $questionsData[1]) {
                                    $i += 1;
                                    echo "<form action='' method='post'>";
                                    echo "<input type='radio' name='question" . $i . "' value='{$reponsesData[2]}'> {$reponsesData[2]}<br>";
                                    echo "<input type='radio' name='question" . $i . "' value='{$reponsesData[3]}'> {$reponsesData[3]}<br>";
                                    echo "<input type='radio' name='question" . $i . "' value='{$reponsesData[4]}'> {$reponsesData[4]}<br>";
                                    echo "<input type='radio' name='question" . $i . "' value='{$reponsesData[5]}'> {$reponsesData[5]}<br>";
                                    echo "<input type='hidden' name='bareme" . $i . "' value='{$questionsData[2]}'> La question vaux {$questionsData[2]}<br>";


                                    $reponseSelectionnee = true;
                                }
                            }
                            fclose($reponsesFile);

                            if (!$reponseSelectionnee) {
                                echo "<p style='color: red;'>Vous devez sélectionner une réponse pour cette question.</p>";
                            }
                        }
                    }
                }
                fclose($questionsFile);
                echo "<input type='submit' value='Valider'>";
                echo "</form>";
            }
        }
    }
    fclose($quizDataFile);
}

                $score = 0;
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $reponsesFile = fopen("../traitement/quiz_reponse.csv", "r");
                    $questionsFile = fopen("../traitement/quiz_question.csv", "r");

                    if ($questionsFile) {
                        fgetcsv($questionsFile);
                        while (($questionsData = fgetcsv($questionsFile)) !== false) {

            if ($reponsesFile) {
                fgetcsv($reponsesFile); // Ignorer la première ligne (en-têtes)

                                while (($reponsesData = fgetcsv($reponsesFile)) !== false) {
                                    if (isset ($_POST['question1'])) {
                                        $bareme = $_POST['bareme1'];
                                        $reponseUtilisateur = $_POST['question1'];
                                        if ($reponseUtilisateur == $reponsesData[6]) {
                                            $score += intval($bareme);
                                        }
                                    }
                                    if (isset ($_POST['question2'])) {
                                        $bareme = $_POST['bareme2'];
                                        $reponseUtilisateur = $_POST['question2'];
                                        if ($reponseUtilisateur == $reponsesData[6]) {
                                            $score += intval($bareme);
                                        }
                                    }
                                    if (isset ($_POST['question3'])) {
                                        $bareme = $_POST['bareme3'];
                                        $reponseUtilisateur = $_POST['question3'];
                                        if ($reponseUtilisateur == $reponsesData[6]) {
                                            $score += intval($bareme);
                                        }
                                    }
                                    if (isset ($_POST['question4'])) {
                                        $bareme = $_POST['bareme4'];
                                        $reponseUtilisateur = $_POST['question4'];
                                        if ($reponseUtilisateur == $reponsesData[6]) {
                                            $score += intval($bareme);
                                        }
                                    }

                                }
                                fclose($reponsesFile);
                            }
                            $resultatFile = fopen("../traitement/quiz_resultat.csv", "a");
                            if ($line[1] == $_SESSION['id'] && $line[2] == $questionsData[1]) {
                                echo "EHHHH non tu l'as déja fait mon grand";
                            } else {
                                fputcsv($resultatFile, [$_SESSION['rôle'], $_SESSION['id'], $titreQuiz, $score]);
                                fclose($resultatFile);
                                header('location: ../quiz/score.php');
                            }
                        }fclose($questionsFile);
                    }
                }

            }
        }
    }
    fclose($quizDataFile);


}
?>
