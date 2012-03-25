<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Guitar Wars - High Scores</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>

	<body>
		<h2>Guitar Wars - Hight Scores</h2>
		<p>Welcome,Guitar Warrior,do you have what it takes to crack the high score list? If so,just<a href="addscore.php">add your own score.</a>.</p>
		<hr/>

<?php
	require_once('appvars.php');
	require_once('connectvars.php');

	$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
	$query = "SELECT * FROM guitarwars ORDER BY score DESC, DATE ASC";
	$data = mysqli_query($dbc,$query);
	
	echo '<table>';
	$i = 0;
	while($row = mysqli_fetch_array($data))
	{
		if($i == 0)
			echo '<tr><td colspan="2" class="topscoreheader">Top Score: ' . $row['score'] . '</td></tr>';
		echo '<tr><td class="scoreinfo"><span class="score">' . $row['score'] . '</span><br/><strong>Name:</strong>' . $row['name'] . '<br/><strong>Date:</strong>' . $row['date'] . '<br/></td>';
		echo '<td><img src=';
		if(is_file(GW_UPLOADPATH . $row['screenshot']) && filesize(GW_UPLOADPATH . $row['screenshot']) > 0)
			echo GW_UPLOADPATH . $row['screenshot'];
		else
			echo GW_UPLOADPATH . 'unverified.gif';
		echo ' alt="Score image"></td></tr>';
		$i++;
	}
	echo '</table>';
	mysqli_close($dbc);
?>
	</body>
</html>
