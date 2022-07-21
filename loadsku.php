<?
include('connect.php');
$drp_1=$_GET['drp_1'];
$drp_2=$_GET['drp_2'];
$drp_3=$_GET['drp_3'];
$main_sku=$_GET['main_sku'];
if($drp_1!=''){$drp_1=str_replace("PPPOPPP","&",$drp_1);$drp_1=str_replace("OOOPOOO","#",$drp_1);$drp_1=str_replace("OXXXOXXXO",'"',$drp_1);$drp_1=str_replace("OXXXOOXXXO","'",$drp_1);$drp_1=str_replace("OXXXOOOXXXO","’",$drp_1);}
if($drp_2!=''){$drp_2=str_replace("PPPOPPP","&",$drp_2);$drp_2=str_replace("OOOPOOO","#",$drp_2);$drp_2=str_replace("OXXXOXXXO",'"',$drp_2);$drp_2=str_replace("OXXXOOXXXO","'",$drp_2);$drp_2=str_replace("OXXXOOOXXXO","’",$drp_2);}
if($drp_3!=''){$drp_3=str_replace("PPPOPPP","&",$drp_3);$drp_3=str_replace("OOOPOOO","#",$drp_3);$drp_3=str_replace("OXXXOXXXO",'"',$drp_3);$drp_3=str_replace("OXXXOOXXXO","'",$drp_3);$drp_3=str_replace("OXXXOOOXXXO","’",$drp_3);}

$MainSku1="";$MainSku2="";$MainSkuF="";
if($drp_1!=''  && $drp_2==''  && $drp_3=='')
{
	$NodeQury="select id,sku,price from flagging_product_size where (name='".addslashes($drp_1)."') and user_sku='".$main_sku."' group by sku";
	$NodeRes=mysql_query($NodeQury);
	if(mysql_affected_rows()>0)
	{
		while($NodeRow=mysql_fetch_array($NodeRes))
		{
			$MainSkuF=$NodeRow['sku'];$Price=$NodeRow['price'];
		}
	}
	$Dataa=$MainSkuF."OOPOO".$Price."OOPOO";
	echo $Dataa;
}
else if($drp_1!='' && $drp_2!='' && $drp_3=='')
{
	$NodeQury="select id,sku,price from flagging_product_size where (name='".addslashes($drp_1)."') and user_sku='".$main_sku."'  group by sku";
	$NodeRes=mysql_query($NodeQury);
	if(mysql_affected_rows()>0)
	{
		while($NodeRow=mysql_fetch_array($NodeRes))
		{
			$MainSku1=$NodeRow['sku'];$Price=$NodeRow['price'];
			
			$NodeQury1="select id,sku,price from flagging_product_size where (name='".addslashes($drp_2)."') and user_sku='".$main_sku."' and sku='".$MainSku1."'  group by sku";
			$NodeRes1=mysql_query($NodeQury1);
			if(mysql_affected_rows()>0)
			{
				while($NodeRow2=mysql_fetch_array($NodeRes1))
				{
					$MainSkuF=$NodeRow2['sku'];$Price=$NodeRow2['price'];
				}
				$Dataa=$MainSkuF."OOPOO".$Price."OOPOO";
				echo $Dataa;
			}
		}
		
	}
	
}
else if($drp_1!='' && $drp_2!='' && $drp_3!='')
{
	$NodeQury="select id,sku,price from flagging_product_size where (name='".addslashes($drp_1)."') and user_sku='".$main_sku."'  group by sku";
	$NodeRes=mysql_query($NodeQury);
	if(mysql_affected_rows()>0)
	{
		while($NodeRow=mysql_fetch_array($NodeRes))
		{
			$MainSku1=$NodeRow['sku'];$Price=$NodeRow['price'];
			
			$NodeQury1="select id,sku,price from flagging_product_size where (name='".addslashes($drp_2)."') and user_sku='".$main_sku."' and sku='".$MainSku1."'  group by sku";
			$NodeRes1=mysql_query($NodeQury1);
			if(mysql_affected_rows()>0)
			{
				while($NodeRow2=mysql_fetch_array($NodeRes1))
				{
					$MainSku2=$NodeRow2['sku'];$Price=$NodeRow2['price'];
					if($MainSku2==$MainSku1)
					{
					
					$NodeQury2="select id,sku,price from flagging_product_size where (name='".addslashes($drp_3)."') and user_sku='".$main_sku."' and sku='".$MainSku2."' group by sku";
					$NodeRes2=mysql_query($NodeQury2);
					if(mysql_affected_rows()>0)
					{
						while($NodeRow3=mysql_fetch_array($NodeRes2))
						{
							$MainSkuF=$NodeRow3['sku'];$Price=$NodeRow3['price'];
						}
						$Dataa=$MainSkuF."OOPOO".$Price."OOPOO";
						echo $Dataa;
					}
					}
					
				}
			}
		}
	
	}
	
}
?>