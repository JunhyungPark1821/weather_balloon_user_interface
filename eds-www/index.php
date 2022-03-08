<?php

    $months = array('January', 'Febuary', 'March', 'April', 'May', 'June', 'July', 
                    'August', 'September', 'October', 'November', 'December');
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

    if((int)(substr($timestamp, 6, 1)) > 9) {
        $monthNumber = (int)(substr($timestamp, 5, 2));
    }
    else{
        $monthNumber = (int)(substr($timestamp, 6, 2));
    }

?>

<html>
    <head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide|Sofia|Trirong">
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

    <div class='date'>

        <h1>    
            <?php
                echo $months[$monthNumber - 1] . " " . substr($timestamp, 8, 2) . " " . substr($timestamp, 0, 4);
            ?>
        </h1>   

    </div> 

    
    <div class="recent">
        <h1>
            <?php
                echo "Most Recent Data ( " . substr($timestamp, 11) . " )"; 
            ?>
        </h1>


        <div class="recentData">  
            <h2> 
                &emsp;&emsp;&emsp;Altitude  &emsp; Latitude  &emsp;   Longitude  &emsp; Temperature (Deg C)
            </h2>

            <h2>
                <?php
                    echo "&emsp;&emsp;&emsp;&emsp;&ensp;" . $altitude . "&ensp;&emsp;&emsp;&emsp;&emsp;" . $latitude . "&emsp;&emsp;&emsp;&emsp;&emsp;" . $longitude . "&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;" . $temperature . "<br>"; 
                ?>
            </h2>
        </div>   
        
    </div>


    <div class="PrevDataHeading">
        <h1 >
            Previous Data
        </h1>
    

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