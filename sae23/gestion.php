<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="styles/stylet.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <title>Gestion</title>
</head>

<body>

<?php
session_start();

// Function to check login credentials and redirect based on user type
function checkLogin($login, $mdp) {
    // Database connection details
    $host = "localhost";
    $dbname = "sae23";
    $username = "root";
    $password = "22207448";

    try {
        // Connect to database
        $conn = mysqli_connect($host, $username, $password, $dbname);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Query to check login credentials
        $query = "SELECT * FROM batiment WHERE login = ? AND mot_de_passe = ?";
        $stmt = mysqli_prepare($conn, $query);

        // Bind parameters and execute query
        mysqli_stmt_bind_param($stmt, "ss", $login, $mdp);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        // If user exists, redirect based on login and password
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($login == "UserRT" && $mdp == $row['mot_de_passe']) {
                header("Location: gestionE102-103.php");
                exit();
            } elseif ($login == "UserINFO" && $mdp == $row['mot_de_passe']) {
                header("Location: gestionB111-112.php");
                exit();
            }
        } else {
            echo "Login or password incorrect.";
        }

        // Close statement and connection
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Check if login form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST["login"];
    $mdp = $_POST["mdp"];

    // Call function to check login credentials
    checkLogin($login, $mdp);
}
?>

<!-- HTML form for login -->
<div class="background">
    <div class="shape"></div>
    <div class="shape"></div>
</div>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <h3>Login Here</h3>

    <label for="login">Login :</label>
    <input type="text" id="login" name="login" required><br><br>

    <label for="mdp">Password :</label>
    <input type="password" id="mdp" name="mdp" required><br><br>

    <button type="submit">Log In</button>
</form>

</body>
</html>
