
    <!-- Connect to Database
        Find most recent date and save it -->

<?php
    $username = "root";
    $password = "";
    $server   = "localhost";
    $database = "weatherballoon";

    $connection = new mysqli($server, $username, $password, $database);

    if ($connection->connect_error) {
        die("Connection Failure" . $connection->connect_error);
    }

    $query = "SELECT * FROM status ORDER BY timestamp DESC LIMIT 1";
    $result = $connection->query($query);

    while ($row = $result->fetch_assoc()) {
        
        $id = $row['id']; 
        $latitude = $row['latitude'];
        $altitude = $row['altitude'];
        $longitude = $row["longitude"];
        $timestamp = $row['timestamp'];
        $temperature = $row['temp'];
    }
?>
    <!-- Setting Title and Refresh Rate -->
<html>
    <head>
    <link rel="stylesheet" href="Style.css">
        <title>   
            Blue Horizon Weather Balloon Project
        </title>
        <meta http-equiv="refresh" content="10">
        
    </head>
    <!-- Header Code -->
    <div class="header">
        <div class="image">
            <image src="https://militaryartsconnection.org/wp-content/uploads/2020/01/USAFA-logo.jpg" 
                Alt="" height="200" width="200" Align="left"/>
        </div>  
        
        <h1>
            Blue Horizon Weather Balloon Project
        </h1>
           
    </div>

        
    <!-- Most Recent Date Display -->

    <body>
       
        <h2 class="date">
            
            <?php
                echo "Date: " . substr($timestamp, 0, 10) . "<br>";
            ?>
            
        </h2>

    <!-- Data display and concat. -->

    <div class="data">
        <p1>

            <?php
                $query = "SELECT * FROM status ORDER BY timestamp DESC LIMIT 10";
                $result = $connection->query($query);

                while ($row = $result->fetch_assoc()) {
                    
                    $id = $row['id']; 
                    $latitude = $row['latitude'];
                    $altitude = $row['altitude'];
                    $longitude = $row["longitude"];
                    $timestamp = $row['timestamp'];
                    $temperature = $row['temp'];

                    
                    # echo "Full Data: " . $timestamp . "<br>";
                    echo "Time : " . substr($timestamp, 11) . "<br>"; 
                    # echo "Time : " . substr($timestamp, 11) . "<br>";
                    echo "Altitude: " . $altitude . " " . "Latitude: " . $latitude . " " . "longitude: " . $longitude . " " . "Temperature (Deg. C): " . $temperature . "<br>";
                    echo "------------------------------------------------------------------------" . "<br>";
                }   
                $connection->close();
            ?>
           
        </p1>

    </div>
    

    </body>

</html>