<!DOCTYPE html>
<html>
<head>
	<title>Shop Local RR - Local Businesses</title>
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
			<h1>Buy Local</h1>
			<p>What are you looking for? Roanoke Rapids has it all. Search by business 
			name, type, or location to find information about local businesses, from retail to services 
			offered, including their location and hours of operation.</p>
			<!-- Insert Search bar here/table to browse -->
			<?php
				include_once "dbconnection.php";
				
				if (!isset($_GET['s'])){
					$filter = 0;
				}
				else{
					$filter = $_GET['s'];
				}
				
				if($filter == 0){
					echo"<form action='buylocal.php' method='GET' class='search'>
						 <input type='text' name='search' placeholder='Enter a search term...'>
						 <input type='hidden' name='s' value='1'>
						 </form>";
					
					//Display all businesses where shown = 1 if no search term
					$query = "SELECT * FROM businesstable WHERE Shown='1' ORDER BY BusinessName ASC";
					$result = mysqli_query($dbconnection,$query)
							  or die('Sorry, something went wrong connecting to the database!');
					
					echo mysqli_error();
					
					if (mysqli_num_rows($result)==0){
						echo("<p>No businesses found matching the search term.</p>");
					}
					else {
						echo"<table>
								<tr>
									<th>Business Name</th>
									<th>Type</th>
									<th>Address</th>
									<th>Hours</th>
								</tr>";
						
						while($row=mysqli_fetch_assoc($result)){
							$name = mysqli_real_escape_string($dbconnection,$row['BusinessID']);
							echo'<tr>
									<td><a class="buslink" href="businessinfo.php?id='.$row['BusinessID'].'">'.$row['BusinessName'].'</a></td>
									<td>'.$row['BusinessType'].'</td>';
									
									
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
								
							
							$busHours = $row['BusinessHours'];
							if(empty($busHours)){
								echo"<td>N/A</td>";
							}
							else{
								echo'<td>'.$row['BusinessHours'].'</td>';
							}	
							
							echo'</tr>';
						}
						echo"</table>";
					}
				}
				elseif($filter==1){
					$searchTerm = $_GET['search'];
					echo"<form action='buylocal.php' method='GET' class='search'>
						 <input type='text' name='search' placeholder='Enter a search term...'>
						 <input type='hidden' name='s' value='1'>
						 </form>";
					
					$query="SELECT * FROM businesstable WHERE Shown='1' AND (BusinessName LIKE '%$searchTerm%' OR BusinessType LIKE '%$searchTerm%' OR LocationAddress LIKE '%$searchTerm%' OR LocationCity LIKE '%$searchTerm%') ORDER BY BusinessName ASC";
					$result = mysqli_query($dbconnection,$query)
							  or die('Sorry, something went wrong connecting to the database!');
					if (mysqli_num_rows($result)==0){
						echo("<p>No businesses found matching the search term.</p>");
					}
					else {
						echo"<table>
								<tr>
									<th>Business Name</th>
									<th>Type</th>
									<th>Address</th>
									<th>Hours</th>
								</tr>";
						
						while($row=mysqli_fetch_assoc($result)){
							$name = mysqli_real_escape_string($dbconnection,$row['BusinessID']);
							echo'<tr>
									<td><a class="buslink" href="businessinfo.php?id='.$row['BusinessID'].'">'.$row['BusinessName'].'</a></td>
									<td>'.$row['BusinessType'].'</td>
									<td>'.$row['LocationAddress'].'';
									
									$locAdd = $row['LocationAddress'];
									if(empty($locAdd)){
										
									}	
									else{
										echo ', ';
									}
									
							echo''.$row['LocationCity'].'</td>
									<td>'.$row['BusinessHours'].'</td>
								</tr>';
						}
						echo"</table>";
					}
				}
			mysqli_close($dbconnection);
			?>
			
			<p>Are you a local business and want to add your information to the database? 
			Enter your information <a href="joinlocal.html">HERE</a> and a moderator will add you to the searchable businesses.</p>
		</div>
		<div class="footer">
			<p>Created by Information Technology Students of <a href="createdlocal.html">HCC</a>.</p>
		</div>
	</div>
</body>
</html>