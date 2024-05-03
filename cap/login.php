<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🔓 | Vyola Login</title>
    <link rel="stylesheet" href="styles/login.css">
    <script src="index.js"></script>
</head>

<body>

    <?php
        if(isset($_COOKIE['logged']) && $_COOKIE['logged'] == true)
        {
           header("Location: dashboard.php");
        }
    ?>

    <h1 class = "title">
        Vyola
    </h1>

    <p class = "subtitle">
        Login to your dashboard
    </p>

    <form action = "" method = "post" class = "loginForm">

      <p class = "inputLbl2">
          Username
      </p>

      <input class = "inputBox" type = "text" name = "username" required>
          
      <br>

      <p class = "inputLbl2">
          Password
      </p>

      <input class = "inputBox" type = "password" name = "password" required>

      <br>

      <input class = "submitBtn" type = "submit" name = "submit" value = "Login"></input>
    </form>

    <div class = "register">
      <p id = "noAcc">Don't have an account?</p>
      <a id = "hyperlink" href = "register.php">Register</a>
    </div>

    <?php

        function capitalizeFirstLetter($str)
        {
            return ucfirst($str);
        }

        $host = "localhost";
        $username = "root";
        $password = "";
        $dbname = "vyola";

        $conn = new mysqli($host, $username, $password, $dbname);
        if ($conn->connect_error)
        {
            die("Connessione fallita: " . $conn->connect_error);
        }

        if(isset($_POST['submit']))
        {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $hashedPassword = hash('sha512', $password);

            $stmt = $conn->prepare("SELECT * FROM account WHERE username = ? AND password = ?");
            $stmt->bind_param("ss", $username, $hashedPassword);

            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1)
            {
                $row = $result -> fetch_assoc();
                // 86400 = 1 day
                setcookie("logged", true, time() + (86400 * 30), "/");
                setcookie("username", $row['username'], time() + (86400 * 30), "/");
                setcookie("id", $row['id'], time() + (86400 * 30), "/");

                header("Location: dashboard.php");
            } else
            {
                echo "<p id = 'error' >Errore nella creazione dell'account!</p>";
            }

            $stmt->close();
        }

        $conn->close();
    ?>

</body>

</html>
