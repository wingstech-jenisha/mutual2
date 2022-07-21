<?php
function EnCry_Decry($str)
{
$ky='puresprouts';
$ky=str_replace(chr(32),'',$ky);
$kl=strlen($ky)<32?strlen($ky):32;
$k=array();for($i=0;$i<$kl;$i++){
$k[$i]=ord($ky{$i})&0x1F;}
$j=0;for($i=0;$i<strlen($str);$i++){
$e=ord($str{$i});
$str{$i}=$e&0xE0?chr($e^$k[$j]):chr($e);
$j++;$j=$j==$kl?0:$j;}
return $str;
}
// Get Name from Any Table GetName(tablename,return field name,where clause, id);
function make_seed() 
{
	list($usec, $sec) = explode(' ', microtime());
	return (float) $sec + ((float) $usec * 100000);
}

function GetName1($tablename,$field,$where,$id)
{
	$uquery="SELECT `$field` FROM `$tablename` WHERE `$where`='$id'";
	$uresult=mysql_query($uquery);
	$urow=mysql_fetch_array($uresult);
	$newval=stripslashes($urow[$field]);
	return $newval;
}
function GetCombo1($display,$tablename,$fieldname,$disfieldname,$where,$orderby,$selected)
{	
	$hrquery="SELECT * FROM $tablename";
	
	if($where)
	{
		$hrquery.=" WHERE $where";
	}
	$hrquery.=" ORDER BY $orderby";
	
	$hrresult=mysql_query($hrquery);
	$hrtotalrow=mysql_affected_rows();
	
	if($display)
		$Getval="<option value=''>Select $display</option>";
	
	
	for($hr=0;$hr<$hrtotalrow;$hr++)
	{
		$hrrow=mysql_fetch_object($hrresult);
		$newval=stripslashes(ucfirst($hrrow->$disfieldname));
		$val=$hrrow->$fieldname;

		if($val==$selected)
			$sel="selected";
		else
			$sel="";
		
		$Getval.="<option value='$val' $sel>$newval</option>";
	}
	return $Getval;
}
function getname($table,$id,$name,$compvar="id")
{
	$getsql = "select $name from $table where $compvar='$id'";
	$getres = mysql_query($getsql);
	if($getres)
	{
		$getobj = mysql_fetch_array($getres);
		return stripslashes($getobj[0]);
	}
	else
	{
		return "";
	}
}
function getcombo($table,$value,$name,$args="",$sel="")
{
	$comboqry = "select $value,$name from $table ".$args ;
	$combosres = mysql_query($comboqry);
	while($comboobj = mysql_fetch_array($combosres))
	{
		$comboobj[0]  = stripslashes($comboobj[0]);
		$comboobj[1]  = stripslashes($comboobj[1]);	
		if($comboobj[0] == $sel)
		{
			$selected ="selected";
		}
		else
		{
			$selected = "";
		}
		echo "<option $selected value='$comboobj[0]'>".ucfirst(strtolower($comboobj[1]))."</option>" ;
	}
}

function getcombonew($table,$value,$name,$args="",$sel="",$seprator="-")
{
	$comboqry = "select $value,$name from $table ".$args ;
	$combosres = mysql_query($comboqry);
	while($comboobj = mysql_fetch_array($combosres))
	{
		$comboobj[0]  = stripslashes($comboobj[0]);
		$DisplayText = "";
		for($discnt=1;$discnt<count($comboobj);$discnt++)
		{
			$DisplayText .= stripslashes($comboobj[$discnt])."-";
		}
		$DisplayText = rtrim($DisplayText,"-");
		if($comboobj[0] == $sel)
		{
			$selected ="selected";
		}
		else
		{
			$selected = "";
		}
		echo "<option $selected value='$comboobj[0]'>$DisplayText</option>" ;
	}
}
function dcd($str)
{
	return stripslashes($str); 
}
function getDayValue($id="")
{
	for($d=1; $d < 32; $d++)
	{
		if($d == $id)
			$dayOption .="<option value='$d' selected>$d</option>";
		else
			$dayOption .="<option value='$d'>$d</option>";
	}
	return $dayOption;
}

function getYear($id="",$val1="5",$type="styear")
{
	$date = getdate();

	$cur_yr = $date[year];

	if($type == "styear")
		$val1 = $cur_yr - $val1 + 1;
	
	for($c=1970; $c<=$val1; $c++,$cur_yr--)
	{
		if($c==$id)
			$motyOption.="<option value='$c' selected>$c</option>";
		else
			$motyOption.="<option value='$c'>$c</option>";
	}
	return $motyOption;
}
function getMonth($id="")
{	
		
	$mon=array("","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
	
	$tMonth=$mon;
	$actMonth=$tMonth;
	
	for($m=1; $m < count($actMonth); $m++)
	{
		if($m == $id)
			$motmOption .="<option value='$m' selected>$actMonth[$m]</option>";
		else
			$motmOption .="<option value='$m'>$actMonth[$m]</option>";					
	}
	
	return $motmOption;
}

function my_array_unique($somearray)
{
	$tmparr = array_unique($somearray);
	$i=0;
	$newarr=array();
	foreach ($tmparr as $v)
	{ 
		if(!in_array(trim($v),$newarr))
		{
			$newarr[$i] = trim($v);
			$i++;
		}	
	}
	return $newarr;
}
function fetchvalue($table,$where,$id,$name)
{
	$getsql = "select $name from $table where $where='$id'";
	$getres = mysql_query($getsql);
	if($getres)
	{
		$getobj = mysql_fetch_array($getres);
		return stripslashes($getobj[0]);
	}
	else
	{
		return "";
	}
}
function GTG_get_cat_name($id)
{
	$q = "select catname from mutual_category where id=".$id;
	$r = mysql_query($q);
	if(mysql_num_rows($r) > 0)
	{
		while($r1 = mysql_fetch_array($r))
		{
			return trim(stripslashes($r1['catname']));
		}
	}
	else
	{
		return "N/A";
	}
}

function GTG_get_main_cat_name($id)
{
	$q = "select * from mutual_category where id=".$id;
	$r = mysql_query($q);
	if(mysql_num_rows($r) > 0)
	{
		while($r1 = mysql_fetch_array($r))
		{
			$qq = "select catname from mutual_category where id=".$r1['parent'];
			$rr = mysql_query($qq);
			if(mysql_num_rows($rr) > 0)
			{
				while($rr1 = mysql_fetch_array($rr))
				{
					return trim(stripslashes($rr1['catname']));
				}
			}
		}
	}
	else
	{
		return "N/A";
	}
}

function GTG_get_image($pid)
{
	$q = "select * from prodimages where pid=".$pid." order by pimage asc limit 1";
	$r = mysql_query($q);
	if(mysql_num_rows($r) > 0)
	{
		while($r1 = mysql_fetch_array($r))
		{
			return trim($r1['pimage']);
		}
	}
	else
	{
		return "";
	}
}

function GTG_get_pagename($pid)
{
	$q = "select name from `staticpage` where `id`=".$pid;
	$r = mysql_query($q);
	if(mysql_num_rows($r) > 0)
	{
		while($r1 = mysql_fetch_array($r))
		{
			return trim($r1['name']);
		}
	}
}

function GTG_get_pagecontent($pid)
{
	$q = "select content from staticpage where id=".$pid;
	$r = mysql_query($q);
	if(mysql_num_rows($r) > 0)
	{
		while($r1 = mysql_fetch_array($r))
		{
			return trim(stripslashes($r1['content']));
		}
	}
}

function GTG_gtg_password($email)
{
	$q = "select password from users where email='".$email."'";
	$r = mysql_query($q);
	if(mysql_num_rows($r) > 0)
	{
		while($r1 = mysql_fetch_array($r))
		{
			return trim(stripslashes($r1['password']));
		}
	}
	else
	{
		return "NO_PASSWORD_FOUND";
	}
}

function GTG_tocap($str)
{
	echo ucfirst(strtolower($str));
}

## 31 ##
	function getcountry($id)
	{
		if($id != "" && $id > 0)
		{
			$q = "select * from country where id=".$id;
			$r = mysql_query($q);
			while($r1 = mysql_fetch_array($r))
			{
				return $r1['name'];
			}
		}
		else
		{
			return "N/A";
		}
	}
function getMonthpraful($id="")
{	
		
	$mon=array("","January","February","March","April","May","June","July","August","September","October","November","December");
	
	$tMonth=$mon;
	$actMonth=$tMonth;
	return $actMonth[$id];
}
function replace_praful($str) 
{
	$str=ereg_replace("�","e",$str);
	$str=ereg_replace("�","n",$str);
	$str=ereg_replace("&","and",$str);
	$str=ereg_replace("&amp;","and",$str);
	
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","c",$str);
	$str=ereg_replace("�","e",$str);
	$str=ereg_replace("�","e",$str);
	$str=ereg_replace("�","e",$str);
	$str=ereg_replace("�","e",$str);
	$str=ereg_replace("�","i",$str);
	$str=ereg_replace("�","i",$str);
	$str=ereg_replace("�","i",$str);
	$str=ereg_replace("�","i",$str);
	$str=ereg_replace("�","n",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","u",$str);	
	$str=ereg_replace("�","u",$str);
	$str=ereg_replace("�","u",$str);
	$str=ereg_replace("�","u",$str);
	$str=ereg_replace("�","y",$str);
	$str=ereg_replace("�","y",$str);
	
	$str=ereg_replace("�","A",$str);
	$str=ereg_replace("�","A",$str);
	$str=ereg_replace("�","A",$str);
	$str=ereg_replace("�","A",$str);
	$str=ereg_replace("�","A",$str);
	$str=ereg_replace("�","A",$str);	
	$str=ereg_replace("�","C",$str);
	$str=ereg_replace("�","E",$str);
	$str=ereg_replace("�","E",$str);
	$str=ereg_replace("�","E",$str);
	$str=ereg_replace("�","E",$str);
	$str=ereg_replace("�","I",$str);	
	$str=ereg_replace("�","I",$str);
	$str=ereg_replace("�","I",$str);
	$str=ereg_replace("�","I",$str);
	$str=ereg_replace("�","N",$str);
	$str=ereg_replace("�","O",$str);
	$str=ereg_replace("�","O",$str);	
	$str=ereg_replace("�","O",$str);
	$str=ereg_replace("�","O",$str);
	$str=ereg_replace("�","O",$str);
	$str=ereg_replace("�","O",$str);
	$str=ereg_replace("�","U",$str);
	$str=ereg_replace("�","U",$str);	
	$str=ereg_replace("�","U",$str);
	$str=ereg_replace("�","U",$str);
	$str=ereg_replace("�","Y",$str);	
	//$str=ereg_replace("'","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	
	
	return $str;
}
//
function replace_praful_1($str) 
{
	$str=ereg_replace("�","e",$str);
	$str=ereg_replace("�","n",$str);
	//$str=ereg_replace("&","and",$str);
	$str=ereg_replace("&amp;","and",$str);
	
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","c",$str);
	$str=ereg_replace("�","e",$str);
	$str=ereg_replace("�","e",$str);
	$str=ereg_replace("�","e",$str);
	$str=ereg_replace("�","e",$str);
	$str=ereg_replace("�","i",$str);
	$str=ereg_replace("�","i",$str);
	$str=ereg_replace("�","i",$str);
	$str=ereg_replace("�","i",$str);
	$str=ereg_replace("�","n",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","u",$str);	
	$str=ereg_replace("�","u",$str);
	$str=ereg_replace("�","u",$str);
	$str=ereg_replace("�","u",$str);
	$str=ereg_replace("�","y",$str);
	$str=ereg_replace("�","y",$str);
	
	$str=ereg_replace("�","A",$str);
	$str=ereg_replace("�","A",$str);
	$str=ereg_replace("�","A",$str);
	$str=ereg_replace("�","A",$str);
	$str=ereg_replace("�","A",$str);
	$str=ereg_replace("�","A",$str);	
	$str=ereg_replace("�","C",$str);
	$str=ereg_replace("�","E",$str);
	$str=ereg_replace("�","E",$str);
	$str=ereg_replace("�","E",$str);
	$str=ereg_replace("�","E",$str);
	$str=ereg_replace("�","I",$str);	
	$str=ereg_replace("�","I",$str);
	$str=ereg_replace("�","I",$str);
	$str=ereg_replace("�","I",$str);
	$str=ereg_replace("�","N",$str);
	$str=ereg_replace("�","O",$str);
	$str=ereg_replace("�","O",$str);	
	$str=ereg_replace("�","O",$str);
	$str=ereg_replace("�","O",$str);
	$str=ereg_replace("�","O",$str);
	$str=ereg_replace("�","O",$str);
	$str=ereg_replace("�","U",$str);
	$str=ereg_replace("�","U",$str);	
	$str=ereg_replace("�","U",$str);
	$str=ereg_replace("�","U",$str);
	$str=ereg_replace("�","Y",$str);	
	//$str=ereg_replace("'","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	return $str;
}

function replace_praful_runner($str) 
{
	$str=ereg_replace("�","e",$str);
	$str=ereg_replace("�","n",$str);
	
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","c",$str);
	$str=ereg_replace("�","e",$str);
	$str=ereg_replace("�","e",$str);
	$str=ereg_replace("�","e",$str);
	$str=ereg_replace("�","e",$str);
	$str=ereg_replace("�","i",$str);
	$str=ereg_replace("�","i",$str);
	$str=ereg_replace("�","i",$str);
	$str=ereg_replace("�","i",$str);
	$str=ereg_replace("�","n",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","u",$str);	
	$str=ereg_replace("�","u",$str);
	$str=ereg_replace("�","u",$str);
	$str=ereg_replace("�","u",$str);
	$str=ereg_replace("�","y",$str);
	$str=ereg_replace("�","y",$str);
	
	$str=ereg_replace("�","A",$str);
	$str=ereg_replace("�","A",$str);
	$str=ereg_replace("�","A",$str);
	$str=ereg_replace("�","A",$str);
	$str=ereg_replace("�","A",$str);
	$str=ereg_replace("�","A",$str);	
	$str=ereg_replace("�","C",$str);
	$str=ereg_replace("�","E",$str);
	$str=ereg_replace("�","E",$str);
	$str=ereg_replace("�","E",$str);
	$str=ereg_replace("�","E",$str);
	$str=ereg_replace("�","I",$str);	
	$str=ereg_replace("�","I",$str);
	$str=ereg_replace("�","I",$str);
	$str=ereg_replace("�","I",$str);
	$str=ereg_replace("�","N",$str);
	$str=ereg_replace("�","O",$str);
	$str=ereg_replace("�","O",$str);	
	$str=ereg_replace("�","O",$str);
	$str=ereg_replace("�","O",$str);
	$str=ereg_replace("�","O",$str);
	$str=ereg_replace("�","O",$str);
	$str=ereg_replace("�","U",$str);
	$str=ereg_replace("�","U",$str);	
	$str=ereg_replace("�","U",$str);
	$str=ereg_replace("�","U",$str);
	$str=ereg_replace("�","Y",$str);	
	//$str=ereg_replace("'","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	//$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	//$str=ereg_replace("�","",$str);	
	//$str=ereg_replace("�","",$str);	
	//$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	//$str=ereg_replace("�","",$str);	
	//$str=ereg_replace("�","",$str);	
	
	
	return $str;
}
//SQL injection functoin 
function pyp_add($str) 
{
	$str=ereg_replace("script=","",$str);
	$str=ereg_replace("script","",$str);
	$str=ereg_replace("select","",$str);
	$str=ereg_replace("union","",$str);
	$str=ereg_replace("drop","",$str);
	$str=ereg_replace("<","&lt;",$str);
	$str=ereg_replace("%3C","",$str);
	$str=ereg_replace(">","&gt;",$str);
	$str=ereg_replace("%3E","",$str);
	//$str=ereg_replace("&lt;","",$str);
	//$str=ereg_replace("&gt;","",$str);
	$str=ereg_replace(";","",$str);
	$str=ereg_replace("%3B","",$str);
	$str=ereg_replace("--","",$str);
	$str=ereg_replace("insert","",$str);
	$str=ereg_replace("delete","",$str);
	$str=ereg_replace("xp_","",$str);
	$str=ereg_replace("\*","",$str);
	$str=ereg_replace("sysobjects","",$str);
	$str=ereg_replace(".exe","",$str);
	$str=ereg_replace("exec","",$str);
	$str=ereg_replace("^","",$str);
	$str=ereg_replace("%5E","",$str);
	
	$str=addslashes(htmlentities($str, ENT_QUOTES)); 
	
	return $str;
}
function pyp_strip($str) 
{
	$str=ereg_replace("script=","",$str);
	$str=ereg_replace("script","",$str);
	$str=ereg_replace("select","",$str);
	$str=ereg_replace("union","",$str);
	$str=ereg_replace("drop","",$str);
	$str=ereg_replace("<","&lt;",$str);
	$str=ereg_replace("%3C","",$str);
	$str=ereg_replace(">","&gt;",$str);
	$str=ereg_replace("%3E","",$str);
	//$str=ereg_replace("&lt;","",$str);
	//$str=ereg_replace("&gt;","",$str);
	$str=ereg_replace(";","",$str);
	$str=ereg_replace("%3B","",$str);
	$str=ereg_replace("--","",$str);
	$str=ereg_replace("insert","",$str);
	$str=ereg_replace("delete","",$str);
	$str=ereg_replace("xp_","",$str);
	$str=ereg_replace("\*","",$str);
	$str=ereg_replace("sysobjects","",$str);
	$str=ereg_replace(".exe","",$str);
	$str=ereg_replace("exec","",$str);
	$str=ereg_replace("^","",$str);
	$str=ereg_replace("%5E","",$str);
	
	//Special Characters//
	$str=ereg_replace("�","e",$str);
	$str=ereg_replace("�","n",$str);
	//$str=ereg_replace("&","and",$str);
	$str=ereg_replace("&amp;","and",$str);	
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","a",$str);
	$str=ereg_replace("�","c",$str);
	$str=ereg_replace("�","e",$str);
	$str=ereg_replace("�","e",$str);
	$str=ereg_replace("�","e",$str);
	$str=ereg_replace("�","e",$str);
	$str=ereg_replace("�","i",$str);
	$str=ereg_replace("�","i",$str);
	$str=ereg_replace("�","i",$str);
	$str=ereg_replace("�","i",$str);
	$str=ereg_replace("�","n",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","o",$str);
	$str=ereg_replace("�","u",$str);	
	$str=ereg_replace("�","u",$str);
	$str=ereg_replace("�","u",$str);
	$str=ereg_replace("�","u",$str);
	$str=ereg_replace("�","y",$str);
	$str=ereg_replace("�","y",$str);	
	$str=ereg_replace("�","A",$str);
	$str=ereg_replace("�","A",$str);
	$str=ereg_replace("�","A",$str);
	$str=ereg_replace("�","A",$str);
	$str=ereg_replace("�","A",$str);
	$str=ereg_replace("�","A",$str);	
	$str=ereg_replace("�","C",$str);
	$str=ereg_replace("�","E",$str);
	$str=ereg_replace("�","E",$str);
	$str=ereg_replace("�","E",$str);
	$str=ereg_replace("�","E",$str);
	$str=ereg_replace("�","I",$str);	
	$str=ereg_replace("�","I",$str);
	$str=ereg_replace("�","I",$str);
	$str=ereg_replace("�","I",$str);
	$str=ereg_replace("�","N",$str);
	$str=ereg_replace("�","O",$str);
	$str=ereg_replace("�","O",$str);	
	$str=ereg_replace("�","O",$str);
	$str=ereg_replace("�","O",$str);
	$str=ereg_replace("�","O",$str);
	$str=ereg_replace("�","O",$str);
	$str=ereg_replace("�","U",$str);
	$str=ereg_replace("�","U",$str);	
	$str=ereg_replace("�","U",$str);
	$str=ereg_replace("�","U",$str);
	$str=ereg_replace("�","Y",$str);	
	//$str=ereg_replace("'","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	$str=ereg_replace("�","",$str);	
	
	$str=stripslashes($str);
}
function GetDropdown($value,$name,$table,$args="",$sel="")
{
	$comboqry = "select $value,$name from $table ".$args ;
	$combosres = mysql_query($comboqry);
	while($comboobj = mysql_fetch_array($combosres))
	{
		$comboobj[0]  = stripslashes($comboobj[0]);
		$comboobj[1]  = stripslashes($comboobj[1]);	
		if($comboobj[0] == $sel)
		{
			$selected ="selected";
		}
		else
		{
			$selected = "";
		}
		echo "<option $selected value='$comboobj[0]'>".trim($comboobj[1])."</option>" ;
	}
}

//expire hour
function expHour($id="")
{

	for($c=1; $c<=12; $c++)
	{
		$selected = ($c == $id)?"SELECTED":"";
		$motyOption .="<option value='".str_pad($c,2,"0",STR_PAD_LEFT)."' $selected>".str_pad($c,2,"0",STR_PAD_LEFT)."</option>";
	}
	return $motyOption;
}

//expire minute
function expMin($id="")
{

	for($c=1; $c<=59; $c++)
	{
		$selected = ($c == $id)?"SELECTED":"";
		$motyOption .="<option value='".str_pad($c,2,"0",STR_PAD_LEFT)."' $selected>".str_pad($c,2,"0",STR_PAD_LEFT)."</option>";
	}
	return $motyOption;
}
