<? include('connect.php');
$TopTab = "Blog";
$id = $_REQUEST['id'];
$HomeBnrQuery1 = mysql_query("select * from mutual_blog where urlcomponent='" . mysql_real_escape_string(trim($_REQUEST['id'])) . "'");
$total1 = mysql_affected_rows();
if ($total1 > 0) {
    $HomeBnrRow1 = mysql_fetch_object($HomeBnrQuery1);
    $Title = stripslashes($HomeBnrRow1->title);
    $Description = stripslashes($HomeBnrRow1->description);
    $Date = $HomeBnrRow1->createdate;
    $MetaPageTitle = $Title;
    $MetaDescription_JOIN = $Title;
    $MetaKeyword_JOIN = $Title;
} else {
    header("location:$SITE_URL");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <base href="<? echo $SITE_URL; ?>/">
    <meta charset="utf-8">
    <title><?= $MetaPageTitle; ?> | <?= $SITE_TITLE; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1" name="viewport" />
    <meta content="Blogs, <?= $MetaDescription_JOIN; ?>" name="description" />
    <meta content="Blogs, <?= $MetaKeyword_JOIN; ?>" name="keywords" />

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
                <? if ($HomeBnrRow1->featured == '') { ?>
                    <? include("blogleft.php"); ?>
                <? } else { ?>
                    <div class="category-left">
                        <div class="dropdowns">
                            <div class="category-left-title about-list-title">Related Products </div>
                            <div class="responsive-category-left-title responsive-about-list-title">Related Products <i class="fa fa-angle-down" aria-hidden="true"></i></div>

                            <ul class="category-list about-list">
                                <?php if ($HomeBnrRow1->featured) { ?>
                                    <?php $Option = explode(",", $HomeBnrRow1->featured);
                                    for ($TT = 0; $TT < count($Option); $TT++) {
                                        if (trim($Option[$TT]) != '')
                                            $get_temp = "select product_title,item_price,user_defined_sku_id,main_image_url,id from mutual_searplusitems where id='" . $Option[$TT] . "'";
                                        $gets = mysql_query($get_temp);
                                        $tot = mysql_affected_rows();
                                        if ($tot > 0) {
                                            $SelMovieObj = mysql_fetch_object($gets);
                                            $tittl = stripslashes($SelMovieObj->product_title);
                                            $tittl = str_replace("&quot;", '"', $tittl);
                                            $tittlXX = $tittl;
                                            $image_url = $IMGPATHURL . "Products/croped/" . stripslashes($SelMovieObj->main_image_url);
                                            $ItmUrl = Get_ProductUrl($SelMovieObj->id);
                                            $imageALT = stripslashes($SelMovieObj->user_defined_sku_id) . ", " . stripslashes($SelMovieObj->product_title) . ", " . $siteALTTXT;
                                            $imageALT = str_replace('"', '', $imageALT);


                                    ?>

                                            <li class="left-blog-box-img"><a href="<?= $ItmUrl; ?>"><? if ($image_url != '') { ?><img src="<?= stripslashes($image_url); ?>" alt="<?= stripslashes($imageALT); ?>" title="<?= stripslashes($imageALT); ?>" /><? } else { ?><img src="noimg.jpg" style="max-height:170px;" alt="<?= stripslashes($imageALT); ?>" title="<?= stripslashes($imageALT); ?>"><? } ?></a></li>
                                            <li><a href="<?= $ItmUrl; ?>"><?= stripslashes($tittl); ?></a></li>

                                <? }
                                    }
                                } ?>
                            </ul>
                        </div>
                    </div><? } ?>
                <div class="category-right blog-deta">
                    <div class="blog-detail-main">
                        <h1 class="blog-detail-title"><?php echo $Title; ?></h1>
                        <div class="blog-date"><? echo date('F d, Y', strtotime($Date)); ?></div>
                        <p><?php echo $Description; ?></p>
                    </div>
                </div>
                <div class="clear"></div>
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
    <script>
        $(document).ready(function() {
            $(".responsive-category-left-title").click(function() {
                $(".category-list").toggle();
            });
        });
    </script>

    <? include("dbclose.php"); ?>
</body>

</html>