<?php
include '../accueil/header.php';

$user_id = $_SESSION['id'];
$filename = "../traitement/users.csv";
$file = fopen($filename, "r");

if ($_SESSION['rôle'] == 'User')
{
    while (($line = fgetcsv($file)) !== false)
    {
        if ($line[3] == $user_id) {
            echo "<h3>Current Last name</h3>";
            echo "<li>$line[1]</li>";
            echo "<h3>Current First name</h3>";
            echo "<li>$line[2]</li>";
            echo "<h3>Current Email</h3>";
            echo "<li>$line[6]</li>";
        }
    }

    fclose($file);

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $updatedLines = [];

        $file = fopen($filename, "r");
        while (($line = fgetcsv($file)) !== FALSE)
        {
            if ($line[3] == $user_id)
            {
                $line[1] = ($line[1] == $_SESSION["lastname"]) ? $_POST["change_lastname"] : $_SESSION["lastname"];
                $line[2] = ($line[2] == $_SESSION["firstname"]) ? $_POST["change_firstname"] : $_SESSION["firstname"];
                $line[3] = ($line[3] == $_SESSION["id"]) ? $_POST["change_id"] : $_SESSION["id"];
                $line[4] = ($line[4] == $_SESSION["password"]) ? password_hash($_POST['change_password'], PASSWORD_DEFAULT) : $_SESSION["password"];
                $line[6] = ($line[6] == $_SESSION["email"]) ? $_POST["change_email"] : $_SESSION["email"];
                
                header("location: ../login/deconnection.php");
            }
            $updatedLines[] = $line;
        }

        fclose($file);

        $file_open = fopen($filename, 'w');
        foreach ($updatedLines as $updatedLine)
        {
            fputcsv($file_open, $updatedLine);
        }
        fclose($file_open);
    }
} else {
    header('location: ../accueil/accueil.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My account</title>
</head>
<body>
    <h2>Update User Data</h2>
    <form method='POST' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        First Name: <input type="text" name="change_firstname" value="<?php echo $_SESSION["firstname"]; ?>"><br>
        Last Name: <input type="text" name="change_lastname" value="<?php echo $_SESSION["lastname"]; ?>"><br>
        ID: <input type="text" name="change_id" value="<?php echo $_SESSION["id"]; ?>"><br>
        Email: <input type="email" name="change_email" value="<?php echo $_SESSION["email"]; ?>"><br>
        Password: <input type="password" name="change_password" value=""><br>
        <input type="submit" value="Update information">
    </form>
</body>
</html>
