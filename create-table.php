<?php

require "config.php";

try {
	$sql_users = "
		CREATE TABLE IF NOT EXISTS pets (
			id INT AUTO_INCREMENT PRIMARY KEY,
			pet_name VARCHAR(30) NOT NULL,
			pet_gender CHAR(6) NOT NULL,
			birthdate DATE NOT NULL,
			owner_name VARCHAR(70) NOT NULL,
			email VARCHAR(100) NOT NULL,
			address VARCHAR(255) NOT NULL,
			contact_number VARCHAR(20) NOT NULL,
			created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
		)
	";
	$conn->exec($sql_users);
	echo "<li>Created pets table";

} catch (PDOException $e) {
	error_log($e->getMessage());
	echo "<h1 style='color: red'>" . $e->getMessage() . "</h1>";
}