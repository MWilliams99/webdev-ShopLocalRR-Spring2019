<!DOCTYPE html>
<html>
<head>
	<title>Shop Local RR - Business Information</title>
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
			<!-- Insert Search bar here/table to browse -->
			<?php
				include_once "dbconnection.php";
				$idNum = $_GET['id'];
				
				$query = "SELECT * FROM businesstable WHERE BusinessID='$idNum'";
				$result = mysqli_query($dbconnection,$query)
						  or die('Sorry, something went wrong connecting to the database!');
				
				if (mysqli_num_rows($result)==0){
					echo"<h1>Sorry,</h1>";
					echo "<p>It seems there is no business associated with that ID. You can try another search at our <a href='buylocal.php'>buy local</a> page.</p>";
					echo "<p>If you are getting this error after following a link on our buy local page, please send our website admin an email at <a href='mailto:admin@shop-local-rr.com'>admin@shop-local-rr.com</a> </p>";
					//return them to business search page
				}
				else{
					$row = mysqli_fetch_assoc($result);
					echo"<h1>".$row['BusinessName']."</h1>
						<p>
						<strong>Type:</strong> ".$row['BusinessType']." ";
					echo"<strong>Hours:</strong> ".$row['BusinessHours']."";
						$busHours = $row['BusinessHours'];
						if(empty($busHours)){
							echo"N/A";
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
						 
						<p>".$row['BusinessDescription']."</p>";
						
						$busWeb = $row['BusinessWebsite'];
						if(empty($busWeb)){
							echo"<p>";
						}
						else{
							echo"<p>Check out the <strong>website</strong> for this business at: <a href='http://www.".$row['BusinessWebsite']."' target='_blank'>".$row['BusinessWebsite']."</a></br>";
						}
						
						$busPhone = $row['BusinessPhone'];
						if(empty($busPhone)){
							echo"</p>";
						}
						else{
							echo"Contact them via their <strong>phone:</strong> ".$row['BusinessPhone']."</p>";
						}
						
					//Include all three images in a p
					echo"<p>";
					$socFB = $row['SocialFacebook'];
					$socTW = $row['SocialTwitter'];
					$socIN = $row['SocialInstagram'];
					
					
					
					//Add fb img and a link set to it for the business's fb page.
					if (empty($socFB)){
						
					}
					else{
						echo "<a href='".$row['SocialFacebook']."'><img src='images/FacebookLogo.png' alt='Facebook logo'></a>&nbsp";
					}
					
					//Add twitter img and a link set to it for the business's twitter page.
					if (empty($socTW)){
						
					}
					else{
						echo "<a href='".$row['SocialTwitter']."'><img src='images/TwitterLogo.png' alt='Twitter logo'></a>&nbsp";
					}
					
					//Add instagram img and a link set to it for the business's instagram page.
					if (empty($socIN)){
						
					}
					else{
						echo "<a href='".$row['SocialInstagram']."'><img src='images/InstagramLogo.png' alt='Instagram logo'></a>&nbsp";
					}
					echo"</p>";
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