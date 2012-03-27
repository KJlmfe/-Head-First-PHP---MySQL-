<?php
	require_once('authorize.php');
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset:utf-8"/>
		<title>Guitar Wars - Remove a High Score</title>
		<link ref="stylesheet" type="text/css" href="style.css"/>
	</head>
	
	<body>
		<h2>Guitar Wars - Remove a High Score</h2>
		<p>Are you sure want to delete the following high score?</p>

<?php
	require_once('appvars.php');
	require_once('connectvars.php');

	if(isset($_GET['id']) && isset($_GET['name']) && isset($_GET['date']) && isset($_GET['score']) && isset($_GET['screenshot']))
    {
		echo '<p><strong>Name: </strong>' . $_GET['name'] . '<br/>';
		echo '<strong>Date: </strong>' . $_GET['date'] . '<br/>';
		echo '<strong>Score: </strong>' . $_GET['score'] . '</p>';
		echo '<form method = "post" action="removescore.php">';
		echo '<input type="radio" name="confirm" value="YES">YES</input>';
		echo '<input type="radio" name="confirm" value="NO">No</input>';
		echo '<br/>';
		echo '<input type="submit" value="submit" name="submit"/>';
		echo '<input type="hidden" name="id" value="' . $_GET['id'] . '"/>';
		echo '<input type="hidden" name="name" value="' . $_GET['name'] . '"/>';
		echo '<input type="hidden" name="score" value="' . $_GET['score'] . '"/>';
		echo '<input type="hidden" name="screenshot" value="' . $_GET['screenshot'] . '"/></form>';
	}
	else if(isset($_POST['submit']))
	{
		if($_POST['confirm'] == 'YES')
		{
			@unlink(GW_UPLOADPATH . $screenshot);
			$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME)
				or die("Error to connect to database");
			$sql = "DELETE FROM guitarwars WHERE id = " . $_POST['id'];
			mysqli_query($dbc,$sql)
				or die("Error to query");
			mysqli_close($dbc);
		
			echo '<p>The high score of ' . $_POST['score'] . ' for ' . $_POST['name'] . ' was successfully removed.</p>';
		}
		else
			echo '<p class = "error">The high score was not removed.</p>';
	}
	else
		echo '<p class="error">Sorry, no high score was specified for removal.</p>';
?>
		<p><a href="admin.php"> &lt;&lt; Back to admin page</a></p>
	</body>

</html>
