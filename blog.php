<? include('connect.php');
$TopTab = "Blog";
$CMSQry = "select * from mutual_staticpage where id='24'";
$CMSRes = mysql_query($CMSQry);
$CMSRow = mysql_fetch_object($CMSRes);
$pgtitle = trim(stripslashes($CMSRow->pgtitle));
$meta_desc = trim(stripslashes($CMSRow->meta_desc));
$meta_kwords = trim(stripslashes($CMSRow->meta_kwords));
$Home_name = stripslashes($CMSRow->name);
$Home_content = stripslashes($CMSRow->content);

$PaginUrrl = "blog";
$portfolioPERPAGE = 10;
$ShowPage = 10;
$Numm = 10;

if ($_REQUEST['Page'] > 0)
    $PageNo = ($_REQUEST['Page']);
else
    $PageNo = 1;
if (!$StartRow1)
    $StartRow =   $portfolioPERPAGE * ($PageNo - 1);
else
    $StartRow = $StartRow1;


$get_temp = "select * from mutual_blog order by createdate desc";
$gets = mysql_query($get_temp);
$tot = mysql_affected_rows();
$pppttot = $tot;
$totalpages = (int) ($tot / $portfolioPERPAGE);
$get_temp .= " LIMIT $StartRow,$portfolioPERPAGE";
$get = mysql_query($get_temp);
$totalres = mysql_affected_rows();

if (($tot % $portfolioPERPAGE) != 0)
    $totalpages++;
$page_totalpages = $totalpages * 2;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= $pgtitle; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1" name="viewport" />
    <meta content="<?= $meta_desc; ?>" name="description" />
    <meta content="<?= $meta_kwords; ?>" name="keywords" />

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
                <? include("blogleft.php"); ?>
                <div class="category-right blog-deta">
                    <div class="category-title"><?php echo $Home_name; ?></div>
                    <? if ($pppttot > 0) { ?>
                        <div class="blog-deta">
                            <? $iII = 0;
                            $iIIXXX = 0;
                            for ($i = $StartRow; $i < ($StartRow + $portfolioPERPAGE) && $i < ($pppttot); $i++) {
                                $SelMovieObj = mysql_fetch_object($get);
                            ?>
                                <div class="blog-deta-box">
                                    <div class="blog-box-title"><a href="<?php echo GetUrl_Blog($SelMovieObj->id); ?>"><?php echo stripslashes($SelMovieObj->title); ?></a></div>
                                    <p><?php echo substr(strip_tags(stripslashes($SelMovieObj->description), "<a><b><i></a></b></i><br></br><u></u>"), 0, 200); ?>...</p>
                                    <div class="blog-read-more-btn"><a href="<?php echo GetUrl_Blog($SelMovieObj->id); ?>">Read More >></a></div>
                                </div>
                            <? } ?>
                            <? if ($pppttot > $ShowPage) { ?><div class="blog-item-list">
                                    <ul><? if ($PageNo > 1) {
                                            $PrevPageNo = $PageNo - 1; ?>
                                            <li><a href="<?= $PaginUrrl; ?>?Page=<?= $PrevPageNo; ?>">&laquo; Previous</a></li><? } ?>
                                        <? if ($PageNo <= 10) {
                                            for ($i = 1; $i <= $totalpages, $i <= 10; $i++) {
                                                if ($i > 10 || $i > $totalpages)
                                                    break;
                                                if ($PageNo == $i) {
                                        ?> <li class="active"><a href="<?= $PaginUrrl; ?><? if ($i > 1) { ?>?Page=<?= $i; ?><? } ?>"><?= $i; ?></a></li><?
                                                                                                                                                    } else {
                                                                                                                                                        ?> <li><a href="<?= $PaginUrrl; ?><? if ($i > 1) { ?>?Page=<?= $i; ?><? } ?>"><?= $i; ?></a></li><?
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
                                                                                                                                                                                                                                                            ?> <li class="active"><a href="<?= $PaginUrrl; ?><? if ($i > 1) { ?>?Page=<?= $i; ?><? } ?>"><?= $i; ?></a></li><?
                                                                                                                                                                                                                                                                                                                                                                        } else { ?> <li><a href="<?= $PaginUrrl; ?><? if ($i > 1) { ?>?Page=<?= $i; ?><? } ?>"><?= $i; ?></a></li><? }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                        } ?>
                                        <? if ($PageNo < $totalpages) {
                                            $NextPageNo = $PageNo + 1; ?>
                                            <li><a href="<?= $PaginUrrl; ?>?Page=<?= $NextPageNo; ?>">Next&raquo;</a></li>
                                        <? } ?>
                                    </ul>
                                </div><? } ?>
                        </div>
                    <? } else { ?>
                        <div class="clear">&nbsp;</div>
                        <div class="clear" align="center"><strong>No matching records found.</strong></div>
                        <div class="clear">&nbsp;</div>
                    <? } ?>
                </div>
                <div class="clear">&nbsp;</div>
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