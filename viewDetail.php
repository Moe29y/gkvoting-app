<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
            overflow-x: auto;
            /* Enable horizontal scroll on small screens */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        $servername = "localhost";
        $username = "root";
        $userpassword = "07084802023";
        $dbname = "voting2023";

        $conn = new mysqli($servername, $username, $userpassword, $dbname);

        if ($conn->connect_error) {
            die("connection error" . $conn->connect_error);
        }

        $sql = "SELECT * FROM viewdb";
        $result = $conn->query($sql);
        ?>

        <table id="table_id" class="table table-striped">
            <thead>
                <tr>
                    <th>NAME</th>
                    <th>CHAIRMAN</th>
                    <th>VICE PRESIDENT</th>
                    <th>SECRETARY</th>
                    <th>INFORMATION</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td data-label='Name'>" . $row["name"] . "</td>";
                        echo "<td data-label='Chairman'>" . $row["chairman"] . "</td>";
                        echo "<td data-label='Vice President'>" . $row["vicepresident"] . "</td>";
                        echo "<td data-label='Secretary'>" . $row["secretary"] . "</td>";
                        echo "<td data-label='Information'>" . $row["information"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr>";
                    echo "<td colspan='5'>No users found</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <?php
        $conn->close();
        ?>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#table_id').DataTable();
        });
    </script>
</body>

</html>