<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Guitar Wars - High Score Administration</title>				
		<link rel="stylesheet" type="text/css" href="style.css"/>
	</head>

	<body>
		<h2>Guitar Wars - High Scores Administration</h2>
		<p>Below is a list of all Guitar Wars high scores. Use this page to remove scores as needed.</p>
		<hr/>
		<table>
<?php
	require_once('appvars.php');
	require_once('connectvars.php');

	$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
	$sql = "SELECT * FROM guitarwars ORDER BY score DESC, date ASC";
	$result = mysqli_query($dbc,$sql);
	while($data = mysqli_fetch_array($result))
	{
		echo '<tr class="scorerow"><td><strong>' . $data['name'] .'</strong></td><td>' . $data['date'] . '</td><td>' . $data['score'] . '</td><td><a href="removescore.php?id=' . $data['id'] . '&amp;date=' . $data['date'] .'&amp;name=' . $data['name'] . '&amp;score=' . $data['score'] . '&amp;screenshot=' . $data['screenshot'] . '">Remove</a></td>';  
	}
	mysqli_close($dbc);
?>
		</table>
	</body>
</html>
