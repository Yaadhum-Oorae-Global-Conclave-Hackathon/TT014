<?php
include('session.php');
include('profiledb.php');
   if(!isset($_SESSION["loggedin"]) === true){
   header("location: ../index.html");
   exit;
}
$subscription_key = "ae1fd286411b48fbaeec3640ddbc8dc2";
$endpoint = "https://api.cognitive.microsofttranslator.com/";
$path = "translate?api-version=3.0";
$params = "&to=ta";
if (!function_exists('com_create_guid')) {
  function com_create_guid() {
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
        mt_rand( 0, 0xffff ),
        mt_rand( 0, 0x0fff ) | 0x4000,
        mt_rand( 0, 0x3fff ) | 0x8000,
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
  }
}
function Translate ($host, $path, $key, $params, $content) {
    $headers = "Content-type: application/json\r\n" .
        "Content-length: " . strlen($content) . "\r\n" .
        "Ocp-Apim-Subscription-Key: $key\r\n" .
        "X-ClientTraceId: " . com_create_guid() . "\r\n";
    $options = array (
        'http' => array (
            'header' => $headers,
            'method' => 'POST',
            'content' => $content
        )
    );
    $context  = stream_context_create ($options);
    $resul = file_get_contents ($host . $path . $params, false, $context);
    return $resul;
}
$value = $_GET['val'];
$res = "";
$sql="SELECT * FROM answers WHERE questionid = $value";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
while($row = mysqli_fetch_assoc($result)) {
$res= $res."<span id='ansdisp'>"."id: " . $row["answerid"]." <br>Name: " . $row["answeredby"]. "<br><b> " . $row["answer"]. "</b><br>"."</span>";
}
} else {
$res= "<span id='ansdispnone'>No one has Answered yet! Why dont you give it a try</span>";
}
?>
<html">   
   <head>
      	<title>Dashboard</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <script src="https://kit.fontawesome.com/a076d05399.js"></script>
      	<link rel="stylesheet" type="text/css" href="../css/dashboardstyle.css">
		<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet'>
      	<meta name="viewport" content="width=device-width, initial-scale=1">
   </head>
   <body>
   	<div id="wrapper">
   		<div id="header">
   				<div id="sitename">
   					<span id="namesite"><a href="dashboard.php?msg=0">தமிழ் PEDIA</a></span>
   				</div>
   				<div id="userpanel">
   					<span id="uname">
					   வணக்கம், <?php echo $login_session; ?>
   					</span>
						<div class="dropdown">
							<button class="dropbtn"><i class="fa fa-cog fa-spin"></i></button>
							<div class="dropdown-content">
								<a href="logout.php">Logout</a>
							</div>
						</div>
   				</div>
   		</div>
   		<div id="content">
            <div id="question-disp">
               Thread
               <?php
               $sql="SELECT * FROM questions WHERE questionid=$value";
               $result = mysqli_query($conn, $sql);
               if (mysqli_num_rows($result) > 0) {
               		$sql2="SELECT * FROM votes WHERE questionid=$value AND username='$login_session'";
               		$result2 = mysqli_query($conn, $sql2);
					   $row = mysqli_fetch_assoc($result);
					   $text = $row["question"];
                        $requestBody = array (
                           array (
                                 'Text' => $text,
                           ),
                        );
                        $content = json_encode($requestBody);
                        $resul = Translate ($endpoint, $path, $subscription_key, $params, $content);
                        $json = json_decode($resul,true)[0]["translations"][0]["text"];
                  	if(mysqli_num_rows($result2)>0){
						
                  		$row2 = mysqli_fetch_assoc($result2);
	                  	if($row2["liked"]==1){
	                    	echo "<span id='quesdisplay'>"."ID: " . $row["questionid"]." <br><b> " . $json. "</b><br>கேள்வி கேட்ட நபர்: ".$row["askedby"]."<br><div class='liked highlight'><i class='fas fa-thumbs-up'></i></div><div class='disliked'><i class='fas fa-thumbs-down'></i></div></span>";
	                	}
	                	elseif ($row2['disliked']==1) {
	                		echo "<span id='quesdisplay'>"."ID: " . $row["questionid"]." <br><b> " . $json. "</b><br>கேள்வி கேட்ட நபர்: ".$row["askedby"]."<br><div class='liked'><i class='fas fa-thumbs-up'></i></div><div class='highlight disliked'><i class='fas fa-thumbs-down'></i></div></span>";
	                	}
	                	else{
                			echo "<span id='quesdisplay'>"."ID: " . $row["questionid"]." <br><b> " . $json. "</b><br>கேள்வி கேட்ட நபர்: ".$row["askedby"]."<br><div class='liked'><i class='fas fa-thumbs-up'></i></div><div class='disliked'><i class='fas fa-thumbs-down'></i></div></span>";
                		}
	                }
                	else{
                		echo "<span id='quesdisplay'>"."ID: " . $row["questionid"]." <br><b> " . $json. "</b><br>கேள்வி கேட்ட நபர்: ".$row["askedby"]."<br><div class='liked'><i class='fas fa-thumbs-up'></i></div><div class='disliked'><i class='fas fa-thumbs-down'></i></div></span>";
                	}
    
               	} else {
                	echo "<span id='quesdisp'>"."Error, try again!"."</span>";
               	}
               ?>
            </div>
            <div id="answers">
            		<?php
            		echo $res;
            		?>
            </div>
            <br>
            <div id="ansques">
               <form method="post" id="askquestion-form"action="submitanswers.php?id=<?php echo $value; ?>">
                  <input type="text" name="postansr" autocomplete="off" id="askques-text" placeholder="Type something to answer." />
                  <br>
                  <input type="submit" name="postansrsubm" id="askques-subm">
               </form>
            </div>
   		</div>
   	</div>
      <script type="text/javascript" src="../java/questionfetchscript.js">
      </script>
   </body>
</html>