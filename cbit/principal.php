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
					<title>Principal CBIT</title>
				</head>
				<body>
					<center>
						<form action='principal.php' method='POST'>
							Enter Roll number:
							<input type='text' name='rollno' required>
							<input type='submit' name='submit' value='search'>
						</form>
					</center>
				</body>
		</html>
	";
		if(isset($_POST["submit"]))
		{
			//echo "<script>alert('1')</script>";
			if($_POST['rollno']!=null)
			{
				
				$rno = $_POST['rollno'];
				$sql = "select * from admission where rollno='$rno'";
				$retval = mysqli_query($conn, $sql);
				$retval2 = mysqli_query($conn, $sql);
				if(! $retval )
				{
					echo "<script>alert('Entered RollNo does not exist!')</script>";
					die('Could not get data: ' . mysqli_error());
				}
				//echo"
					//<h3>Admission Details</h3>
					//	";
				while($row = mysqli_fetch_array($retval))
				{
					//echo "<script>alert('3')</script>";
					//$role=$row['role'];
					echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['Photo'] ).'" width=200px height=200px/><br>';
				}
				echo "<h1>Admission Details:</h1>
				<table border='1'>
					<tr>
						<th>Admission No</th>
						<th>Roll number</th>
						<th>Name</th>
						<th>Phone Number</th>
						<th>Father Name</th>
						<th>Father Phonenumber</th>
						<th>Address</th>
						<th>Graduation</th>
						<th>Branch</th>
						<th>Date of Joining</th>
						<th>Email Id</th>
					</tr>";
					while($row = mysqli_fetch_array($retval2))
					{
						echo "
							<tr>
								<td>{$row['AdminNo']}</td>
								<td>{$row['RollNo']}</td>
								<td>{$row['FirstName']}"." "."{$row['LastName']}</td>
								<td>{$row['Phno']}</td>
								<td>{$row['FatherName']}</td>
								<td>{$row['FatherPhno']}</td>
								<td>{$row['Address']}</td>
								<td>{$row['Graduation']}</td>
								<td>{$row['Branch']}</td>
								<td>{$row['Date of Joining']}</td>
								<td>{$row['email']}</td>
							</tr>
						";
					}
				echo"</table>";
				
				
				echo "<br><br><h1>Attendance Details:<h1>";
				$sql="SELECT CourseId, Coe.Cname, Attendance from coe natural join aec where RollNo='$rno'";
				$retval3 = mysqli_query($conn, $sql);
				echo "
				<table border='1'>
					<tr>
						<th>Course Id</th>
						<th>Course Name</th>
						<th>Attendance</th>
					</tr>";
					while($row = mysqli_fetch_array($retval3))
					{
						echo "
							<tr>
								<td>{$row['CourseId']}</td>
								<td>{$row['Cname']}</td>
								<td>{$row['Attendance']}</td>
							</tr>
						";
					}
				echo"</table>";
				
				
				echo "<br><h1>Marks Details:<h1>";
				$sql="SELECT stu_coe.CourseId, Coe.Cname, Grade 
				from coe join stu_coe on coe.CourseId=stu_coe.CourseId 
				where RollNo='$rno'";
				$retval4 = mysqli_query($conn, $sql);
				echo "
				<table border='1'>
					<tr>
						<th>Course Id</th>
						<th>Course Name</th>
						<th>Grade</th>
					</tr>";
					while($row = mysqli_fetch_array($retval4))
					{
						echo "
							<tr>
								<td>{$row['CourseId']}</td>
								<td>{$row['Cname']}</td>
								<td>{$row['Grade']}</td>
							</tr>
						";
					}
				echo"</table>";
				
				
				echo "<br><h1>Library Details:<h1>";
				$sql="SELECT BookName
						from library join takesbook on library.BookId=takesbook.BookId
						where RollNo='$rno'";
				$retval4 = mysqli_query($conn, $sql);
				echo "
				<table border='1'>
					<tr>
						<th>Books Taken</th>
					</tr>";
					$count=0;
					while($row = mysqli_fetch_array($retval4))
					{
						$count++;
						echo "
							<tr>
								<td>{$row['BookName']}</td>
							</tr>
						";
					}
				echo"<tr><th>Total:$count</th></tr></table>";
				


				echo "<br><h1>Placement Details:<h1>";
				$sql="select CompanyName, Result
						from std_placement_details
						where RollNo='$rno'";
				$retval4 = mysqli_query($conn, $sql);
				echo "
				<table border='1'>
					<tr>
						<th>Company Name</th>
						<th>Result</th>
					</tr>";
					//$count=0;
					while($row = mysqli_fetch_array($retval4))
					{
						//$count++;
						echo "
							<tr>
								<td>{$row['CompanyName']}</td>
								<td>{$row['Result']}</td>
							</tr>
						";
					}
				echo"</table>";
				

				echo "<br><h1>Bus Details:<h1>";
				$sql="SELECT BusNo, SeatNo
						from stu_bus
						where RollNo='$rno'";
				$retval4 = mysqli_query($conn, $sql);
				echo "
				<table border='1'>
					<tr>
						<th>Bus Number</th>
						<th>Seat Number</th>
					</tr>";
					//$count=0;
					while($row = mysqli_fetch_array($retval4))
					{
						//$count++;
						echo "
							<tr>
								<td>{$row['BusNo']}</td>
								<td>{$row['SeatNo']}</td>
							</tr>
						";
					}
				echo"</table>";	
			}
		}
		
?>