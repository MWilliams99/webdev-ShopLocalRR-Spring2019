<!DOCTYPE html>
<html>
<head>
	<title>Shop Local RR - Local Events</title>
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
			<h1>Do Local</h1>
			<p>Looking for something to do? Roanoke Rapids has plenty to offer. Try searching for an event's name, date, host, or location!</p>
			<!-- Insert search bar and table here-->
			<?php
				include_once "dbconnection.php";
				
				if (!isset($_GET['s'])){
					$filter = 0;
				}
				else{
					$filter = $_GET['s'];
				}
				
				if($filter == 0){
					echo"<p><form action='dolocal.php' method='GET' class='search'>
						 <input type='text' name='search' placeholder='Enter a search term...'>
						 <input type='hidden' name='s' value='1'>
						 </form></p>";
					
					//Display all events where shown = 1 if no search term
					$query = "SELECT * FROM eventtable WHERE Shown='1' ORDER BY EventDate ASC";
					$result = mysqli_query($dbconnection,$query)
							  or die('Sorry, something went wrong connecting to the database!');
					
					if (mysqli_num_rows($result)==0){
						echo("<p>No events found matching the search term.</p>");
					}
					else {
						echo"<table>
								<tr>
									<th>Event Name</th>
									<th>Date</th>
									<th>Time</th>
									<th>Address</th>
								</tr>";
						
						while($row=mysqli_fetch_assoc($result)){
							$name = mysqli_real_escape_string($dbconnection,$row['EventID']);
							echo'<tr>
									<td><a class="eventlink" href="eventinfo.php?id='.$row['EventID'].'">'.$row['EventName'].'</a></td>
									<td>'.$row['EventDate'].'</td>';
									
								$evStart = $row['EventStart'];
								$evEnd = $row['EventEnd'];
								if(($evStart == '00:00:00')&&($evEnd == '00:00:00')){
									echo'<td>N/A</td>';
								}
								else{
									if($evStart == '00:00:00'){
										echo'<td> N/A';
									}
									else{
										echo'<td>'.$row['EventStart'].'';
									}
									echo' - ';
									if($evEnd == '00:00:00'){
										echo'N/A</td>';
									}
									else{
										echo''.$row['EventEnd'].'</td>';
									}
								}
								
								//echo'<td>'.$row['EventStart'].'-'.$row['EventEnd'].'</td>';
								
								$locAdd = $row['LocationAddress'];
								$locCity = $row['LocationCity'];
								if(empty($locAdd)){
									echo'<td>';
								}	
								else{
									echo'<td>'.$row['LocationAddress'].'';
									echo ', ';
								}
								
								if(empty($locAdd)&&empty($locCity)){
									echo"N/A";
								}
								
								if(empty($locCity)){
									echo'</td>';
								}
								else{
									echo ''.$row['LocationCity'].'</td>';
								}
								
						}
						echo"</table>";
					}
				}
				elseif($filter==1){
					$searchTerm = $_GET['search'];
					echo"<form action='dolocal.php' method='GET' class='search'>
						 <input type='text' name='search' placeholder='Enter a search term...'>
						 <input type='hidden' name='s' value='1'>
						 </form>";
					
					$query="SELECT * FROM eventtable WHERE Shown='1' AND (EventName LIKE '%$searchTerm%' OR EventDate LIKE '%$searchTerm%' OR EventHost LIKE '%$searchTerm%' OR LocationAddress LIKE '%$searchTerm%') ORDER BY EventDate ASC";
					$result = mysqli_query($dbconnection,$query)
							  or die('Sorry, something went wrong connecting to the database!');
					if (mysqli_num_rows($result)==0){
						echo("<p>No events found matching the search term.</p>");
					}
					else {
						echo"<table>
								<tr>
									<th>Event Name</th>
									<th>Date</th>
									<th>Time</th>
									<th>Address</th>
								</tr>";
						
while($row=mysqli_fetch_assoc($result)){
							$name = mysqli_real_escape_string($dbconnection,$row['EventID']);
							echo'<tr>
									<td><a class="eventlink" href="eventinfo.php?id='.$row['EventID'].'">'.$row['EventName'].'</a></td>
									<td>'.$row['EventDate'].'</td>';
									
								$evStart = $row['EventStart'];
								$evEnd = $row['EventEnd'];
								if(($evStart == '00:00:00')&&($evEnd == '00:00:00')){
									echo'<td>N/A</td>';
								}
								else{
									if($evStart == '00:00:00'){
										echo'<td> N/A';
									}
									else{
										echo'<td>'.$row['EventStart'].'';
									}
									echo' - ';
									if($evEnd == '00:00:00'){
										echo'N/A</td>';
									}
									else{
										echo''.$row['EventEnd'].'</td>';
									}
								}
								
								//echo'<td>'.$row['EventStart'].'-'.$row['EventEnd'].'</td>';
								
								$locAdd = $row['LocationAddress'];
								$locCity = $row['LocationCity'];
								if(empty($locAdd)){
									echo'<td>';
								}	
								else{
									echo'<td>'.$row['LocationAddress'].'';
									echo ', ';
								}
								
								if(empty($locAdd)&&empty($locCity)){
									echo"N/A";
								}
								
								if(empty($locCity)){
									echo'</td>';
								}
								else{
									echo ''.$row['LocationCity'].'</td>';
								}
								
						}
						echo"</table>";
					}
				}
			mysqli_close($dbconnection);
			?>
			<p>Are you a local organization or business and want to add your event to the calendar?
			Enter your information <a href="joinlocal.html">HERE</a> and a moderator will add you to the calendar of events.</p>
		</div>
		<div class="footer">
			<p>Created by Information Technology Students of <a href="createdlocal.html">HCC</a>.</p>
		</div>
	</div>
</body>
</html>