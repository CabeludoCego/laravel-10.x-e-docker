<?php

namespace App\Enums;

enum SupportStatus : string 
{
	case A = "Open";
	case P = "Pending";
	case C = "Closed";

	public static function fromValue(string $status): string 
	{
		foreach (self::cases() as $status) {
			if($status === $status->name) 
			{
				return $status->value;
			}
		}
		throw new \ValueError("$status is not a valid option.");

	}
}