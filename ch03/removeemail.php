<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Make Me Elvis - Remove Email</title>
		<link ref="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<?php
			$email = $_POST['email'];
			
			$dbc = mysqli_connect('localhost','root','','elvis_store')
				or die('Error to connect MySQL server');
			$query = "DELETE FROM email_list WHERE email = '$email'";
			mysqli_query($dbc,$query)
				or die('Error to delete');
	
			echo $email.'has been delete.';
			
			mysqli_close($dbc);
		?>
	</body>
</html>
