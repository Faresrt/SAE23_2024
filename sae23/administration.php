<?php
session_start(); // Start the session

// Database connection parameters
$servername = "localhost";
$username = "root";
$password_db = "22207448";
$dbname = "sae23";

// Connect to the database
$conn = mysqli_connect($servername, $username, $password_db, $dbname);

// Check the database connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Handle the login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login']) && isset($_POST['password'])) {
        $login = $_POST['login'];
        $password = $_POST['password'];

        // Query to verify the credentials
        $query = "SELECT * FROM administration WHERE login = '$login' AND mot_de_passe = '$password'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            // User authenticated successfully
            $_SESSION['admin_logged'] = true;
            $_SESSION['login'] = $login;
            
            // Redirect to the intadmin
            header("Location: intadmin.php");
            exit();
        } else {
            $error = "Invalid credentials. Please try again.";
        }
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/stylet.css">
    <title>Login</title>
</head>
<body>

<div class="login-form">
    <h2>Login</h2>
    <?php if (isset($error)) { echo "<p>$error</p>"; } // Display error message if it exists ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); // Ensure the form submits to the current page ?>">
        <label for="login">Login:</label>
        <input type="text" id="login" name="login" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <button type="submit">Log In</button>
    </form>
</div>

</body>
</html>
