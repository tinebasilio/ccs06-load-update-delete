<?php

require "config.php";

use App\Pet;

try {
	Pet::register('Pao', 'Male', '2022-05-02', 'Pee', 'ilypao@gmail.com', 'My Address 1043', '090123455');
	echo "<li>Added 1 pet";

	$pets = [
		[
			'pet_name' => 'Chow',
			'pet_gender' => 'Male',
			'birthdate' => '2022-05-02',
			'owner_name' => 'King',
			'email' => 'ilychow@gmail.com',
			'address' => 'My Address 1043',
			'contact_number' => '090123455'
		],
		[
			'pet_name' => 'Jolly',
			'pet_gender' => 'Male',
			'birthdate' => '2022-05-02',
			'owner_name' => 'Bee',
			'email' => 'ilyjolly@gmail.com',
			'address' => 'My Address 1043',
			'contact_number' => '090123455'
		]
	];
	Pet::registerMany($pets);
	echo "<li>Added " . count($pets) . " more pets";
	echo "<br /><a href='index.php'>Proceed to Index Page</a>";

} catch (PDOException $e) {
	error_log($e->getMessage());
	echo "<h1 style='color: red'>" . $e->getMessage() . "</h1>";
}