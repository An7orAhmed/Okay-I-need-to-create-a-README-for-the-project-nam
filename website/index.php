
<?php
    include('db_connect.php');
    
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

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>IOT Health Care</title>
	<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet"> 
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<header>
		<h1>IoT Remote Healthcare</h1>
	</header>

	<section class="main container">
		<div class="form" id=form>
			 <form>
			    <h1>Welcome</h1>
			    <p>Enter Paitent ID & Password</p>

			    <label for="pid"><b>Paitent ID:</b></label>
			    <input id="pid" type="text" placeholder="Enter paitent ID" name="pid" required>

			    <label for="psw"><b>Password:</b></label>
			    <input id="pswd" type="password" placeholder="Enter Password" name="psw" required>
			  
			</form> 
			 <button id="psgo" type="button" class="signupbtn">GO</button>
				<div id="message">
				  <b>Wrong</b> Password or patient ID.
				</div>
		</div>
	<div id=info>
		<h2>XYZ Ahmed</h2><hr>
		<p style="line-height: 1.6">
			<b>Age:</b> 21<br>
			<b>Sex:</b> MALE<br>
			<b>Marital Status:</b> NO<br>
			<b>Blood Group:</b> A(+ve)<br>		
		</p>
		<div class="Informations flex-container">
			<div class="info-box pulse">
				<b>Pulse Rate</b>
				<h1><?=$pulse_col['PULSE'];?> BMP</h1>
				
			</div>
			<div class="info-box temp">
				<b>Temperature</b>
				<h1><?=$temp_col['TEMP'];?>&degF</h1>
				
			</div>
		</div>
		<div class="info-box smoke">
			<h1>Smoking: <?=$gas_col['GAS'];?></h1>
		</div>
		<button id="find">
			Find Another
		</a>
	</div>
	</section>

	<footer>
		This website is developed by Nafis Anjum Mohona.
	</footer>
		<script src="js/pswd.js"></script>

</body>
</html>