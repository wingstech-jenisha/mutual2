<? 
include("connect.php");

$TopTab="Cat"; 
$MorQry="";
$Catid=trim(addslashes(($_GET["id"])));
$urlCCCC = "http" . ((!empty($_SERVER['HTTPS'])) ? "s" : "") . "://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
//echo $_SERVER['QUERY_STRING'];
$CatOrQry="";

if($Catid!='')
{
	$CattQry="SELECT jet_node_id FROM mutual_category WHERE parent_id='".$Catid."' order by sortorder asc";
	$CattRes=mysql_query($CattQry);
	if(mysql_affected_rows()>0)
	{
		while($CattRow=mysql_fetch_array($CattRes))
		{
			$CatSID=stripslashes($CattRow["jet_node_id"]);
			$CatOrQry.=" or concat(',',concat(JetBrowseNodeID,','))  like '%,".$CatSID.",%'";
			
			$CattQry2="SELECT jet_node_id FROM mutual_category WHERE parent_id='".$CatSID."' order by sortorder asc";
			$CattRes2=mysql_query($CattQry2);
			if(mysql_affected_rows()>0)
			{
				while($CattRow2=mysql_fetch_array($CattRes2))
				{
					$CatPID=stripslashes($CattRow2["jet_node_id"]);
					$CatOrQry.=" or concat(',',concat(JetBrowseNodeID,','))  like '%,".$CatPID.",%'";
					
					$CattQry3="SELECT jet_node_id FROM mutual_category WHERE parent_id='".$CatPID."' order by sortorder asc";
					$CattRes3=mysql_query($CattQry3);
					if(mysql_affected_rows()>0)
					{
						while($CattRow3=mysql_fetch_array($CattRes3))
						{
							$CatPID2=stripslashes($CattRow3["jet_node_id"]);
							$CatOrQry.=" or concat(',',concat(JetBrowseNodeID,','))  like '%,".$CatPID2.",%' ";
						}
					}
				}
			}
		}
	}
	
}

if($Catid!="")
{
	$PaginUrrl=GetUrl_Catt($Catid)."?"; $FormUrrl=GetUrl_Catt($Catid);
	$MorQry=" and (concat(',',concat(JetBrowseNodeID,','))  like '%,".$Catid.",%' $CatOrQry)";
}

if($_GET["keyword"]!=""){ $PaginUrrl.="keyword=".$_GET["keyword"]."&"; }
if($_GET["sort"]!=""){ $PaginUrrl.="sort=".$_GET["sort"]."&"; }if($_GET["brand"]!=""){ $PgUrls.="brand=".$_GET["brand"]."&"; }
if($_GET["view"]!=""){ $PaginUrrl.="view=".$_GET["view"]."&"; }
if($_GET["type"]!=""){ $PaginUrrl.="type=".$_GET["type"]."&"; }
if($PaginUrrl!=""){ $PaginUrrl=substr($PaginUrrl,0,-1); }
if($_GET["sort"]!="" || $_GET["view"]!="" || $_GET["type"]!="")
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
		$SoryQry="order by id asc";
}
$get_temp="select product_title,item_price,user_defined_sku_id,main_image_url,id,mfr_part_number,brand,standard_product_codes from mutual_searplusitems where main_image_url!='' and main_image_url is not null AND parent_id=0 $SpecialQry $MorQry $SoryQry"; 
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

$Cattitle=stripslashes(GetName1("mutual_category","jet_node_name",'jet_node_id',$Catid));
/*$Catid2=stripslashes(GetName1("mutual_category","parent_id",'jet_node_id',$Catid));
$Cattitle2=stripslashes(GetName1("mutual_category","jet_node_name",'jet_node_id',$Catid2));
$Catid3=stripslashes(GetName1("mutual_category","parent_id",'jet_node_id',$Catid));
$Cattitle3=stripslashes(GetName1("mutual_category","jet_node_name",'jet_node_id',$Catid3));*/

$CatBrThb="";
if($Catid!='')
{
	$CattQry="SELECT jet_node_name,parent_id,jet_node_id FROM mutual_category WHERE jet_node_id='".$Catid."'";
	$CattRes=mysql_query($CattQry);
	if(mysql_affected_rows()>0)
	{
		$CattRow=mysql_fetch_array($CattRes);
		$CatNm=stripslashes($CattRow["jet_node_name"]);$CatPID=stripslashes($CattRow["parent_id"]);		
		$CatBrThb='<a href="'.GetUrl_Catt($Catid).'">'.$CatNm.'</a>';
		if($CatPID>0)
		{
			$CattQry2="SELECT jet_node_name,parent_id,jet_node_id FROM mutual_category WHERE jet_node_id='".$CatPID."'";
			$CattRes2=mysql_query($CattQry2);
			if(mysql_affected_rows()>0)
			{
				$CattRow2=mysql_fetch_array($CattRes2);
				$CatNm=stripslashes($CattRow2["jet_node_name"]);$CatPID=stripslashes($CattRow2["parent_id"]);
				$CatBrThb='<a href="'.GetUrl_Catt($CattRow2['jet_node_id']).'">'.$CatNm.' |
				</a>'.$CatBrThb;
				if($CatPID>0)
				{
					$CattQry3="SELECT jet_node_name,parent_id,jet_node_id FROM mutual_category WHERE jet_node_id='".$CatPID."'";
					$CattRes3=mysql_query($CattQry3);
					if(mysql_affected_rows()>0)
					{
						$CattRow3=mysql_fetch_array($CattRes3);
						$CatNm=stripslashes($CattRow3["jet_node_name"]);$CatPID=stripslashes($CattRow3["parent_id"]);
						$CatBrThb='<a href="'.GetUrl_Catt($CattRow3['jet_node_id']).'">'.$CatNm.'|
						</a>'.$CatBrThb;
					}
				}
			}
		}
	}
}


$MetaDescription_JOIN="Buy ".$Cattitle." products online at low prices on MutualIndustries.net,";
$MetaKeyword_JOIN=$Cattitle." for sale";	
$MetaPageTitle=$Cattitle." for sale";	

if($_REQUEST['type']!='')
{
	$MetaDescription_JOIN.=" ".$_REQUEST['type']." View - ";
	$MetaKeyword_JOIN.=" ".$_REQUEST['type']." Vimutualew, ";	
	$MetaPageTitle.=" ".$_REQUEST['type']." View, ";	
}
/*else
{
	$MetaDescription_JOIN.=" Grid View - ";
	$MetaKeyword_JOIN.=" Grid View, ";
	$MetaPageTitle.=" Grid View,";	
}*/

if($_REQUEST['Page']!='')
{
	$MetaDescription_JOIN.=" Page ".$_REQUEST['Page']." -";
	$MetaKeyword_JOIN.=" Page ".$_REQUEST['Page'].",";	
	$MetaPageTitle.=" | Page ".$_REQUEST['Page']." ";
}
if($_REQUEST['sort']!='')
{
	$MetaDescription_JOIN.=" by ".$_REQUEST['sort']." -";
	$MetaKeyword_JOIN.=" by ".$_REQUEST['sort'].",";	
	$MetaPageTitle.=" | by ".$_REQUEST['sort']."";	
}
if($_REQUEST['view']!='')
{
	$MetaDescription_JOIN.=" ".$_REQUEST['view']." /page -";
	$MetaKeyword_JOIN.=" ".$_REQUEST['view']." /page,";	
	$MetaPageTitle.=" ".$_REQUEST['view']." /page,";	
}


if (strpos($_SERVER['QUERY_STRING'], '&') !== false) {$CattitleJoin="Sort ";}

$MetaDescription_JOIN=trim($MetaDescription_JOIN)." ".$METADESCRIPTION;
$MetaKeyword_JOIN=trim($MetaKeyword_JOIN)." ".$METAKEYWORD;
$MetaPageTitle=trim($MetaPageTitle)." by ".$METAKEYWORD;
$MetaPageTitle_LENGTH=strlen($MetaPageTitle);

if($MetaPageTitle_LENGTH>75)
{
	$MetaPageTitle=substr($MetaPageTitle,0,72)."...";
}

$urlCCCCYGS=explode("?",$urlCCCC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Mutualindustries</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <link rel="stylesheet" href="css/carouseller.css">
    <link rel="stylesheet" type="text/css" href="css/slick.css">
    <link rel="stylesheet" type="text/css" href="css/slick-theme.css">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/responsive.css" />
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css" />

</head>

<body>
    <? include("top.php"); ?>
    <div class="middlewrapper">
        <div class="wrapper">
            <div class="category-main">
                <? include("left.php"); ?>
                <div class="category-right">
                    <div class="category-right-link">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li>|</li>
                            <li><a href="#">Products </a></li>
                            <li>|</li>
                            <li>MiViz Safety Vests and Apparel</li>
                        </ul>
                    </div>
                    <div class="category-title"> <?=$CatBrThb;?></div>
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
								
								$inventory='0';
								$JetQtyRs=mysql_query("SELECT `Inventory` FROM mutual_products_inventory_2 WHERE user_defined_sku_id like '".stripslashes($SelMovieObj->user_defined_sku_id)."%'");
								$TotgetJetError=mysql_affected_rows();
								if($TotgetJetError>0)
								{
									$getJetErrorQryRow=mysql_fetch_array($JetQtyRs);
									$inventory=$getJetErrorQryRow['Inventory'];
								}
								else
								{
									$inventory=150;
								}
								$ItmUrl=Get_ProductUrl($SelMovieObj->id);
								$imageALT=stripslashes($SelMovieObj->user_defined_sku_id).", ".stripslashes($SelMovieObj->product_title).", ".$siteALTTXT;
								$imageALT=str_replace('"','',$imageALT);								
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
                            <div class="category-img-detail" style="text-align: center;">
                                <div class="category-img-title"><a
                                        href="<?= $ItmUrl; ?>"><?= stripslashes($tittl); ?></a></div>
                                <div class="category-part-number"> <span>SKU#
                                        <?= $SelMovieObj->user_defined_sku_id; ?></span></div>
                                <span class="price">$<?= stripslashes($SelMovieObj->item_price); ?></span>
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
                        <?}?>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <? include("footer.php"); ?>

    <!-- <script>
    function AddToWatchList(vehicleid) {
        var http2SF = false;
        if (navigator.appName == "Microsoft Internet Explorer") {
            http2SF = new ActiveXObject("Microsoft.XMLHTTP");
        } else {
            http2SF = new XMLHttpRequest();
        }
        http2SF.abort();
        http2SF.open("GET", "ajax_validation.php?Type=AddToWatchListSEAERCH&vehicleid=" + vehicleid, true);
        document.getElementById("AddToWatchListID" + vehicleid).innerHTML = "Please wait...";
        http2SF.onreadystatechange = function() {
            if (http2SF.readyState == 4) {
                if (http2SF.responseText == "Added") {
                    document.getElementById("AddToWatchListID" + vehicleid).innerHTML = "Added to watch list.";
                    return false;
                }
                if (http2SF.responseText == "Already added") {
                    document.getElementById("AddToWatchListID" + vehicleid).innerHTML = "Added to watch list.";
                    return false;
                }
                if (http2SF.responseText == "NotLoggedin") {
                    document.getElementById("AddToWatchListID" + vehicleid).innerHTML =
                        "Please login to add in watch list.";
                    return false;
                }
            }
        }
        http2SF.send(null);
    }
    </script> -->
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css" />
    <script src="js/simplemenu.js"></script>
    <script type="text/javascript" src="js/scriptbreaker-multiple-accordion-1.js"></script>
    <script language="JavaScript">
    $(document).ready(function() {
        $(".topnav").accordion({
            accordion: false,
            speed: 500,
            closedSign: '<i class="fa fa-plus"></i>',
            openedSign: '<i class="fa fa-minus"></i>'
        });
    });

    function openNav() {
        document.getElementById("myNav").style.width = "100%";
    }

    function closeNav() {
        document.getElementById("myNav").style.width = "0%";
    }
    </script>
    <script language="JavaScript">
    $(document).ready(function() {
        $(".topnav").accordion({
            accordion: false,
            speed: 500,
            closedSign: '<i class="fa fa-plus"></i>',
            openedSign: '<i class="fa fa-minus"></i>'
        });
    });
    </script>
    <script>
    < script >
        $(document).ready(function() {
            $(".pro-head").click(function() {
                $(".footer-pro-link").toggle();
            });
        });
    $(document).ready(function() {
        $(".about-head").click(function() {
            $(".footer-about-link").toggle();
        });
    });
    $(document).ready(function() {
        $(".account-head").click(function() {
            $(".footer-acc-link").toggle();
        });
    });
    $(document).ready(function() {
        $(".service-head").click(function() {
            $(".footer-service-link").toggle();
        });
    });
    </script>
    <script>
    $(document).ready(function() {
        $(".responsive-category-left-title").click(function() {
            $(".category-list").toggle();
        });
    });
    </script>
    <script>
    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("shows");
    }

    function myFunction1() {
        document.getElementById("myDropdown1").classList.toggle("shows");
    }

    function myFunction2() {
        document.getElementById("myDropdown2").classList.toggle("shows");
    }

    function myFunction3() {
        document.getElementById("myDropdown3").classList.toggle("shows");
    }

    function myFunction4() {
        document.getElementById("myDropdown4").classList.toggle("shows");
    }
    </script>
    <script>
	$(document).ready(function(){
	  $(".responsive-category-left-title").click(function(){
		$(".category-list").toggle();
	  });
	});
</script>
    <? include("dbclose.php"); ?>
</body>

</html>