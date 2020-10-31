<?php
	include('session.php');
   	include('profiledb.php');
   	$lat=$_GET['lat'];
   	$long=$_GET['long'];
   	$lat1=substr($lat,0,5);
   	$long1=substr($long,0,5);
   	if((float)$lat1<=13.00 and (float)$lat1>=12.90 and (float)$long1<=80.20 and (float)$long1>=80.00){
   		$address="chromepet";
   	}
   	$sql="SELECT location from userlog where username='$login_session'";
   	$result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if($row['location']!=$address){
    	echo "<script>
            prompt('location has been changed!');
            window.location.href='../index.html';
            </script>";
    $SESSION['location']=$address;
    header('Location: dashboard.php?msg=0');
    }
    return;

   	// echo "$lat";
   	// $geocode = "https://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$long&sensor=false&key=AIzaSyAYeIYlksB2SmjznmVedvDsX2qGYar5jbs";
    // $ch = curl_init();
    // curl_setopt($ch, CURLOPT_URL, $geocode);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
    // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    // $response = curl_exec($ch);
    // curl_close($ch);
    // $output = json_decode($response);
    // $dataarray = get_object_vars($output);
    // if ($dataarray['status'] != 'ZERO_RESULTS' && $dataarray['status'] != 'INVALID_REQUEST') {
    //     if (isset($dataarray['results'][0]->formatted_address)) {

    //         $address = $dataarray['results'][0]->formatted_address;

    //     } else {
    //         $address = 'Not Found';

    //     }
    // } else {
    //     $address = 'Not Found';
    // }
?>