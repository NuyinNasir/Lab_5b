<?php //database connection
$conn = new mysqli("localhost", "root", "", "Lab_5b"); //create connection to mysql database
if ($conn->connect_error) {
    die("The connection isn't successful!" . $conn->connect_error);
} //terminate with error message if true 

//check the form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") { //check if the form was submitted using post method
    $matric = $_POST['matric']; //retrieve matric from the submitted form
    $name = $_POST['name']; //retrieve name from the submitted form
    $accessLevel = $_POST['accessLevel']; //retrieve access level from the submitted form

    //update submissions query 
    $sql = "UPDATE users SET name = ?, accessLevel = ? WHERE matric = ?";
    $stmt = $conn->prepare($sql); //sql statement to update
    $stmt->bind_param("sss", $name, $accessLevel, $matric);

    if ($stmt->execute()) {
        header("Location: display.php");
        exit; //redirect to display.php if the update is successful
    } else {
        echo "Cannot update, it's error" . $stmt->error; //show this message if the update is fail
    }

    $stmt->close(); //close statement
}

//check if matric is provided in url
if (isset($_GET['matric'])) {
    $matric = $_GET['matric'];

    //fetching the data from user
    $sql = "SELECT * FROM users WHERE matric = ?"; //sql query to fetch
    $stmt = $conn->prepare($sql); //execution sql statement
    $stmt->bind_param("s", $matric); //matric parameter to sql query
    $stmt->execute(); //to execute the query
    $result = $stmt->get_result(); //to retrieve the result from executed query

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
    } else {
        echo "Undefined users!"; //display message if this user not found on the record
        exit;
    }

    $stmt->close(); //close statement
}

$conn->close(); //close database statement
?>

<!DOCTYPE html> <!--Document as HTML -->
<html lang="en"> <!-- open html languange and set into english -->
<head>
    <meta charset="UTF-8"> <!--character specification encoding and support most chars-->
       <!--ensure the page is responsive in every devices-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title> <!--Title Page-->
</head>
<body> 
    <h2>Update User</h2> <!--Title Page-->
    <form method="POST" action=""> <!-- To update the user -->
        <label for="matric">Matric : </label> <!-- Input the updated matric-->
        <input type="text" id="matric" name="matric" value="<?php echo $user['matric']; ?>" readonly><br>
        <label for="name">Name : </label> <!-- Input the updated name-->
        <input type="text" id="name" name="name" value="<?php echo $user['name']; ?>" required><br>
        <label for="accessLevel">Access Level : </label> <!-- Input the updated access level-->
        <input type="text" id="accessLevel" name="accessLevel" value="<?php echo $user['accessLevel']; ?>" required><br>
        <button type="submit">Update</button> <!-- Update button-->
        <a href="display.php">Cancel</a> <!-- Cancel update button-->
    </form>
</body>
</html> <!-- Closes the form, main container, document and HTML-->
