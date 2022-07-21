<?php
include("connect.php");
$kkword = $_REQUEST['keyword'];
$brandd = $_REQUEST['brand'];
if ($_REQUEST['brand'] != "") {
    $DisplayH1TestJOin = " " . $_REQUEST['brand'];
    $brandd = str_replace(" ", "+", $brandd);
}
if ($_REQUEST['keyword'] != "") {
    $kkword = str_replace(" ", "+", $kkword);
}
$DisplayH1 = "YES";
$DisplayH1Test = "Search$DisplayH1TestJOin Products";
if ($_GET["sid"] != "") {
    $PgUrls = "categories/" . $_GET["cid"] . "/" . $_GET["sid"] . "?";
    if ($_GET["keyword"] != "") {
        $PgUrls .= "keyword=" . $kkword . "&";
    }
    if ($_GET["sort"] != "") {
        $PgUrls .= "sort=" . $_GET["sort"] . "&";
    }
    if ($_GET["brand"] != "") {
        $PgUrls .= "brand=" . $brandd . "&";
    }
    if ($_GET["view"] != "") {
        $PgUrls .= "view=" . $_GET["view"] . "&";
    }
    if ($_GET["type"] != "") {
        $PgUrls .= "type=" . $_GET["type"] . "&";
    }
    if ($PgUrls != "") {
        $PgUrls = substr($PgUrls, 0, -1);
    }
} else if ($_GET["cid"] != "") {
    $PgUrls = GetUrl_Catt($_GET["cid"]) . "?";
    if ($_GET["keyword"] != "") {
        $PgUrls .= "keyword=" . $kkword . "&";
    }
    if ($_GET["sort"] != "") {
        $PgUrls .= "sort=" . $_GET["sort"] . "&";
    }
    if ($_GET["brand"] != "") {
        $PgUrls .= "brand=" . $brandd . "&";
    }
    if ($_GET["view"] != "") {
        $PgUrls .= "view=" . $_GET["view"] . "&";
    }
    if ($_GET["type"] != "") {
        $PgUrls .= "type=" . $_GET["type"] . "&";
    }
    if ($PgUrls != "") {
        $PgUrls = substr($PgUrls, 0, -1);
    }
} else {
    $PgUrls = "search?";
    if ($_GET["keyword"] != "") {
        $PgUrls .= "keyword=" . $kkword . "&";
    }
    if ($_GET["sort"] != "") {
        $PgUrls .= "sort=" . $_GET["sort"] . "&";
    }
    if ($_GET["brand"] != "") {
        $PgUrls .= "brand=" . $brandd . "&";
    }
    if ($_GET["view"] != "") {
        $PgUrls .= "view=" . $_GET["view"] . "&";
    }
    if ($_GET["type"] != "") {
        $PgUrls .= "type=" . $_GET["type"] . "&";
    }
    if ($PgUrls != "") {
        $PgUrls = substr($PgUrls, 0, -1);
    }
}

if ($_REQUEST['brand'] != '') {
    $MetaDescription_JOIN .= $_REQUEST['brand'] . " brand - ";
    $MetaKeyword_JOIN .= $_REQUEST['brand'] . " brand, ";
    $Cattitle .= $_REQUEST['brand'] . " brand, ";
}
if ($_REQUEST['Page'] != '') {
    $MetaDescription_JOIN .= "Page " . $_REQUEST['Page'] . " - ";
    $MetaKeyword_JOIN .= "Page " . $_REQUEST['Page'] . ", ";
}
if ($_REQUEST['sort'] != '') {
    $MetaDescription_JOIN .= "Sorted by " . $_REQUEST['sort'] . " - ";
    $MetaKeyword_JOIN .= "Sorted by " . $_REQUEST['sort'] . ", ";
}
if ($_REQUEST['type'] != '') {
    $MetaDescription_JOIN .= "" . $_REQUEST['type'] . " view - ";
    $MetaKeyword_JOIN .= "" . $_REQUEST['type'] . "view, ";
}
if ($_REQUEST['view'] != '') {
    $MetaDescription_JOIN .= $_REQUEST['view'] . " /page - ";
    $MetaKeyword_JOIN .= $_REQUEST['view'] . " /page, ";
}
if (strpos($_SERVER['QUERY_STRING'], '&') !== false) {
    $CattitleJoin = "Sort ";
}
$pgtitle = $CattitleJoin . "Search Result - " . $MetaDescription_JOIN . $SITENAME;

$title_dis = $pgtitle;
$t_len = strlen($pgtitle);
if ($t_len > 75) {
    $title_dis = substr($pgtitle, 0, 72) . "...";
}
if ($title_dis == '') {
    $title_dis = "Search Result - " . $MetaDescription_JOIN . " " . $SITENAME;
}

if ($meta_kwords == '') {
    $meta_kwords = $Cattitle . " " . $METAKEYWORD;
}
if ($meta_desc == '') {
    $meta_desc = $pgtitle . ", " . $METADESCRIPTION;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= $title_dis; ?></title>
    <meta name="description" content="<?= $meta_desc; ?>" />
    <meta name="keywords" content="<?= $meta_kwords; ?>" />
    <? include("favicon.php"); ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1" name="viewport" />
</head>
<style type="text/css">
    .YGSh1_black {
        color: #ffffff;
        float: left;
        font-size: 1px;
        position: absolute;
    }
</style>

<body style="font-size:1px;color:#FFFFFF"><? if ($DisplayH1 == "YES") { ?><h1 class="YGSh1_black"><?= $DisplayH1Test; ?></h1><? } ?>
    Please wait!! Redirecting to the search result page!
</body>

</html>
<? echo "<script>window.location.href='" . $PgUrls . "';</script>";
exit; ?>