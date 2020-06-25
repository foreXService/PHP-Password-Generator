<?php 
declare(strict_types=1);

class RandomPassword
{
    public static function Generate(int $length = 12,bool $useUppercase = true,bool $useLowercase = true,bool $useNumber = false,bool $useSpecial = false):string
    {
		self::Validation($useUppercase,$useLowercase,$useNumber,$useSpecial);
		return self::GenerateCode(
			self::Lenght($length),
			self::Alphabet($useUppercase,$useLowercase,$useNumber,$useSpecial)
		);
	}

	private static function Validation(bool &$useUppercase,bool &$useLowercase,bool &$useNumber,bool &$useSpecial):void
	{
		if (!$useNumber && !$useSpecial && !$useUppercase && !$useLowercase) 
		{
			$useUppercase = true;
			$useLowercase = true;
		}
	}
	
	private static function Lenght(int $length):int
	{
		if ($length <= 0) $length = 1;
		if ($length > 2048) $length = 2048;
		return $length;
	}

	private static function Alphabet(bool $useUppercase,bool $useLowercase,bool $useNumber,bool $useSpecial):string
	{
		$codeAlphabet = '';
		if ($useUppercase) $codeAlphabet .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		if ($useLowercase) $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
		if ($useSpecial) $codeAlphabet.= "!@#$%^&*()-_=+,<.>/?;:'\"[{]}\\|`~";
		if ($useNumber) $codeAlphabet.= "0123456789";
		return $codeAlphabet;
	}

	private static function GenerateCode(int $length, string $codeAlphabet):string
	{
		srand((int)microtime() * 1000000);
		$token = '';
		while(strlen($token) != $length) {
			$token .= $codeAlphabet[rand()%strlen($codeAlphabet) - 1];
		}
		return $token;
	}
}