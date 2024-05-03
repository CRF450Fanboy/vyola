<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🔓 | Vyola Register</title>
    <link rel="stylesheet" href="styles/login.css">
    <script src="index.js"></script>
</head>

<body>

    <h1 class = "title">
        Vyola
    </h1>

    <p class = "subtitle">
        Register to the future of app stores
    </p>

    <form id="registerForm" action="" method="post" class="loginForm" onsubmit="scrollToError(); return false;">

      <div class = "formCompile">
            <div class = "registerLeft">

                <div class = "inputContainer">
                    <p class = "inputLbl" id = "longerInput1">
                        Username
                    </p>

                    <input class = "inputBox" type = "text" name = "username" required>
                </div>
                    
                <br>

                <div class = "inputContainer">
                    <p class = "inputLbl" id = "longerInput2">
                        Password
                    </p>

                    <input class = "inputBox" type = "password" name = "password" required>
                </div>

                <br>

                <div class = "inputContainer">
                    <p class = "inputLbl" id = "longerInput3">
                        Repeat password
                    </p>

                    <input class = "inputBox" type = "password" name = "passwordRepeat" required>
                </div>
            </div>

            <div class = "registerRight">

                <div class = "inputContainer">
                    <p class = "inputLbl" id = "longerInput4">
                        Name
                    </p>

                    <input class = "inputBox" type = "text" name = "name" required>
                </div>
                    
                <br>

                <div class = "inputContainer">
                    <p class = "inputLbl" id = "longerInput5">
                        Surname
                    </p>

                    <input class = "inputBox" type = "password" name = "surname" required>
                </div>

                <br>

                <div class = "inputContainer">
                    <p class = "inputLbl" id = "longerInput6">
                        Date of birth
                    </p>

                    <input class = "inputBox" id = "inputDate" type = "date" name = "dob" required>
                </div>

            </div>
        </div>

      <br>

      <input class = "submitBtn" type = "submit" name = "submit" value = "Register"></input>
    </form>

    <div class = "register">
      <p id = "noAcc">Already have an account?</p>
      <a id = "hyperlink" href = "login.php">Login</a>
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
            $passwordRepeat = $_POST['passwordRepeat'];

            $hashedPassword = hash('sha512', $password);
            $hashedPasswordRepeat = hash('sha512', $passwordRepeat);

            $name = capitalizeFirstLetter($_POST['name']);
            $surname = capitalizeFirstLetter($_POST['surname']);
            $dob = $_POST['dob'];

            $initialBalance = 10;

            if(!($password == $passwordRepeat))
            {
                echo '<p id = "error"> The passwords you entered do not match! </p>';
            }
            else
            {
                $stmt = $conn->prepare("INSERT INTO account (username, password, name, surname, dob, balance) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssi", $username, $hashedPassword, $name, $surname, $dob, $initialBalance);

                if ($stmt->execute())
                {
                    // 86400 = 1 day
                    setcookie("logged", true, time() + (86400 * 30), "/");
                    setcookie("username", $username, time() + (86400 * 30), "/");
                    setcookie("password", $hashedPassword, time() + (86400 * 30), "/");

                    header("Location: dashboard.php");
                } else
                {
                    echo "<p id = 'error' >Errore nella creazione dell'account!</p>";
                }

                $stmt->close();
            }
        }

        $conn->close();

    ?>

</body>

</html>
