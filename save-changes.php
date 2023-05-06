<?php

require "config.php";

use App\Pet;

// Save the Pet information, and automatically redirect to index

try {
	$id = $_POST['id'];
	$pet_name = $_POST['pet_name'];
	$pet_gender = $_POST['pet_gender'];
	$birthdate = $_POST['birthdate'];
	$owner_name = $_POST['owner_name'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$contact_number = $_POST['contact_number'];
	
	$result = Pet::update($id, $pet_name, $pet_gender, $birthdate, $owner_name, $email, $address, $contact_number);

	if ($result) {
		header('Location: index.php');
	}

} catch (PDOException $e) {
	error_log($e->getMessage());
	echo "<h1 style='color: red'>" . $e->getMessage() . "</h1>";
}