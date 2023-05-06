<?php

namespace App;

use PDO;

class Pet
{
	protected $id;
	protected $name;
	protected $gender;
	protected $birthdate;
	protected $owner;
	protected $email;
	protected $address;
	protected $contact_number;
	protected $created_at;

	public function getId()
	{
		return $this->id;
	}

	public function getPetName()
	{
		return $this->name;
	}

	public function getPetGender()
	{
		return $this->gender;
	}

	public function getBirthdate()
	{
		return $this->birthdate;
	}

	public function getOwnerName()
	{
		return $this->owner;
	}
	public function getEmail()
	{
		return $this->email;
	}
	public function getAddress()
	{
		return $this->address;
	}
	public function getContactNumber()
	{
		return $this->contact_number;
	}
	public static function list()
	{
		global $conn;

		try {
			$sql = "SELECT * FROM pets";
			$statement = $conn->query($sql);
			
			$pets = [];
			while ($row = $statement->fetchObject('App\Pet')) {
				array_push($pets, $row);
			}

			return $pets;
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return null;
	}

	public static function getById($id)
	{
		global $conn;

		try {
			$sql = "
				SELECT * FROM pets
				WHERE id=:id
				LIMIT 1
			";
			$statement = $conn->prepare($sql);
			$statement->execute([
				'id' => $id
			]);
			$result = $statement->fetchObject('App\Pet');
			return $result;
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return null;
	}

	public static function register($name, $gender, $birthdate, $owner, $email, $address, $contact_number)
	{
		global $conn;

		try {
			$sql = "
				INSERT INTO pets (name, gender, birthdate, owner, email, address, contact_number)
				VALUES ('$name', '$gender', '$birthdate', '$owner', '$email', '$address', '$contact_number')
			";
			$conn->exec($sql);

			return $conn->lastInsertId();
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return false;
	}

	public static function registerMany($users)
	{
		global $conn;

		try {
			foreach ($users as $user) {
				$sql = "
					INSERT INTO pets
					SET
						name=\"{$user['name']}\",
						gender=\"{$user['gender']}\",
						birthdate=\"{$user['birthdate']}\",
						owner=\"{$user['owner']}\",
						email=\"{$user['email']}\",
						address=\"{$user['address']}\",
						contact_number=\"{$user['contact_number']}\"

				";
				$conn->exec($sql);
			}
			return true;
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return false;
	}

	public static function update($id, $name, $gender, $birthdate, $owner, $email, $address, $contact_number)
	{
		global $conn;

		try {
			$sql = "
				UPDATE pets
				SET
					name=?,
					gender=?,
					birthdate=?,
					owner=?,
					email=?,
					address=?,
					contact_number=?
				WHERE id=?
			";
			$statement = $conn->prepare($sql);
			return $statement->execute([
				$name,
				$gender,
				$birthdate,
				$owner,
				$email,
				$address,
				$contact_number,
				$id
			]);
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return false;
	}

	public static function updateUsingPlaceholder($id, $name, $gender, $birthdate, $owner, $email, $address, $contact_number)
	{
		global $conn;

		try {
			$sql = "
				UPDATE pets
				SET
					name=:name,
					gender=:gender,
					birthdate=:birthdate
					owner=:owner,
					email=:email,
					address=:address
					contact_number=:contact_number,
				WHERE id=:id
			";
			$statement = $conn->prepare($sql);
			return $statement->execute([
				'name' => $name,
				'gender' => $gender,
				'birthdate' => $birthdate,
				'owner' => $owner,
				'email' => $email,
				'address' => $address,
				'contact_number' => $contact_number,
				'id' => $id
			]);
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return false;
	}

	public static function deleteById($id)
	{
		global $conn;

		try {
			$sql = "
				DELETE FROM pets
				WHERE id=:id
			";
			$statement = $conn->prepare($sql);
			return $statement->execute([
				'id' => $id
			]);
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return false;
	}

	public static function clearTable()
	{
		global $conn;

		try {
			$sql = "TRUNCATE TABLE pets";
			$statement = $conn->prepare($sql);
			return $statement->execute();
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return false;
	}
}