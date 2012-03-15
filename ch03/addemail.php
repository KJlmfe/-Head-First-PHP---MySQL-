<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Make Me Elvis - Add Email</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>

		<?php
			$dbc = mysqli_connect('localhost','root','','elvis_store')
				or die('Error connecting to MySQL server.');

			$first_name = $_POST['firstname'];
			$last_name = $_POST['lastname'];
			$email = $_POST['email'];

			$query = "INSERT INTO email_list (first_name, last_name, email) VALUES ('$first_name', '$last_name', '$email')";
			mysqli_query($dbc,$query)
				or die('Error querying database.');

			echo 'Customer added.';

			mysqli_close($dbc);
		?>

	</body>
</html>
