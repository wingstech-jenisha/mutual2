<?
include('connect.php');
$SKUID=$_GET['itemsku'];
$NodeQury="select * from flagging_product_size where user_sku='".$SKUID."' group by type";
$NodeRes=mysql_query($NodeQury);
$NodeTot=mysql_affected_rows();
if($NodeTot>0)
{
	$k=0;
	while($NodeRow=mysql_fetch_array($NodeRes))
	{
		if($NodeRow['type']!=''){ $Drop.="<div class='extra-drop-filed'><strong>".$NodeRow['type'].": </strong>";}else{ $Drop.="<div class='extra-drop-filed'><strong>".GetName1("flagging_searplusitems","product_title","user_defined_sku_id",$NodeRow['user_sku']).": </strong>";}
		$ColorQry="select * from flagging_product_size where user_sku='".$NodeRow['user_sku']."' and type='".$NodeRow['type']."' group by name";
		$ColorRes=mysql_query($ColorQry);
		$ColorTot=mysql_affected_rows();
		if($ColorTot>0)
		{
			$k++;
			$Drop.='<select name="drp_'.$k.'" id="drp_'.$k.'" class="itemData hoverInfo" onchange="Getsku(this.value,'.$k.');">';
			while($ColorRow=mysql_fetch_array($ColorRes))
			{
				if($ColorRow['default_option']=="Y"){$selected="selected";}else{$selected="";}
				if($Name==''){$Ajaxnm=1;}
				$drp_1=stripslashes($ColorRow['name']);
				$drp_1=str_replace("&","PPPOPPP",$drp_1);
				$drp_1=str_replace("#","OOOPOOO",$drp_1);
				$drp_1=str_replace('"','OXXXOXXXO',$drp_1);
				$drp_1=str_replace("'",'OXXXOOXXXO',$drp_1);
				$drp_1=str_replace("’",'OXXXOOOXXXO',$drp_1);
				$Name=str_replace("’","'",$ColorRow['name']);
				$Drop.="<option value='".stripslashes($drp_1)."' ".$selected.">".$Name."</option>";
			}
			$Drop.="</select></div>&nbsp;&nbsp;&nbsp;";
		}
	}
}
if($Ajaxnm!=''){echo $Drop;}
?>