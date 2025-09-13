<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Environment Monitor Dashboard</title>
    <style>
        .container {
            margin-top: 80px;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .player-name {
            border: 2px solid #9610d4;
            border-radius: 2px;
            font-size: 50px;
            margin-bottom: 30px;
            margin-top: -20px;
            width: 1800px;
        }

        .card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            width: 200px;
            text-align: center;
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-10px);
        }

        .icon {
            width: 50px;
            height: 50px;
            margin-bottom: 15px;
        }

        .temperature-icon {
            background: url('http://localhost/EDI/images/temp.jpg') no-repeat center center / contain;
        }

        .humidity-icon {
            background: url('http://localhost/EDI/images/humid.jpg') no-repeat center center / contain;
        }

        .gas-icon {
            background: url('http://localhost/EDI/images/gas.jpg') no-repeat center center / contain;
        }

        .active-time-icon {
            background: url('http://localhost/EDI/images/time.png') no-repeat center center / contain;
        }

        .circular-progress {
            position: relative;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: conic-gradient(#4d5bf9 var(--progress), #cadcff var(--progress));
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }

        .circular-progress::before {
            content: '';
            position: absolute;
            width: 100px;
            height: 100px;
            background: #fff;
            border-radius: 50%;
        }

        .progress-value {
            position: relative;
            font-size: 24px;
            color: #333;
        }

        .details h2 {
            margin: 0;
            font-size: 1.2em;
            color: #333;
        }

        .details p {
            margin: 5px 0 0;
            font-size: 2.5em;
            color: #555;
        }

        .top-band {
            background-color: #4CAF50; /* Set background color */
            padding: 10px; /* Add padding */
            height: 80px; /* Set height */
            color: white; /* Set text color */
            text-align: center; /* Center text */
            font-size: 50px;
        }

        .navbar {
            background-color: #4CAF50; /* Set background color */
            padding: 8px; /* Add padding */
            display: flex; /* Use flexbox for layout */
            justify-content: space-between; /* Space items horizontally */
            align-items: center; /* Center items vertically */
        }

        .navbar-brand {
            color: white; /* Set text color */
            font-size: 30px; /* Set font size */
        }

        .home-button {
            color: white; /* Set text color */
            text-decoration: none; /* Remove underline */
            font-size: 28px; /* Set font size */
            margin-right: 20px; /* Add margin for spacing */
        }

        .separator {
            background-color: #ddd; /* Set background color */
            height: 10px; /* Set height */
        }

        .button-container {
            text-align: right;
            margin-right: 200px; /* Center the button horizontally */
            margin-top: 20px; /* Add some space above the button */
        }

        .action-button {
            background-color: #4CAF50; /* Set background color */
            color: white; /* Set text color */
            padding: 10px 20px; /* Add padding */
            font-size: 16px; /* Set font size */
            border: none; /* Remove border */
            border-radius: 4px; /* Add border radius */
            cursor: pointer; /* Add cursor pointer */
            transition: background-color 0.3s; /* Add transition effect */
        }

        .action-button:hover {
            background-color: #45a049; /* Change background color on hover */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        .all-entries-button {
            background-color: #4CAF50; /* Set background color */
            color: white; /* Set text color */
            padding: 10px 20px; /* Add padding */
            font-size: 16px; /* Set font size */
            border: none; /* Remove border */
            border-radius: 4px; /* Add border radius */
            cursor: pointer; /* Add cursor pointer */
            transition: background-color 0.3s; /* Add transition effect */
            display: inline-block; /* Make it an inline-block */
            margin-top: 20px; /* Add some space above */
        }

        .all-entries-button:hover {
            background-color: #9610d4; /* Change background color on hover */
        }
    </style>
</head>
<body>
<div class="top-band">
    Employee DATA
</div>

<div class="separator"></div> <!-- Separation Block -->

<div class="navbar">
    <a href="http://localhost/EDI/main copy.php" class="home-button">Home</a>
</div>

<div class="button-container">
    <button id="alert-button" class="action-button">Send Alert</button>
</div>

<div class="container">
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "EDI";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $player_id = $_GET['player_id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Update buzzer_status to 1
        $sql = "UPDATE employee SET buzzer_status = 1 WHERE ID =$player_id";
        // $sql = "UPDATE employee SET buzzer_status = 0";
        if ($conn->query($sql) === TRUE) {
            
        } else {
           
        }
    }

    $name = $_GET['name'];

    echo "<h2 class='player-name'>". $name ."( ". $player_id." )</h2>";





    // Fetch data from the database
    
    $sql = "SELECT * FROM emp_$player_id ORDER BY srno DESC LIMIT 1"; // Adjust table name as per your setup
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="card">';
            echo '<div class="icon temperature-icon"></div>';
            echo '<div class="details">';
            echo '<h2>TEMPERATURE</h2>';
            echo '<p id="temperature">' . $row['temp'] . '°C</p>';
            echo '</div>';
            echo '</div>';

            echo '<div class="card">';
            echo '<div class="icon humidity-icon"></div>';
            echo '<div class="details">';
            echo '<h2>HUMIDITY</h2>';
            echo '<p id="humidity">' . $row['Humid'] . '%</p>';
            echo '</div>';
            echo '</div>';

            echo '<div class="card">';
            // echo '<div class="circular-progress" id="gas-progress">';
            // // echo '<span class="progress-value" id="gas-value">' . $row['gas'] . '%</span>';
            // echo '</div>';
            echo '<div class="icon gas-icon"></div>';

            echo '<div class="details">';
            echo '<h2>Gas Level</h2>';
            echo '<p id="gas-level">' . $row['gas'] . ' ppm</p>';
            echo '</div>';
            echo '</div>';

            $active = $row['srno'] * 2;
            $sec = $active % 60; 
            $min = intdiv($active, 60); 

            echo '<div class="card">';
            echo '<div class="icon active-time-icon"></div>';
            echo '<div class="details">';
            echo '<h2>ACTIVE TIME</h2>';
            echo "<p id='active-time'>".$min." min ".$sec."sec</p>";
            echo '</div>';
            echo '</div>';

            $sql = "SELECT * FROM emp_$player_id ORDER BY srno DESC LIMIT 5"; // Adjust table name as per your setup
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<table>';
        echo '<tr><th>SR NO</th><th>Temperature</th><th>Humidity</th><th>Gas Level</th><th>Time</th></tr>';
        while ($row = $result->fetch_assoc()) {
            
            echo '<tr>';
            echo '<td>' . $row['srno'] . '</td>';
            echo '<td>' . $row['temp'] . '°C</td>';
            echo '<td>' . $row['Humid'] . '%</td>';
            echo '<td>' . $row['gas'] . ' ppm</td>';
            echo "<td>". $row['time'] ." </td>";
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo "0 results";
    }

        }
    } else {
        echo "0 results";
    }

    $conn->close();
    ?>
</div>
<div class="button-container">
    <form action="http://localhost/EDI/display.php" method="GET" style="display: inline;">
        <input type="hidden" name="player_id" value="<?php echo $player_id; ?>">
        <input type="hidden" name="name" value="<?php echo $name; ?>">
        <button type="submit" id="all-entries-button" class="all-entries-button">Show All Entries</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const alertButton = document.getElementById('alert-button');

        // Add event listener for button click
        alertButton.addEventListener('click', function () {
            // Create a form element
            const form = document.createElement('form');
            form.method = 'POST';
            form.style.display = 'none';
            document.body.appendChild(form);
            form.submit();
        });

    });
</script>

</body>
</html>
