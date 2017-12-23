<?php

	$dbhost = 'localhost';
	$dbuser = 'admin';
	$dbpass = 'cbit';
	
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass,'cbit');
   
	
	if(! $conn )
	{
		echo "Not connected to database." . mysqli_error();
	}
		echo "
			<html>
				<head>
					<title>CBIT MANAGEMENT SYSTEM</title>
				</head>
				<body>
					<center>
						LOGIN:
						<form method='POST' action='index.php' >
							USERNAME:	
							<input type='text' name='username' required><br><br>
							PASSWORD:
							<input type='password' name='password' required><br><br>
							<input type='submit' value='submit' name='submit'>
						</form>
					</center>
				</body>
			</html>
		";
				
		if(isset($_POST["submit"]))
		{
			//echo "<script>alert('1')</script>";
			if($_POST['username']!=null&&$_POST['password']!=null)
			{				
				//echo "<script>alert('2')</script>";
				$uname = $_POST['username'];
				$pword = $_POST['password'];
				
				$sql="
					SELECT * from login where Username='$uname' and Password=Password('$pword');
				";
				$retval = mysqli_query($conn, $sql);
				if(! $retval )
				{
					echo "<script>alert('Invalid user credentials!! ')</script>";
					//die('Could not get data: ' . mysqli_error());
				}
				
				while($row = mysqli_fetch_array($retval))
				{
					//echo "<script>alert('3')</script>";
					$role=$row['role'];
				}
				echo "<script language='javascript'>
					window.location=\"principal.php\";
					</script>
				";
			}
			else
                echo "<script language='javascript'>
				alert('Please fill all fields!');
				</script>
				";
		}
?>