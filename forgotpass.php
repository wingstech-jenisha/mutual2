<?
include("connect.php");
$TopTab = "Login";
$ShWSubMenu = "Y";
$mesgg = "";
function Get_CreatePasswordXXX($email = '')
{
    $chars = "abcdefghijkmnopqrstuvwxyz023456789";
    srand((float)microtime() * 1000000);
    $i = 0;
    $pass = '';
    while ($i <= 25) {
        $num = rand() % 33;
        $tmp = substr($chars, $num, 1);
        $pass = $pass . $tmp;
        $i++;
    }
    return $pass;
}
if ($_POST['HidRegUser'] == "1") {
    $query1 = "select id,firstname,lastname,password,email from flagging_users where email='" . trim(addslashes(($_POST['email']))) . "' ";
    $res = mysql_query($query1);
    $tot = mysql_affected_rows();
    if ($tot > 0) {
        $getCustomerQryRow = mysql_fetch_object($res);
        $password = EnCry_Decry(stripslashes($getCustomerQryRow->password));
        $user_login = stripslashes($getCustomerQryRow->email);
        $firstname = stripslashes($getCustomerQryRow->firstname);
        $lastname = stripslashes($getCustomerQryRow->lastname);
        $toemail = addslashes($_POST['email']);

        $tokenn = Get_CreatePasswordXXX($toemail);
        mysql_query("update flagging_users set forgot_tokenn='" . $tokenn . "' where email='" . trim(addslashes(($_POST['email']))) . "'");

        $SITELINK = '<a href="' . $SITE_URL . '" >' . $SITE_URL . '</a>';
        $LOGINLINK = '<a href="' . $SITE_URL . '/login" style="display:inline-block; background:#34bad4; color:#FFFFFF; text-transform:uppercase; border-radius:10px; padding:15px; text-decoration:none;" >LOGIN INTO YOUR ACCOUNT</a>';
        $RESET_PASSWORD_LINK = "<a href='$SITE_URL/reset-password?token=$tokenn' style='display:inline-block; background:#34bad4; color:#FFFFFF; text-transform:uppercase; border-radius:10px; padding:15px; text-decoration:none;'>$SITE_URL/reset-password?token=$tokenn</a>";

        $subject1 = stripslashes(GetName1("flagging_mail_messages", "subject", "id", 11));
        $mailcontent1 = stripslashes(GetName1("flagging_mail_messages", "content", "id", 11));
        $mailcontent1 = str_replace("[FIRSTNAME]", ucwords($firstname), $mailcontent1);
        $mailcontent1 = str_replace("[LASTNAME]", ucwords($lastname), $mailcontent1);
        $mailcontent1 = str_replace("[PASSWORD]", $password, $mailcontent1);
        $mailcontent1 = str_replace("[EMAIL]", $user_login, $mailcontent1);
        $mailcontent1 = str_replace("[RESET_PASSWORD_LINK]", $RESET_PASSWORD_LINK, $mailcontent1);
        $mailcontent1 = str_replace("[LOGINLINK]", $LOGINLINK, $mailcontent1);
        $mailcontent1 = str_replace("[SITELINK]", $SITELINK, $mailcontent1);
        echo $toemail . $subject1 . $mailcontent1 . $ADMIN_MAIL;
        exit;
        if ($_SERVER['HTTP_HOST'] != "ishu") {
            $headers  = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
            $headers .= "From: Factory Direct <$ADMIN_MAIL>" . "\r\n";
            mail($toemail, $subject1, $mailcontent1, $headers);
        }
        header("location:forgot-password?m=1");
        exit;
    } else {
        $message = "Whoops! We can't find a user with that email address.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Forgot Passsword? | <?= $SITE_TITLE; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1" name="viewport" />
    <meta content="Login or Create an Account, <?= $METADESCRIPTION; ?>" name="description" />
    <meta content="Login or Create an Account, <?= $METAKEYWORD; ?>" name="keywords" />
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
            <div class="login-main">
                <div class="login-title">Login or Create an Account</div>
                <div class="login-detail">

                    <div class="login-right">
                        <div class="login-detail-title">Forgot Password? </div>

                        <div class="login-frm">
                            <form name="FrmRegister" enctype="multipart/form-data" method="post">
                                <? if ($message != "") { ?><p align="left"><strong style="color:#FF0000"><?= $message; ?></strong></p><? } else if ($_GET["m"] != "") { ?><p align="left" style="color:#FF0000;">Your password has been sent.<br>You will receive an email shortly with your password.</p><? } ?>
                                <div class="login-frm-title">If you have an account with us, please enter your email address.</div>
                                <div class="l-row">
                                    <label>Email Address <span>*</span></label>
                                    <div class="l-col">
                                        <input id="email" class="logintextbox" name="email" type="text">
                                    </div>
                                </div>

                                <div class="row"> <span style="margin:0;color:red;">*</span> Required Fields </div>
                                <div class="login-bottom-btn">

                                    <a class="login-bottom-btn-right" href="#" onClick="Chkregister();return false;">Submit</a>
                                    <div class="clear"></div><input type="hidden" name="HidRegUser" id="HidRegUser" value="0" />
                                </div>


                            </form>
                        </div>
                    </div>
                    <div class="login-left">
                        <h2 class="login-detail-title">New Customers</h2>
                        <div class="new-custimer-title">
                            <h4>Register with us for future convenience:</h4><br>
                            <ul>
                                <li>Fast and easy check out</li>
                                <li>Easy access to your order history and status</li>
                                <li>Exclusive promotional offers and deals</li>
                                <li><b>Earn Rewards</b> on every purchase</li>
                                <li>Sign in with your preferred Social Network credentials</li>
                            </ul>
                            <!--<div class="s_customers-btn"> <a href="#" title="facebook"><img src="images/fblogin.png" alt="facebook login"></a> <a href="google_login.php" title="google login"><img src="images/googlelogin.png" alt="google login"></a> </div>-->
                            <div class="login-bottom-btn">

                                <a class="login-bottom-btn-right" href="register" title="register">Register</a>

                                <div class="clear"></div>
                            </div>
                        </div>


                        <div class="clear">&nbsp;</div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <? include("footer.php"); ?>

    <script src="js/jquery-2.2.0.min.js"></script>
    <script src="js/scriptbreaker-multiple-accordion-1.js"></script>

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
        function Chkregister() {
            form = document.FrmRegister;
            if (form.email.value == "") {
                alert("Please enter your email address.")
                form.email.focus();
                return false;
            } else if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(form.email.value))) {
                alert("Please enter a proper email address.");
                form.email.focus();
                return false;
            } else {
                form.HidRegUser.value = 1;
                form.submit();
                return true;
            }
        }
    </script>

    <? include("dbclose.php"); ?>
</body>

</html>