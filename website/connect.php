<?php
    include('db_connect.php');
    echo "Connected to Database successfully. ";

   mysqli_query($conn, "DELETE FROM DATA WHERE ID=1"); 
   $sql = "INSERT INTO DATA (ID, GAS, TEMP, PULSE) VALUES ('1','".$_GET["g_value"]."','".$_GET["t_value"]."','".$_GET["p_value"]."')";    
    
    if (mysqli_query($conn, $sql)) {
       echo "New record created successfully.";
    } 
    else {
       echo "Error: " . $sql . "" . mysqli_error($conn);
    }

    $sql = 'SELECT GAS FROM DATA WHERE ID=1';
    $result = mysqli_query($conn, $sql);
    $gas_col = mysqli_fetch_assoc($result);

    $sql = 'SELECT TEMP FROM DATA WHERE ID=1';
    $result = mysqli_query($conn, $sql);
    $temp_col = mysqli_fetch_assoc($result);

    $sql = 'SELECT PULSE FROM DATA WHERE ID=1';
    $result = mysqli_query($conn, $sql);
    $pulse_col = mysqli_fetch_assoc($result);

    $conn->close();
?> 

<!DOCTYPE HTML>
<html>
   <head>
      <title>IoT Home Report system</title>
   </head>

   <body>
      <h1>Smoke Sensor: <?=$gas_col['GAS'];?></h1>
      <h1>Temperature Sensor: <?=$temp_col['TEMP'];?></h1>
      <h1>Pulse Sensor: <?=$pulse_col['PULSE'];?></h1>
   </body>
</html>