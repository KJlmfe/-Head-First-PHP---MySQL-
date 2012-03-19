<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Make Me Elvis - Add Email</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<img src="blankface.jpg" width="161" height="350" alt="" style="float:right" />
  		<img name="elvislogo" src="elvislogo.gif" width="229" height="32" border="0" alt="Make Me Elvis" />
		<p>Enter your first name, last name, and email to be added to the <strong>Make Me Elivs</strong> mailing list.</p>
		
		<?php
			echo $_POST['first_name'];
			if(isset($_POST['submit']))
			{
				$first_name = $_POST['first_name'];
				$last_name = $_POST['last_name'];
				$email = $_POST['email'];
				$output = "no";
				if(empty($first_name) || empty($_POST['last_name']) || empty($_POST['email']))
				{
					echo "你输入的信息不完整";
					$output = "yes";
				}
				else
				{
					$dbc = mysqli_connect('localhost','root','','elvis_store')
						or die("Connect Error to MySQL");
					$query = "INSERT INTO email_list (first_name, last_name, email) VALUES ('$first_name','$last_name','$email')";
			 		mysqli_query($dbc,$query)
						or die("Insert Error");
					mysqli_close($dbc);
					echo "成功将你的信息加入数据库";
				}
			}
			else
				$output = "yes";
			
			if($output == "yes")
				{
		?>
					<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
						<label>First name: </label>
						<input type="text" name="first_name" /><br />
						<label>Last name: </label>
						<input type="text" name="last_name" /><br />
						<label>Email: </label>
						<input type="text" name="email" /><br />
						<input type="submit" name="submit" /><br />
					</form>
		<?php
				}
		?>
	</body>
</html>
