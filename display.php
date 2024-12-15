<!DOCTYPE html> <!--Document as HTML -->
<html lang="en"> <!-- open html languange and set into english -->
<head>
    <meta charset="UTF-8"> <!--character specification encoding and support most chars-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--ensure the page is responsive in every devices-->
    <title>User Data</title> <!--Title Page-->
    <style>
        body {
            font-family: Verdana, sans-serif;
            background-color: #f7f9fc;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #BCCCDC;
            color: #131010;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>User Data</h2> <!--The title page-->
        <table>
    <thead><!--To display the user data-->
        <tr>
            <th>Matric</th> <!--The row column for matric-->
            <th>Name</th> <!--The row column for name-->
            <th>Access Level</th> <!--The row column for access level-->
            <th>Action</th> <!--The row column for action such update and delete-->
        </tr>
    </thead>
    <tbody>
        <?php
        //to establish the database connectio in Lab 5b using username even no password
        $conn = new mysqli("localhost", "root", "", "Lab_5b");
        //to check the connection successful or else
        if ($conn->connect_error) {
            die("The connection isn't successful!" . $conn->connect_error);
        }
        //to get the matric, name and access level from the  insertion
        $sql = "SELECT matric, name, accessLevel FROM users";
        $result = $conn->query($sql);

        //store the result
        if ($result->num_rows > 0) {
            //checks the rows in result type
            while ($row = $result->fetch_assoc()) {
                //classified the result in row
                echo "<tr>
                        <td>{$row['matric']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['accessLevel']}</td>
                        <td>
                            <a href='update.php?matric={$row['matric']}'>Update</a> |
                            <a href='delete.php?matric={$row['matric']}' onclick=\"return confirm('Are you sure you want to delete this user?');\">Delete</a>
                        </td>
                      </tr>";
                      //outputs in a table of row for each type
            }
        } else {
            echo "<tr><td colspan='4'>Data isn't available</td></tr>";
        } //no table will show message above

        //close the connection
        $conn->close();
        ?>
    </tbody>
</table>
    </div>
</body>
</html>
<!-- Closes the form, main container, document and HTML-->
