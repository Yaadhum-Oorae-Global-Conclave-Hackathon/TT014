<?php
include('session.php');
include('profiledb.php');
$qid=$_GET['val'];
$action=$_GET['act'];
$src='questionfetch.php?val='.$qid.'&msg=0';
$sql="SELECT * FROM votes WHERE questionid=$qid AND username='$login_session'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	if($action==1){
		if($row['disliked']==1){
			$sql1="UPDATE votes SET disliked=0,liked=1 WHERE questionid=$qid AND username='$login_session'";
		}
		else{
			$sql1="UPDATE votes SET liked=0 WHERE questionid=$qid AND username='$login_session'";
		}
	}
	else{
		if($row['liked']==1){
			$sql1="UPDATE votes SET disliked=1,liked=0 WHERE questionid=$qid AND username='$login_session'";
		}
		else{
			$sql1="UPDATE votes SET disliked=0 WHERE questionid=$qid AND username='$login_session'";
		}
	}
}
else{
	if($action==1){
		$sql1="INSERT INTO votes(questionid,liked,username) VALUES($qid,1,'$login_session')";
	}
	else{
		$sql1="INSERT INTO votes(questionid,disliked,username) VALUES($qid,1,'$login_session')";
	}
}
if (mysqli_query($conn, $sql1)) {
	$sql2="DELETE FROM votes WHERE liked=0 AND disliked=0";
	if (mysqli_query($conn, $sql2)) {
    	header('location: '.$src);
	}
} 
else{
    echo "<script>
	alert('Oops! An error occured,Please Try Again');
	window.location.href='../index.html';
	</script>";
	header('location: '.$src);

}
?>