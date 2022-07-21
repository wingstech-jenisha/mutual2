<?

//Function to crypt using ascii values and adding a key of 12 to it;	
	function Crypt1($string)
	{
		$sLen=strlen($string);
		for ($i=0;$i<$sLen;$i++)
			$RetStr.=ord(substr($string,$i,1))+1;
		return $RetStr;	
	}
	function CryptK($string,$Key)
	{
		$sLen=strlen($string);
		for ($i=0;$i<$sLen;$i++)
			$RetStr.=ord(substr($string,$i,1))+$Key;
		return $RetStr;	
	}
//Function to Reverse the crypt using ascii values and adding a key of 12 to it;
	function DeCrypt1($string)
	{
		$sLen=strlen($string)/2;
		$j=0;
		for ($i=0;$i<$sLen;$i++)
		{
			$RetStr.=chr(substr($string,$j,2)-1);
			$j+=2;
		}
		return $RetStr;	
	}
	function DeCryptK($string,$Key)
	{
		$sLen=strlen($string)/2;
		$j=0;
		for ($i=0;$i<$sLen;$i++)
		{
			$RetStr.=chr(substr($string,$j,2)-$Key);
			$j+=2;
		}
		return $RetStr;	
	}

?>
