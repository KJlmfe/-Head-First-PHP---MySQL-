<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Make Me Elvis - Send Email</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<img src="blankface.jpg" width="161" height="350" alt="" style="float:right" />
		<img name="elvislogo" src="elvislogo.gif" width="229" height="32" border="0" alt="Make Me Elvis" />
		<p><strong>Private:</strong>For Elmer's use ONLY<br />
		Write and send an email to mailing list members.</p>
		
		<?php
			$from = "addds@hit.edu.cn";
			$subject = $_POST['subject'];
			$message = $_POST['message'];
			$output = true;
			if(isset($_POST['submit']))	
			{
				if (empty($subject) && empty($message))
					echo "请输入你的Subject和Message";
			    elseif (!empty($subject) && empty($message))
					echo "请输入你的Message";
				elseif (empty($subject) && !empty($message))
					echo "请输入你的Subject";
				else 
				{
					$output = false;
					$dbc = mysqli_connect('localhost','root','','elvis_store')
						or die("Error to Connect MySQL");
					$query = "SELECT * FROM email_list";
					$result = mysqli_query($dbc,$query)
						or die("Error to query");
					while($row = mysqli_fetch_array($result))
					{
						$to = $row['email'];
						$first_name = $row['first_name'];
						$last_name = $row['last_name'];
						$msg = "Dear $first_nmae $last_name,\n$message";
						mail($to,$subject,$msg,'From:' . $from);
						echo 'Email sent to: ' . $to . '<br />';
					}
					mysqli_close($dbc);
				}
			}
			
			if($output)
				{
		?>
					<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
						<label>Subject of email:</label><br />
						<input name="subject" type="text" value="<?php echo $subject; ?>"/><br />
						<label>Body of email:</label><br />
						<textarea name="message" rows="8" cols="40"><?php echo $message; ?></textarea><br />
						<input type="submit" name="submit"/>
					</form>
		<?php
				}
		?>
	</body>

</html>
