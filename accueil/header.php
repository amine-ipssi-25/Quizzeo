<?php
session_start();
$user_id = isset($_SESSION['id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizzeo</title>
    <link rel="stylesheet" href="../accueil/header.css">
    <script src="https://kit.fontawesome.com/3b9e7859ca.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <nav>
            <div class='logo'>
                <a href="../accueil/accueil.php">
                <img src="../accueil/assets/quizzeo.png" alt="logo"/> 
                </a>
            </div>
            <ul>
                <li class='home button'><a href="../accueil/accueil.php">Home</a></li>
                <?php
                if (isset($_SESSION["rôle"]))
                {
                    if ($_SESSION['rôle'] == 'Admin')
                    {?>
                        <li class='Admin button'><a class='Admin' href="../admin/admin.php">Admin</a></li><?php
                    }
                    if ($_SESSION['rôle'] == 'School')
                    {?>
                        <li class='Admin button'><a class='Admin' href="../school/school.php">School</a></li><?php
                    }
                    if ($_SESSION['rôle'] == 'Company')
                    {?>
                        <li class='Admin button'><a class='Admin' href="../company/company.php">Company</a></li><?php
                    }
                    if ($_SESSION["rôle"] == 'School' || $_SESSION["rôle"] == 'Company')
                    {?>
                        <li class='myquizz button'><a href="../quiz/myquiz.php">My Quizz</a></li>
                        <li class='create button'><a class="quiz" href="../quiz/quiz.php">Create</a></li><?php
                    }
                    if ($_SESSION["rôle"] == 'User')
                    {?>
                        <li class='myquizz button'><a href="../quiz/myquiz.php">Play</a></li>
                        <li class='Dashboard button'><a href="../user/user.php">Dashboard</a></li><?php
                    }
                }?>
            </ul>
        </nav>
        <div class = 'login'>
            <?php
            if(isset($_SESSION['id']))
            {
                ?>
                <a href="../login/deconnection.php"><i class="fa-solid fa-user fa-2xl" style="color: #9a79fb;"></i></a>
                <a href="../login/deconnection.php"><h3>Logout</h3></a>
                <?php
            }
            else {
                ?>
                <a href="../login/connection.php"><i class="fa-solid fa-user fa-2xl" style="color: #9a79fb;"></i></a>
                <a href="../login/connection.php"><h3>Login</h3></a>
                <?php
            }
            ?>
        </div>
    </header>
</body>
</html>