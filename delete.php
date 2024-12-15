<?php
if (isset($_GET['matric'])) { //check the matric is in url
    $matric = $_GET['matric']; //store the matric value in get request

    //database connection
    $conn = new mysqli("localhost", "root", "", "Lab_5b");

    if ($conn->connect_error) { //create connection to the mysql database using username even no password
        die("Connection failed: " . $conn->connect_error);
    }
    //delete query section
    $sql = "DELETE FROM users WHERE matric = ?"; //delete by using the matric number given
    $stmt = $conn->prepare($sql); //sql statement
    $stmt->bind_param("s", $matric); //bind the matric parameter for the sql query 

    if ($stmt->execute()) { //checking if the deletion was successful
        header("Location: display.php"); //exit after deletion
        exit;
    } else { //display error if the deletion is fail
        echo "Cannot delete, there's an error" . $stmt->error;
    }

    $stmt->close(); //close statement
    $conn->close(); //close the database 
} else {
    echo "Wrong request!"; //display error message if cannot run in the url
}
?>
