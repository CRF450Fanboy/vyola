<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🔓 | Vyola App</title>
    <link rel="stylesheet" href="styles/styleHeight950.css">
    <script src="index.js"></script>
</head>

<body>

    <?php
        if(!isset($_COOKIE['logged']) || $_COOKIE['logged'] == false)
        {
            //header("Location: index.php");
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

        $username = $_COOKIE['username'];
        $id = $_COOKIE['id'];

        $stmt = $conn->prepare("SELECT * FROM account WHERE username = ? AND id = ?");
        $stmt->bind_param("ss", $username, $id);

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1)
        {
            $row = $result -> fetch_assoc();
            // 86400 = 1 day

            $id = $row['id'];
            $username = $row['username'];
            $name = $row['name'];
            $surname = $row['surname'];
            $dob = $row['dob'];
            $balance = $row['balance'];
        } else
        {
            //header("Location: index.php");
            echo '<br><br><br><br><br><br><br> no res';
        }

        $stmt->close();

        $conn->close();
    ?>

    <div class = "header">

    <div class = "headerLeft">
        <a href = "index.php">
            <img src = "img/logo.png" id = "logoHeader">
        </a>
    </div>

    <div class = "headerRight">
        <ul>
            <li> <a href = "index.php" class = "linkHeader"> Home </a> </li>
            <li> <a href = "#" class = "linkHeader"> Store </a> </li>
            <li> <a href = "about.php" class = "linkHeader"> About </a> </li>
        </ul>
    </div>

    <a href = "login.php">
        <img src = "img/login2.png" id = "logoHeader2">
    </a>

    </div>

    <h1 class = "title">
    Vyola User Dashboard
    </h1>

    <p class = "subtitle">
    Alternative app stores at their finest!
    </p>

    <?php
        echo $id . "<br>";
        echo $username . "<br>";
        echo $name . "<br>";
        echo $surname . "<br>";
        echo $dob . "<br>";
        echo $balance . "<br>";
    ?>

</body>

</html>
