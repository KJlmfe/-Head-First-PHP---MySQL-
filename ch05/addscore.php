<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html charset=utf-8"/>
		<title>Guitar Wars - Add Your High Score</title>
		<link rel="stylesheet" type="css/text" href="style.css"/>
	</head>
		
	<body>
		<h2>Guitar Wars - Add Your High Score</h2>

<?php
	require_once('appvars.php');
	require_once('connectvars.php');

	if(isset($_POST['submit']))
	{
		$name = $_POST['name'];
		$score = $_POST['score'];
		$screenshot = $_FILES['screenshot']['name'];
		$screenshot_type = $_FILES['screenshot']['type'];
		$screenshot_size = $_FILES['screenshot']['size'];
		if(!empty($name) && !empty($score) && !empty($screenshot))
		{
			if(($screenshot_type == 'image/gif' || $screenshot_type == 'image/jpeg' || $screenshot_type == 'image/pjpeg' || $screenshot_type == 'image/png') && ($screenshot_size > 0) && ($screenshot_size <= GW_MAXFILESIZE) )
			{
				if($_FILES['screenshot']['error'] == 0)
				{
					$target = GW_UPLOADPATH . $screenshot;
					if(move_uploaded_file($_FILES['screenshot']['tmp_name'], $target))
					{
						$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
						$query = "INSERT INTO guitarwars VALUES (0, NOW(), '$name', '$score','$screenshot')";
						mysqli_query($dbc,$query);
				
						echo '<p>Thanks for adding your new high score! It will be reviewed and added to the high score list as sonn as possile.</p>';
						echo '<p><strong>Name:</strong>' . $name . '<br/>';
						echo '<p><strong>Score:</strong>' . $score . '<br/>';
						echo '<img src=" ' . GW_UPLOADPATH . $screenshot . '" alt="Score image" /></p>';
						echo '<p><a href="index.php">&lt;&lt; Back to high scores</a></p>';

						$name = "";
						$score = "";
						$screenshot = "";

						mysqli_close($dbc);
					}
					else
					{
						echo '<p class="error">Sorry, there was a problem uploading your screen shot image.</p>';
					}
				}
			}
			else
				echo '<P class="error">The screen shot must be a GIF, JPEG or PNG image file no greater than ' . (GW_MAXFILESIZE / 1024) . ' KB in size.</p>';
			@unlink($_FILES['screenshot']['tmp_name']);
		}
		else
			echo '<p class="error">Please enter all of the information to add your high score.</p>';
	}
?>

		<hr/>
		<form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo GW_MAXFILESIZE; ?>">
			<label>Name:</label>
			<input type="text" name="name" value="<?php if(!empty($name)) echo $name; ?>"/><br/>
			<label>Score:</label>
			<input type="text" name="score" value="<?php if(!empty($score)) echo $score; ?>"/><br/> 
			<label>Screen shot:</label>
			<input type="file" id="screenshot" name="screenshot"/><br/>
			<hr/>
			<input type="submit" name="submit"/>
		</form>
	</body>
</html>
