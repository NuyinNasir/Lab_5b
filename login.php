<!DOCTYPE html> <!--Document as HTML -->
<html lang="en"> <!-- open html languange and set into english -->
<head>
    <meta charset="UTF-8"> <!--character specification encoding and support most chars-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
     <!--ensure the page is responsive in every devices-->
    <title>Login Page</title> <!--Title Page-->
    <style>
        body {
            font-family: Verdana, sans-serif;
            background-color: #f7f9fc;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin: 12px 0 6px;
            font-weight: bold;
        }
        input {
            padding: 10px;
            font-size: 1rem;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 6px;
        }
        button {
            background: #00778d7;
            color: #fff;
            padding: 12px;
            font-size: 1rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        button:hover {
            background: #005bb5;
        }
        .register-link, .login-link {
            text-align: center;
            margin-top: 10px;
            font-size: 0.9rem;
        }
        .register-link a, .login-link a {
            color: purple;
            text-decoration: none;
        }
        .register-link a:hover, .login-link a:hover {
            text-decoration: underline;
        }
        .error-message {
            color: red;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php
        session_start();
        //login form 
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //entering the data such matric and password
            $matric = $_POST['matric'];
            $password = $_POST['password'];
            //connect to the database
            $conn = new mysqli("localhost", "root", "", "Lab_5b");

            //checking the coonnection if failed
            if ($conn->connect_error) {
                die("The connection isn't successful!" . $conn->connect_error);
            }
            //query to connect the user
            $sql = "SELECT * FROM users WHERE matric = ?";
            $stmt = $conn->prepare($sql); //preparing the query 
            $stmt->bind_param("s", $matric); //bind the matric to the query
            $stmt->execute(); //execute the query 
            $result = $stmt->get_result(); //result

            //ensure the user is available
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc(); //get user details
                if (password_verify($password, $user['password'])) {
                    //login successful
                    header("Location: display.php"); //redirect to display.php
                    exit;
                } else {
                    echo "<p class='error-message'>Incorrect username or password, do <a href='login.php'>login</a> again.</p>";
                } //if password error, then show message above
            } else {
                echo "<p class='error-message'>Incorrect username or password, do <a href='login.php'>login</a> again.</p>";
                //if user isn't found, then show message above
            }
            $stmt->close(); //close statement
            $conn->close(); //close connection
        }
        ?>
        <!--login form-->
        <form method="POST" action="">
            <label for="matric">Matric:</label>
            <input type="text" id="matric" name="matric" required>
            <!--input matric form-->
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <!--input password form-->
            <button type="submit">Login</button> <!--submit button-->
        </form>
        <div class="register-link"> <!--register button if not register yet-->
            <a href="register.php">Register</a> here if you have no account.
        </div>
    </div>
</body>
</html>
<!-- Closes the form, main container, document and HTML-->
