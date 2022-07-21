<?
class get_pageing{
var $record_per_page=10;
var	$pages=5;
var $tbl,$file_names,$order,$query;

function start()
{
	if($_GET["start"])
		return	$start=$_GET["start"];
	else
		return	$start=0;
}
function start1()
{
	if($_GET["start1"])
		return	$start=$_GET["start1"];
	else
		return	$start=0;
}

function start2()
{
	if($_GET["start"])
		return	$start=$_GET["start"];
	else
		return	$start=1;
}
function file_names()
{
	//$pt=explode("/",$_SERVER['SCRIPT_FILENAME']);
	$pt=explode("/",$_SERVER['PHP_SELF']);
	$totpt=count($pt);
	return $this->file_names=$pt[$totpt-1];
} 
function number_pageing_nodetail($query,$record_per_page='',$pages='')
{
		return $this->number_pageing($query,$record_per_page,$pages,"N");
}

function number_pageing_bottom_nodetail($query,$record_per_page='',$pages='')
{
		return $this->number_pageing($query,$record_per_page,$pages,"N","Y");
}
function number_pageing_bottom($query,$record_per_page='',$pages='')
{
		return $this->number_pageing($query,$record_per_page,$pages,"","Y");
}
function number_pageing_bottom_admin($query,$record_per_page='',$pages='')
{
		return $this->number_pageing_admin($query,$record_per_page,$pages,"Y","Y");
}
function runquery($query)
{
	return	mysql_query($query);
}
	
	function table($result,$titles,$fields,$passfield="",$edit,$delete,$parent="")
	{
			if($parent=="")
				$parent="Y";
			
			if($passfield=="")
				$passfield="id";

			$cont="<table width='100%' cellspacing='0' cellpadding='3' border='0' ><tr>";
			foreach($titles as $K=>$V)
			{
				$cont1.="<td";
				$cont1.=(is_numeric($V))?" width='$V%' align='center'><strong>$K</strong></td>":" align='center'><strong>$V</strong></td>";
			}
			$cont.=$cont1."</tr>";
			$cont.="<tr><td colspan='".count($titles)."'><script language=javascript>
					msg=\"<table border=0 cellpadding=3 cellspacing=1 width='100%'><TR>$cont1</TR></table>\";
					
					</script>
			<script src='topmsg.js'></script>			
			</td></tr>";
			$j=0;
			while($gets=mysql_fetch_object($result))
			{
				$j=1;
				$cont.="<tr onmouseover=\"this.className='yellowdark3bdr'\" onmouseout=\"this.className=''\">";
				foreach($fields as $K=>$V)
				{
					$cont.="<td align='center'>";
					$tmps=explode(",",$V);
					$newval="";
					foreach($tmps as $val)
					{
						$newval.=$gets->$val." ";
					}
					$cont.=(is_numeric($K))?$newval:"<a href='$K?$passfield=".$gets->$passfield."' onmouseover=\"smsg('View Detail of ".addslashes($newval)."');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">".$newval."</a>";
					$cont.="&nbsp;</td>";
				}
				$cont.="<td><INPUT name='button' type='button' onClick=\"";
				$cont.=($parent=="N")?"window":"parent.body";
				$cont.=".location.href='$edit?$passfield=".$gets->$passfield."'\" value='Edit' onmouseover=\"smsg('Edit This Record -> $newval');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">&nbsp;&nbsp;<INPUT onClick=\"deleteconfirm('Are you sure you want to delete this Record?.','$delete?$passfield=".$gets->$passfield."');\" type='button' value='Delete' onmouseover=\"smsg('Delete This Record -> $newval');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">&nbsp;</td>";
				$cont.="</tr>";
			}
			
			if($j==0)
			{
				$cont.="<tr><td colspan='".(count($fields)+1)."' align='center'><font color='red'><strong>No Record To Display</strong></font></td></tr>";
			}
			echo	$cont.="</table>";
	}
///////////// NUMERIC FUNCTION WITH RECORD DESTAIL//////////////////////////////////////
function number_pageing($query,$record_per_page='',$pages='',$detail='',$bottom='',$simple='')
{

		$this->file_names();
		$this->query=$query;
		
		if($record_per_page>0)
			$this->record_per_page=$record_per_page;
		
		if($pages>0)
			$this->pages=$pages;

		$result=$this->runquery($this->query);
		$totalrows= mysql_affected_rows();										
		
		$start=$this->start();
		
		$order=$_GET['order'];
		$this->query.=" limit $start,".$this->record_per_page;  
		$result=$this->runquery($this->query);
		$total= mysql_affected_rows();
		
		$total_pages=ceil($totalrows/$this->record_per_page);
		$current_page=($start+$this->record_per_page)/$this->record_per_page;
		$loop_counter=ceil($current_page/$this->pages);
		$start_loop=($loop_counter*$this->pages-$this->pages)+1;
		$end_loop=($this->pages*$loop_counter)+1;

		if($end_loop>$total_pages)
			$end_loop=$total_pages+1;

		$tmpva="";
		foreach($_GET as $V=>$K)
		{
			if($V!="start")
				$tmpva.="&".$V."=".$K;
		}
		
		$this->tbl="<table width='100%' height='100%' border='0' cellpadding='0' cellspacing='0' ><tr><td width='15%' align='left'><strong>&nbsp;&nbsp;";
		
		
		if($start>0)
		{ 
			$this->tbl.="<a href='".$this->file_names."?start=".($start-$this->record_per_page).$tmpva."'  class='ttt'  onmouseover=\"smsg('previous Page');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">&lt;&lt;Previous</a>&nbsp;&nbsp;"; 
		} 

		$this->tbl.="</strong>&nbsp;</td><td width='70%' class='blogDate'  align='center' style='text-align:center'>&nbsp;";
/*		if($detail!="N" and $simple !="N")
			$this->tbl.="<strong>Result ".($start+1)." - ".($start+$total)." of ".$totalrows." Records</strong><BR>";
*/		if($simple!='N')
		{
			for($i=$start_loop;$i<$end_loop;$i++) 
			{
				if($current_page==$i)	
				{
					$this->tbl.="<strong><span class='ttt'>".$i."</span></strong>&nbsp;&nbsp;";	
				}	
				else 
				{ 
					$this->tbl.="<strong><a href='".$this->file_names."?start=".($i-1)*$this->record_per_page.$tmpva."'  class='ttt' onmouseover=\"smsg('View Page Number $i');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">".$i."</a></strong>&nbsp;&nbsp;"; 
				}
			}
		}
		
		$this->tbl.="&nbsp;</td><td width='15%' align='right' style='text-align:right'><strong>";
		if($start+$this->record_per_page<$totalrows) 
		{ 
			$this->tbl.="<a href='".$this->file_names."?start=".($start+$this->record_per_page).$tmpva."' class='ttt' onmouseover=\"smsg('Next Page');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">Next&gt;&gt;</a>"; 
		} 
		$this->tbl.="&nbsp;&nbsp;</strong>&nbsp;</td></tr></table>";
		
		if($bottom=="Y")
		{
			if($totalrows>0)
				return $result=array($result,$this->tbl);
			else
				return $result=array($result,"");
		}
		else
		{
			if($totalrows>0)
			{
				echo $this->tbl;		
				return $result;
			}
			else
			{
				return $result;
			}
		}
	
}
function number_pageing_admin($query,$record_per_page='',$pages='',$detail='',$bottom='',$simple='')
{

		$this->file_names();
		$this->query=$query;
		
		if($record_per_page>0)
			$this->record_per_page=$record_per_page;
		
		if($pages>0)
			$this->pages=$pages;

		$result=$this->runquery($this->query);
		$totalrows= mysql_affected_rows();										
		
		$start=$this->start();
		
		$order=$_GET['order'];
		$this->query.=" limit $start,".$this->record_per_page;  
		$result=$this->runquery($this->query);
		$total= mysql_affected_rows();
		
		$total_pages=ceil($totalrows/$this->record_per_page);
		$current_page=($start+$this->record_per_page)/$this->record_per_page;
		$loop_counter=ceil($current_page/$this->pages);
		$start_loop=($loop_counter*$this->pages-$this->pages)+1;
		$end_loop=($this->pages*$loop_counter)+1;

		if($end_loop>$total_pages)
			$end_loop=$total_pages+1;

		$tmpva="";
		foreach($_GET as $V=>$K)
		{
			if($V!="start")
				$tmpva.="&".$V."=".$K;
		}
		
		$this->tbl="<table width='100%' height='100%' border='0' cellpadding='0' cellspacing='0' ><tr><td width='15%' align='left'><strong>&nbsp;&nbsp;";
		
		
		if($start>0)
		{ 
			$this->tbl.="<a href='".$this->file_names."?start=".($start-$this->record_per_page).$tmpva."'  class='ttt'  onmouseover=\"smsg('previous Page');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">&lt;&lt;previous</a>&nbsp;&nbsp;"; 
		} 

		$this->tbl.="</strong>&nbsp;</td><td width='70%' class='blogDate'  align='center'>&nbsp;";
		if($detail!="N" and $simple !="N")
			$this->tbl.="<strong>Result ".($start+1)." - ".($start+$total)." of ".$totalrows." Records</strong><BR>";
		if($simple!='N')
		{
			for($i=$start_loop;$i<$end_loop;$i++) 
			{
				if($current_page==$i)	
				{
					$this->tbl.="<strong><span class='ttt'>".$i."</span></strong>&nbsp;&nbsp;";	
				}	
				else 
				{ 
					$this->tbl.="<strong><a href='".$this->file_names."?start=".($i-1)*$this->record_per_page.$tmpva."'  class='ttt' onmouseover=\"smsg('View Page Number $i');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">".$i."</a></strong>&nbsp;&nbsp;"; 
				}
			}
		}
		
		$this->tbl.="&nbsp;</td><td width='15%' align='right'><strong>";
		if($start+$this->record_per_page<$totalrows) 
		{ 
			$this->tbl.="<a href='".$this->file_names."?start=".($start+$this->record_per_page).$tmpva."' class='ttt' onmouseover=\"smsg('Next Page');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">Next&gt;&gt;</a>"; 
		} 
		$this->tbl.="&nbsp;&nbsp;</strong>&nbsp;</td></tr></table>";
		
		if($bottom=="Y")
		{
			if($totalrows>0)
				return $result=array($result,$this->tbl);
			else
				return $result=array($result,"");
		}
		else
		{
			if($totalrows>0)
			{
				echo $this->tbl;		
				return $result;
			}
			else
			{
				return $result;
			}
		}
	
}	


	function pageing($query,$record_per_page="",$pages="")
	{
			return $this->number_pageing($query,$record_per_page,$pages,'','','N');
	}

	function order()
	{
		$this->file_names();
		$this->order.="<TR><TD><a href='".$this->file_names."' onmouseover=\"smsg('View All Records');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">All</a></TD><TD >|</TD>";
		for($i=65;$i<91;$i++)
		{		
			$this->order.="<TD><a class=la href='$file_names?order=".chr($i)."' onmouseover=\"smsg('View By ".chr($i)."');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">".chr($i)."</a></TD><TD class=lg>|</TD>";
		}
		return $this->order.="</TR>";
	}
	function MakeCombo($query,$value="",$fill_value,$comboname,$selected="")
	{
		if($value=="")
			$value=$fill_value;
		$run=$this->runquery($query);
		$totlist=mysql_affected_rows();
		$Combo="<select name='$comboname'>";
		$Combo.="<option value=''>-----Select-----</option>";
		for($i=0;$i<$totlist;$i++)
		{
			$get=mysql_fetch_object($run);
			$Combo.="<option value='".$get->$value."'";
			if($selected==$get->$value)
			{
				$Combo.="selected='selected'";
			}
			$Combo.=">".$get->$fill_value."</option>";
		}
		$Combo.="</select>";
		echo $Combo;
	}
}

$prs_pageing= new get_pageing;

function run($query)
{
	return	mysql_query($query);
}

function addlink($title,$file,$class="")
{
	$str="<a href='$file'";
	$str.=(strlen($class)>0)?" class='$class'":"";
	$str.=" onmouseover=\"smsg('$title');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">$title</a>";
	echo $str;
}

function CountryCombo($query="",$value="",$fill_value="",$combo_name="",$selected="")
{
	if($query=="")
		$query="select * from country order by `plid` asc, `name` asc";
	if($fill_value=="")
		$fill_value="name";
	if($value=="")
		$value=$fill_value;
	if($combo_name=="")
		$combo_name="country";
		$prs_pageing= new get_pageing;
	$prs_pageing->MakeCombo($query,$value,$fill_value,$combo_name,$selected);
}
function ads($str)
{
	return $newstr=htmlentities($str,ENT_QUOTES);
}
function rms($str)
{
	return $newstr=stripslashes($str);
}

function getimage($nm,$mywidth,$myheight,$text="")
{
	echo "sample.php?nm=$nm&mwidth=$mywidth&mheight=$myheight&text=$text";
}

function getuser($condition="",$return_true,$return_false="",$tbl="")
{
	if($condition=="")
		$condition="id=".$_COOKIE["UID"];
	
	if($tbl=="")
		$seluser="select * from users";
	else
		$seluser="select * from $tbl";
	
	$seluser.=" where $condition";
	$runuser=run($seluser);
	echo mysql_error();
	$totuser=mysql_affected_rows();
	if($totuser>0)
	{
		$getuser=mysql_fetch_object($runuser);
		return $getuser->$return_true;
	}
	else
	{
		if($return_false=="")
			return 0;
		else
			return $return_false;	
	}
}

function getvalue($tbl,$condition="",$return_true,$return_false="")
{
	$values=getuser($condition,$return_true,$return_false,$tbl);
	return $values;
}

function GetReplyCount($Bid)
{
	$BrSql=mysql_query("SELECT * FROM blog_reply WHERE blog_post_id='".$Bid."'");
	$BrTot=mysql_num_rows($BrSql);
	
	return $BrTot;	
}

function GetGroupMember($Uid)
{
	$GrpId="";

	$S1=mysql_query("SELECT to_userid FROM blog_invite WHERE from_userid=".$Uid."");
	
	if($S1)
	{
		while($R1=mysql_fetch_object($S1))
		{
			if($GrpId=="")
				$GrpId=$R1->to_userid;
			else
				$GrpId=$GrpId.",".$R1->to_userid;
		}
	}
	
	$S2=mysql_query("SELECT from_userid FROM blog_invite WHERE to_userid='".$Uid."'");
	if($S2)
	{
		while($R2=mysql_fetch_object($S2))
		{
			if($GrpId=="")
				$GrpId=$R2->from_userid;
			else
				$GrpId=$GrpId.",".$R2->from_userid;
		}
	}	
	return $GrpId;
}
function getvar()
{
	$sel="select * from affiliate where id=".$_COOKIE["AID"];
	$run=mysql_query($sel);
}
?>