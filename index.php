<?
$page='home';
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
                        <div class="single-item-deta-title"><?= stripslashes(strip_tags($bnrtext, "</br><br>\n")); ?>
                        </div>
                    </div>
                    <? } ?>

                </div>
                <? } ?>

            </div>
        </div>
        <? } ?>
        <div class="featured-products">
            <div class="wrapper">
                <div class="featured-products-title">Featured Products</div>
                <div class="featured-products-box-main">
                    <?
                    $FeaturedQry = "AND (user_defined_sku_id='14993' OR user_defined_sku_id='16001' OR user_defined_sku_id='15903' OR user_defined_sku_id='16002' OR user_defined_sku_id='14981' OR user_defined_sku_id='17777' OR user_defined_sku_id='16343' OR user_defined_sku_id='14640-4' OR user_defined_sku_id='15900' OR user_defined_sku_id='14899' OR user_defined_sku_id='A346' OR user_defined_sku_id='3200' OR user_defined_sku_id='16342' OR user_defined_sku_id='50078' OR user_defined_sku_id=' 14967' OR user_defined_sku_id='14505' OR user_defined_sku_id='17779' OR user_defined_sku_id='50064' OR user_defined_sku_id='14646-0') ";
                    $get_temp = "select product_title,item_price,user_defined_sku_id,main_image_url,id,mfr_part_number,brand,standard_product_codes, `Product Description` as product_description from mutual_searplusitems where main_image_url!='' and main_image_url is not null AND parent_id=0 $FeaturedQry order by rand() asc limit 0,4";
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
                            <div class="featured-products-img">
                                <? if ($image_url != '') { ?><a href="<?= $ItmUrl; ?>"><img
                                        src="<?= stripslashes($image_url); ?>" alt="<?= stripslashes($imageALT); ?>"
                                        title="<?= stripslashes($imageALT); ?>" /></a>
                                <? } else { ?><img src="noimg.jpg" style="max-height:170px;"
                                    alt="<?= stripslashes($imageALT); ?>" title="<?= stripslashes($imageALT); ?>">
                                <? } ?>
                            </div>
                            <div class="featured-products-img-top">
                                <div class="featured-products-img-title"><a
                                        href="<?= $ItmUrl; ?>"><?= stripslashes($SelMovieObj->product_title); ?></a>
                                </div>
                                <div class="featured-products-img-part-number"><b>Part#
                                        <?= stripslashes($SelMovieObj->user_defined_sku_id); ?></b></div>
                                <!-- <div class="featured-products-img-part-number"><b>Price: $<?= stripslashes($SelMovieObj->item_price); ?></b></div> -->
                            </div>
                            <div class="featured-products-img-detail">
                                <p><?= strip_tags($SelMovieObj->product_description); ?></p>
                                <div class="more-info-btn">
                                    <a href="<?= $ItmUrl; ?>">More Info</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <? } ?>
                    <? } ?>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <div class="mutual-ind">
            <div class="mutual-ind-top">
                <div class="wrapper">
                    <div class="mutual-ind-title">Quality Manufacturing For Over A Century</div>
                    <div class="mutual-ind-sub-title">Mutual Industries Inc. - A Manufacturing Leader Since 1910</div>
                </div>
            </div>
            <div class="wrapper">
                <div class="mutual-ind-detail">
                    <div class="mutual-ind-detail-left">
                        <div class="mutual-ind-img">
                            <img src="images/mutual-ind-img1.jpg" alt="" />
                        </div>
                        <div class="mutual-ind-img-detail">
                            <p>Mutual Industries, Inc. has been an industry leader in developing and manufacturing a
                                diverse line of quality products for over 100 years.</p>
                            <p>Mutual's line of quality construction, safety, and surveying materials continues the
                                quality tradition.</p>
                            <p>Mutual's flagging/surveying tapes, barricade tapes, flags, safety fence and silt fence
                                have set the industry standard.</p>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="mutual-ind-detail-right">
                        <div class="mutual-ind-img mutual-ind-img-right">
                            <img src="images/mutual-ind-img2.jpg" alt="" />
                        </div>
                        <div class="mutual-ind-img-detail mutual-ind-img-detail-right">
                            <p>Mutual has also become the premier manufacturer of sediment control and erosion control
                                products, as well as a full line of safety vests and personal protection products. These
                                products are manufactured by Mutual to the same exacting standards and level of quality
                                that you've come to expect from Mutual, while being very competitively priced.</p>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <div class="highlighted-products">
            <div class="wrapper">
                <div class="featured-products-title">HIGHLIGHTED PRODUCTS</div>
                <div id="first" class="carouseller">
                    <a href="javascript:void(0)" class="carouseller__left"><i class="fa fa-angle-left"
                            aria-hidden="true"></i></a>
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
                                    <div class="carouseller-box-img">
                                        <? if ($image_url != '') { ?><a href="<?= $ItmUrl; ?>"><img
                                                src="<?= stripslashes($image_url); ?>"
                                                alt="<?= stripslashes($imageALT); ?>"
                                                title="<?= stripslashes($imageALT); ?>" /></a>
                                        <? } else { ?><img src="noimg.jpg" style="max-height:170px;"
                                            alt="<?= stripslashes($imageALT); ?>"
                                            title="<?= stripslashes($imageALT); ?>">
                                        <? } ?>
                                    </div>
                                    <div class="hp-name">
                                        <h4><?= stripslashes($SelMovieObj->product_title); ?></h4>
                                        <!-- <span class="part-deta"><b>SKU# <?= stripslashes($SelMovieObj->user_defined_sku_id); ?></b></span><br>
                                                <span class="r-price-deta"><b>Price: $<?= stripslashes($SelMovieObj->item_price); ?></b></span> -->
                                    </div>
                                </div>
                            </div>
                            <? } ?>
                            <? } ?>
                        </div>
                    </div>
                    <a href="javascript:void(0)" class="carouseller__right"><i class="fa fa-angle-right"
                            aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
        <div class="product-categories">
            <div class="wrapper">
                <div class="featured-products-title">PRODUCT CATAGORIES</div>
                <div class="product-catagories-box-detial">
                   
                    <div class="product-catagories-box">
                        <div class="product-catagories-box-in pcbi1">
                            <a href="category/erosion-control/12">
                                <div class="product-catagories-name">EROSION CONTROL</div>
                                <img src="images/erosion-control.png" alt="EROSION CONTROL" />
                            </a>
                        </div>
                    </div>
                    <div class="product-catagories-box">
                        <div class="product-catagories-box-in pcbi2">
                            <a href="category/safety-fence/121">
                                <div class="product-catagories-name">SAFETY FENCE</div>
                                <img src="images/safety-fences2.png" alt="SAFETY FENCE" />
                            </a>
                        </div>
                    </div>
                    <div class="product-catagories-box">
                        <div class="product-catagories-box-in pcbi3">
                            <a href="category/tapes-barricade/14">
                                <div class="product-catagories-name">TAPES</div>
                                <img src="images/tapes.png" alt="TAPES" />
                            </a>
                        </div>
                    </div>
                    <div class="product-catagories-box">
                        <div class="product-catagories-box-in pcbi4">
                            <a href="category/marking-and-measuring/5">
                                <div class="product-catagories-name">MARKING PRODUCTS</div>
                                <img src="images/marking-product.png" alt="MARKING PRODUCTS" />
                            </a>
                        </div>
                    </div>
                    <div class="product-catagories-box">
                        <div class="product-catagories-box-in pcbi5">
                            <a href="category/miviz-safety-vests-apparel/2">
                                <div class="product-catagories-name">SAFETY APPAREL</div>
                                <img src="images/safety-apparel.png" alt="SAFETY APPAREL" />
                            </a>
                        </div>
                    </div>
                    <div class="product-catagories-box">
                        <div class="product-catagories-box-in pcbi6">
                            <a href="category/traffic-safety/1">
                                <div class="product-catagories-name">TRAFFIC SAFETY</div>
                                <img src="images/pc-1.png" alt="TRAFFIC SAFETY" />
                            </a>
                        </div>
                    </div>
                    <div class="product-catagories-box">
                        <div class="product-catagories-box-in pcbi7">
                            <a href="category/personal-protection/3">
                                <div class="product-catagories-name">PERSONAL PROTECTION</div>
                                <img src="images/personal-protection.png" alt="PERSONAL PROTECTION" />
                            </a>
                        </div>
                    </div>
                    <div class="product-catagories-box">
                        <div class="product-catagories-box-in pcbi8">
                            <a href="category/building-materials/145">
                                <div class="product-catagories-name">BUILDING MATERIALS</div>
                                <img src="images/pc-2.png" alt="BUILDING MATERIALS" />
                            </a>
                        </div>
                    </div>
                    
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <div class="high-visibility-apparel">
            <div class="wrapper">
                <div class="featured-products-title">High Visibility Apparel</div>
                <div class="responsive-slider">
                    <?
                    $get_temp = "select product_title,item_price,user_defined_sku_id,main_image_url,id,mfr_part_number,brand,standard_product_codes, `Product Description` as product_description from mutual_searplusitems where main_image_url!='' and main_image_url is not null AND parent_id=0 AND `JetBrowseNodeID` LIKE '%144%' order by rand() asc";
                    $gets = mysql_query($get_temp);
                    $tot = mysql_affected_rows();
                    if ($tot > 0) {
                        while ($SelMovieObj = mysql_fetch_object($gets)) {
                            $image_url = $IMGPATHURL . "Products/croped/" . stripslashes($SelMovieObj->main_image_url);
                            $ItmUrl = Get_ProductUrl($SelMovieObj->id);
                            $imageALT = stripslashes($SelMovieObj->user_defined_sku_id) . ", " . stripslashes($SelMovieObj->product_title) . ", " . $siteALTTXT;
                            $imageALT = str_replace('"', '', $imageALT);
                        ?>
                    <div>
                        <? if ($image_url != '') { ?>
                        <a href="<?= $ItmUrl; ?>"><img src="<?= stripslashes($image_url); ?>"
                                alt="<?= stripslashes($imageALT); ?>" title="<?= stripslashes($imageALT); ?>" /></a>
                        <? } else { ?>
                        <img src="noimg.jpg" style="max-height:170px;" alt="<?= stripslashes($imageALT); ?>"
                            title="<?= stripslashes($imageALT); ?>">
                        <? } ?>
                        <div class="visibility-apparel-box">
                            <div class="visibility-apparel-title"><?= stripslashes($SelMovieObj->product_title); ?>
                            </div>
                            <div class="va-part">Part# <?= stripslashes($SelMovieObj->user_defined_sku_id); ?></div>
                            <p><?php echo substr(strip_tags(stripslashes($SelMovieObj->product_description), "<a><b><i></a></b></i><br></br><u></u>"), 0, 80); ?>...
                            </p>
                            <div class="more-info-btn">
                                <a href="<?= $ItmUrl; ?>">More Info</a>
                            </div>
                        </div>
                    </div>
                    <? } ?>
                    <? } ?>
                </div>
            </div>
        </div>
        <div class="safety-stories">
            <div class="safety-stories-top">
                <div class="wrapper">
                    <div class="afety-stories-top-title"><b>SAFETY STORIES</b> - THE MUTUAL BLOG</div>
                </div>
            </div>
            <?
                $MutualBlogQry = "select * from mutual_blog order by createdate desc LIMIT 4";
                $MutualBlogData = mysql_query($MutualBlogQry);
            ?>
            <div class="wrapper">
                <div class="blog-post-deta">
                    <?
                        while ($MutualBlogRow = mysql_fetch_object($MutualBlogData)) {
                    ?>
                    <div class="blog-post-box">
                        <div class="blog-post-title"><a
                                href="<?php echo GetUrl_Blog($MutualBlogRow->id); ?>"><?php echo stripslashes($MutualBlogRow->title); ?></a>
                        </div>
                        <p><?php echo substr(strip_tags(stripslashes($MutualBlogRow->description), "<a><b><i></a></b></i><br></br><u></u>"), 0, 160); ?>...
                        </p>
                        <div class="blog-post-btn"><a href="<?php echo GetUrl_Blog($MutualBlogRow->id); ?>">Read More <i
                                    class="fa fa-angle-double-right" aria-hidden="true"></i></a></div>
                    </div>
                    <? } ?>
                    <div class="clear"></div>
                </div>
                <div class="view-blog-link">
                    <a href="<?= $SITE_URL; ?>/blog">View all Blog Posts</a>
                </div>
            </div>
        </div>
        <div class="mutual-brands">
            <div class="wrapper">
                <div class="featured-products-title">MUTUAL COMPANIES AND BRANDS</div>
                <div id="first1" class="carouseller">
                    <a href="javascript:void(0)" class="carouseller__left"><i class="fa fa-angle-left"
                            aria-hidden="true"></i></a>
                    <div class="carouseller__wrap">
                        <div class="carouseller__list">
                            <div class="car__3">
                                <div class="carouseller-box">
                                    <div class="carouseller-box-img"><a href="#"><img src="images/brands-logo1.png"
                                                alt="" /></a></div>
                                </div>
                            </div>
                            <div class="car__3">
                                <div class="carouseller-box">
                                    <div class="carouseller-box-img"><a href="#"><img src="images/brands-logo2.png"
                                                alt="" /></a></div>
                                </div>
                            </div>
                            <div class="car__3">
                                <div class="carouseller-box">
                                    <div class="carouseller-box-img"><a href="#"><img src="images/brands-logo3.png"
                                                alt="" /></a></div>
                                </div>
                            </div>
                            <div class="car__3">
                                <div class="carouseller-box">
                                    <div class="carouseller-box-img"><a href="#"><img src="images/brands-logo4.png"
                                                alt="" /></a></div>
                                </div>
                            </div>
                            <div class="car__3">
                                <div class="carouseller-box">
                                    <div class="carouseller-box-img"><a href="#"><img src="images/brands-logo5.png"
                                                alt="" /></a></div>
                                </div>
                            </div>
                            <div class="car__3">
                                <div class="carouseller-box">
                                    <div class="carouseller-box-img"><a href="#"><img src="images/brands-logo1.png"
                                                alt="" /></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="javascript:void(0)" class="carouseller__right"><i class="fa fa-angle-right"
                            aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
        <!-- <div class="mutual-brands">
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
        </div> -->
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
    <? include("dbclose.php"); ?>
</body>

</html>