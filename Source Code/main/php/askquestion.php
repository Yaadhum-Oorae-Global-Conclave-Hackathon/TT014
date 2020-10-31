<?php
include('session.php');
include('profiledb.php');
$name = $login_session;
$ques = $_POST['askquestext'];
if(strlen($ques)>0){
$sqlt= "INSERT INTO questions(question,askedby,area) VALUES('$ques','$name','$locat')";
if(mysqli_query($conn,$sqlt)){
	header('Location: dashboard.php?msg=0');
}else{
	echo "<script>
		alert('Unable to ask question right now!');
		window.location.href='dashboard.php?msg=0';
		</script>";
}
}
else{
	echo "<script>
		alert('Question value cannot be Empty!');
		window.location.href='dashboard.php?msg=0';
		</script>";
	// header('Location: dashboard.php?msg=0');
}
?>
