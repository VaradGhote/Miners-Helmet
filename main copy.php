<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player Search</title>
    <link rel="stylesheet" type="text/css" href="try.css">
    <style>
        .card {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 20px;
        width: 200px;
        height: 200px;
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
    background: url('icons/temperature.png') no-repeat center center / contain;
}

.details h2 {
    margin: 10;
    font-size: 2.2em;
    color: #333;
}

.details p {
    margin: 5px 0 0;
    font-size: 2.5em;
    color: #555;
}
.container {
    display: flex;
    flex-wrap: wrap;
    gap: 200px;
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


        
    </style>
</head>
<body>

<div class="top-band">
    Employee Dashboard
</div>

<div class="separator"></div> <!-- Separation Block -->

<div class="navbar">
    <a href="http://localhost/EDI/main copy.php" class="home-button">Home</a>
</div>
<?php
        // Database connection parameters
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "EDI"; // Adjust database name as per your setup

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // SQL query to retrieve all rows
        $sql = "SELECT * FROM employee";

        $result = $conn->query($sql);

        if (!$result) {
            die("Query failed: " . $conn->error);
        }

        // Check if any rows were returned
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                // Display the retrieved information
                echo "<div class='player-box'>";
                echo "<a href='http://localhost/EDI/front.php?player_id=" . $row['ID'] . "&name= ". $row['Name'] ."' class='player-link'>";
                echo "<h2 class='player-name'>" . $row["Name"] . "</a></h2>";
                // echo "<div class='player-info'>";
                // echo "<p><d><strong>Nationality:</strong></d> " . $row["COL 2"] . "</p>";
                // echo "<p><strong>Seasons:</strong> " . $row["COL 3"] . "</p>";
                // echo "<p><strong>Championships:</strong> " . $row["COL 4"] . "</p>";
                // echo "<p><strong>Pole Positions:</strong> " . $row["COL 7"] . "</p>";
                // echo "<p><strong>Years Active:</strong> " . $row["COL 21"] . "</p>";
                // // Add more HTML code here to display other columns
                // echo "</div>";
                echo "<div class='container'>";
                $table_name = $row["linked_DB"];

                // $query = "SELECT MAX(srno) AS max_srno FROM $table_name";

                // $data = mysqli_query($connection, $query);

                // if ($data) {
                // $row = mysqli_fetch_assoc($data);

                // $max_srno = $row['max_srno'];

                // } else {
                // echo "Error: " . mysqli_error($connection);
                // }\

                $ID = $row["ID"];

                if( $row["Active_Status"] == 0)
                {
                    $stat="Inactive";
                }
                else{
                    $stat="Active";
                }

                



               


                echo "<div class=\"card\"><div class=\"details\"><h2>ID</h2><p id=\"temperature\">". $row["ID"] . "</p></div></div>";
                echo "<div class=\"card\"><div class=\"details\"><h2>Status</h2><p id=\"temperature\">". $stat ."</p></div></div>";

                $sql2 = "SELECT * FROM emp_$ID ORDER BY srno DESC LIMIT 1"; // Adjust table name as per your setup
                $result2 = $conn->query($sql2);
                $row2 = $result2->fetch_assoc();
                $active = $row2['srno'] * 2;
                $sec = $active % 60; 
                $min = intdiv($active, 60); 

                echo "<div class=\"card\"><div class=\"details\"><h2>Active time</h2><p id=\"temperature\">".$min." min ".$sec."sec</p></div></div>";
                
                
                echo "</div>";
                echo "</div>";


            }
        } 
        else {
            echo "No results found.";
        }

        $conn->close();
        ?>



</body>
</html>
