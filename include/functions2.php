<?
function loadcart()
{
	$CartID = $_SESSION["ELXCartID"];
	$cartarray = array();
	
	$ssql = "Select * from cartitems where sess_id='".$CartID."'";
	$cartarray[0] = mysql_query($ssql);
	$cartarray[1] = mysql_affected_rows();	
	
	/*$shipqry = "select * from shipping where id = 1";
	$shipres = mysql_query($shipqry);
	$shipobj = mysql_fetch_object($shipres);
	$cartarray[6] = $shipobj->shipping;
	$cartarray[7] = $shipobj->type;*/
	
	if($_SESSION["NewCartId"] != "")
	{
		$cdqry = "select * from cartdetail where cart_id=".$_SESSION["NewCartId"]." and session_id='$CartID'";
		$cdres = mysql_query($cdqry);
		$cdobj = mysql_fetch_object($cdres);
		if(mysql_num_rows($cdres) == 1)
		{
			$cartarray[8] = $cdobj->subtotal;
			$cartarray[9] = $cdobj->shipping;
			$cartarray[10] = $cdobj->nettotal;
			$cartarray[11] = $cdobj->netdiscount;
			$cartarray[12] = $cdobj->final_total;
			$cartarray[13] = $cdobj->address;
			$cartarray[14] = $cdobj->country;
			$cartarray[15] = $cdobj->state;
			$cartarray[16] = $cdobj->city;
			$cartarray[17] = $cdobj->pincode;
			$cartarray[18] = $cdobj->s_address;
			$cartarray[19] = $cdobj->s_country;
			$cartarray[20] = $cdobj->s_state;
			$cartarray[21] = $cdobj->s_city;
			$cartarray[22] = $cdobj->s_pincode;
			$cartarray[23] = $cdobj->order_id;
			$cartarray[24] = $cdobj->order_date;
			$cartarray[25] = $cdobj->first_name;			
			$cartarray[27] = $cdobj->last_name;			
			$cartarray[28] = $cdobj->couponcode;			
		}		
		
	}	
	return $cartarray;	
}

function checkout($ftotal,$stotal,$discount,$tax,$shiping,$NetTotal=0.00,$NetDiscount,$noback='N',$couponcode="")
{
		$sessid = $_SESSION["ELXCartID"];
		//echo $_SESSION["NewCartId"];		
		if($_SESSION["NewCartId"] == "")
		{			
			$timestring = mktime (date("g"),date("i"),date("s"),date("n"),date("j"),date("Y"));
			$orderid = "ELX".$timestring;
			$orderdate = date("Y-m-d");
		$InsQry = "insert into cartdetail(session_id,nettotal,netdiscount,subtotal,shipping,final_total,order_id,order_date,order_status,couponcode)
values('$sessid','$NetTotal',$NetDiscount,'$stotal',$shiping,'$ftotal','$orderid','$orderdate','INCOMPLETE','$couponcode')"; 
			mysql_query($InsQry);	
			//echo "test:".mysql_error();
			$NewId = mysql_insert_id();
			$_SESSION["NewCartId"] = $NewId;
			
			$UpQry = "update cartitems set cart_id=$NewId where sess_id='$sessid'";
			mysql_query($UpQry);
			
			if($noback == 'N')
			{			
				if($_SESSION["UsErId"]>0)
				{
					header("location:shippinginfo.php");	
				}
				else
				{
					header("location:signin.php?chkout=y");
				}
			}
			
		}
		else
		{
			$cart_id = $_SESSION["NewCartId"];						
			$UpQry = "update cartdetail set subtotal=$stotal,shipping=$shiping,final_total=$ftotal,netdiscount=$NetDiscount,couponcode='$couponcode' where cart_id=$cart_id ";
			mysql_query($UpQry);	
			//echo mysql_error();
			$UpQry = "update cartitems set cart_id=$cart_id where sess_id='$sessid'";
			mysql_query($UpQry);
			
			if($noback == 'N')
			{		
				if($_SESSION["UsErId"]>0)
				{
					header("location:shippinginfo.php");	
				}
				else
				{
					header("location:signin.php?chkout=y");
				}
			}
		}	
} 
?>