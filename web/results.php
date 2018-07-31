<!DOCTYPE html>

<html lang="en">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />

<head>
	<h1>
		Results Verification Page Preston Segura
	</h1>

	<div class="styled-input-2">

		<p class="para">
			<?php
	$firstName = $_REQUEST['firstName'];
	$lastName = $_REQUEST['lastName'];
	$email = $_REQUEST['email'];
	$address = $_REQUEST['address'];
	$phone = $_REQUEST['phone'];
	$education = $_REQUEST['education'];  // Storing Selected Value In Variable
	$salary = $_REQUEST['salary'];
	
	
   
	echo ("First Name: " . $firstName);
	echo "<br>";
	echo ("Last Name: " . $lastName);
	echo "<br>";
	echo ("Email: " . $email);
	echo "<br>";
	echo ("Address: " . $address);
	echo "<br>";
	echo ("Phone Number: " . $phone);
	echo "<br>";
	echo ("Education: " . $education);
	echo "<br>";
	echo ("Salary: " . $salary);
	
	?>
		</p>
		<style>
			.para {
				font-size: 20px;
				text-align: center;
				color: #fff;
				margin: 30px 0;
				text-shadow: -2px 5px 20px rgb(10, 10, 10);
				letter-spacing: 4px;
				font-style: italic;
				font-family: 'Acme', sans-serif;
			}
		</style>

	</div>



	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Live Demo of Google Maps Geocoding Example with PHP</title>

	<style>
		body {
			font-family: arial;
			font-size: .8em;
		}

		input[type=text] {
			padding: 0.5em;
			width: 20em;
		}

		input[type=submit] {
			padding: 0.4em;
		}

		#gmap_canvas {
			width: 100%;
			height: 30em;
		}

		#map-label,
		#address-examples {
			margin: 1em 0;
		}
	</style>

</head>

<body>

	<?php
if($_POST){

	// get latitude, longitude and formatted address
	$data_arr = geocode($_POST['address']);

	// if able to geocode the address
	if($data_arr){
		
		$latitude = $data_arr[0];
		$longitude = $data_arr[1];
		$formatted_address = $data_arr[2];
					
	?>

	<!-- google map will be shown here -->
	<div id="gmap_canvas">Loading map...</div>


	<!-- JavaScript to show google map -->
	<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyANMpdZNEj4sHbMPdt9KgUSNMFun4yzsB8"></script>
	<script type="text/javascript">
		function init_map() {
			var myOptions = {
				zoom: 14,
				center: new google.maps.LatLng( <?php echo $latitude; ?> , <?php echo $longitude; ?> ),
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);
			marker = new google.maps.Marker({
				map: map,
				position: new google.maps.LatLng( <?php echo $latitude; ?> , <?php echo $longitude; ?> )
			});
			infowindow = new google.maps.InfoWindow({
				content: "<?php echo $formatted_address; ?>"
			});
			google.maps.event.addListener(marker, "click", function() {
				infowindow.open(map, marker);
			});
			infowindow.open(map, marker);
		}
		google.maps.event.addDomListener(window, 'load', init_map);
	</script>

	<?php

	// if unable to geocode the address
	}else{
		echo "No map found.";
	}
}
?>

	<!-- enter any address -->
	<form action="" method="post">

	</form>

	<?php

// function to geocode address, it will return false if unable to geocode address
function geocode($address){

	// url encode the address
	$address = urlencode($address);
	
	// google map geocode api url
	$url = "https://maps.google.com/maps/api/geocode/json?address={$address}&key=AIzaSyANMpdZNEj4sHbMPdt9KgUSNMFun4yzsB8";

	// get the json response
	$resp_json = file_get_contents($url);
	
	// decode the json
	$resp = json_decode($resp_json, true);

	// response status will be 'OK', if able to geocode given address 
	if($resp['status']='OK'){

		// get the important data
		$lati = $resp['results'][0]['geometry']['location']['lat'];
		$longi = $resp['results'][0]['geometry']['location']['lng'];
		$formatted_address = $resp['results'][0]['formatted_address'];
		
		// verify if data is complete
		if($lati && $longi && $formatted_address){
		
			// put the data in the array
			$data_arr = array();			
			
			array_push(
				$data_arr, 
					$lati, 
					$longi, 
					$formatted_address
				);
			
			return $data_arr;
			
		}else{
			return false;
		}
		
	}else{
		return false;
	}
}
?>

</body>

</html>