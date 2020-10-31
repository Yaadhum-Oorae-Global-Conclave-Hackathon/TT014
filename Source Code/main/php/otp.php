<?php
include('profiledb.php');
session_start();
$uname=$_SESSION['uname'];
$pass=$_SESSION['pass'];
$name=$_SESSION['name'];
$mobile=$_SESSION['mobile'];
$email=$_SESSION['email'];
$loc=$_SESSION['loc'];
$sql = "INSERT INTO userlog (name,email,mobile,username,password,location)
VALUES ('$name','$email','$mobile','$uname','$pass','$loc')";
if($_SESSION['otpgen']==$_POST['logotp']){
		if (mysqli_query($conn, $sql)) {
			$sql2 = "SELECT * FROM areas where area='$loc";
			$res=mysqli_query($conn,$sql2);
			$count = mysqli_num_rows($result);
			if($count==0){
			$sql1 = "INSERT INTO areas (area) VALUES ('$loc')";
			$result = mysqli_query($conn,$sql1);
			}
			echo "<script>
				alert('Successfully signed up. Please Login to Continue.');
				window.location.href='../index.html';
				</script>";
		} else {
		    echo "<script>
				alert('Oops! An error occured,Please Try Again');
				window.location.href='../index.html';
				</script>";
		}
	}
	else{
		echo "<script>
				alert('Oops! Incorrect OTP,Please Try Again');
				window.location.href='../index.html';
				</script>";
	}
?>