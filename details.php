<?
$page='detail';
include("connect.php");
$SCHEMAA = "Y";
$TopTabb = "Products";
$urlname = addslashes(str_replace("_", " ", $_GET["id"]));
$urlname = addslashes(str_replace("---", " ", $urlname));
$get_temp = "select * from mutual_searplusitems where urlsafename='" . $urlname . "'";
$gets = mysql_query($get_temp);

if (mysql_affected_rows() > 0) {
    $ProRow = mysql_fetch_array($gets);
    $ProID = stripslashes($ProRow["id"]);
} else {
    header("location:" . $SITE_URL . "/");
    exit;
}

$SITE_TITLE_X = stripslashes($ProRow["product_title"]);
$mesgg = "";
//FB URL
$urlCCCC = "http" . ((!empty($_SERVER['HTTPS'])) ? "s" : "") . "://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$FB_urlCCCC = $urlCCCC;
$FB_urlCCCC = str_replace("://", "%3A%2F%2F", $FB_urlCCCC);
$FB_urlCCCC = str_replace("/", "%2F", $FB_urlCCCC);
$sizesku = $ProRow["main_image_url"];
$imgurll = stripslashes($ProRow["main_image_url"]);
$image_url = $IMGPATHURL . "Products/" . stripslashes($ProRow['user_defined_sku_id']) . ".jpg";
$image_url = $IMGPATHURL . "Products/thumb/" . stripslashes($ProRow['main_image_url']);

if ($imgurll != "") {
    $SCHMIMG = $SITE_URL . "/Products/" . stripslashes($ProRow['main_image_url']);
}

if ($_SESSION['UsErId'] != "") {
    $SelUserQry = "SELECT firstname,email FROM mutual_users WHERE id='" . $_SESSION['UsErId'] . "'";
    $SelUserQryRs = mysql_query($SelUserQry);
    $SelUserQryRow = mysql_fetch_array($SelUserQryRs);
    $RevwNm = stripslashes($SelUserQryRow["firstname"]);
    $RevwEml = stripslashes($SelUserQryRow["email"]);
}

$CatBrThb = "";
if ($ProRow['JetBrowseNodeID'] != '') {
    $tagsarray1 = explode(",", $ProRow['JetBrowseNodeID']);
    for ($TT = 0; $TT < count($tagsarray1); $TT++) {
        if (trim($tagsarray1[$TT]) != '')
            $Catid = $tagsarray1[$TT];
    }
}
if ($Catid != '') {
    $CattQry = "SELECT jet_node_name,parent_id,jet_node_id FROM mutual_category WHERE jet_node_id='" . $Catid . "'";
    $CattRes = mysql_query($CattQry);
    if (mysql_affected_rows() > 0) {
        $CattRow = mysql_fetch_array($CattRes);
        $CatNm = stripslashes($CattRow["jet_node_name"]);
        $CatPID = stripslashes($CattRow["parent_id"]);
        $CatBrThb = '<li><a class="title-brad" href="' . GetUrl_Catt($Catid) . '">' . $CatNm . '</a></li>';
        if ($CatPID > 0) {
            $CattQry2 = "SELECT jet_node_name,parent_id,jet_node_id FROM mutual_category WHERE jet_node_id='" . $CatPID . "'";
            $CattRes2 = mysql_query($CattQry2);
            if (mysql_affected_rows() > 0) {
                $CattRow2 = mysql_fetch_array($CattRes2);
                $CatNm = stripslashes($CattRow2["jet_node_name"]);
                $CatPID = stripslashes($CattRow2["parent_id"]);
                $CatBrThb = '<li><a class="title-brad" href="' . GetUrl_Catt($CattRow2['jet_node_id']) . '">' . $CatNm . '</a></li>' . $CatBrThb;
                if ($CatPID > 0) {
                    $CattQry3 = "SELECT jet_node_name,parent_id,jet_node_id FROM mutual_category WHERE jet_node_id='" . $CatPID . "'";
                    $CattRes3 = mysql_query($CattQry3);
                    if (mysql_affected_rows() > 0) {
                        $CattRow3 = mysql_fetch_array($CattRes3);
                        $CatNm = stripslashes($CattRow3["jet_node_name"]);
                        $CatPID = stripslashes($CattRow3["parent_id"]);
                        $CatBrThb = '<li><a class="title-brad" href="' . GetUrl_Catt($CattRow3['jet_node_id']) . '">' . $CatNm . '</a></li>' . $CatBrThb;
                    }
                }
            }
        }
    }
}

$brandurl = stripslashes($ProRow["brand"]);
$brandurl = str_replace(' ', '+', $brandurl);

if ($ProRow["item_price"] > 0) {
    $EPRC = number_format($ProRow["item_price"], 2, '.', '');
} else {
    $EPRC = "0.00";
}


$mfr = stripslashes($ProRow["mfr_part_number"]);
$mfr = str_replace('"', '', $mfr);
$upc = stripslashes($ProRow["standard_product_codes"]);
$upc = str_replace('"', '', $upc);


$dessc = stripslashes($ProRow["Product Description"]);
$dessc = str_replace('http://', 'https://', $dessc);
$dessc = str_replace('<img ', '<img alt="' . $SITENAME . '" title="' . $SITENAME . '" ', $dessc);


$bullets = "";

$MetaTitle_JOIN .= ucfirst($SITE_TITLE_X) . " | ";

if (stripslashes($ProRow["user_defined_sku_id"]) != '') {
    $MetaDescription_JOIN = stripslashes($ProRow["user_defined_sku_id"]) . " - ";
    $MetaKeyword_JOIN = stripslashes($ProRow["user_defined_sku_id"]) . ", ";
}
if ($upc != '') {
    $MetaDescription_JOIN .= stripslashes($upc) . " - ";
    $MetaKeyword_JOIN .= stripslashes($upc) . ", ";
}
if (stripslashes($ProRow["brand"]) != '') {
    $MetaDescription_JOIN .= stripslashes($ProRow["brand"]) . " - ";
    $MetaKeyword_JOIN .= stripslashes($ProRow["brand"]) . ", ";
    $MetaTitle_JOIN .= stripslashes($ProRow["brand"]) . " | ";
}
$MetaTitle_JOIN .= stripslashes($ProRow["user_defined_sku_id"]);
if ($SITE_TITLE_X != '') {
    $MetaDescription_JOIN .= stripslashes($SITE_TITLE_X) . " - ";
    $MetaKeyword_JOIN .= stripslashes($SITE_TITLE_X) . ", ";
}

$title_dis = $MetaDescription_JOIN . " - " . $SITENAME;
$t_len = strlen($title_dis);

if ($title_dis == '') {
    $title_dis = "View Product - " . $MetaDescription_JOIN . " " . $SITENAME;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <base href="<?= $SITE_URL; ?>/" />
    <title><?= stripslashes($ProRow["pagetitle"]); ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1" name="viewport" />
    <meta name="keywords" content="<?= str_replace('"', '', stripslashes($ProRow["metakeyword"])); ?>">
    <meta name="description" content="<?= str_replace('"', '', stripslashes($ProRow["metadescription"])); ?>">
    <? include("favicon.php"); ?>
    <link rel="stylesheet" href="css/easyzoom.css" />
    <link rel="stylesheet" href="css/carouseller.css">
    <link rel="stylesheet" type="text/css" href="css/slick.css">
    <link rel="stylesheet" type="text/css" href="css/slick-theme.css">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/responsive.css" />
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css" />
    <? include("headermore.php"); ?>
    <script type="application/ld+json">
        {
            "@context": "http://schema.org/",
            "@type": "Product",
            "name": "<?= str_replace('"', '', $SITE_TITLE_X); ?>",
            "image": "<?= stripslashes($image_url); ?>",
            "description": "<?= str_replace('"', '', stripslashes($ProRow["Product Description"])); ?>",
            "brand": "<? echo str_replace('"', '', stripslashes($ProRow['brand'])); ?>",
            "sku": "<?= str_replace('"', '', stripslashes($ProRow['user_defined_sku_id'])); ?>",
            "offers": {
                "@type": "Offer",
                "priceCurrency": "USD",
                "price": "<?= $ProRow["item_price"]; ?>",
                "url": "<?= $SITE_URL; ?><? echo $_SERVER['REQUEST_URI']; ?>",
                "availability": "http://schema.org/InStock",
                "itemCondition": "http://schema.org/NewCondition"
            }
        }
    </script>
    <script type="application/ld+json">
        {
            "@context": "http://schema.org/",
            "@type": "BreadcrumbList",
            "itemListElement": [{
                    "@type": "ListItem",
                    "position": "1",
                    "item": {
                        "@id": "https://www.flaggingdirect.com/",
                        "name": "Home"
                    }
                },
                <?
                $yyyy = 1;
                $ExplodedCatBrThb = explode('href="', $CatBrThb);
                for ($eppp = 1; $eppp < count($ExplodedCatBrThb); $eppp++) {
                    $yyyy++;
                    $ExplodedCatBrThb2 = explode('"', $ExplodedCatBrThb[$eppp]);
                    $ExplodedCatBrThb3 = explode('">', $ExplodedCatBrThb[$eppp]);
                    $ExplodedCatBrThb4 = explode('<i', $ExplodedCatBrThb3[1]);
                ?> {
                        "@type": "ListItem",
                        "position": "<?= $yyyy; ?>",
                        "item": {
                            "@id": "<?= $ExplodedCatBrThb2[0] ?>",
                            "name": "<?= $ExplodedCatBrThb4[0] ?>"
                        }
                    }
                    <? if ($eppp < (count($ExplodedCatBrThb) - 1)) { ?>, <? } ?>
                <? } ?>
            ]
        }
    </script>
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?= str_replace('"', '', stripslashes($ProRow["pagetitle"])); ?>" />
    <meta property="og:description" content="<?= str_replace('"', '', stripslashes($ProRow["metadescription"])); ?>" />
    <meta property="og:url" content="<? echo $SITE_URL . $_SERVER['REQUEST_URI']; ?>" />
    <meta property="og:site_name" content="Flagging Direct" />
    <meta property="og:image" content="<?= stripslashes($image_url); ?>" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="<?= str_replace('"', '', stripslashes($ProRow["pagetitle"])); ?>" />
    <meta name="twitter:description" content="<?= str_replace('"', '', stripslashes($ProRow["metadescription"])); ?>" />
    <meta name="twitter:image" content="<?= stripslashes($image_url); ?>" />
</head>

<body onLoad="loadDropDown();">
    <? include("top.php"); ?>
    <div class="middlewrapper">
        <div class="pro-detail-deta">
            <div class="wrapper">
                <div class="pro-detail-head"><?= stripslashes($ProRow["product_title"]); ?></div>
                <div class="pro-detail-deta-main">
                    <div class="pro-detail-deta-left">
                        <div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
                            <? if ($imgurll != '') {  ?>
                            <a href="<?= stripslashes($image_url); ?>">
                                <img id="zoomview" class="main-img"  src="<?= stripslashes($image_url); ?>" alt="<?= stripslashes($ProRow["user_defined_sku_id"]); ?>, <?= str_replace('"', '', stripslashes($SITE_TITLE_X)); ?>, <?= $siteALTTXT; ?>" title="<?= stripslashes($ProRow["user_defined_sku_id"]); ?>, <?= str_replace('"', '', stripslashes($SITE_TITLE_X)); ?>, <?= $siteALTTXT; ?>" />
                            </a>
                            <? } ?>
                        </div>
                        <? $strQueryPerPage = "select imgpath,id,sku from mutual_product_img where sku='" . $ProRow["user_defined_sku_id"] . "' and title='" . $ProRow["product_title"] . "'";
                        $strResultPerPage = mysql_query($strQueryPerPage);
                        $strResultTot = mysql_affected_rows();
                        if ($strResultTot > 0) {
                            if ($strResultTot != 1) { ?>
                                <div class="thumbnails">
                                    <?  while ($strResultPerPageRow = mysql_fetch_array($strResultPerPage)) {
                                        $k++;
                                        $image_url1 = $IMGPATHURL . "Products_img/thumb/" . stripslashes($strResultPerPageRow['imgpath']); ?>
                                        <div class="thumbnails-box">
                                            <a href="<?= stripslashes($image_url1); ?>" data-standard="<?= stripslashes($image_url1); ?>">
                                                <img src="<?= stripslashes($image_url1); ?>" alt="<?= stripslashes($ProRow["user_defined_sku_id"]); ?>, <?= str_replace('"', '', stripslashes($SITE_TITLE_X)); ?>, <?= $siteALTTXT; ?>" title="<?= stripslashes($ProRow["user_defined_sku_id"]); ?>, <?= str_replace('"', '', stripslashes($SITE_TITLE_X)); ?>, <?= $siteALTTXT; ?>" />
                                            </a>
                                        </div>
                                    <? } ?>
                                </div>
                                <? } ?>
                            <? } ?>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <div class="pro-detail-deta-right">
                        <div class="pdr-part">Part# 
                            <?  if ($ProRow['user_defined_sku_id']) {
                                    echo $ProRow['user_defined_sku_id'];
                                } else {
                            } ?>
                        </div>
                        <div class="pdr-details">
                            <? $dessc2 = str_replace('id="stcpDiv"', '', stripslashes($ProRow["Product Description"])); ?><?= strip_tags($dessc2, "<br><img><a><b><strong><u><i><p>"); ?>
                        </div>
                        <!-- <div class="pdr-details">
                            <ul>
                                <li>Economical 36" or 24" width silt fabrics</li>
                                <li>1½” x 1½” (Nominal) hardwood stakes</li>
                                <li>Stakes spaced every 10' (10' centers)</li>
                                <li>11 stakes per 100' fabric</li>
                            </ul>
                        </div> -->
                        <div class="distributors-box">
                            <form name="distributors" id="distributors" method="post" enctype="multipart/form-data">
                                <div class="distributors-head">DISTRIBUTORS ONLY</div>
                                <p>Please call <b>800-523-0888</b> to request a quote or use the quoting cart.</p>
                                <div class="db-row">
                                    <label>SIZE:</label>
                                    <div class="db-col">
                                        <select id="size" class="distributors-input" name="size">
                                            <option value="">24" X 100' MISF150 1-1/2 X 1/2 (nom) 10' Center</option>
                                        </select>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <div class="db-row">
                                    <label>COLOR:</label>
                                    <div class="db-col">
                                        <select id="size" class="distributors-input" name="size">
                                            <option value="">BLACK</option>
                                        </select>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <div class="distributors-btn">
                                    <a href="#">Add to Quote</a>
                                </div>
                            </form>
                        </div>
                        <div class="pdr-details">
                            <div class="pdr-details-head">BUY IT NOW</div>
                            End users can purchase this item now by clicking on the "Buy Now" button. Your order will be fulfilled by the closest distributor.
                        </div>
                        <div class="pdr-buy-btn">
                            <a href="#">Buy Now</a>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <!-- <div class="product-speci-deta">
                <div class="wrapper">
                    <div class="product-speci-title">PRODUCT SPECIFICATIONS</div>
                    <div class="product-speci-box">
                        <p>Product Description: <span>CONTRACTORS GRADE SILT FENCE</span></p>
                        <p>Dimensions: <span>7" x 4" x 16"</span></p>
                        <p>Weight: <span>1.5 LBS</span></p>
                        <p>Brand: <span>MUTUAL INDUSTRIES</span></p>
                    </div>
                    <div class="product-speci-box">
                        <p>SKU: <span>00000-00-0000</span></p>
                        <p>UPC: <span>0000000000000000</span></p>
                        <p>Availability: <span>In Stock & Ready to Ship</span></p>
                        <a class="spec-btn" href="#">Spec Sheet</a>
                    </div>
                    <div class="clear"></div>
                </div>
            </div> -->
            <div class="product-speci-deta">
                <div class="wrapper">
                    <?
                    $ArtributQur = "select description from mutual_product_feature where user_defined_sku_id='" . $ProRow["user_defined_sku_id"] . "'";
                    $ArtributRes = mysql_query($ArtributQur);
                    $ArtributTot = mysql_affected_rows();
                    if ($ArtributTot > 0) {
                        $ArtributRow = mysql_fetch_array($ArtributRes); ?>
                        <div class="product-speci-box">
                            <h3 class="product-speci-title">Product Features</h3>
                            <h4> <?php echo strip_tags(stripslashes($ArtributRow['description']), "<br><img><a><b><strong><u><i><p>"); ?></h4>
                        </div>
                    <? } ?>
                    <?
                    $SpecQur = "select * from mutual_product_specification where user_defined_sku_id='" . $ProRow["user_defined_sku_id"] . "'";
                    $SpecRes = mysql_query($SpecQur);
                    $SpecTot = mysql_affected_rows();
                    if ($SpecTot > 0) { ?>
                        <div class="product-speci-box speci-link" style="width:100%;">
                            <h3 class="product-speci-title">PRODUCT SPECIFICATIONS</h3>
                            <h4>
                                <? while ($SpecRow = mysql_fetch_array($SpecRes)) {
                                    $FileNm = getModifiedUrlNamechangeJET(trim(stripslashes($ProRow['product_title']))) . ".pdf";
                                ?>
                                    <?php echo strip_tags(stripslashes($SpecRow['description'])); ?>
                                    <? if ($SpecRow['filename'] != '') { ?>
                                        <img alt="application/pdf icon" src="images/application-pdf.png" style="vertical-align: middle;">

                                        <a href="files/<?php echo stripslashes($SpecRow['filename']); ?>" type="application/pdf"><?php echo $FileNm; ?></a>

                                <? }
                                } ?>
                            </h4>
                        </div>
                    <? } ?>
                    <?
                    $PriceQur = "select description from  mutual_product_pricedesc where user_defined_sku_id='" . $ProRow["user_defined_sku_id"] . "'";
                    $PriceRes = mysql_query($PriceQur);
                    $PriceTot = mysql_affected_rows();
                    if ($PriceTot > 0) {
                        $PriceRow = mysql_fetch_array($PriceRes); ?>
                        <div class="pro-specification-box" style="width:100%;">
                            <h3 class="middle-head">Product Pricing Description</h3>
                            <h4> <?php echo trim(stripslashes($PriceRow['description'])); ?></h4>
                        </div>
                    <? } ?>
                    <div class="clear"></div>
                </div>
            </div>
            <?
            if ($ProRow['JetBrowseNodeID'] != '') {
                $tagsarray = explode(",", $ProRow['JetBrowseNodeID']);
                for ($TT = 0; $TT < count($tagsarray); $TT++) {
                    if (trim($tagsarray[$TT]) != '')
                        $category1 .= "concat(',',concat(JetBrowseNodeID,','))  like '%," . $tagsarray[$TT] . ",%' or ";
                }
            }
            if ($category1 != '') {
                $category1 = substr($category1, 0, -3);
            }
            $get_tempRE = "select product_title,item_price,user_defined_sku_id,main_image_url,`Product Description` as product_description,id from mutual_searplusitems where main_image_url!='' and main_image_url is not null AND user_defined_sku_id!='" . $ProRow['user_defined_sku_id'] . "' AND parent_id=0 and ($category1) limit 0,4";
            $getsRe = mysql_query($get_tempRE);
            $totRe = mysql_affected_rows();
            if ($totRe <= 0) {
                $get_tempRE = "select product_title,item_price,user_defined_sku_id,main_image_url,`Product Description` as product_description,id from mutual_searplusitems where main_image_url!='' and main_image_url is not null AND user_defined_sku_id!='" . $ProRow['user_defined_sku_id'] . "' AND parent_id=0 and ($category1) limit 0,4";
                $getsRe = mysql_query($get_tempRE);
                $totRe = mysql_affected_rows();
            }
            if ($totRe > 0) { ?>
            <div class="related-item-deta">
                <div class="wrapper">
                    <div class="featured-products-title">RELATED ITEMS</div>
                    <div class="related-item-box-main">
                        <? while ($RowRe = mysql_fetch_object($getsRe)) {
                            $image_url = $IMGPATHURL . "Products/croped/" . stripslashes($RowRe->main_image_url);
                        ?>
                        <div class="related-item-box">
                            <div class="category-img">
                                <? if ($RowRe->main_image_url != '') { ?>
                                    <a href="<?= Get_ProductUrl($RowRe->id); ?>"><img src="<?= stripslashes($image_url); ?>" alt="<?= stripslashes($RowRe->user_defined_sku_id); ?>, <?= str_replace('"', '', stripslashes($RowRe->product_title)); ?>, <?= $siteALTTXT; ?>" title="<?= stripslashes($RowRe->user_defined_sku_id); ?>, <?= str_replace('"', '', stripslashes($RowRe->product_title)); ?>, <?= $siteALTTXT; ?>" /></a>
                                <? } else { ?>
                                <img src="noimg.jpg" alt="<?= stripslashes($RowRe->user_defined_sku_id); ?>, <?= str_replace('"', '', stripslashes($RowRe->product_title)); ?>, <?= $siteALTTXT; ?>" title="<?= stripslashes($RowRe->user_defined_sku_id); ?>, <?= str_replace('"', '', stripslashes($RowRe->product_title)); ?>, <?= $siteALTTXT; ?>">
                                <? } ?>
                            </div>
                            <div class="category-img-detail related-item-detail">
                                <div class="related-item-head">
                                    <div class="category-img-title"><a href="<?= Get_ProductUrl($RowRe->id); ?>"><?= stripslashes($RowRe->product_title); ?></a></div>
                                    <div class="category-part-number">Part# <?= stripslashes($RowRe->user_defined_sku_id); ?></div>
                                </div>
                                <p><?php echo substr(strip_tags(stripslashes($RowRe->product_description), "<a><b><i></a></b></i><br></br><u></u>"), 0, 50); ?>...</p>
                                <div class="category-bottom-box"><a href="<?= Get_ProductUrl($RowRe->id); ?>">More Info</a></div>
                            </div>
                        </div>
                        <? } ?>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            <? } ?>
            <?
            $get_tempRE3 = "select product_title,item_price,user_defined_sku_id,main_image_url,`Product Description` as product_description,id from mutual_searplusitems where main_image_url!='' and main_image_url is not null AND parent_id=0 order by rand() limit 0,4";
            $getsRe3 = mysql_query($get_tempRE3);
            $totRe3 = mysql_affected_rows();
            if ($totRe3 > 0) { ?>
            <div class="featured-products">
                <div class="wrapper">
                    <div class="featured-products-title">CUSTOMERS ALSO VIEWED</div>
                    <div class="featured-products-box-main">
                        <? while ($RowRe = mysql_fetch_object($getsRe3)) {
                            $tittl = stripslashes($RowRe->product_title);
                            $tittl = str_replace("&quot;", '"', $tittl);
                            $tittlXX = $tittl;
                            $tittl = substr($tittl, 0, 60);
                            if (strlen($tittlXX) > 60) {
                                $tittl = $tittl . "...";
                            }
                            $image_url = $IMGPATHURL . "Products/croped/" . stripslashes($RowRe->main_image_url);
                        ?>
                        <div class="featured-products-box">
                            <div class="featured-products-box-in">
                                <div class="featured-products-img">
                                    <? if ($RowRe->main_image_url != '') { ?>
                                        <a href="<?= Get_ProductUrl($RowRe->id); ?>"><img src="<?= stripslashes($image_url); ?>" alt="<?= stripslashes($RowRe->user_defined_sku_id); ?>, <?= str_replace('"', '', stripslashes($RowRe->product_title)); ?>, <?= $siteALTTXT; ?>" title="<?= stripslashes($RowRe->user_defined_sku_id); ?>, <?= str_replace('"', '', stripslashes($RowRe->product_title)); ?>, <?= $siteALTTXT; ?>" /></a>
                                    <? } else { ?>
                                        <img src="noimg.jpg" alt="<?= stripslashes($RowRe->user_defined_sku_id); ?>, <?= str_replace('"', '', stripslashes($RowRe->product_title)); ?>, <?= $siteALTTXT; ?>" title="<?= stripslashes($RowRe->user_defined_sku_id); ?>, <?= str_replace('"', '', stripslashes($RowRe->product_title)); ?>, <?= $siteALTTXT; ?>">
                                    <? } ?>
                                </div>
                                <div class="featured-products-img-top">
                                    <div class="featured-products-img-title"><a href="<?= Get_ProductUrl($RowRe->id); ?>"><?= stripslashes($tittl); ?></a></div>
                                    <div class="featured-products-img-part-number">Part# <? echo stripslashes($RowRe->user_defined_sku_id); ?></div>
                                </div>
                                <div class="featured-products-img-detail">
                                    <p><?= strip_tags($RowRe->product_description); ?></p>
                                    <div class="more-info-btn">
                                        <a href="<?= Get_ProductUrl($RowRe->id); ?>">More Info</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <? } ?>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            <? } ?>
        </div>
    </div>
    <? include("footer.php"); ?>
    <script type="text/javascript" src="js/scriptbreaker-multiple-accordion-1.js"></script>
    
    <script src="js/simplemenu.js"></script>
   
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css" />
    <script>
        function fillinbixxx(valll) {
            valll = valll.replace(/[^0-9]+/g, '');
            document.getElementById("qtyy").value = valll;
        }

        function gogtoto(id) {
            qtyyX = document.getElementById("qtyy").value;
            SkuId = document.getElementById("SKUID-Main").value;
            var drp_1 = document.getElementById('drp_1').value;
            var drp_2 = document.getElementById('drp_2').value;
            var drp_3 = document.getElementById('drp_3').value;

            AddtoCartAjaxDtl(id, id, SkuId, qtyyX, drp_1, drp_2, drp_3);
        }

        function gogtotoSize() {
            qtyyX = document.getElementById("qtyy").value;
            id = document.getElementById("selitmid").value;
            SkuId = document.getElementById("SKUID-Main").value;
            AddtoCartAjaxDtl(id, id, SkuId, qtyyX);
        }

        function review() {}

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
                        document.getElementById("AddToWatchListID" + vehicleid).innerHTML = "Please login to add in watch list.";
                        return false;
                    }
                }
            }
            http2SF.send(null);
        }

        function getRandom(length) {
            return Math.floor(Math.pow(10, length - 1) + Math.random() * 9 * Math.pow(10, length - 1));
        }

        function AddtoCartAjaxDtl(AddtoCartAjax_ID, itemid, price, quantity, Drop1, Drop2, Drop3) {
            var http7333 = false;
            if (navigator.appName == "Microsoft Internet Explorer") {
                http7333 = new ActiveXObject("Microsoft.XMLHTTP");
            } else {
                http7333 = new XMLHttpRequest();
            }
            http7333.abort();
            http7333.open("GET", "ajax_validation.php?Type=AddtoCartAjax&itemid=" + itemid + "&price=" + price + "&quantity=" + quantity + "&colors=" + Drop1 + "&sizes=" + Drop2 + "&types=" + Drop3, true);
            http7333.onreadystatechange = function() {
                if (http7333.readyState == 4) {
                    window.location.href = 'items-in-your-cart';
                    return false;
                }
            }
            http7333.send(null);
        }
    </script>
    <?
    $ProductQury223 = "SELECT * FROM mutual_product_size WHERE `user_sku`='" . addslashes($ProRow['user_defined_sku_id']) . "' and `title`='" . addslashes($ProRow['product_title']) . "'";
    $ProductRes223 = mysql_query($ProductQury223);
    $tot223 = mysql_affected_rows();
    if ($tot223 > 0) {
    ?>
        <script>
            function loadDropDown() {
                var httpSizee = false;
                if (navigator.appName == "Microsoft Internet Explorer") {
                    httpSizee = new ActiveXObject("Microsoft.XMLHTTP");
                } else {
                    httpSizee = new XMLHttpRequest();
                }
                httpSizee.abort();
                httpSizee.open("GET", "loaddropdown.php?itemsku=<?= $ProRow['user_defined_sku_id']; ?>", true);
                httpSizee.onreadystatechange = function() {
                    if (httpSizee.readyState == 4) {
                        aa = httpSizee.responseText; //alert(aa);
                        document.getElementById('DropDown').innerHTML = httpSizee.responseText;
                        Getsku('1', '1');
                        return false;
                    }
                }
                httpSizee.send(null);
            }
        </script>
    <? } ?>
    <script>
        function Getsku(id, no) {
            //alert(no);
            var drp_1 = document.getElementById('drp_1');
            if (typeof(drp_1) != 'undefined' && drp_1 != null) {
                var drp_1 = document.getElementById('drp_1').value;
                //drp_1 = drp_1.replace("&","PPPOPPP");drp_1 = drp_1.replace('"',"XXXOXXX");drp_1 = drp_1.replace("#","OOOPOOO");

            } else {
                var drp_1 = "";
            }
            var drp_2 = document.getElementById('drp_2');
            if (typeof(drp_2) != 'undefined' && drp_2 != null) {
                var drp_2 = document.getElementById('drp_2').value;
                //drp_2 = drp_2.replace("&","PPPOPPP");drp_2 = drp_2.replace('"',"XXXOXXX");drp_2 = drp_2.replace("#","OOOPOOO");
            } else {
                var drp_2 = "";
            }
            var drp_3 = document.getElementById('drp_3');
            if (typeof(drp_3) != 'undefined' && drp_3 != null) {
                var drp_3 = document.getElementById('drp_3').value;
                //drp_3 = drp_3.replace("&","PPPOPPP");drp_3 = drp_3.replace('"',"XXXOXXX");drp_3 = drp_3.replace("#","OOOPOOO");
            } else {
                var drp_3 = "";
            }
            //var drp_1=document.getElementById('drp_1').value;
            //	drp_1 = drp_1.replace("&","PPPOPPP");drp_1 = drp_1.replace('"',"XXXOXXX");drp_1 = drp_1.replace("#","OOOPOOO");
            //	var drp_2=document.getElementById('drp_2').value;
            //	drp_2 = drp_2.replace("&","PPPOPPP");drp_2 = drp_2.replace('"',"XXXOXXX");drp_2 = drp_2.replace("#","OOOPOOO");
            //	var drp_3=document.getElementById('drp_3').value;
            //	drp_3 = drp_3.replace("&","PPPOPPP");drp_3 = drp_3.replace('"',"XXXOXXX");drp_3 = drp_3.replace("#","OOOPOOO");
            var main_sku = '<? echo $ProRow['user_defined_sku_id']; ?>';
            //alert(drp_2);

            var httpSizee = false;
            if (navigator.appName == "Microsoft Internet Explorer") {
                httpSizee = new ActiveXObject("Microsoft.XMLHTTP");
            } else {
                httpSizee = new XMLHttpRequest();
            }
            httpSizee.abort();
            httpSizee.open("GET", "loadsku.php?drp_1=" + drp_1 + "&drp_2=" + drp_2 + "&drp_3=" + drp_3 + "&main_sku=" + main_sku, true);
            httpSizee.onreadystatechange = function() {
                if (httpSizee.readyState == 4) {
                    aa = httpSizee.responseText; //alert(aa);
                    if (aa != '') {
                        bb = httpSizee.responseText.split("OOPOO");
                        SkuId = bb[0];
                        Price = bb[1];
                        if (SkuId != '') {
                            document.getElementById('SKUID').innerHTML = SkuId;
                            document.getElementById('SKUID-Main').value = SkuId;
                        } else {
                            document.getElementById('SKUID').innerHTML = '<?= $ProRow['user_defined_sku_id']; ?>';
                            document.getElementById('SKUID-Main').value = '<?= $ProRow['user_defined_sku_id']; ?>';
                        }
                        if (Price != '') {
                            document.getElementById('Price').innerHTML = "$" + Price;
                            <? if ($case_value != '') { ?>
                                var x = Price;
                                var y = <?= $case_value; ?>;
                                var res = x / y;
                                document.getElementById('eachprice').innerHTML = "$" + res.toFixed(2) + " each";
                                document.getElementById('drop_value').style.display = "block";
                                document.getElementById('drop_value1').style.display = "none";
                            <? } ?>
                        } else {
                            document.getElementById('Price').innerHTML = "$" + <?= $EPRC; ?>;
                            <? if ($case_value != '') { ?>
                                var Price = <?= $EPRC; ?>;
                                var x = Price;
                                var y = <?= $case_value; ?>;
                                var res = x / y;
                                document.getElementById('eachprice').innerHTML = "$" + res.toFixed(2) + " each";
                                document.getElementById('drop_value').style.display = "block";
                                document.getElementById('drop_value1').style.display = "none";
                            <? } ?>
                        }
                    }
                    return false;
                }
            }
            httpSizee.send(null);
        }
    </script>
    <link href="shadowbox/shadowbox.css" rel="stylesheet" type="text/css" />
    <script src="shadowbox/shadowbox2.js"></script>
    <script>
        Shadowbox.init({
            language: 'en',
            players: ['img', 'html', 'iframe', 'qt', 'wmp', 'swf', 'flv']
        });
    </script>
    <? include("googleanalytic.php"); ?><? include("dbclose.php"); ?>
</body>

</html>