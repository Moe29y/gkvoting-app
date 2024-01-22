<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Voting Results</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Custom CSS */
        .candidate-list {
            display: none;
        }

        .table th,
        .table td {
            text-align: center;
        }

        .btn {
            border: 1px solid #fff;
            background-color: #0056b3;
            font-size: 16px;
            cursor: pointer;
            display: inline-block;
        }

        /* On mouse-over */
        .btn:hover {
            background: #0802A3;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Voting Results</h1>

        <!-- Menu buttons for different positions -->

        <div class="btn-group mb-4" role="group">
            <div class="btn-group">
                <button type="button" class="btn btn-primary menu-btn" data-position="chairman">Chairman </button>
            </div>
            <br>
            <div class="btn-group">
                <button type="button" class="btn btn-primary menu-btn" data-position="vicepresident">Vice
                    President</button>
            </div>
            <br>
            <div class="btn-group">
                <button type="button" class="btn btn-primary menu-btn" data-position="secretary">Secretary</button>
            </div>
            <br>
            <div class="btn-group">
                <button type="button" class="btn btn-primary menu-btn" data-position="information">Information</button>
            </div>
        </div>

        <?php
        // Establish a database connection
        $servername = "localhost";
        $username = "root";
        $password = "07084802023";
        $dbname = "voting2023";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve vote counts for each candidate position
        $positions = array("chairman", "vicepresident", "secretary", "information");
        $results = array(
            'chairman' => array(),
            'vicepresident' => array(),
            'secretary' => array(),
            'information' => array()
        );

        foreach ($positions as $position) {
            $sql = "SELECT $position, COUNT(*) AS count FROM viewdb GROUP BY $position";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $candidate = $row[$position];
                    $count = $row['count'];
                    if (!isset($results[$position])) {
                        $results[$position] = array();
                    }
                    $results[$position][$candidate] = $count;
                }
            }
        }

        // Calculate vote percentages
        $totalVotes = count($positions); // Total number of positions
        ?>

        <!-- Candidate lists for each position -->
        <?php foreach ($results as $position => $candidates): ?>
            <div class="candidate-list" id="<?php echo $position; ?>">
                <h2 class="mb-3">
                    <?php echo ucwords($position); ?>
                </h2>
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Name</th>
                            <th>Votes</th>
                            <th>Percentage</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $personList = array(
                            'Khun John Paul', 'Khun Nay Myo Naing', 'Khun No San Lin', 'Khun Benadeto', 'Khun Kyar Aung',
                            'Khun Moe Htet Yan', 'Khun Phyo Aung', 'Khun Fili zel', 'Khun Tino', 'Khun Maung Not',
                            'Khun Christopher', 'Khun Win Maung', 'Khun Marino', 'Mu Ngyan Zin Khing', 'Mu Shin',
                            'Mu Thu Thu Lyan', 'Mu Emary', 'Mu Kay Thwel Win', 'Mu Htwe Htwe Hla', 'Khun Mozet',
                            'Khun Soe Moe Lwin'
                        );

                        // Create a temporary array to hold candidates' data for sorting
                        $sortedCandidates = array();

                        foreach ($personList as $person):
                            $votes = isset($candidates[$person]) ? $candidates[$person] : 0;
                            $percentage = ($votes > 0) ? round(($votes / array_sum($candidates)) * 100, 2) : 0;

                            // Push data into the temporary array for sorting
                            $sortedCandidates[$person] = $percentage;
                        endforeach;

                        // Sort the candidates based on their percentages in descending order
                        arsort($sortedCandidates);

                        // Display the candidates sorted by percentages
                        foreach ($sortedCandidates as $person => $percentage):
                            $votes = isset($candidates[$person]) ? $candidates[$person] : 0;
                            ?>
                            <tr>
                                <td>
                                    <?php echo $person; ?>
                                </td>
                                <td>
                                    <?php echo $votes; ?>
                                </td>
                                <td>
                                    <?php echo $percentage; ?>%
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endforeach; ?>


    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // JavaScript to handle menu button clicks
        $(document).ready(function () {
            $('.menu-btn').on('click', function () {
                var position = $(this).data('position');
                $('.candidate-list').hide(); // Hide all candidate lists
                $('#' + position).show(); // Show the selected candidate list
            });
        });
    </script>
</body>

</html>