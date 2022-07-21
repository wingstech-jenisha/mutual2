<?

include("connect.php");
$TopTab = "Home";
$CMSQry = "select * from mutual_staticpage where id='1'";
$CMSRes = mysql_query($CMSQry);
$CMSRow = mysql_fetch_object($CMSRes);
$pgtitle = trim(stripslashes($CMSRow->pgtitle));
$meta_desc = trim(stripslashes($CMSRow->meta_desc));
$meta_kwords = trim(stripslashes($CMSRow->meta_kwords));
$Home_name = stripslashes($CMSRow->name);
$Home_content = stripslashes($CMSRow->content);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <title>Flagging Direct - Quality Construction, Safety, Surveying, Geotextiles, and Erosion Control Products | Flagging Direct</title>
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
    <? include("headermore.php"); ?>

</head>

<body>
    <? include("top.php"); ?>
    <div class="middlewrapper">

        <? $HomBnrQry = "select * from mutual_banner order by sortorder asc";
        $HomBnrRes = mysql_query($HomBnrQry);
        if (mysql_affected_rows() > 0) { ?>
            <div class="slider-main">
                <div class="single-item">
                    <? while ($HomBnrRow = mysql_fetch_object($HomBnrRes)) {
                        $bnrtext = stripslashes($HomBnrRow->content);
                        $bnrtext = str_replace("s_detail", "banner-text", $bnrtext); ?>

                        <div>
                            <img src="<?= $IMGPATHURL; ?>banner/<?= stripslashes($HomBnrRow->image); ?>" alt="">
                            <? if ($bnrtext != '') { ?>

                                <div class="single-item-deta">
                                    <div class="single-item-deta-title"><?= stripslashes(strip_tags($bnrtext, "</br><br>\n")); ?></div>
                                </div>
                            <? } ?>

                        </div>
                    <? } ?>

                </div>
            </div>
        <? } ?>
        <div class="special-deals-deta">
            <div class="wrapper">
                <h3 class="middle-head">LOOK AT THESE LOW PRICES!</h3>
                <div class="special-deals-detail">
                    <?
                    $FeaturedQry = "AND (user_defined_sku_id='16001' OR user_defined_sku_id='16002' OR user_defined_sku_id='BK751' OR user_defined_sku_id='15903') ";
                    $get_temp = "select product_title,item_price,user_defined_sku_id,main_image_url,id,mfr_part_number,brand,standard_product_codes,package_length_inches,package_width_inches,package_height_inches from mutual_searplusitems where main_image_url!='' and main_image_url is not null $FeaturedQry group by user_defined_sku_id order by rand() asc";
                    $gets = mysql_query($get_temp);
                    $tot = mysql_affected_rows();
                    if ($tot > 0) {
                        while ($SelMovieObj = mysql_fetch_object($gets)) {

                            $SelRat = "SELECT COUNT(id) as totreview, AVG(rating) as totrating FROM mutual_reviews where vid='" . addslashes($SelMovieObj->id) . "' and status='Y' ";
                            $SelRatRes = mysql_query($SelRat);
                            $RatRow = mysql_fetch_object($SelRatRes);
                            $average = $RatRow->totrating;

                            $tittl = stripslashes($SelMovieObj->product_title);
                            $tittl = str_replace("&quot;", '"', $tittl);
                            $tittlXX = $tittl;

                            $image_url = $IMGPATHURL . "Products/croped/" . stripslashes($SelMovieObj->main_image_url);
                            //$image_url=stripslashes($SelMovieObj->main_image_url);
                            /*if(!file_exists($image_url))
            {
                $image_url=stripslashes($SelMovieObj->main_image_url);
                $image_url=str_replace("https://www.mutualindustries.net/","",$image_url);
                $image_url=str_replace("http://www.mutualindustries.net/","",$image_url);
                $image_url="goodthumbOri.php?src=".$image_url."&w=166&h=166";
            }*/
                            $inventory = '0';
                            $JetQtyRs = mysql_query("SELECT `Inventory` FROM mutual_products_inventory WHERE user_defined_sku_id like '" . stripslashes($SelMovieObj->user_defined_sku_id) . "%'");
                            $TotgetJetError = mysql_affected_rows();
                            if ($TotgetJetError > 0) {
                                $getJetErrorQryRow = mysql_fetch_array($JetQtyRs);
                                $inventory = $getJetErrorQryRow['Inventory'];
                            }
                            $ItmUrl = Get_ProductUrl($SelMovieObj->id);
                            $imageALT = stripslashes($SelMovieObj->user_defined_sku_id) . ", " . stripslashes($SelMovieObj->product_title) . ", " . $siteALTTXT;
                            $imageALT = str_replace('"', '', $imageALT);
                    ?>
                            <div class="special-deals-box">
                                <div class="special-deals-box-in">
                                    <div class="sd-img"><a href="<?= $ItmUrl; ?>"><? if ($image_url != '') { ?><img src="<?= stripslashes($image_url); ?>" alt="<?= stripslashes($imageALT); ?>" title="<?= stripslashes($imageALT); ?>" /><? } else { ?><img src="noimg.jpg" style="max-height:170px;" alt="<?= stripslashes($imageALT); ?>" title="<?= stripslashes($imageALT); ?>"><? } ?></a></div>
                                    <div class="sd-img-detail">
                                        <h4><a href="<?= $ItmUrl; ?>"><?= stripslashes($tittl); ?></a></h4>
                                        <? if ($SelMovieObj->package_length_inches != '') { ?><p><? echo stripslashes($SelMovieObj->package_length_inches) . '" x ' . stripslashes($SelMovieObj->package_width_inches) . '" x ' . stripslashes($SelMovieObj->package_height_inches); ?></p><? } ?>
                                        <span class="part-deta"><b>SKU# <?= $SelMovieObj->user_defined_sku_id; ?></b></span> <span class="r-price-deta"><b>Price: $<?= stripslashes($SelMovieObj->item_price); ?></b></span>
                                        <!-- <span class="s-price-deta"> <b>Special Price <br>
              <i>$19</i> /Each</b> </span>
              <p><small>20 Bags Per Box <br>
                72 Boxes Per Pallet</small></p>-->
                                    </div>
                                </div>
                            </div>
                            <? } ?><? } ?>
                            <div class="clear"></div>
                </div>
            </div>
        </div>
        <!-- <div class="featured-products">
            <div class="wrapper">
                <div class="featured-products-title">Featured Products</div>
                <div class="featured-products-box-main">

                    <? $FeaturedQry = "AND (user_defined_sku_id='14993' OR user_defined_sku_id='16001' OR user_defined_sku_id='15903' OR user_defined_sku_id='16002' OR user_defined_sku_id='14981' OR user_defined_sku_id='17777' OR user_defined_sku_id='16343' OR user_defined_sku_id='14640-4' OR user_defined_sku_id='15900' OR user_defined_sku_id='14899' OR user_defined_sku_id='A346' OR user_defined_sku_id='3200' OR user_defined_sku_id='16342' OR user_defined_sku_id='50078' OR user_defined_sku_id=' 14967' OR user_defined_sku_id='14505' OR user_defined_sku_id='17779' OR user_defined_sku_id='50064' OR user_defined_sku_id='14646-0') ";
                    $get_temp = "select product_title,item_price,user_defined_sku_id,main_image_url,id,mfr_part_number,brand,standard_product_codes from mutual_searplusitems where main_image_url!='' and main_image_url is not null AND parent_id=0 $FeaturedQry order by rand() asc";
                    $gets = mysql_query($get_temp);
                    $tot = mysql_affected_rows();
                    if ($tot > 0) {
                        while ($SelMovieObj = mysql_fetch_object($gets)) {

                            $image_url = $IMGPATHURL . "Products/croped/" . stripslashes($SelMovieObj->main_image_url);
                            //$image_url=stripslashes($SelMovieObj->main_image_url);
                            /*if(!file_exists($image_url))
            {
                $image_url=stripslashes($SelMovieObj->main_image_url);
                $image_url=str_replace("https://www.mutualindustries.net/","",$image_url);
                $image_url=str_replace("http://www.mutualindustries.net/","",$image_url);
                $image_url="goodthumbOri.php?src=".$image_url."&w=166&h=166";
            }*/
                            $inventory = '0';
                            $JetQtyRs = mysql_query("SELECT `Inventory` FROM mutual_products_inventory_2 WHERE user_defined_sku_id like '" . stripslashes($SelMovieObj->user_defined_sku_id) . "%'");
                            $TotgetJetError = mysql_affected_rows();
                            if ($TotgetJetError > 0) {
                                $getJetErrorQryRow = mysql_fetch_array($JetQtyRs);
                                $inventory = $getJetErrorQryRow['Inventory'];
                            } else {
                                $inventory = 150;
                            }
                            $ItmUrl = Get_ProductUrl($SelMovieObj->id);
                            $imageALT = stripslashes($SelMovieObj->user_defined_sku_id) . ", " . stripslashes($SelMovieObj->product_title) . ", " . $siteALTTXT;
                            $imageALT = str_replace('"', '', $imageALT);
                    ?>
                            <div class="featured-products-box">
                                <div class="featured-products-box-in">
                                    <div class="featured-products-img"><? if ($image_url != '') { ?><a href="<?= $ItmUrl; ?>"><img src="<?= stripslashes($image_url); ?>" alt="<?= stripslashes($imageALT); ?>" title="<?= stripslashes($imageALT); ?>" /></a><? } else { ?><img src="noimg.jpg" style="max-height:170px;" alt="<?= stripslashes($imageALT); ?>" title="<?= stripslashes($imageALT); ?>"><? } ?></div>
                                    <div class="featured-products-img-detail">
                                        <h4><a href="<?= $ItmUrl; ?>"><?= stripslashes($SelMovieObj->product_title); ?></a></h4>
                                        <span class="part-deta"><b>SKU# <?= stripslashes($SelMovieObj->user_defined_sku_id); ?></b></span> <span class="r-price-deta"><b>Price: $<?= stripslashes($SelMovieObj->item_price); ?></b></span>
                                    </div>
                                </div>
                            </div>
                            <? } ?><? } ?>
                </div>

            </div>
        </div> -->
        <div class="highlighted-products">
            <div class="wrapper">
                <div class="featured-products-title">Featured Products</div>
                <div id="first" class="carouseller">
                    <a href="javascript:void(0)" class="carouseller__left"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
                    <div class="carouseller__wrap">
                        <div class="carouseller__list">
                            <? $FeaturedQry = "AND (user_defined_sku_id='14993' OR user_defined_sku_id='16001' OR user_defined_sku_id='15903' OR user_defined_sku_id='16002' OR user_defined_sku_id='14981' OR user_defined_sku_id='17777' OR user_defined_sku_id='16343' OR user_defined_sku_id='14640-4' OR user_defined_sku_id='15900' OR user_defined_sku_id='14899' OR user_defined_sku_id='A346' OR user_defined_sku_id='3200' OR user_defined_sku_id='16342' OR user_defined_sku_id='50078' OR user_defined_sku_id=' 14967' OR user_defined_sku_id='14505' OR user_defined_sku_id='17779' OR user_defined_sku_id='50064' OR user_defined_sku_id='14646-0') ";
                            $get_temp = "select product_title,item_price,user_defined_sku_id,main_image_url,id,mfr_part_number,brand,standard_product_codes from mutual_searplusitems where main_image_url!='' and main_image_url is not null AND parent_id=0 $FeaturedQry order by rand() asc";
                            $gets = mysql_query($get_temp);
                            $tot = mysql_affected_rows();
                            if ($tot > 0) {
                                while ($SelMovieObj = mysql_fetch_object($gets)) {

                                    $image_url = $IMGPATHURL . "Products/croped/" . stripslashes($SelMovieObj->main_image_url);
                                    //$image_url=stripslashes($SelMovieObj->main_image_url);
                                    /*if(!file_exists($image_url))
            {
                $image_url=stripslashes($SelMovieObj->main_image_url);
                $image_url=str_replace("https://www.mutualindustries.net/","",$image_url);
                $image_url=str_replace("http://www.mutualindustries.net/","",$image_url);
                $image_url="goodthumbOri.php?src=".$image_url."&w=166&h=166";
            }*/
                                    $inventory = '0';
                                    $JetQtyRs = mysql_query("SELECT `Inventory` FROM mutual_products_inventory_2 WHERE user_defined_sku_id like '" . stripslashes($SelMovieObj->user_defined_sku_id) . "%'");
                                    $TotgetJetError = mysql_affected_rows();
                                    if ($TotgetJetError > 0) {
                                        $getJetErrorQryRow = mysql_fetch_array($JetQtyRs);
                                        $inventory = $getJetErrorQryRow['Inventory'];
                                    } else {
                                        $inventory = 150;
                                    }
                                    $ItmUrl = Get_ProductUrl($SelMovieObj->id);
                                    $imageALT = stripslashes($SelMovieObj->user_defined_sku_id) . ", " . stripslashes($SelMovieObj->product_title) . ", " . $siteALTTXT;
                                    $imageALT = str_replace('"', '', $imageALT);
                            ?>
                                    <div class="car__3">
                                        <div class="carouseller-box">
                                            <div class="carouseller-box-img"><? if ($image_url != '') { ?><a href="<?= $ItmUrl; ?>"><img src="<?= stripslashes($image_url); ?>" alt="<?= stripslashes($imageALT); ?>" title="<?= stripslashes($imageALT); ?>" /></a><? } else { ?><img src="noimg.jpg" style="max-height:170px;" alt="<?= stripslashes($imageALT); ?>" title="<?= stripslashes($imageALT); ?>"><? } ?></div>
                                            <div class="hp-name">
                                                <h4><a href="<?= $ItmUrl; ?>"><?= stripslashes($SelMovieObj->product_title); ?></a></h4>
                                                <span class="part-deta"><b>SKU# <?= stripslashes($SelMovieObj->user_defined_sku_id); ?></b></span><br> <span class="r-price-deta"><b>Price: $<?= stripslashes($SelMovieObj->item_price); ?></b></span>
                                            </div>
                                        </div>
                                    </div>
                                    <? } ?><? } ?>
                        </div>
                    </div>
                    <a href="javascript:void(0)" class="carouseller__right"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
        <div class="mutual-ind">
            <div class="mutual-ind-top">
                <div class="wrapper">
                    <div class="mutual-ind-title">FLAGGING DIRECT...</div>

                </div>
            </div>
            <div class="wrapper">
                <div class="mutual-ind-detail">
                    <div class="mutual-ind-detail-left">

                        <div class="mutual-ind-img-detail">
                            <p class="title-mn"><b>Safety and Construction Accessories at Factory Direct Low Prices!</b></p>
                            <p>Don't pay high middle man prices again! Purchase direct from the manufacturing source and save money.</p>
                            <p>Flagging Direct features quality construction, safety, surveying accessories, geotextile and erosion control materials.</p>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="mutual-ind-img">
                        <img src="images/flaggingdirectHomeImage.jpg" alt="">
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <div class="highlighted-products">
            <div class="wrapper">
                <div class="featured-products-title">SILT FENCE</div>
                <div id="first" class="carouseller">
                    <a href="javascript:void(0)" class="carouseller__left"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
                    <div class="carouseller__wrap">
                        <div class="carouseller__list">
                            <?
                            $CattQry = "SELECT jet_node_id FROM mutual_category WHERE parent_id='11'";
                            $CattRes = mysql_query($CattQry);
                            if (mysql_affected_rows() > 0) {
                                while ($CattRow = mysql_fetch_array($CattRes)) {
                                    $CatSID = stripslashes($CattRow["jet_node_id"]);
                                    $CatOrQry .= " or concat(',',concat(JetBrowseNodeID,','))  like '%," . $CatSID . ",%'";

                                    $CattQry2 = "SELECT jet_node_id FROM mutual_category WHERE parent_id='" . $CatSID . "'";
                                    $CattRes2 = mysql_query($CattQry2);
                                    if (mysql_affected_rows() > 0) {
                                        while ($CattRow2 = mysql_fetch_array($CattRes2)) {
                                            $CatPID = stripslashes($CattRow2["jet_node_id"]);
                                            $CatOrQry .= " or concat(',',concat(JetBrowseNodeID,','))  like '%," . $CatPID . ",%' ";

                                            $CattQry3 = "SELECT jet_node_id FROM mutual_category WHERE parent_id='" . $CatPID . "'";
                                            $CattRes3 = mysql_query($CattQry3);
                                            if (mysql_affected_rows() > 0) {
                                                while ($CattRow3 = mysql_fetch_array($CattRes3)) {
                                                    $CatPID2 = stripslashes($CattRow3["jet_node_id"]);
                                                    $CatOrQry .= " or concat(',',concat(JetBrowseNodeID,','))  like '%," . $CatPID2 . ",%' ";
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                            $MorQry = " and (concat(',',concat(JetBrowseNodeID,','))  like '%,11,%' $CatOrQry ) ";
                            $get_temp = "select product_title,item_price,user_defined_sku_id,main_image_url,id,mfr_part_number,brand,standard_product_codes from mutual_searplusitems where main_image_url!='' and main_image_url is not null AND parent_id=0 $MorQry order by rand() limit 0,7 ";
                            $gets = mysql_query($get_temp);
                            $tot = mysql_affected_rows();
                            if ($tot > 0) {
                                while ($SelMovieObj = mysql_fetch_object($gets)) {

                                    $image_url = $IMGPATHURL . "Products/croped/" . stripslashes($SelMovieObj->main_image_url);
                                    //$image_url=stripslashes($SelMovieObj->main_image_url);
                                    /*if(!file_exists($image_url))
            {
                $image_url=stripslashes($SelMovieObj->main_image_url);
                $image_url=str_replace("https://www.mutualindustries.net/","",$image_url);
                $image_url=str_replace("http://www.mutualindustries.net/","",$image_url);
                $image_url="goodthumbOri.php?src=".$image_url."&w=166&h=166";
            }*/
                                    $inventory = '0';
                                    $JetQtyRs = mysql_query("SELECT `Inventory` FROM mutual_products_inventory_2 WHERE user_defined_sku_id like '" . stripslashes($SelMovieObj->user_defined_sku_id) . "%'");
                                    $TotgetJetError = mysql_affected_rows();
                                    if ($TotgetJetError > 0) {
                                        $getJetErrorQryRow = mysql_fetch_array($JetQtyRs);
                                        $inventory = $getJetErrorQryRow['Inventory'];
                                    } else {
                                        $inventory = 150;
                                    }
                                    $ItmUrl = Get_ProductUrl($SelMovieObj->id);
                                    $imageALT = stripslashes($SelMovieObj->user_defined_sku_id) . ", " . stripslashes($SelMovieObj->product_title) . ", " . $siteALTTXT;
                                    $imageALT = str_replace('"', '', $imageALT);
                            ?>
                                    <div class="car__3">
                                        <div class="carouseller-box">
                                            <div class="carouseller-box-img"><? if ($image_url != '') { ?><a href="<?= $ItmUrl; ?>"><img src="<?= stripslashes($image_url); ?>" alt="<?= stripslashes($imageALT); ?>" title="<?= stripslashes($imageALT); ?>" /></a><? } else { ?><img src="noimg.jpg" style="max-height:170px;" alt="<?= stripslashes($imageALT); ?>" title="<?= stripslashes($imageALT); ?>"><? } ?></div>
                                            <div class="hp-name">
                                                <h4><a href="<?= $ItmUrl; ?>"><?= stripslashes($SelMovieObj->product_title); ?></a></h4>
                                                <span class="part-deta"><b>SKU# <?= stripslashes($SelMovieObj->user_defined_sku_id); ?></b></span><br> <span class="r-price-deta"><b>Price: $<?= stripslashes($SelMovieObj->item_price); ?></b></span>
                                            </div>
                                        </div>
                                    </div>
                                    <? } ?><? } ?>
                        </div>
                    </div>
                    <a href="javascript:void(0)" class="carouseller__right"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
        <div class="product-categories">
            <div class="wrapper">
                <div class="featured-products-title">PRODUCT CATAGORIES</div>
                <div class="product-catagories-box-detial">
                    <div class="product-catagories-box">
                        <div class="product-catagories-box-in pcbi1"> <a href="search?cid=12,11">
                                <h4>EROSION CONTROL</h4>
                                <img src="images/erosion-control.png" alt="EROSION CONTROL" />
                            </a> </div>
                    </div>
                    <div class="product-catagories-box">
                        <div class="product-catagories-box-in pcbi2"> <a href="category/safety-fence/121">
                                <h4>SAFETY FENCE</h4>
                                <img src="images/safety-fences2.png" alt="SAFETY FENCE" />
                            </a> </div>
                    </div>
                    <div class="product-catagories-box">
                        <div class="product-catagories-box-in pcbi3"> <a href="search?cid=14,15">
                                <h4>TAPES</h4>
                                <img src="images/tapes.png" alt="TAPES" />
                            </a> </div>
                    </div>
                    <div class="product-catagories-box lastbox">
                        <div class="product-catagories-box-in pcbi4"> <a href="category/marking-and-measuring/5">
                                <h4>MARKING PRODUCTS</h4>
                                <img src="images/marking-product.png" alt="MARKING PRODUCTS" />
                            </a> </div>
                    </div>
                    <div class="product-catagories-box">
                        <div class="product-catagories-box-in pcbi5"> <a href="category/miviz-safety-vests-and-apparel/2">
                                <h4>SAFETY APPAREL</h4>
                                <img src="images/safety-apparel.png" alt="SAFETY APPAREL" />
                            </a> </div>
                    </div>
                    <div class="product-catagories-box">
                        <div class="product-catagories-box-in pcbi6"> <a href="category/traffic-safety/1">
                                <h4>TRAFFIC SAFETY</h4>
                                <img src="images/pc-1.png" alt="TRAFFIC SAFETY" />
                            </a> </div>
                    </div>
                    <div class="product-catagories-box">
                        <div class="product-catagories-box-in pcbi7"> <a href="category/personal-protection/3">
                                <h4>PERSONAL PROTECTION</h4>
                                <img src="images/personal-protection.png" alt="PERSONAL PROTECTION" />
                            </a> </div>
                    </div>
                    <div class="product-catagories-box lastbox">
                        <div class="product-catagories-box-in pcbi8"> <a href="category/building-materials/145">
                                <h4>BUILDING MATERIALS</h4>
                                <img src="images/pc-2.png" alt="BUILDING MATERIALS" />
                            </a> </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <div class="mutual-brands">
            <div class="wrapper">
                <div class="featured-products-title">Tapes - Reflective</h3>
                    <div id="first1" class="carouseller">
                        <a href="javascript:void(0)" class="carouseller__left"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
                        <div class="carouseller__wrap">
                            <div class="carouseller__list">
                                <?
                                $CattQry = "SELECT jet_node_id FROM mutual_category WHERE parent_id='45'";
                                $CattRes = mysql_query($CattQry);
                                if (mysql_affected_rows() > 0) {
                                    while ($CattRow = mysql_fetch_array($CattRes)) {
                                        $CatSID = stripslashes($CattRow["jet_node_id"]);
                                        $CatOrQry1 .= " or concat(',',concat(JetBrowseNodeID,','))  like '%," . $CatSID . ",%' ";

                                        $CattQry2 = "SELECT jet_node_id FROM mutual_category WHERE parent_id='" . $CatSID . "'";
                                        $CattRes2 = mysql_query($CattQry2);
                                        if (mysql_affected_rows() > 0) {
                                            while ($CattRow2 = mysql_fetch_array($CattRes2)) {
                                                $CatPID = stripslashes($CattRow2["jet_node_id"]);
                                                $CatOrQry1 .= " or concat(',',concat(JetBrowseNodeID,','))  like '%," . $CatPID . ",%' ";

                                                $CattQry3 = "SELECT jet_node_id FROM mutual_category WHERE parent_id='" . $CatPID . "'";
                                                $CattRes3 = mysql_query($CattQry3);
                                                if (mysql_affected_rows() > 0) {
                                                    while ($CattRow3 = mysql_fetch_array($CattRes3)) {
                                                        $CatPID2 = stripslashes($CattRow3["jet_node_id"]);
                                                        $CatOrQry1 .= " or concat(',',concat(JetBrowseNodeID,','))  like '%," . $CatPID2 . ",%' ";
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                                $MorQry = " and (concat(',',concat(JetBrowseNodeID,','))  like '%,45,%' $CatOrQry1 ) ";
                                $get_temp = "select product_title,item_price,user_defined_sku_id,main_image_url,id,mfr_part_number,brand,standard_product_codes from mutual_searplusitems where main_image_url!='' and main_image_url is not null AND parent_id=0 $MorQry order by rand() limit 0,7 ";
                                $gets = mysql_query($get_temp);
                                $tot = mysql_affected_rows();
                                if ($tot > 0) {
                                    while ($SelMovieObj = mysql_fetch_object($gets)) {

                                        $image_url = $IMGPATHURL . "Products/croped/" . stripslashes($SelMovieObj->main_image_url);
                                        //$image_url=stripslashes($SelMovieObj->main_image_url);
                                        /*if(!file_exists($image_url))
            {
                $image_url=stripslashes($SelMovieObj->main_image_url);
                $image_url=str_replace("https://www.mutualindustries.net/","",$image_url);
                $image_url=str_replace("http://www.mutualindustries.net/","",$image_url);
                $image_url="goodthumbOri.php?src=".$image_url."&w=166&h=166";
            }*/
                                        $inventory = '0';
                                        $JetQtyRs = mysql_query("SELECT `Inventory` FROM mutual_products_inventory_2 WHERE user_defined_sku_id like '" . stripslashes($SelMovieObj->user_defined_sku_id) . "%'");
                                        $TotgetJetError = mysql_affected_rows();
                                        if ($TotgetJetError > 0) {
                                            $getJetErrorQryRow = mysql_fetch_array($JetQtyRs);
                                            $inventory = $getJetErrorQryRow['Inventory'];
                                        } else {
                                            $inventory = 150;
                                        }
                                        $ItmUrl = Get_ProductUrl($SelMovieObj->id);
                                        $imageALT = stripslashes($SelMovieObj->user_defined_sku_id) . ", " . stripslashes($SelMovieObj->product_title) . ", " . $siteALTTXT;
                                        $imageALT = str_replace('"', '', $imageALT);
                                ?>
                                        <div class="car__3">
                                            <div class="carouseller-box">
                                                <div class="carouseller-box-img"><? if ($image_url != '') { ?><a href="<?= $ItmUrl; ?>"><img src="<?= stripslashes($image_url); ?>" alt="<?= stripslashes($imageALT); ?>" title="<?= stripslashes($imageALT); ?>" /></a><? } else { ?><img src="noimg.jpg" style="max-height:170px;" alt="<?= stripslashes($imageALT); ?>" title="<?= stripslashes($imageALT); ?>"><? } ?></div>
                                                <div class="hp-name">
                                                    <h4><a href="<?= $ItmUrl; ?>"><?= stripslashes($SelMovieObj->product_title); ?></a></h4>
                                                    <span><b>SKU# <?= stripslashes($SelMovieObj->user_defined_sku_id); ?></b></span><br> <span><b>Price: $<?= stripslashes($SelMovieObj->item_price); ?></b></span>
                                                </div>
                                            </div>
                                        </div>
                                        <? } ?><? } ?>
                            </div>
                        </div>
                        <a href="javascript:void(0)" class="carouseller__right"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <? include("footer.php"); ?>
    <script src="js/jquery-2.2.0.min.js"></script>
    <script src="js/scriptbreaker-multiple-accordion-1.js"></script>
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
    <script src="js/slick.js" charset="utf-8"></script>
    <script type="text/javascript">
        $('.single-item').slick();
        $('.responsive-slider').slick({
            dots: false,
            infinite: true,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 1,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    </script>
    <script src="js/carouseller.js"></script>
    <script>
        $(function() {
            $('#first').carouseller({});
        });
        $(function() {
            $('#first1').carouseller({});
        });
    </script>
    <script>
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



    <? include("dbclose.php"); ?>
</body>

</html>