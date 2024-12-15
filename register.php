<!DOCTYPE html> <!--Document as HTML -->
<html lang="en"> <!-- open html languange and set into english -->
<head> 
    <meta charset="UTF-8"> <!--character specification encoding and support most chars-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--ensure the page is responsive in every devices-->
    <title>Registration Page</title> <!--Page Title -->
    <style>
        body { 
            font-family: Verdana, sans-serif;
            background-color: #f7f9fc;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 550px;
            margin: 0 auto;
            background: #ffffff;
            padding: 25px;
            border-radius: 10px;
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
            padding: 12px;
            font-size: 1rem;
            margin-bottom: 20px;
            border: 1px solid #bbb;
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
        .alert {
            margin-top: 20px;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //checking for the submitted form
        $matric = $_POST['matric'];
        $name = $_POST['name'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); //to encrypt the password
        $accessLevel = $_POST['accessLevel']; //to hashing the password and collect the data
        $conn = new mysqli("localhost", "root", "", "Lab_5b"); //to connect the database

        //this is to check the database whether it has any error or not
        if ($conn->connect_error) {
            die("The connection isn't successful!". $conn->connect_error);
        }
        //to prepare the sql statement before entering the data
        $sql = "INSERT INTO users (matric, name, password, accessLevel) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        //checking the statement if it was successful
        if (!$stmt) {
            die("Failed statement" . $conn->error);
        }
        //ensure the binds form data to the sql query parameters
        $stmt->bind_param("ssss", $matric, $name, $password, $accessLevel);

        //executes query and outputs either success or failed
        if ($stmt->execute()) {
            echo "<p class='message' style='color: green;'>Registration successful!</p>";
        } else {
            echo "<p class='message' style='color: red;'>Error: " . $stmt->error . "</p>";
        }
        //close statement
        $stmt->close();
        $conn->close();
}
?>

        <form method="POST" action=""> <!--For the user to input and submitted in form -->
            <label for="matric">Matric Number</label>
            <input type="text" id="matric" name="matric" required>
            <!--The input part for the matric number -->
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required>
            <!--The input part for the name -->
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <!--The input part for the password -->
            <label for="accessLevel">Access Level</label>
            <input type="text" id="accessLevel" name="accessLevel" required>
            <!--The input part for the access level -->
            <button type="submit">Submit</button>
            <!--To submit the form -->
        </form>
    </div>
</body>
</html>
<!-- closes the form, main container, document and HTML-->