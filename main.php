<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player Search</title>
    <link rel="stylesheet" type="text/css" href="try.css">
    <style>
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

        .player-box {
            border: 3px solid #0edc53;
            border-radius: 6px;
            padding: 50px;
            padding-top: 20px;
            margin-bottom: 20px;
            margin-top: 30px;
            width: 1500px;
        }

        .player-name {
            border: 2px solid #9610d4;
            border-radius: 2px;
            font-size: 50px;
            margin-bottom: 30px;
            margin-top: 20px;
        }

        .player-info {
            border: 1px solid #ffffff;
            border-radius: 10px;
            padding: 10px;
            display: flex;
            flex-wrap: wrap;
        }

        .player-info p {
            width: 200px;
            height: 300px;
            border-radius: 20px;
            margin-right: 95px; /* Adjust margin for spacing */
            
            border: 1px solid #9d1313;
            font-size: 25px;
            box-sizing: border-box; /* Include padding and border in the width calculation */
        }
        .player-info  d {
            width: 200px;
            height: 100px;
            margin-top : 0px;
            margin-left : 0px;
            margin-right: 95px; /* Adjust margin for spacing */
            padding: 30px;
            border-bottom: 5px solid #9d1313;
            font-size: 25px;
            display: flex;
            box-sizing: border-box; /* Include padding and border in the width calculation */
        }
        .player-info  a {
            width: 200px;
            height: 100px;
            margin-top : 0px;
            margin-left : 0px;
            margin-right: 95px; /* Adjust margin for spacing */
            padding: 30px;
            font-size: 25px;
            display: flex;
            box-sizing: border-box; /* Include padding and border in the width calculation */
        }
        .no-border {
            border-bottom: 0px;
            border-left: 10px; /* Remove bottom border */
        }

        
    </style>
</head>
<body>

<div class="top-band">
    Search for Player
</div>

<div class="separator"></div> <!-- Separation Block -->

<div class="navbar">
    <a href="http://localhost/dms/front.html" class="home-button">Home</a>
</div>
<?php
        // Database connection parameters
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "F1"; // Adjust database name as per your setup

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // SQL query to retrieve all rows
        $sql = "SELECT * FROM f1driversdataset";

        $result = $conn->query($sql);

        if (!$result) {
            die("Query failed: " . $conn->error);
        }

        // Check if any rows were returned
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                $ID =10;
                // Display the retrieved information
                echo "<div class='player-box'>";
                echo "<a href='http://localhost/EDI/front.php?player_id=" . $row['ID'] . "' class='player-link'>";
                echo "<h2 class='player-name'>" . $row["COL_1"] . "</a></h2>";
                echo "<div class='player-info'>";
                echo "<p><d><strong>Nationality:</strong></d><a> " . $row["COL 2"] . "</a></p>";
                echo "<p><d><strong>Seasons:</strong></d><a> " . $row["COL 3"] . "</a></p>";
                echo "<p><d><strong>Championships:</strong></d><a> " . $row["COL 4"] . "</a></p>";
                echo "<p><d><strong>Pole Positions:</strong></d><a> " . $row["COL 7"] . "</a></p>";
                echo "<p><d><strong>Years Active:</strong></d><a> " . $row["COL 21"] . "</a></p>";
                                // Add more HTML code here to display other columns
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "No results found.";
        }

        $conn->close();
        ?>

</body>
</html>
