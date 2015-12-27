<?php 

namespace App\Http\Utilities;

class Country 
{
	protected static $countries = 
	[
		"Turkey" => "tr",
		"United States" => "us",
	];

	public static function all()
	{
		return static::$countries;
	}
}