<? 
$page='spec_sheet';
include("connect.php");
$DisplayH1="";
$TopTab="Sheet"; 
$MorQry="";$MorQryBRN="";
$urlCCCC = "http" . ((!empty($_SERVER['HTTPS'])) ? "s" : "") . "://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
$PaginUrrl="spec-sheets";
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
	$portfolioPERPAGE=($_GET["view"]);
    $ShowPage=($_GET["view"]);
    $Numm=($_GET["view"]);
}
$portfolioPERPAGE=20;
$ShowPage=20;
$Numm=20;
$_SESSION["SPERPAGELST"]=$portfolioPERPAGE;

if($_REQUEST['Page']>0 )
	$PageNo = ($_REQUEST['Page']);		
else
	$PageNo = 1;
if(!$StartRow1)
	$StartRow =   $portfolioPERPAGE * ($PageNo-1);
else
	$StartRow = $StartRow1;	


$SoryQry="order by id desc";				
$get_temp="select mutual_searplusitems.product_title,mutual_searplusitems.item_price,mutual_searplusitems.user_defined_sku_id,mutual_searplusitems.main_image_url,mutual_searplusitems.id,mutual_searplusitems.mfr_part_number,mutual_searplusitems.brand,mutual_searplusitems.standard_product_codes from 
mutual_searplusitems,mutual_product_specification
where 
mutual_product_specification.user_defined_sku_id=mutual_searplusitems.user_defined_sku_id  AND
mutual_product_specification.filename!='' AND mutual_searplusitems.parent_id=0 group by mutual_product_specification.user_defined_sku_id $SoryQry "; 
// $get_temp="select mutual_searplusitems.product_title,mutual_searplusitems.item_price,mutual_searplusitems.user_defined_sku_id,mutual_searplusitems.main_image_url,mutual_searplusitems.id,mutual_searplusitems.mfr_part_number,mutual_searplusitems.brand,mutual_searplusitems.standard_product_codes from 
// mutual_searplusitems,mutual_product_specification
// where 
// mutual_product_specification.user_defined_sku_id=mutual_searplusitems.user_defined_sku_id"; 
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
</head>

<body>
    <? include("top.php"); ?>
    <div class="middlewrapper">
        <div class="wrapper">
            <div class="category-main">
                <!-- <div class="category-right"> -->
                <div class="category-right-link">
                    <div class="category-title">SPEC SHEETS</div>
                </div>
                <div class="category-box-main">
                    <? if($pppttot>0){?>
                    <? $iII=0;$iIIXXX=0;
                        for ($i=$StartRow;$i<($StartRow+$portfolioPERPAGE) && $i<($pppttot);$i++) 
                        { 
                            $SelMovieObj=mysql_fetch_object($get);                            
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
                            $ItmUrl=Get_ProductUrl($SelMovieObj->id);
                    ?>

                    <div class="category-box">
                        <div class="category-img cat_img">
                            <? if($image_url!=''){?>
                            <a href="<?=$ItmUrl;?>"><img src="<?=stripslashes($image_url);?>" alt="<?=stripslashes($SelMovieObj->user_defined_sku_id);?>,
                                             <?=stripslashes($SelMovieObj->product_title);?>, 
                                             <?=$siteALTTXT;?>"
                                    title="<?=stripslashes($SelMovieObj->user_defined_sku_id);?>, <?=stripslashes($SelMovieObj->product_title);?>, <?=$siteALTTXT;?>" /></a>
                            <? }else{ ?><img src="noimg.jpg" style="max-height:170px;" alt="<?=stripslashes($SelMovieObj->user_defined_sku_id);?>, 
                                        <?=stripslashes($SelMovieObj->product_title);?>, 
                                        <?=$siteALTTXT;?>" title="<?=stripslashes($SelMovieObj->user_defined_sku_id);?>, 
                                        <?=stripslashes($SelMovieObj->product_title);?>,
                                         <?=$siteALTTXT;?>">
                            <? } ?>
                        </div>
                        <div class="category-img-detail">
                            <div class="category-img-title">
                                <a href="<?=$ItmUrl;?>"><?=stripslashes($tittl);?></a>
                            </div>
                            <div class="category-part-number">
                                Part# <?=$SelMovieObj->user_defined_sku_id;?>
                            </div>
                            <?
                                            $SpecQur="select * from mutual_product_specification where user_defined_sku_id='".$SelMovieObj->user_defined_sku_id."' and filename!=''";
                                            $SpecRes=mysql_query($SpecQur);
                                            $SpecTot=mysql_affected_rows();
                                            if($SpecTot>0)
                                        {?>
                            <p>
                                <? while($SpecRow=mysql_fetch_array($SpecRes))
                                            {?>
                                <? echo strip_tags(stripslashes($SpecRow['description']));?>
                                <img alt="application/pdf icon" src="images/application-pdf.png" align="absmiddle">

                                <a style="font-weight: normal;font-size: 12px;text-decoration:underline;"
                                    href="files/<?php echo stripslashes($SpecRow['filename']);?>" type="application/pdf"
                                    target="_blank"><?php echo stripslashes($SpecRow['filename']);?></a><br>

                                <? }?>
                            </p>
                            <? }?>
                        </div>
                    </div>
                    <? } ?>
                    <div class="clear"></div>
                    <? if ($pppttot>$ShowPage) { ?>
                    <div class="pagging">
                        <? if($PageNo>1){ $PrevPageNo = $PageNo -1;?>
                        <a href="<?=$PaginUrrl;?>Page=<?=$PrevPageNo;?>" class="butt">&laquo;<span class="mobpg">
                                Previous</span></a></li>
                        <? } ?>
                        <? if($PageNo<=10)
			{
				for($i=1;$i<=$totalpages,$i<=10;$i++)
				{
					if($i>10 || $i>$totalpages)
						break;
					if($PageNo==$i)
					{
						?><a href="<?=$PaginUrrl;?><? if($i>1){?>Page=<?=$i;?><? }?>" class="active"><?=$i;?></a>
                        <? 
					}
					else
					{ 
					?><a href="<?=$PaginUrrl;?><? if($i>1){?>Page=<?=$i;?><? }?>"><?=$i;?></a>
                        <? 
					}
				} 
			}
			else
			{
				$temp=$PageNo-($PageNo%10);
				if($PageNo%10==0)
					$temp=$PageNo-9;
				else $temp=$temp+1;
	
				if($temp+9>$totalpages)
					$temp1=$totalpages;
				else
					$temp1=$temp+9;
				for($i=$temp;$i<=$temp1;$i++){
					if($i>$totalpages)
						break;
			
				if($PageNo==$i) { 									
				?><a href="<?=$PaginUrrl;?><? if($i>1){?>Page=<?=$i;?><? }?>" class="active"><?=$i;?></a>
                        <? 
				}else{ ?><a href="<?=$PaginUrrl;?><? if($i>1){?>Page=<?=$i;?><? }?>"><?=$i;?></a>
                        <? } 
			  }
		   } ?>
                        <? if($PageNo<$totalpages){ $NextPageNo = $PageNo + 1;?>
                        <a href="<?=$PaginUrrl;?>Page=<?=$NextPageNo;?>" class="butt"><span class="mobpg">Next
                            </span>&raquo;</a>
                        <? } ?>
                    </div>
                    <? } ?>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <? }?>
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