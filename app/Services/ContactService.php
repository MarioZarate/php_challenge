<?php

namespace App\Services;

use App\Contact;


class ContactService
{
	
	public static function findByName(string $name): Contact
	{
		// queries to the db
	}

	public static function validateNumber(string $number): bool
	{
		if (!preg_match('/^[0-9]{3}-[0-9]{3}-[0-9]{3}$/', $number)) {
            return false;
        }
        return true;
	}
}