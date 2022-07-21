<?
include("connect.php");
$CMSQry = "select * from mutual_staticpage where id='$pageid'";
$CMSRes = mysql_query($CMSQry);
$CMSRow = mysql_fetch_object($CMSRes);
$pgtitle = trim(stripslashes($CMSRow->pgtitle));
$meta_desc = trim(stripslashes($CMSRow->meta_desc));
$meta_kwords = trim(stripslashes($CMSRow->meta_kwords));
$meta_h1title = trim(stripslashes($CMSRow->h1title));
$Home_name = stripslashes($CMSRow->name);
$Home_content = stripslashes($CMSRow->content);

if ($meta_kwords == '') {
    $meta_kwords = $pgtitle . ", " . $METAKEYWORD;
}
if ($meta_desc == '') {
    $meta_desc = $pgtitle . ", " . $METADESCRIPTION;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= $pgtitle; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1" name="viewport" />
    <meta name="description" content="<?= $meta_desc; ?>" />
    <meta name="keywords" content="<?= $meta_kwords; ?>" />
    <? include("favicon.php"); ?>
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
        <div class="wrapper">
            <div class="category-main">
                <? include("cmsleft.php"); ?>
                <div class="category-right about-deta">
                    <div class="category-title"><?= $meta_h1title; ?></div>
                    <div style="font-size: larger;">
                        <?= $Home_content; ?>
                    </div>


                </div>
                <div class="clear"></div>
            </div>

        </div>
    </div>
    </div>
    <? include("footer.php"); ?>
    
    <script type="text/javascript" src="js/scriptbreaker-multiple-accordion-1.js"></script>
   
    <script src='js/hammer.min.js'></script>
    <script src="js/simplemenu.js"></script>
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css" />
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
    <? include("googleanalytic.php"); ?>
    <? include("dbclose.php"); ?>
</body>

</html>