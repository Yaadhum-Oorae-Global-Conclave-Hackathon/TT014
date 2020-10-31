<?php
include('profiledb.php');
session_start();
$uname=$_POST['loguname'];
$pass=$_POST['logpass'];
$sql = "SELECT * FROM userlog WHERE username='$uname' and password='$pass'";
    $result = mysqli_query($conn,$sql); 
    $count = mysqli_num_rows($result);
    $row = $result->fetch_assoc();	
    if($count == 1) {
        $_SESSION['loc']= $row['location'];
        $locc=$row['location'];
        $sql1= "SELECT * FROM areas WHERE area='$locc'";
        $res1 = mysqli_query($conn,$sql1);
        $count1 = mysqli_num_rows($res1);
        // if($count1>=1){
            $_SESSION['user'] = $uname;
            $_SESSION['loc'] = $locc;
            $_SESSION['loggedin']= true;
            
            header("location: dashboard.php?msg=0");
        // }
        // else{
        //     echo "<script>
        //     alert('Location does not exist, try later!');
        //     window.location.href='../index.html';
        //     </script>";
        // }
    }else {
    	echo "<script>
		alert('Invalid Login Credentials, Try Again');
		window.location.href='../index.html';
		</script>";
    }
$conn1->close();
?>