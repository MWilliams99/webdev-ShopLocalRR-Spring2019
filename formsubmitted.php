<!DOCTYPE html>
<html>
<head>
	<title>Shop Local RR - Submitted</title>
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
			<?php
				include_once "dbconnection.php";
				$form = $_POST['formType'];
				
				if($form == 1){
					//Form 1 is the 'Submit a Business' form
					//Put form inputs into variables
					$busName = mysqli_real_escape_string($dbconnection,$_POST['busName']);
					$busPhone = mysqli_real_escape_string($dbconnection,$_POST['busPhone']);
					$busWebsite = mysqli_real_escape_string($dbconnection,$_POST['busWebsite']);
					$busHours = mysqli_real_escape_string($dbconnection,$_POST['busHours']);
					$busType = mysqli_real_escape_string($dbconnection,$_POST['busType']);
					$busDesc = mysqli_real_escape_string($dbconnection,$_POST['busDesc']);
					
					$locStAdd = mysqli_real_escape_string($dbconnection,$_POST['locStAdd']);
					$locCity = mysqli_real_escape_string($dbconnection,$_POST['locCity']);
					$locState = mysqli_real_escape_string($dbconnection,$_POST['locState']);
					$locZip = mysqli_real_escape_string($dbconnection,$_POST['locZip']);
					
					$conFirst = mysqli_real_escape_string($dbconnection,$_POST['conFName']);
					$conLast = mysqli_real_escape_string($dbconnection,$_POST['conLName']);
					$conPhone = mysqli_real_escape_string($dbconnection,$_POST['conPhone']);
					$conEmail = mysqli_real_escape_string($dbconnection,$_POST['conEmail']);
					
					$socFB = mysqli_real_escape_string($dbconnection,$_POST['socmedFaceB']);
					$socTW = mysqli_real_escape_string($dbconnection,$_POST['socmedTwitter']);
					$socIN = mysqli_real_escape_string($dbconnection,$_POST['socmedInsta']);
					
					//Check if exact business already exists in the database; if not, add it to the database
					$busCheckQuery = "SELECT * FROM businesstable WHERE BusinessName='$busName' AND BusinessPhone='$busPhone' AND BusinessWebsite='$busWebsite' AND BusinessType='$busType' AND LocationAddress='$locStAdd' AND LocationCity='$locCity' AND LocationState='$locState' AND LocationZip='$locZip'";
					$busCheckResult =  mysqli_query($dbconnection,$busCheckQuery);
					
					if(mysqli_num_rows($busCheckResult) > 0){
						//Business already exists within database; display appropriate message and reroute to search businesses page
						echo"<h1>Sorry,</h1>";
						echo "<p>That business appears to already exist in our database. If this is your business and you'd like to update information, please email our site admin at <a href='mailto:admin@shop-local-rr.com'>admin@shop-local-rr.com</a> </p>";
						echo"<p>Otherwise, you can explore local businesses at our <a href='buylocal.php'>buy local</a> page.</p>";
						//header("refresh:5;url=buylocal.php");
					}
					elseif(mysqli_num_rows($busCheckResult) < 1){
						$busAddQuery = "INSERT INTO businesstable (BusinessName,BusinessPhone,BusinessWebsite,BusinessHours,BusinessType,BusinessDescription,LocationAddress,LocationCity,LocationState,LocationZip,ContactFirstN,ContactLastN,ContactPhone,ContactEmail,SocialFacebook,SocialTwitter,SocialInstagram)
						VALUES ('$busName','$busPhone','$busWebsite','$busHours','$busType','$busDesc','$locStAdd','$locCity','$locState','$locZip','$conFirst','$conLast','$conPhone','$conEmail','$socFB','$socTW','$socIN')";
						if(mysqli_query($dbconnection,$busAddQuery)){
							//header("refresh:5;url=buylocal.php");
							echo"<h1>Success!</h1>";
							echo "<p>New business record successfully added to our database, a moderator will review it as soon as possible. Head on over to our <a href='buylocal.php'>buy local</a> page to browse other businesses in our database.</p>";
							//Send site admin email notification of new business record
							$emailMsg = "New business, '$busName' submitted to the website.";
							mail("admin@shop-local-rr.com","New business record",$emailMsg);
							
							
						}
						else{
							//header("refresh:5;url=buylocal.php");
							echo"<h1>Sorry,</h1>";
							echo "<p>Something went wrong and new business record could not be added to our database. Head on over to our <a href='buylocal.php'>buy local</a> page to browse other businesses in our database.</p>";
							
							//echo "Error:".mysqli_error($dbconnection);
							
						}
						
					}
					
				}
				elseif($form == 2){
					//Form 2 is the 'Submit an Event' form
					//Put form inputs into variables
					$evName = mysqli_real_escape_string($dbconnection,$_POST['eventName']);
					$evDate = mysqli_real_escape_string($dbconnection,$_POST['eventDate']);
					$evStart = mysqli_real_escape_string($dbconnection,$_POST['eventStart']);
					$evEnd = mysqli_real_escape_string($dbconnection,$_POST['eventEnd']);
					$evHost = mysqli_real_escape_string($dbconnection,$_POST['eventHost']);
					$evDesc = mysqli_real_escape_string($dbconnection,$_POST['eventDesc']);
					
					$locStAdd = mysqli_real_escape_string($dbconnection,$_POST['locStAdd']);
					$locCity = mysqli_real_escape_string($dbconnection,$_POST['locCity']);
					$locState = mysqli_real_escape_string($dbconnection,$_POST['locState']);
					$locZip = mysqli_real_escape_string($dbconnection,$_POST['locZip']);
					
					$conFirst = mysqli_real_escape_string($dbconnection,$_POST['conFName']);
					$conLast = mysqli_real_escape_string($dbconnection,$_POST['conLName']);
					$conPhone = mysqli_real_escape_string($dbconnection,$_POST['conPhone']);
					$conEmail = mysqli_real_escape_string($dbconnection,$_POST['conEmail']);
					
					//Check if exact event already exists in the database? Such as name with exact date start and time matching at the same location?
					$evCheckQuery = "SELECT * FROM eventtable WHERE EventName='$evName' AND EventDate='$evDate' AND EventStart='$evStart' AND EventEnd='$evEnd' AND EventHost='$evHost' AND LocationAddress='$locStAdd' AND LocationCity='$locCity' AND LocationState='$locState' AND LocationZip='$locZip'";
					$evCheckResult = mysqli_query($dbconnection,$evCheckQuery);
					
					if(mysqli_num_rows($evCheckResult) > 0){
						//The exact event already exists within database; display appropriate message and reroute to search events page
						echo"<h1>Sorry,</h1>";
						echo "<p>That exact event appears to already exist in our database. If this is your event and you are trying to update information, please email our site admin at <a href='mailto:admin@shop-local-rr.com'>admin@shop-local-rr.com</a> </p>";
						echo"<p>Otherwise, you can explore what events are going on locally at our <a href='dolocal.php'>do local</a> page.</p>";
						//header("refresh:5;url=dolocal.php");
					}
					elseif(mysqli_num_rows($evCheckResult) < 1){
						$evAddQuery = "INSERT INTO eventtable (EventName,EventDate,EventStart,EventEnd,EventHost,EventDescription,LocationAddress,LocationCity,LocationState,LocationZip,ContactFirstN,ContactLastN,ContactPhone,ContactEmail) 
						VALUES ('$evName','$evDate','$evStart','$evEnd','$evHost','$evDesc','$locStAdd','$locCity','$locState','$locZip','$conFirst','$conLast','$conPhone','$conEmail')";
						if(mysqli_query($dbconnection,$evAddQuery)){
							//header("refresh:5;url=dolocal.php");
							//If new record can add to the database; display message and reroute to search events page
							echo"<h1>Success!</h1>";
							echo "<p>New event record successfully added to our database, a moderator will review it as soon as possible. Head on over to our <a href='dolocal.php'>do local</a> page to browse other events in our database.</p>";
							//Send site admin email notification of new event
							$msg = "New event, '$evName' submitted to the website.";
							mail("admin@shop-local-rr.com","New event record",$msg);
							
						}
						else{
							//If new record cannot be added to the database; display message
							//header("refresh:5;url=dolocal.php");
							echo"<h1>Sorry,</h1>";
							echo "<p>Something went wrong and we could not add your event to our database.  Head on over to our <a href='dolocal.php'>do local</a> page to browse other events in our database.</p>";
							
							//echo "Error:".mysqli_error($dbconnection);
							
						}
						
					}
					
				}
				else{}
				mysqli_close($dbconnection);
			?>
		</div>
		<div class="footer">
			<p>Created by Information Technology Students of <a href="createdlocal.html">HCC</a>.</p>
		</div>
	</div>
</body>
</html>