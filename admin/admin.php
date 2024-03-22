<?php
include('../accueil/header.php');
if(isset($_SESSION['admin']))
{
    if(isset($_POST['toggle']))
    {
        $user_id = $_POST['id'];
        $file_name = '../traitement/users.csv';
        $file_open = fopen($file_name, 'r');

        $updatedLines = [];

        while (($line = fgetcsv($file_open)) !== FALSE)
        {
            if ($line[0] == 'Admin')
            {
                $line[5] = '1';
            }
            else if ($line[3] == $user_id)
            {
                $line[5] = ($line[5] == "1") ? "0" : "1";
            }
            $updatedLines[] = $line;
        }

        fclose($file_open);

        $file_open = fopen($file_name, 'w');
        foreach ($updatedLines as $updatedLine)
        {
            fputcsv($file_open, $updatedLine);
        }
        fclose($file_open);

        $quiz_id = $_POST['id_quiz'];
        $file_name_quiz = '../traitement/quiz_data.csv';
        $file_open_quiz = fopen($file_name_quiz, 'r+');

        $updated_quiz_lines = [];

        while (($line_quiz = fgetcsv($file_open_quiz)) !== FALSE)
        {
            if ($line_quiz[3] == $quiz_id)
            {
                $line_quiz[2] = ($line_quiz[2] == "1") ? "0" : "1";
            }
            $updated_quiz_lines[] = $line_quiz;
        }

        fclose($file_open_quiz);

        $file_open_quiz = fopen($file_name_quiz, 'w');
        foreach ($updated_quiz_lines as $updated_Line)
        {
            fputcsv($file_open_quiz, $updated_Line);
        }
        fclose($file_open_quiz);

        header("Location: ".$_SERVER['REQUEST_URI']);
        exit();
    }?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./admin.css">
        <title>Admin</title>
    </head>
    <body>
        <div class ='admin'>
            <h1>Database</h1>
            <h2>All accounts</h2>
            <ul>
                <?php
                $file_name = '../traitement/users.csv';
                $file_open = fopen($file_name,'r');

                while (($line = fgetcsv($file_open)) !== FALSE)
                {
                    echo "<li>$line[0]: $line[3]</li>";
                }
                fclose($file_open);
                ?>
            </ul>
            
            <h2>Activate | Deactivate account</h2>
            <ul>
                <?php
                $file_name = '../traitement/users.csv';
                $file_open = fopen($file_name,'a+');

                while (($line = fgetcsv($file_open)) !== FALSE)
                {
                    if ($line[5] == "1")
                    {
                        if ($line[0] == 'Admin')
                        {
                            echo "<li>$line[3]</li>";
                            echo "<form method='POST'>";
                            echo "<input type='hidden' name='id' value='$line[3]'>";
                            echo "<button type='submit' name='toggle'>Admin</button>";
                            echo "</form>";
                        } else
                        {
                            echo "<li>$line[3]</li>";
                            echo "<form method='POST'>";
                            echo "<input type='hidden' name='id' value='$line[3]'>";
                            echo "<button type='submit' name='toggle'>Deactivate</button>";
                            echo "</form>";
                        }
                    }
                    else if ($line[5] == "0")
                    {
                        echo "<li>$line[3]</li>";
                        echo "<form method='POST'>";
                        echo "<input type='hidden' name='id' value='$line[3]'>";
                        echo "<button type='submit' name='toggle'>Activate</button>";
                        echo "</form>";
                    }
                }
                fclose($file_open);
                ?>
            </ul>
            
            <h2>Activate | Deactivate quiz</h2>
            <ul><?php
            $file_name_quiz = '../traitement/quiz_data.csv';
            $file_open_quiz = fopen($file_name_quiz,'a+');

            while (($line_quiz = fgetcsv($file_open_quiz)) !== FALSE)
            {
                if ($line_quiz[2] == "1" && $line_quiz[1] !== "Quiz")
                {
                    echo "<li>$line_quiz[1]</li>";
                    echo "<form method='POST'>";
                    echo "<input type='hidden' name='id_quiz' value='$line_quiz[3]'>";
                    echo "<button type='submit' name='toggle'>Deactivate</button>";
                    echo "</form>";
                }
                if ($line_quiz[2] == "0")
                {
                    echo "<li>$line_quiz[1]</li>";
                    echo "<form method='POST'>";
                    echo "<input type='hidden' name='id_quiz' value='$line_quiz[3]'>";
                    echo "<button type='submit' name='toggle'>Activate</button>";
                    echo "</form>";
                }
            }
            fclose($file_open_quiz);
            ?>
        </ul>

        <h2>State of the Quiz</h2>
        </div>
    </body>
    </html><?php
}?>