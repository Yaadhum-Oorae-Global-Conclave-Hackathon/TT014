<?php
session_start();
$_SESSION['uname']=$_POST['loguname'];
$_SESSION['pass']=$_POST['logpass'];
$_SESSION['name']=$_POST['logname'];
$_SESSION['mobile']=$_POST['logmobile'];
$_SESSION['email']=$_POST['logemail'];
$_SESSION['loc']=$_POST['loglocation'];
$mobile=$_SESSION['mobile'];
	$randomNumber = rand(10000,99999);
	$_SESSION['otpgen']=$randomNumber;
	$username = "ckmganesh2000@gmail.com";
	$hash = "6d6df0422ed1f4176dcb74ac995993cb79c1d62e55c58acfb98abd3f226253c7";
	$test = "0";
	$sender = "TXTLCL";
	$numbers = "91".$mobile;
	$message = "Your NAMMA AREA, OTP is ".(string)$randomNumber;
	$message = urlencode($message);
	$data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
	$ch = curl_init('http://api.textlocal.in/send/?');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$resultotp = curl_exec($ch);
	curl_close($ch);
	header('Location: otp.html');
?>