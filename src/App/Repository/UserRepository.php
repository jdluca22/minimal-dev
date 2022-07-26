<?php

namespace Repository;

use Service\DatabaseService;
use Enum\User;

class UserRepository
{
	/*
	SELECT * FROM user
	SELECT * FROM user WHERE id = :id"
	INSERT INTO user (username, password) VALUES (:username, :password)
	UPDATE user SET username = :username, password = :password WHERE id = :id
	DELETE FROM user WHERE id = :id
	SELECT * FROM user WHERE username LIKE :search

	*/

	public function findAllUsers(): array
	{
		return DatabaseService::getInstance()->execute("SELECT * FROM user", []);
	}

	public function findUserWithID(int $id): array
	{
		return DatabaseService::getInstance()->execute("SELECT * FROM user WHERE id = :id", ["id" => $id]);
	}

	public function createUser(string $username, string $password, int $age, string $street, string $number, string $zip, string $city): void
	{
		DatabaseService::getInstance()->execute("INSERT INTO user (username, password, age, street, house_number, zip_code, city, deleted) 
			VALUES (:username, :password, :age, :street, :house_number, :zip_code, :city, false)",
			[
				"username" 		=> $username,
				"password" 		=> $password,
				"age" 			=> $age,
				"street" 		=> $street,
				"house_number" 	=> $number,
				"zip_code" 		=> $zip,
				"city" 			=> $city
			]);
	}

	public function updateUser(int $id, string $username, string $password): void
	{
		DatabaseService::getInstance()->execute("UPDATE user SET username = :username, password = :password WHERE id = :id",
			["id" => $id, "username" => $username, "password" => $password]);
	}

    public function updateAttributeById(int $id, User $attribute, string $value):void
    {
        DatabaseService::getInstance()->execute("UPDATE user SET $attribute->value = :value WHERE id = :id",
            ["id" => $id, "value" => $value]);
    }

	public function deleteUser(int $id): void
	{
		DatabaseService::getInstance()->execute("UPDATE user SET deleted = 1 WHERE id = :id", ["id" => $id]);

	}

	public function findUserWhereUsernameLike(string $search): array
	{
		return DatabaseService::getInstance()->execute("SELECT * FROM user WHERE username LIKE :search", ["search" => '%' . $search . '%']);
	}
}