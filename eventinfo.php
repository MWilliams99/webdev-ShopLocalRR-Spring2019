<!DOCTYPE html>
<html>
<head>
	<title>Shop Local RR - Event Information</title>
	<meta name="author" content="HCC CTS-289-1D1 Spring 2019">
	<link href="css/resetcss.css" rel="stylesheet"/>
	<link href="css/slrr_layout.css" rel="stylesheet"/>
	<link href="css/slrr_style.css" rel="stylesheet"/>
</head>
<body>
	<div class="grid-container">
		<div class="header">
			<h1>Shop Local Roanoke Rapids</h1>
		</div>
		<div class="nav">
			<ul>
				<li><a href="index.html">Home</a></li>
				<li><a href="whylocal.html">Why Local?</a></li>
				<li><a href="buylocal.php">Buy Local</a></li>
				<li><a href="dolocal.php">Do Local</a></li>
				<li><a href="joinlocal.html">Join Local</a></li>
			</ul>
		</div>
		<div class="content">
			<!-- Get Event information and display it on the page -->
			<?php
				include_once "dbconnection.php";
				$idNum = $_GET['id'];
				
				$query = "SELECT * FROM eventtable WHERE EventID='$idNum'";
				$result = mysqli_query($dbconnection,$query)
						  or die('Sorry, something went wrong connecting to the database!');
				
				if (mysqli_num_rows($result)==0){
					echo"<h1>Sorry,</h1>";
					echo "<p>It seems there are no events associated with that ID. You can try another search at our <a href='dolocal.php'>do local</a> page.</p>";
					echo "<p>If you are getting this error after following a link on our do local page, please send our website admin an email at <a href='mailto:admin@shop-local-rr.com'>admin@shop-local-rr.com</a> </p>";
					//return them to event search page
				}
				else{
					$row = mysqli_fetch_assoc($result);
					echo"<h1>".$row['EventName']."</h1>
						<p>
						<strong>Date:</strong> ".$row['EventDate']." <strong>Time:</strong> "; 
						$evStart = $row['EventStart'];
								if($evStart == '00:00:00'){
									echo" N/A ";
								}	
								else{
									echo"".$row['EventStart']."";
								}
						
					echo" to ";
						$evEnd = $row['EventEnd'];
								if($evEnd == '00:00:00'){
									echo" N/A ";
								}	
								else{
									echo"".$row['EventEnd']." ";
								}
						
					echo"<strong>Host:</strong> ".$row['EventHost']."";
						$evHost = $row['EventHost'];
								if(empty($evHost)){
									echo" N/A ";
								}	
								else{
									
								}
					echo"</br>";
						
					echo"<strong>Location:</strong> ".$row['LocationAddress']."";
						
						$locAdd = $row['LocationAddress'];
								if(empty($locAdd)){
									
								}	
								else{
									echo ', ';
								}
						
					echo"".$row['LocationCity']."";
					
						$locAdd = $row['LocationCity'];
								if(empty($locAdd)){
									
								}	
								else{
									echo ', ';
								}
					
					echo"".$row['LocationState']." ".$row['LocationZip']."</p>
						 
						<p>".$row['EventDescription']."</p>";
				}
				
				mysqli_close($dbconnection);
			?>
		</div>
		<div class="footer">
			<p>Created by Information Technology Students of <a href="createdlocal.html">HCC</a>.</p>
		</div>
	</div>
</body>
</html>