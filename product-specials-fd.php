<? 
$page="specials"; 
include("connect.php");
$DisplayH1="";
$TopTab="Specials"; 
$MorQry="";$MorQryBRN="";
$urlCCCC = "http" . ((!empty($_SERVER['HTTPS'])) ? "s" : "") . "://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
if($_GET["sid"]!="")
{
	$PaginUrrl="categories/".$_GET["cid"]."/".$_GET["sid"]."?";
	if($_GET["keyword"]!=""){ $PaginUrrl.="keyword=".$_GET["keyword"]."&"; }
	if($_GET["sort"]!=""){ $PaginUrrl.="sort=".$_GET["sort"]."&"; }
	if($_GET["view"]!=""){ $PaginUrrl.="view=".$_GET["view"]."&"; }
	if($_GET["type"]!=""){ $PaginUrrl.="type=".$_GET["type"]."&"; }
	if($PaginUrrl!=""){ $PaginUrrl=substr($PaginUrrl,0,-1); }
}
else if($_GET["cid"]!="")
{
	$PaginUrrl=GetUrl_Catt($_GET["cid"])."?";
	if($_GET["keyword"]!=""){ $PaginUrrl.="keyword=".$_GET["keyword"]."&"; }
	if($_GET["sort"]!=""){ $PaginUrrl.="sort=".$_GET["sort"]."&"; }
	if($_GET["view"]!=""){ $PaginUrrl.="view=".$_GET["view"]."&"; }
	if($_GET["type"]!=""){ $PaginUrrl.="type=".$_GET["type"]."&"; }
	if($PaginUrrl!=""){ $PaginUrrl=substr($PaginUrrl,0,-1); }
}
else
{
	$PaginUrrl="product-specials-fd?";
	if($_GET["keyword"]!=""){ $PaginUrrl.="keyword=".$_GET["keyword"]."&"; }
	if($_GET["sort"]!=""){ $PaginUrrl.="sort=".$_GET["sort"]."&"; }
	if($_GET["view"]!=""){ $PaginUrrl.="view=".$_GET["view"]."&"; }
	if($_GET["type"]!=""){ $PaginUrrl.="type=".$_GET["type"]."&"; }
	if($PaginUrrl!=""){ $PaginUrrl=substr($PaginUrrl,0,-1); }
}
if($_GET["sort"]!="" || $_GET["view"]!="" || $_GET["keyword"]!="" || $_GET["type"]!="" || $_GET["brand"]!="")
{
	$PaginUrrl=$PaginUrrl."&";
}
else
{
	$PaginUrrl=$PaginUrrl."?";
}

if($_GET["view"]!="")
{
	$portfolioPERPAGE=($_GET["view"]);$ShowPage=($_GET["view"]);$Numm=($_GET["view"]);
}
else if ($_SESSION["SPERPAGELST"]!="")
{
	$portfolioPERPAGE=$_SESSION["SPERPAGELST"];$ShowPage=$_SESSION["SPERPAGELST"];$Numm=$_SESSION["SPERPAGELST"];
}
else
{
	$portfolioPERPAGE=60;$ShowPage=60;$Numm=60;
}
$_SESSION["SPERPAGELST"]=$portfolioPERPAGE;

if($_REQUEST['Page']>0 )
	$PageNo = ($_REQUEST['Page']);		
else
	$PageNo = 1;
if(!$StartRow1)
	$StartRow =   $portfolioPERPAGE * ($PageNo-1);
else
	$StartRow = $StartRow1;	

$cid=trim(addslashes(($_GET["cid"])));
$sid=trim(addslashes(($_GET["sid"])));
$srchh=trim(addslashes(($_GET["keyword"]))); 
$srchh22=trim(addslashes(addslashes(($_GET["keyword"]))));
$srchhLOWER=trim(strtolower($srchh));

if($cid!="")
{
	$MorQry.=" and `JetBrowseNodeID`='".$cid."' ";
	$MorQryBRN.=" and `JetBrowseNodeID`='".$cid."' ";
}
if($sid!="")
{
	$MorQry.=" and `JetBrowseNodeID`='".$sid."' ";
	$MorQryBRN.=" and `JetBrowseNodeID`='".$sid."' ";
}
if($srchh!="")
{
	$SKuQryy="";
	$ExploSrch=explode(" ",$srchh);
	for($ds=0;$ds<count($ExploSrch);$ds++)
	{
		$sepwrd=trim($ExploSrch[$ds]);
		if($sepwrd!="")
		{
			if(strlen($sepwrd)>3)
			{
				$SKuQryy.=" or trim(user_defined_sku_id)='".$sepwrd."' or trim(product_title) like '%".$sepwrd."%' ";
			}	
		}
	}
	
	$SrchNew=explode("'",stripslashes($_GET["keyword"]));
	$NewKword=trim($SrchNew[0]);
	if(is_numeric($NewKword)){$joinedqryyy="";}else{$joinedqryyy=" OR trim(product_title) LIKE '%".$NewKword."%' ";}
	
	$srchhSChar=substr($srchh,0,-1);
	
	$SKuQryy.=" OR REPLACE( `user_defined_sku_id` , '-', '' )='".$srchh."'";
	$SKuQryy.=" OR REPLACE( `user_defined_sku_id` , ' ', '' )='".$srchh."'";
	$MorQry.=" and (trim(product_title) LIKE '%".$srchhSChar."%' ".$joinedqryyy." OR trim(product_title) LIKE '%".$srchh."%' OR trim(product_title) LIKE '%".$srchh22."%' OR trim(item_price) LIKE '%".$srchh."%' OR trim(`standard_product_codes`) LIKE '%".$srchh."%' OR trim(user_defined_sku_id) LIKE '%".$srchh."%' OR trim(product_title) LIKE '%".$srchhLOWER."%' OR trim(standard_product_codes) LIKE '%".$srchhLOWER."%' OR trim(user_defined_sku_id) LIKE '%".$srchhLOWER."%' OR trim(`Product Description`) LIKE '%".$srchh."%' OR trim(manufacturer) LIKE '%".$srchh."%' OR trim(mfr_part_number) LIKE '%".$srchh."%' OR trim(`JetBrowseNodeID`) LIKE '%".$srchh."%' OR trim(brand) LIKE '%".$srchh."%' OR trim(`Bullet1`) LIKE '%".$srchh."%' OR trim(`Bullet2`) LIKE '%".$srchh."%' OR trim(`Bullet3`) LIKE '%".$srchh."%' OR trim(`Bullet4`) LIKE '%".$srchh."%' OR trim(`Bullet5`) LIKE '%".$srchh."%' OR trim(`Bullet6`) LIKE '%".$srchh."%' $SKuQryy) ";
	$MorQryBRN.=" and (trim(product_title) LIKE '%".$srchhSChar."%' OR trim(product_title) LIKE '%".$srchh."%' OR trim(product_title) LIKE '%".$srchh22."%' OR trim(item_price) LIKE '%".$srchh."%' OR trim(`standard_product_codes`) LIKE '%".$srchh."%' OR trim(user_defined_sku_id) LIKE '%".$srchh."%' OR trim(product_title) LIKE '%".$srchhLOWER."%' OR trim(standard_product_codes LIKE) '%".$srchhLOWER."%' OR trim(user_defined_sku_id) LIKE '%".$srchhLOWER."%' OR trim(`Product Description`) LIKE '%".$srchh."%' OR trim(manufacturer) LIKE '%".$srchh."%' OR trim(mfr_part_number) LIKE '%".$srchh."%' OR trim(`JetBrowseNodeID`) LIKE '%".$srchh."%' OR trim(brand) LIKE '%".$srchh."%' OR trim(`Bullet1`) LIKE '%".$srchh."%' OR trim(`Bullet2`) LIKE '%".$srchh."%' OR trim(`Bullet3`) LIKE '%".$srchh."%' OR trim(`Bullet4`) LIKE '%".$srchh."%' OR trim(`Bullet5`) LIKE '%".$srchh."%' OR trim(`Bullet6`) LIKE '%".$srchh."%' $SKuQryy) ";
}

//Sort Query
if($_GET["sort"]!="")
{
	if($_GET["sort"]=="Rated")
	{
			//$SoryQry="order by noofrating desc";
	}
	else if($_GET["sort"]=="Reviewed")
	{
			//$SoryQry="order by noofreviews desc";
	}
	else if($_GET["sort"]=="TitleDesc")
	{
			$SoryQry="order by product_title desc";
	}
	else if($_GET["sort"]=="TitleAsc")
	{
			$SoryQry="order by product_title asc";
	}
	else if($_GET["sort"]=="PriceDesc")
	{
			$SoryQry="order by item_price desc";
	}
	else if($_GET["sort"]=="PriceAsc")
	{
			$SoryQry="order by item_price asc";
	}
	else
	{
		$SoryQry="order by id desc";
	}	
}
else
{
	if($srchh!="")
	{
		$SoryQry="order by trim(product_title) LIKE '".$srchh22."%' desc";
	}
	else
	{
		$SoryQry="order by id desc";
	}	
}

if($srchh!="")
{
	$SoryQry="order by trim(product_title) LIKE '%".trim($srchh)."%' desc";
	$SKuQryy="";
	$ExploSrch=explode(" ",trim($srchh));
	$totalspaces=count($ExploSrch);
	for($ds=0;$ds<($totalspaces-1);$ds++)
	{
		$sepwrd=trim($ExploSrch[$ds]);
		if($sepwrd!="")
		{
			$ygsJOin.=trim($sepwrd)." ";
		}
	}
	if($ygsJOin!='')
	{
		$SoryQry.=", trim(product_title) LIKE '".trim($ygsJOin)."%' desc";
	}	
	
	for($ds=0;$ds<($totalspaces-2);$ds++)
	{
		$sepwrd=trim($ExploSrch[$ds]);
		if($sepwrd!="")
		{
			$ygsJOin2.=trim($sepwrd)." ";
		}
	}
	if($ygsJOin2!='')
	{
		$SoryQry.=", trim(product_title) LIKE '".trim($ygsJOin2)."%' desc";
	}	
	
	for($ds=0;$ds<($totalspaces-3);$ds++)
	{
		$sepwrd=trim($ExploSrch[$ds]);
		if($sepwrd!="")
		{
			$ygsJOin3.=trim($sepwrd)." ";
		}
	}
	if($ygsJOin3!='')
	{
		$SoryQry.=", trim(product_title) LIKE '".trim($ygsJOin3)."%' desc";
	}
	
	for($ds=1;$ds<($totalspaces);$ds++)
	{
		$sepwrd=trim($ExploSrch[$ds]);
		if($sepwrd!="")
		{
			$ygsJOin4.=trim($sepwrd)." ";
		}
	}
	if($ygsJOin4!='')
	{
		$SoryQry.=", trim(product_title) LIKE '".trim($ygsJOin4)."%' desc";
	}
}					
$SpecialQry="AND (user_defined_sku_id='16002' OR user_defined_sku_id='17777') ";
$get_temp="select `Product Description` as product_description,product_title,item_price,user_defined_sku_id,main_image_url,id,mfr_part_number,brand,standard_product_codes from mutual_searplusitems where main_image_url!='' and main_image_url is not null AND parent_id=0 $SpecialQry $MorQry $SoryQry"; 
$gets=mysql_query($get_temp);
$tot= mysql_affected_rows();

$pppttot=$tot;
$totalpages = (int) ($tot / $portfolioPERPAGE);
$get_temp .= " LIMIT $StartRow,$portfolioPERPAGE";
$get=mysql_query($get_temp);
$totalres=mysql_affected_rows();

if(($tot % $portfolioPERPAGE)!=0)
	$totalpages++;	
$page_totalpages=$totalpages*2;

$urlCCCC = "http" . ((!empty($_SERVER['HTTPS'])) ? "s" : "") . "://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
$_SESSION["S_BACKURL"]=$urlCCCC;

if($_REQUEST['Page']!='')
{
	$MetaDescription_JOIN.=" Page ".$_REQUEST['Page']." -";
	$MetaKeyword_JOIN.=" Page ".$_REQUEST['Page']." |";	
	$MetaPageTitle.=" Page ".$_REQUEST['Page']." |";	
}
if($_REQUEST['sort']!='')
{
	$MetaDescription_JOIN.=" by ".$_REQUEST['sort']." -";
	$MetaKeyword_JOIN.=" by ".$_REQUEST['sort']." |";	
	$MetaPageTitle.=" by ".$_REQUEST['sort']." |";	
}
if($_REQUEST['view']!='')
{
	$MetaDescription_JOIN.=" ".$_REQUEST['view']."/page -";
	$MetaKeyword_JOIN.=" ".$_REQUEST['view']."/page |";	
	$MetaPageTitle.=" ".$_REQUEST['view']."/page |";	
}
$MetaDescription_JOIN=trim($MetaDescription_JOIN)." ".$METADESCRIPTION;
$MetaKeyword_JOIN=trim($MetaKeyword_JOIN)." ".$METAKEYWORD;
$MetaPageTitle=trim($MetaPageTitle)." ".$METAKEYWORD;
$MetaPageTitle_LENGTH=strlen($MetaPageTitle);

/*if($MetaPageTitle_LENGTH>75)
{
	$MetaPageTitle=substr($MetaPageTitle,0,72)."...";
}*/
$DisplayH1Test=$MetaKeyword_JOIN;

$urlCCCCYGS=explode("?",$urlCCCC);
if($_REQUEST['brand']!='')
{
	$canonicalUrl=$SITE_URL."/search?brand=".trim($_REQUEST['brand']);
}
else
{
	$canonicalUrl=$urlCCCCYGS[0];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <base href="<?= $SITE_URL; ?>/" />
    <title><?= $MetaPageTitle; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1" name="viewport" />
    <meta name="description" content="<?= $MetaDescription_JOIN; ?>" />
    <meta name="keywords" content="<?= $MetaKeyword_JOIN; ?>" />
    <? include("favicon.php"); ?>
    <link rel="stylesheet" href="css/simplemenu.css">
    <link rel="stylesheet" type="text/css" href="css/style.css<?= $CSSLOAD; ?>" />
    <link rel="stylesheet" type="text/css" href="css/responsive.css<?= $CSSLOAD; ?>" />
    <? include("headermore.php"); ?>
    <script>
    function gogtoto(id) {
        qtyyX = 1;
        AddtoCartAjaxDtl(id, id, '', qtyyX);
    }

    function AddtoCartAjaxDtl(AddtoCartAjax_ID, itemid, price, quantity) {
        var http7333 = false;
        if (navigator.appName == "Microsoft Internet Explorer") {
            http7333 = new ActiveXObject("Microsoft.XMLHTTP");
        } else {
            http7333 = new XMLHttpRequest();
        }
        http7333.abort();
        http7333.open("GET", "ajax_validation.php?Type=AddtoCartAjax&itemid=" + itemid + "&price=" + price +
            "&quantity=" + quantity, true);
        http7333.onreadystatechange = function() {
            if (http7333.readyState == 4) {
                window.location.href = 'items-in-your-cart';
                return false;
            }
        }
        http7333.send(null);
    }

    function setsortgrid(id) {
        document.getElementById('sort2').value = id;
        document.frmsrch2.submit();
        return false;
    }

    function setpagegrid(id) {
        document.getElementById('view2').value = id;
        document.frmsrch2.submit();
        return false;
    }
    </script>
</head>

<body>
    <? include("top.php"); ?>
    <div class="middlewrapper">
        <div class="wrapper">
            <div class="category-main">
                <? include("left.php"); ?>
                <div class="category-right">
                    <h2>Discount Specials</h2>
                    <!-- <div class="breadcrumb-wrapper"><a class="test" href="<?= $SITE_URL; ?>">Home</a><?= $CatBrThb; ?>
                    </div> -->
                    <!-- <div class="category-title"><?=$CatBrThb1;?></div> -->
                    <div class="category-box-main">
                        <? if($pppttot>0){?>
                        <? $iII=0;$iIIXXX=0;
				for ($i=$StartRow;$i<($StartRow+$portfolioPERPAGE) && $i<($pppttot);$i++) 
				{ 
				  $SelMovieObj=mysql_fetch_object($get);
				  
				  $SelRat="SELECT COUNT(id) as totreview, AVG(rating) as totrating FROM mutual_reviews where vid='".addslashes($SelMovieObj->id)."' and status='Y' ";
				  $SelRatRes=mysql_query($SelRat);
				  $RatRow=mysql_fetch_object($SelRatRes);
				  $average=$RatRow->totrating;
				  
				  $tittl=stripslashes($SelMovieObj->product_title);
				  $tittl=str_replace("&quot;",'"',$tittl);
				  $tittlXX=$tittl;
				  
				  $image_url=$IMGPATHURL."Products/croped/".stripslashes($SelMovieObj->main_image_url);
				  //$image_url=stripslashes($SelMovieObj->main_image_url);
				  /*if(!file_exists($image_url))
				  {
						$image_url=stripslashes($SelMovieObj->main_image_url);
						$image_url=str_replace("https://www.mutualindustries.net/","",$image_url);
						$image_url=str_replace("http://www.mutualindustries.net/","",$image_url);
						$image_url="goodthumbOri.php?src=".$image_url."&w=186&h=194";
				  }*/
					$inventory='0';
					$JetQtyRs=mysql_query("SELECT `Inventory` FROM mutual_products_inventory WHERE user_defined_sku_id like '".stripslashes($SelMovieObj->user_defined_sku_id)."%'");
					$TotgetJetError=mysql_affected_rows();
					if($TotgetJetError>0)
					{
						$getJetErrorQryRow=mysql_fetch_array($JetQtyRs);
						$inventory=$getJetErrorQryRow['Inventory'];
					}
					$inventory=150;
					$ItmUrl=Get_ProductUrl($SelMovieObj->id);
			  ?>
                        <div class="category-box">
                            <div class="category-img">
                                <? if($image_url!=''){?><a href="<?=$ItmUrl;?>"><img
                                        src="<?=stripslashes($image_url);?>"
                                        alt="<?=stripslashes($SelMovieObj->user_defined_sku_id);?>, <?=stripslashes($SelMovieObj->product_title);?>, <?=$siteALTTXT;?>"
                                        title="<?=stripslashes($SelMovieObj->user_defined_sku_id);?>, <?=stripslashes($SelMovieObj->product_title);?>, <?=$siteALTTXT;?>" /></a>
                                <? }else{ ?><img src="noimg.jpg" style="max-height:170px;"
                                    alt="<?=stripslashes($SelMovieObj->user_defined_sku_id);?>, <?=stripslashes($SelMovieObj->product_title);?>, <?=$siteALTTXT;?>"
                                    title="<?=stripslashes($SelMovieObj->user_defined_sku_id);?>, <?=stripslashes($SelMovieObj->product_title);?>, <?=$siteALTTXT;?>">
                                <? } ?>
                            </div>

                            <div class="category-img-detail">
                                <div class="category-img-title"><a
                                        href="<?= $ItmUrl; ?>"><?= stripslashes($tittl); ?></a></div>
                                <div class="category-part-number"> Part#
                                    <?= $SelMovieObj->user_defined_sku_id; ?></div>
                                <p><span></span>
                                    <?= str_replace('','  ',substr(strip_tags(stripslashes($SelMovieObj->product_description), "<a><b><i></a></b></i><br></br><u></u>"), 0, 65)); ?>... 
                                </p>
                                <? if ($inventory > 0) { ?>
                                <div class="category-bottom-box"> <a href="<?= $ItmUrl; ?>">More Info</a> </div>
                                <? } else { ?>
                                <div class="category-bottom-box"> <a href="#" onClick="return false;">Out of Stock</a>
                                </div>
                                <? } ?>

                            </div>

                        </div>
                        <? } ?>

                        <div class="clear"></div>
                        <? if ($pppttot > $ShowPage) { ?>
                        <div class="pagging">
                            <? if ($PageNo > 1) {   																			$PrevPageNo = $PageNo - 1; ?><a
                                href="<?= $PaginUrrl; ?>Page=<?= $PrevPageNo; ?>" class="butt">&laquo;<span
                                    class="mobpg"> Previous</span></a></li>
                            <? } ?>
                            <? if ($PageNo <= 10) {
										for ($i = 1; $i <= $totalpages, $i <= 10; $i++) {
											if ($i > 10 || $i > $totalpages)
												break;
											if ($PageNo == $i) {
									?><a href="<?= $PaginUrrl; ?><? if ($i > 1) { ?>Page=<?= $i; ?><? } ?>" class="active"><?= $i; ?></a>
                            <?
																																		} else {
																																			?><a
                                href="<?= $PaginUrrl; ?><? if ($i > 1) { ?>Page=<?= $i; ?><? } ?>"><?= $i; ?></a>
                            <?
																																																								}
																																																							}
																																																						} else {
																																																							$temp = $PageNo - ($PageNo % 10);
																																																							if ($PageNo % 10 == 0)
																																																								$temp = $PageNo - 9;
																																																							else $temp = $temp + 1;

																																																							if ($temp + 9 > $totalpages)
																																																								$temp1 = $totalpages;
																																																							else
																																																								$temp1 = $temp + 9;
																																																							for ($i = $temp; $i <= $temp1; $i++) {
																																																								if ($i > $totalpages)
																																																									break;

																																																								if ($PageNo == $i) {
																																																									?><a
                                href="<?= $PaginUrrl; ?><? if ($i > 1) { ?>Page=<?= $i; ?><? } ?>"
                                class="active"><?= $i; ?></a>
                            <?
																																																																																		} else { ?><a
                                href="<?= $PaginUrrl; ?><? if ($i > 1) { ?>Page=<?= $i; ?><? } ?>"><?= $i; ?></a>
                            <? }
																																																																																																								}
																																																																																																							} ?>
                            <? if ($PageNo < $totalpages) {
										$NextPageNo = $PageNo + 1; ?>
                            <a href="<?= $PaginUrrl; ?>Page=<?= $NextPageNo; ?>" class="butt"><span class="mobpg">Next
                                </span>&raquo;</a>
                            <? } ?>
                        </div>
                        <? } ?>


                        <div class="clear">&nbsp;</div>
                        <? } else { ?>
                        <div class="clear">&nbsp;</div>
                        <div class="clear" align="center" style="min-height:300px;"><strong>No matching records
                                found.</strong></div>
                        <div class="clear">&nbsp;</div>
                        <? } ?>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <? include("footer.php"); ?>
        <link rel="stylesheet" type="text/css" href="css/font-awesome.css" />
        <script src="js/simplemenu.js"></script>
        <script type="text/javascript" src="js/scriptbreaker-multiple-accordion-1.js"></script>
        <? include("dbclose.php"); ?>
</body>

</html>