<?php
	## 1 ##
	function GTG_is_dup_add($table,$field,$value)
	{
		$q = "select ".$field." from ".$table." where ".$field." = '".$value."'";
		$r = mysql_query($q);
		if(mysql_num_rows($r) > 0)
			return true;
		else
			return false;
	}
	
	## 2 ##
	function GTG_is_dup_add_id($table,$field,$value)
	{
		$q = "select ".$field." from ".$table." where ".$field." = ".$value.""; 
		$r = mysql_query($q);
		if(mysql_num_rows($r) > 0)
			return true;
		else
			return false;
	}
	
	## 3 ##
	function GTG_is_dup_edit($table,$field,$value,$id)
	{
		$q = "select ".$field." from ".$table." where ".$field." = '".$value."' and id != ".$id; 
		$r = mysql_query($q);
		if(mysql_num_rows($r) > 0)
			return true;
		else
			return false;
	}
	
	## 4 ##
	function GTG_is_dup_edit_id($table,$field,$value,$id)
	{
		$q = "select ".$field." from ".$table." where ".$field." = ".$value." and id != ".$id; 
		$r = mysql_query($q);
		if(mysql_num_rows($r) > 0)
			return true;
		else
			return false;
	}
	
	## 5 ##
	function GTG_maxid($table)
	{
		$q = "select max(id) as mid from ".$table; 
		$r = mysql_query($q);
		if(mysql_num_rows($r) > 0)
		{
			while($r1 = mysql_num_rows($r))
			{
				print $r1['mid']; exit;
				return $r1['mid'];
			}
		}
		else
		{
			return 0;
		}
	}
	
	## 6 ##
	function GTG_checkfordelete($targettable,$targetfield,$searchvalue)
	{
		$q = "select ".$targetfield." from ".$targettable." where ".$targetfield." = ".$searchvalue; 
		$r = mysql_query($q);
		if(mysql_num_rows($r) > 0)
			return true;
		else
			return false;
	}
	
	## 7 ##
	function GTG_check_category_for_delete($searchvalue)
	{
		$q = "SELECT categoryid FROM product WHERE categoryid LIKE '%".$searchvalue."%'";
		$r = mysql_query($q);
		if(mysql_num_rows($r) > 0)
			return true;
		else
			return false;
	}
	
	## 8 ##
	function GTG_arraytostr($array)
	{
		for($i=0;$i<count($array);$i++)
		{
			if($i == count($array)-1)
			{
				$str = $str.$array[$i];
			}
			else
			{
				$str = $str.$array[$i].",";
			}
		}
		return $str;
	}
	
	## 9 ##
	function GTG_strtoarray($str)
	{
		return explode(",",$str);
	}
	
	## 10 ##
	function GTG_valueinarray($array,$value)
	{
		for($i=0;$i<count($array);$i++)
		{
			if($array[$i]==$value)
			{
				return true;
			}
		}
		return false;
	}
	
	## 11 ##
	function GTG_addzero($n)
	{
		if($n < 10)
			return "0".$n;
		else
			return $n;
	}
	
	## 12 ##
	function GTG_addzero1($n)
	{
		if(strlen($n) == 1)
			return "0".$n;
		else
			return $n;
	}
	
	## 13 ##
	function GTG_is_dup_special_add($id)
	{
		$q = "select isspecial from product where isspecial=1 and id=".$id; 
		$r = mysql_query($q);
		if(mysql_num_rows($r) > 0)
			return true;
		else
			return false;	
	}
	
	
	## 20 ##
	function GTG_add_to_cart($id,$q,$c,$s,$cflag,$wprice,$Mode,$lll,$aaa)
	{
		
		if(isset($_SESSION['P']))
		{
			$P = $_SESSION['P'];
			$Q = $_SESSION['Q'];
			$COLOR = $_SESSION['COLOR'];
			$SIZE = $_SESSION['SIZE'];
			$CFLAG = $_SESSION['CFLAG'];
			$PRICE = $_SESSION['PRICE'];
			$LETER = $_SESSION['LETER'];
			$ASIGN = $_SESSION['ASIGNN'];
			$flag = 0;
			
			for($i=0;$i<count($P);$i++)
			{
				if($P[$i] == $id && $COLOR[$i] == $c && $PRICE[$i] == $wprice && $SIZE[$i] == $s && $LETER[$i] == $lll && $ASIGN[$i] == $aaa)
				{
					$Q[$i] = $Q[$i] + $q;
					$flag = 1;
				}
			}
			if($flag == 0)
			{
				$P[count($_SESSION['P'])]	= $id;
				$COLOR[count($_SESSION['COLOR'])]	= $c;
				$SIZE[count($_SESSION['SIZE'])]	= $s;
				$Q[count($_SESSION['Q'])] = $q;
				$CFLAG[count($_SESSION['CFLAG'])] = $cflag;
				$PRICE[count($_SESSION['PRICE'])] = $wprice;
				$LETER[count($_SESSION['LETER'])]	= $lll;
				$ASIGN[count($_SESSION['ASIGNN'])]	= $aaa;
			}
			$_SESSION['P'] = $P;
			$_SESSION['Q'] = $Q;
			$_SESSION['COLOR'] = $COLOR;
			$_SESSION['SIZE'] = $SIZE;
			$_SESSION['CFLAG'] = $CFLAG;
			$_SESSION['PRICE'] = $PRICE;
			$_SESSION['LETER'] = $LETER;
			$_SESSION['ASIGNN'] = $ASIGN;
		}
		else
		{
			$P[0] = $id;
			$Q[0] = $q;
			$COLOR[0] = $c;
			$SIZE[0] = $s;
			$CFLAG[0] = $cflag;
			$PRICE[0] = $wprice;
			$LETER[0] = $lll;
			$ASIGN[0] = $aaa;
			$_SESSION['P'] = $P;
			$_SESSION['Q'] = $Q;
			$_SESSION['COLOR'] = $COLOR;
			$_SESSION['SIZE'] = $SIZE;
			$_SESSION['CFLAG'] = $CFLAG;
			$_SESSION['PRICE'] = $PRICE;
			$_SESSION['LETER'] = $LETER;
			$_SESSION['ASIGNN'] = $ASIGN;
		}
	}
	
	## 21 ##
	function GTG_remove_from_cart($id,$rem_color,$price,$rem_size,$flag,$rem_LETER,$rem_ASIGN)
	{
		if(isset($_SESSION['P']))
		{
			$P = $_SESSION['P'];
			$Q = $_SESSION['Q'];
			$COLOR = $_SESSION['COLOR'];
			$SIZE = $_SESSION['SIZE'];
			$CFLAG = $_SESSION['CFLAG'];
			$PRICE = $_SESSION['PRICE'];
			$LETER = $_SESSION['LETER'];
			$ASIGN = $_SESSION['ASIGNN'];
			
			$P_temp;
			$Q_temp;
			$COLOR_temp;
			$SIZE_temp;
			$CFLAG_temp;
			$PRICE_temp;
			$LETER_temp;
			$ASIGN_temp;
			
			$count = 0;
			
			if(1==2)
			{
				session_unregister('P');
				session_unregister('Q');
				session_unregister('COLOR');
				session_unregister('SIZE');
				session_unregister('CFLAG');
				session_unregister('PRICE');
				session_unregister('LETER');
				session_unregister('ASIGN');
			}
			else
			{
				for($i=0;$i<count($P);$i++)
				{
					if((trim($P[$i]) != trim($id)) || (trim($COLOR[$i])!=trim($rem_color)) || (trim($PRICE[$i])!=trim($price)) || (trim($SIZE[$i])!=trim($rem_size)) || (trim($CFLAG[$i])!=trim($flag)) || (trim($LETER[$i])!=trim($rem_LETER)) || (trim($ASIGN[$i])!=trim($rem_ASIGN)) )
					{
						$P_temp[$count] = $P[$i];
						$Q_temp[$count] = $Q[$i];
						$COLOR_temp[$count] = $COLOR[$i];
						$SIZE_temp[$count] = $SIZE[$i];
						$CFLAG_temp[$count] = $CFLAG[$i];
						$PRICE_temp[$count] = $PRICE[$i];
						$LETER_temp[$count] = $LETER[$i];
						$ASIGN_temp[$count] = $ASIGN[$i];
						$count++;
					}
				}
				$_SESSION['P'] = $P_temp;
				$_SESSION['Q'] = $Q_temp;
				$_SESSION['COLOR'] = $COLOR_temp;
				$_SESSION['SIZE'] = $SIZE_temp;
				$_SESSION['CFLAG'] = $CFLAG_temp;
				$_SESSION['PRICE'] = $PRICE_temp;
				$_SESSION['LETER'] = $LETER_temp;
				$_SESSION['ASIGNN'] = $ASIGN_temp;
			}
			
		}
	}
	
	## 22 ##
	function GTG_add_to_cart_individual($id,$q,$c,$s,$lll,$aaa)
	{
		//echo "Q=>".$q;
		if(isset($_SESSION['P']))
		{
			$P = $_SESSION['P'];
			$Q = $_SESSION['Q'];
			$COLOR = $_SESSION['COLOR'];
			$ASIGN = $_SESSION['ASIGNN'];
			$LETER = $_SESSION['LETER'];
			$SIZE = $_SESSION['SIZE'];
			$flag = 0;
			for($i=0;$i<count($P);$i++)
			{
				if($P[$i] == $id && $COLOR[$i] == $c && $SIZE[$i] == $s && $LETER[$i] == $lll && $ASIGN[$i] == $aaa)
				{
					$Q[$i] = $q;
					$flag = 1;
				}
				
			}
			if($flag == 0)
			{
				$P[count($_SESSION['P'])]	= $id;
				$Q[count($_SESSION['Q'])] = $q;
			}
			$_SESSION['P'] = $P;
			$_SESSION['Q'] = $Q;
		}
		else
		{
			$P[0] = $id;
			$Q[0] = $q;
			$_SESSION['P'] = $P;
			$_SESSION['Q'] = $Q;
		}
	}
	
	## 23 ##
	
	function location($path)
	{
		header("Location: ".$path."");
	}
	
	## 24 ##
	function GTG_emptycart()
	{
		session_unregister('P');
		session_unregister('Q');
		session_unregister('COLOR');
		session_unregister('SIZE');	
	}
	
	
	## 26 ##
	function insizeproduct($pid,$sid)
	{
		$q = "select id from sizeproduct where sid=".$sid." and pid=".$pid."";
		$r = mysql_query($q);
		if(mysql_num_rows($r) > 0)
			return true;
		else
			return false;
	}
	## 27 ##
	function incolorproduct($pid,$cid)
	{
		$q = "select id from colorproduct where cid=".$cid." and pid=".$pid."";
		$r = mysql_query($q);
		if(mysql_num_rows($r) > 0)
			return true;
		else
			return false;
	}
	## 28 ##
	function getsize($s)
	{
		if($s == "size_infant")
			return "Infant";
		if($s == "size_toddler")
			return "Toddler";
		if($s == "size_small")
			return "Small";
		if($s == "size_medium")
			return "Medium";
		if($s == "size_large")
			return "Large";
		if($s == "size_x_large")
			return "Extra Large";
		if($s == "size_one_size")
			return "One Size";
	}
	## 29 ##
	function getskusize($sku)
	{
		$q = "select * from product where sku like '".$sku."'";
		$r = mysql_query($q);
		while($r1 = mysql_fetch_array($r))
		{
			if($r1['size_infant'] == "Yes")
				return "size_infant";
			if($r1['size_toddler'] == "Yes")
				return "size_toddler";
			if($r1['size_small'] == "Yes")
				return "size_small";
			if($r1['size_medium'] == "Yes")
				return "size_medium";
			if($r1['size_large'] == "Yes")
				return "size_large";
			if($r1['size_x_large'] == "Yes")
				return "size_x_large";
			if($r1['size_one_size'] == "Yes")
				return "size_one_size";
		}
	}
	## 30 ##
	function getskucolor($sku)
	{
		$q = "select * from product where sku like '".$sku."'";
		$r = mysql_query($q);
		while($r1 = mysql_fetch_array($r))
		{
			if($r1['color_baby_blue'] == "Yes")
				return "color_baby_blue";
			if($r1['color_baby_pink'] == "Yes")
				return "color_baby_pink";
			if($r1['color_blue'] == "Yes")
				return "color_blue";
			if($r1['color_green'] == "Yes")
				return "color_green";
			if($r1['color_pink'] == "Yes")
				return "color_pink";
			if($r1['color_red'] == "Yes")
				return "color_red";
			if($r1['color_orange'] == "Yes")
				return "color_orange";
			if($r1['color_black'] == "Yes")
				return "color_black";
			if($r1['color_yellow'] == "Yes")
				return "color_yellow";
			if($r1['color_white'] == "Yes")
				return "color_white";
		}
	}
	
	## 31 ##
	function GTG_getstate($id)
	{
		$q = "select * from state where id=".$id;
		$r = mysql_query($q);
		while($r1 = mysql_fetch_array($r))
		{
			return $r1['name'];
		}
	}
	
	## 32 ##
	function GTG_add_to_cart1($id,$q,$c,$s,$cflag)
	{
		
		if(isset($_SESSION['P1']))
		{
			$P = $_SESSION['P1'];
			$Q = $_SESSION['Q1'];
			$COLOR = $_SESSION['COLOR1'];
			$SIZE = $_SESSION['SIZE1'];
			$CFLAG = $_SESSION['CFLAG1'];
			$flag = 0;
			
			for($i=0;$i<count($P);$i++)
			{
				if($P[$i] == $id && $COLOR[$i] == $c && $SIZE[$i] == $s)
				{
					$Q[$i] = $Q[$i] + $q;
					$flag = 1;
				}
			}
			if($flag == 0)
			{
				$P[count($_SESSION['P1'])]	= $id;
				$COLOR[count($_SESSION['COLOR1'])]	= $c;
				$SIZE[count($_SESSION['SIZE1'])]	= $s;
				$Q[count($_SESSION['Q1'])] = $q;
				$CFLAG[count($_SESSION['CFLAG1'])] = $cflag;
			}
			$_SESSION['P1'] = $P;
			$_SESSION['Q1'] = $Q;
			$_SESSION['COLOR1'] = $COLOR;
			$_SESSION['SIZE1'] = $SIZE;
			$_SESSION['CFLAG1'] = $CFLAG;
		}
		else
		{
			$P[0] = $id;
			$Q[0] = $q;
			$COLOR[0] = $c;
			$SIZE[0] = $s;
			$CFLAG[0] = $cflag;
			$_SESSION['P1'] = $P;
			$_SESSION['Q1'] = $Q;
			$_SESSION['COLOR1'] = $COLOR;
			$_SESSION['SIZE1'] = $SIZE;
			$_SESSION['CFLAG1'] = $CFLAG;
		}
	}
	
	## 33 ##
	function GTG_remove_from_cart1($id)
	{
		
		if(isset($_SESSION['P1']))
		{
			$P = $_SESSION['P1'];
			$Q = $_SESSION['Q1'];
			$COLOR = $_SESSION['COLOR1'];
			$SIZE = $_SESSION['SIZE1'];
			
			$P_temp;
			$Q_temp;
			$COLOR_temp;
			$SIZE_temp;
			
			$count = 0;
			
			if(count($P) == 1)
			{
				session_unregister('P1');
				session_unregister('Q1');
				session_unregister('COLOR1');
				session_unregister('SIZE1');
			}
			else
			{
				for($i=0;$i<count($P);$i++)
				{
					if($P[$i] != $id)
					{
						$P_temp[$count] = $P[$i];
						$Q_temp[$count] = $Q[$i];
						$COLOR_temp[$count] = $COLOR[$i];
						$SIZE_temp[$count] = $SIZE[$i];
						$count++;
					}
				}
				$_SESSION['P1'] = $P_temp;
				$_SESSION['Q1'] = $Q_temp;
				$_SESSION['COLOR1'] = $COLOR_temp;
				$_SESSION['SIZE1'] = $SIZE_temp;
			}
			
		}
	}
	
	## 34 ##
	function remove_dup($pagename)
	{
		$p = isset($_SESSION['P1']) ? $_SESSION['P1'] : 0;
		if($p > 0)
		{ 
			for($i=0;$i<count($p);$i++)
			{	
				$sku = trim($p[$i]);
				$q = "select pname from product where sku like '".$sku."'";
				$r = mysql_query($q);
				if(mysql_num_rows($r) > 0)
				{
					while($r1 = mysql_fetch_array($r))
					{
						$pname = trim($r1['pname']);
						if($pname == $pagename)
						{
							GTG_remove_from_cart1($sku);
						}
					}
				}
			}
		}
	}
	
	## 35 ##
	function check_more($id)
	{
		$q = "select * from stepimage where sid=".$id;
		$r = mysql_query($q);
		if(mysql_num_rows($r) > 0)
			return true;
		else
			return false;
	}
	
	## 36 ##
	function GTG_get_galleryname($id)
	{
		$q = "select title from gallery where id=".$id;
		$r = mysql_query($q);
		if(mysql_num_rows($r) > 0)
		{
			while($r1 = mysql_fetch_array($r))
			{
				return trim($r1['title']);
			}
		}
	}
	
	## 37 ##
	function GTG_check_date($date)
	{
		$q = "select * from event where date='".$date."'";
		$r = mysql_query($q);
		if(mysql_num_rows($r) > 0)
			return true;
		else
			return false;
	}
	
	## 38 ##
	function GTG_get_username($id)
	{
		$q = "select `fname` from `users` WHERE `id`='".$id."'";
		$r = mysql_query($q);
		if(mysql_num_rows($r) > 0)
		{
			while($r1 = mysql_fetch_array($r))
			{
				return trim($r1['fname']);
			}
		}
	}
	
	## 39 ##
	function GTG_get_gallerydesc($id)
	{
		$q = "select desc1 from gallery where id=".$id;
		$r = mysql_query($q);
		if(mysql_num_rows($r) > 0)
		{
			while($r1 = mysql_fetch_array($r))
			{
				return trim(stripslashes($r1['desc1']));
			}
		}
	}
	
	?>