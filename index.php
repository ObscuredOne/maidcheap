<?php

require_once('zillow_get_xml.php');

if (empty($_POST) === false) {

	$errors = array();

	$address 	= $_POST['address'];
	$zipcode 	= $_POST['zipcode'];

	if (empty($address) === true || empty($zipcode) === true) {
		$errors[] = 'Address and zipcode are required';
			} 
	else {
		if (filter_var($zipcode, FILTER_VALIDATE_INT) === false) {
			$errors[] = 'Please enter valid zipcode';
		}

	}
	/*if(empty($errors) === true) {
			header('Location: index.php?sent');
			exit(); 
	}
	*/
}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Quote</title>
</head>
<body> 
	<?php
	if ((isset($_POST['address']) === true) and (isset($_POST['zipcode']) === true)) {	
			$zillow = zillow_xml();
			
			if ($zillow === 'true'){
			echo 'Bad address';
			}

			else {
			extract($zillow);
			echo $city;	
			}
																									// Run function zillow_info
			/*if ($zillow['blank'] === 'false') {																	// If $zillow is empty run code
				echo 'Address not found';
			}

			else {
				;																		// Extract variables from $zillow array
				echo 'hello';		
																						
				}*/	
	} else {

		if (empty($errors) === false) {
			echo '<ul>';
				foreach ($errors as $errors) {
					echo '<li>', $errors, '</li>';
				}
			echo'<ul>';
		}
	?>
		<form method="post" action=" " name="add_zip">
			<p>
				<label for="address">Address:</label><br>
				<input type="text" name="address" id="address" <?php if (isset($_POST['address']) === true) { echo strip_tags($_POST['address']), '"';} ?>>
			</p>
			<p>
				<label for="zipcode">Zipcode:</label><br>
				<input type="number" name="zipcode" id="zipcode" <?php if (isset($_POST['zipcode']) === true) { echo strip_tags($_POST['zipcode']), '"';} ?>>
			</p>
			<p>
				<input type="submit" value="submit">
			</p>
		</form>
	<?php
			}
	?>
</body>
</html>