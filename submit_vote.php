<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Vote Submission</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Vote Submission</h1>

        <?php
        // Establish connection to your database
        $servername = "localhost";
        $username = "root";
        $password = "07084802023";
        $dbname = "voting2023";

        // Retrieve data from the form
        $name = $_POST['name'];
        $chairman = $_POST['chairman'];
        $vicepresident = $_POST['vicepresident'];
        $secretary = $_POST['secretary'];
        $information = $_POST['information'];

        // Create a connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Insert votes into the database (simplified query)
        $insertQuery = "INSERT INTO viewdb (name, chairman, vicepresident, secretary, information) 
                        VALUES ('$name', '$chairman', '$vicepresident', '$secretary', '$information')";

        if ($conn->query($insertQuery) === TRUE) {
            echo '<div class="alert alert-success" role="alert">Votes submitted successfully!</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Error: ' . $conn->error . '</div>';
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>