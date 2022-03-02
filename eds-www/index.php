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
    }
?>

<html>
    <head>
    <link rel="stylesheet" href="Style.css">
        <title>   
            Blue Horizon Weather Balloon Project
        </title>
        <!-- <meta http-equiv="refresh" content="10"> -->
        
    </head>
        
    <div class="header">
        <div class="image">
            <image src="https://militaryartsconnection.org/wp-content/uploads/2020/01/USAFA-logo.jpg" 
                Alt="" height="200" width="200" Align="left"/>
        </div>  
    
        <h1>
            Blue Horizon Weather Balloon Project
        </h1>
        
    </div>

    
    <div class="recent">
        
        <h2>    
            <?php
                echo "Date: " . substr($timestamp, 0, 10);
            ?>
        </h2>   
        
    </div>




    <body>
       

       
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
                    echo "------------------------------------------------------------------------------" . "<br>";
                }   
                $connection->close();
            ?>
           
        </p1>
    </div>
    
<?php




    // // Get the filename from the URL
    // $filename = $_GET["filename"];

    // // Read the JSON file 
    // $json = file_get_contents($filename);
    
    // // Decode the JSON file
    // $json_data = json_decode($json,true);
    
    // Display data
    //print_r($json_data);

    //echo "<b>" . $json_data["glossary"]["title"] . "</b>";

?>
    </body>

</html>