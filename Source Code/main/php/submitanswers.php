<?php
include('session.php');
include('profiledb.php');
$quesid=$_GET['id'];
$answer=$_POST['postansr'];
$src="questionfetch.php?val=".$quesid."&msg=0";
if(strlen($answer)>0){
$sqlt= "INSERT INTO answers(questionid,answer,answeredby) VALUES('$quesid','$answer','$login_session')";
if(mysqli_query($conn,$sqlt)){
	header('Location: '.$src);
}else{
	echo "<script>
		alert('Unable to answer question right now!');
		window.location.href=$src;
		</script>";
}
}else{
	echo "<script>
		alert('Your answer cannot be a null value.');
		window.location.href='dashboard.php?msg=0';
		</script>";
	// header('Location: '.$src);
}
?>