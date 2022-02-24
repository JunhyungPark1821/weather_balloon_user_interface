<?php
    $username = "root";
    $password = "";
    $server   = "localhost";
    $database = "weatherballoon";

    $connection = new mysqli($server, $username, $password, $database);

    if ($connection->connect_error) {
        die("Connection Failure" . $connection->connect_error);
    }
?>

<html>
    <link href="style.css" rel="stylesheet">
    <head>
        <title>   
            Blue Horizon Weather Balloon Project
        </title>
        <meta http-equiv="refresh" content="10">
        <img src='https://militaryartsconnection.org/wp-content/uploads/2020/01/USAFA-logo.jpg' 
            alt = 'Logo Goes Here' height = "206" width = "200" Align = 'middle' />
    </head>
    <body>
        <h1> 
        <center>
            Blue Horizon Weather Balloon Project
        </center>
        </h1>
    <p1>
        <center>
        <?php
            

            $query = "SELECT * FROM status ORDER BY timestamp DESC LIMIT 10";
            $result = $connection->query($query);

            while ($row = $result->fetch_assoc()) {
                

                $id = $row['id']; 
                $latitude = $row['latitude'];
                $altitude = $row['altitude'];
                $longitude = $row["longitude"];
                $timestamp = $row['timestamp'];
                
                # echo "Full Data: " . $timestamp . "<br>";
                echo "Date: " . substr($timestamp, 0, 10) . "<br>";
                echo "Time : " . substr($timestamp, 11) . "<br>";
                echo "Altitude: " . $altitude . " " . "Latitude: " . $latitude . " " . "longitude: " . $longitude . "<br>";
                echo " " . "<br>";
            }   
            $connection->close();
        ?>
        </center>
    </p1>
    <p2>
        <center>
        <?php   
        
            
            
        ?>
        </center>
        </p2>


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