<? 
include("connect.php");
include_once("Mandrill.php");

$TopTab="Login";
$ShWSubMenu="Y";
$mesgg="";
if($_POST['HidRegUser']=="1")
{
	$password = EnCry_Decry($_POST['password']);
	
	$SelUserQry="SELECT id FROM mutual_users WHERE email='".addslashes($_GET['email'])."'";
	$SelUserQryRs=mysql_query($SelUserQry);
	if(mysql_affected_rows()>0)
	{
		$message="Email address already exists!";
	}
	else
	{
		$InsertUserQry = "INSERT INTO mutual_users set imm='" . addslashes($_POST['imm']) . "',
		country='" . addslashes($_POST['country']) . "',fax='" . addslashes($_POST['fax']) . "',sitename='" . addslashes($_POST['sitename']) . "',
		newsletter='" . addslashes($_POST['newsletter']) . "',website='" . addslashes($_POST['website']) . "',aboutme='" . addslashes($_POST['aboutme']) . "',
		firstname='" . addslashes($_POST['firstname']) . "',address1='" . addslashes($_POST['address1']) . "',address2='" . addslashes($_POST['address2']) . "',
		email='" . addslashes($_POST['email']) . "',password='" . addslashes($password) . "',company='" . addslashes($_POST['company']) . "',
		city='" . addslashes($_POST['city']) . "',zip='" . addslashes($_POST['zip']) . "',state='" . addslashes($_POST['state']) . "',
		hometel='" . addslashes($_POST['hometel']) . "',
		regdate=now(),approve='Y'";
		mysql_query($InsertUserQry);
		$InserId = mysql_insert_id();
		$_SESSION['UsErId']=$InserId;
		setcookie("UsErId_COKI",$InserId,time()+(3600*168));
		
		$SITELINK='<a href="'.$SITE_URL.'" >'.$SITE_URL.'</a>';
		$LOGINLINK='<a href="'.$SITE_URL.'/login" style="display:inline-block; background:#34bad4; color:#FFFFFF; text-transform:uppercase; border-radius:10px; padding:15px; text-decoration:none;" >LOGIN INTO YOUR ACCOUNT</a>';
		$subject1=stripslashes(GetName1("mutual_mail_messages","subject","id",10));
		$mailcontent1=stripslashes(GetName1("mutual_mail_messages","content","id",10));
		$mailcontent1=str_replace("[NAME]",ucwords(stripslashes($_POST['firstname'])),$mailcontent1);
		$mailcontent1=str_replace("[EMAIL]",stripslashes($_POST['email']),$mailcontent1);
		$mailcontent1=str_replace("[PASSWORD]",stripslashes($_POST['password']),$mailcontent1);
		$mailcontent1=str_replace("[LOGINLINK]",$LOGINLINK,$mailcontent1);
		$mailcontent1=str_replace("[SITELINK]",$SITELINK,$mailcontent1);
		//echo $_POST['email']."<br>";echo $subject1."<br>";echo $mailcontent1."<br>";echo $ADMIN_MAIL."<br>";exit;
		if($_SERVER['HTTP_HOST']!="yogs")
		{
			$headers  = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
			$headers .= "From: $SITE_TITLE <$ADMIN_MAIL>" . "\r\n";	
			mail($_POST['email'], $subject1, $mailcontent1, $headers);
		}
		
		if($_GET["back"]!="")
		{
			header("location:".$SECURE_URL."/".($_GET["back"]));exit;
		}
		else
		{
			header("location:".$SECURE_URL."/");exit;
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>MutualIndustries</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1" name="viewport" />
    <meta name="description" content="Create an account, <?=$METADESCRIPTION;?>" />
    <meta name="keywords" content="Create an account, <?=$METAKEYWORD;?>" />

    <link rel="stylesheet" href="css/carouseller.css">
    <link rel="stylesheet" type="text/css" href="css/slick.css">
    <link rel="stylesheet" type="text/css" href="css/slick-theme.css">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/responsive.css" />
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css" />

    <!-- <link rel="stylesheet" href="css/simplemenu.css">
<link rel="stylesheet" href="css/carouseller.css">
<link rel="stylesheet" type="text/css" href="css/slider.css">
<link rel="stylesheet" type="text/css" href="css/entypo.css">
<link rel="stylesheet" type="text/css" href="css/style.css<?=$CSSLOAD;?>" />
<link rel="stylesheet" type="text/css" href="css/responsive.css<?=$CSSLOAD;?>" /> -->

</head>

<body onLoad="init();">
    <? include("top.php");?>
    <div class="middlewrapper">
        <div class="wrapper">
            <div class="login-main">
                <div class="login-title">Create an account</div>
                <div class="register-detail">
                    <div class="register-detail-top">Please fill out the form below to gain access to the Mega Safety
                        Mart inventory system to place an order. This system is for Mega Safety Mart Retailers Only.
                        Your information will not be shared with any third parties. It is to verify you are a business
                        and for shipping purposes. An email will be sent to you confirming your login id, password. You
                        will not have access to place an order until your application is approved. We may contact you by
                        email or telephone to verify information.</div>
                    <div class="register-frm">
                        <form id="FrmRegister" name="FrmRegister" method="post" enctype="multipart/form-data">
                            <div class="r-row">
                                <label>Full Name:</label>
                                <div class="r-col">
                                    <input id="firstname" class="registertextbox" name="firstname"
                                        value="<?=$_POST["firstname"];?>" type="text"> *
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="r-row rrow">
                                <label>Email:</label>
                                <div class="r-col">
                                    <input id="email" class="registertextbox" name="email" value="<?=$_POST["email"];?>"
                                        type="text"> *
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="r-row rrow right">
                                <label>Password:</label>
                                <div class="r-col">
                                    <input id="password" class="registertextbox" name="password"
                                        value="<?=$_POST["password"];?>" type="text"> (minimum 5 characters)*
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="r-row rrow">
                                <label>Address 1:</label>
                                <div class="r-col">
                                    <input id="address1" class="registertextbox" name="address1"
                                        value="<?=$_POST["address1"];?>" type="text"> *
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="r-row rrow right">
                                <label>Address 2:</label>
                                <div class="r-col">
                                    <input id="address2" class="registertextbox" name="address2"
                                        value="<?=$_POST["address2"];?>" type="text">
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="r-row rrow">
                                <label>City:</label>
                                <div class="r-col">
                                    <input id="city" class="registertextbox" name="city" value="<?=$_POST["city"];?>"
                                        type="text"> *
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="r-row rrow right">
                                <label>State:</label>
                                <div class="r-col">
                                    <select id="state" class="registertextbox registertextbox-select" name="state">
                                        <option value="">Select</option>
                                        <?=GetDropdown(state,state,statenew,' where 1=1 order by state asc',stripslashes($_POST['state']));?>
                                    </select> *
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="r-row rrow">
                                <label>Zip:</label>
                                <div class="r-col">
                                    <input id="zip" class="registertextbox" name="zip" value="<?=$_POST["zip"];?>"
                                        type="text"> *
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="r-row rrow right">
                                <label>Country:</label>
                                <div class="r-col">
                                    <select id="country" class="registertextbox registertextbox-select" name="country">
                                        <option value="">Select</option>
                                        <?=GetDropdown(country_name,country_name,country,' where 1=1 order by country_name asc',stripslashes($_POST['country']));?>
                                    </select> *
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="r-row rrow">
                                <label>Phone:</label>
                                <div class="r-col">
                                    <input id="hometel" class="registertextbox" name="hometel"
                                        value="<?=$_POST["hometel"];?>" type="text"> *
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="r-row rrow right">
                                <label>Fax:</label>
                                <div class="r-col">
                                    <input id="fax" class="registertextbox" name="fax" value="<?=$_POST["fax"];?>"
                                        type="text">
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="r-row rrow">
                                <label>Company:</label>
                                <div class="r-col">
                                    <input id="company" class="registertextbox" name="company"
                                        value="<?=$_POST["company"];?>" type="text">
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="r-row rrow right">
                                <label>Company URL:</label>
                                <div class="r-col">
                                    <input id="website" class="registertextbox" name="website"
                                        value="<?=$_POST["website"];?>" type="text">
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="r-row">
                                <label>Company Site Name:</label>
                                <div class="r-col">
                                    <input id="sitename" class="registertextbox" name="sitename"
                                        value="<?=$_POST["sitename"];?>" type="text">
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="r-row">
                                <label>Instant Messenger:</label>
                                <div class="r-col">
                                    <select id="imm" class="registertextbox registertextbox-select" name="imm">
                                        <option value="">Select</option>
                                        <option value="AIM" <? if($_POST['imm']=="AIM" ){echo"selected";}?>>AIM</option>
                                        <option value="ICQ" <? if($_POST['imm']=="ICQ" ){echo"selected";}?>>ICQ</option>
                                        <option value="MSN" <? if($_POST['imm']=="MSN" ){echo"selected";}?>>MSN</option>
                                        <option value="Yahoo" <? if($_POST['imm']=="Yahoo" ){echo"selected";}?>>Yahoo
                                        </option>
                                        <option value="Gtalk" <? if($_POST['imm']=="Gtalk" ){echo"selected";}?>>Gtalk
                                        </option>
                                    </select>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="r-row">
                                <label>About Your Business:</label>
                                <div class="r-col">
                                    <textarea id="aboutme" class="registertextbox" style="height:50px;"
                                        name="aboutme"><?=$_POST["aboutme"];?></textarea>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="r-row">
                                <label></label>
                                <div class="r-col">
                                    Please describe your business establishment.(Required For Approval)
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="r-row">
                                <label></label>
                                <div class="r-col">
                                    <input style="margin-left: 0;" id="newsletter" name="newsletter" value="Y"
                                        checked="checked" type="checkbox">
                                    Please describe your business establishment.(Required For Approval)
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="r-row">
                                <label></label>
                                <div class="r-col">
                                    <input style="margin-left: 0;" id="terms" name="terms" value="Y" type="checkbox">
                                    Please acknowledge you have read our <a href="#"><b>privacy policy.</b></a>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="r-row">
                                <label></label>
                                <div class="r-col">
                                    <span id="captchaid2"
                                        style="width:200px;border:1px solid #91d3ee;text-align:center;font-size:19px;height:25px;background-color:#EFEFEF;padding:0px 15px 0px 15px;vertical-align: top;display:inline-block;"
                                        class="recaptcha-box">85398</span>
                                    <input id="recaptcha_response_field" class="registertextbox"
                                        name="recaptcha_response_field" type="text">
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="r-row">
                                <label></label>
                                <div class="r-col">
                                    For security purposes please enter the above letters/numbers appearing in the image:
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="r-row">
                                <label></label>
                                <div class="r-col">
                                    <a class="register-btn" href="#" onClick="return Chkregister();">Register</a>
                                </div>
                                <div class="clear"></div>
                            </div><input type="hidden" name="HidRegUser" id="HidRegUser" value="0">
                            <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
   
    <? include("footer.php");?>
    <script src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/scriptbreaker-multiple-accordion-1.js"></script>

    <link rel="stylesheet" type="text/css" href="css/font-awesome.css" />
    <script>
    function init() {
        document.FrmRegister.reset();
        oStringMask = new Mask("(###) ###-####");
        oStringMask.attach(document.FrmRegister.hometel);
        oStringMask.attach(document.FrmRegister.fax);
    }
    </script>
    <script>
    function Chkregister() {
        form = document.FrmRegister;
        if (form.firstname.value == "") {
            alert("Please enter full name.");
            form.firstname.focus();
            return false;
        }
        if (form.email.value == "") {
            alert("Please enter email address.");
            form.email.focus();
            return false;
        } else if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(form.email.value))) {
            alert("Please enter a proper email address.");
            form.email.focus();
            return false;
        }
        if (form.password.value == "") {
            alert("Please enter password.");
            form.password.focus();
            return false;
        }
        if (form.password.value.length < 5) {
            alert("Please enter valid password.");
            form.password.focus();
            return false;
        }
        if (form.address1.value == "") {
            alert("Please enter address.");
            form.address1.focus();
            return false;
        }
        if (form.city.value == "") {
            alert("Please enter city.");
            form.city.focus();
            return false;
        }
        if (form.state.value == "") {
            alert("Please enter state.");
            form.state.focus();
            return false;
        }
        if (form.zip.value == "") {
            alert("Please enter zipcode.");
            form.zip.focus();
            return false;
        }
        if (form.country.value == "") {
            alert("Please enter country.");
            form.country.focus();
            return false;
        }
        if (form.hometel.value == "") {
            alert("Please enter phone.");
            form.hometel.focus();
            return false;
        }
        if (form.terms.checked == false) {
            alert("Please acknowledge you have read our privacy policy.");
            form.terms.focus();
            return false;
        }
        if (form.recaptcha_response_field.value == "") {
            alert("Please enter captcha code.");
            form.recaptcha_response_field.focus();
            return false;
        }
        if (form.recaptcha_response_field.value != document.getElementById("captchaid2").innerHTML) {
            alert("Please enter valid captcha code.");
            document.FrmRegister.recaptcha_response_field.focus();
            return false;
        } else {
            form.HidRegUser.value = 1;
            form.submit();
            return true;
        }
    }

    function trim(stringToTrim) {
        return stringToTrim.replace(/^\s+|\s+$/g, "");
    }

    function LoadCaptcha() {
        var randd = getRandom(5);
        document.getElementById("captchaid2").innerHTML = randd;
    }
    LoadCaptcha();

    function getRandom(length) {
        return Math.floor(Math.pow(10, length - 1) + Math.random() * 9 * Math.pow(10, length - 1));
    }
    </script>
    <? include("dbclose.php");?>
</body>

</html>