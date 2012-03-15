<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Make Me Elvis - Send Email</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<?php
			$from = 'test@aav.com';
			$subject = $_POST['subject'];
			$text = $_POST['elvismail'];

			$dbc = mysqli_connect('localhost','root','','elvis_store')
				or die('Error connecting to MySQL server');
			
			$query = "SELECT * FROM email_list";
			$result = mysqli_query($dbc,$query)
				or die('Error querying database.');

			while($row = mysqli_fetch_array($result))
			{
				$to = $row['email'];
				$first_name = $row['first_name'];
				$last_name = $row['last_name'];
				$msg = "Dear $first_name $last_name,\n$text";
				mail($to,$subject,$msg,'From:' . $from);
				echo 'Email sent to: '.$to.'<br />';
			}
			
			mysqli_close($dbc);
		?>
	</body>
</html>
