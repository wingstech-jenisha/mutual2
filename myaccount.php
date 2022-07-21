<? 
include("connect.php");
include_once("logincheck.php");
$TopTab="myaccount";
$ShWSubMenu="Y";
$mesgg="";
if($_POST['HidRegUser']=="1")
{
	$password = EnCry_Decry($_POST['password']);
	
	$SelUserQry="SELECT id FROM mutual_users WHERE email='".addslashes($_GET['email'])."' and id!='".$_SESSION['UsErId']."'";
	$SelUserQryRs=mysql_query($SelUserQry);
	if(mysql_affected_rows()>0)
	{
		$message="Email address already exists!";
	}
	else
	{
		$InsertUserQry = "update mutual_users set imm='" . addslashes($_POST['imm']) . "',
		country='" . addslashes($_POST['country']) . "',fax='" . addslashes($_POST['fax']) . "',sitename='" . addslashes($_POST['sitename']) . "',
		newsletter='" . addslashes($_POST['newsletter']) . "',website='" . addslashes($_POST['website']) . "',aboutme='" . addslashes($_POST['aboutme']) . "',
		firstname='" . addslashes($_POST['firstname']) . "',address1='" . addslashes($_POST['address1']) . "',address2='" . addslashes($_POST['address2']) . "',
		email='" . addslashes($_POST['email']) . "',password='" . addslashes($password) . "',company='" . addslashes($_POST['company']) . "',
		city='" . addslashes($_POST['city']) . "',zip='" . addslashes($_POST['zip']) . "',state='" . addslashes($_POST['state']) . "',
		hometel='" . addslashes($_POST['hometel']) . "' where id='".$_SESSION['UsErId']."'";
		mysql_query($InsertUserQry);
		$message="Your profile has been updated!";
	}
}

$SelUserQry="SELECT * FROM mutual_users WHERE id='".$_SESSION['UsErId']."'";
$SelUserQryRs=mysql_query($SelUserQry);
$SelUserQryRow=mysql_fetch_array($SelUserQryRs);

$pgtitle="My Account | ".$SITE_TITLE."";
$meta_kwords="My Account, ".$METAKEYWORD;
$meta_desc="My Account, ".$METADESCRIPTION;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?=$pgtitle;?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1" name="viewport" />
    <meta name="description" content="<?=$meta_desc;?>" />
    <meta name="keywords" content="<?=$meta_kwords;?>" />
    <? include("favicon.php");?>
    <link rel="stylesheet" href="css/simplemenu.css">
    <link rel="stylesheet" type="text/css" href="css/style.css<?=$CSSLOAD;?>" />
    <link rel="stylesheet" type="text/css" href="css/responsive.css<?=$CSSLOAD;?>" />
    <? include("headermore.php");?>
</head>

<body onLoad="init();">
    <? include("top.php");?>
    <div class="middlewrapper">
        <!-- <div class="wrapper">
    <div class="category-detail">
	  <div class="category-detail-right" style="width:100%">
        <h1>My Account <span style="float:right;font-size:22px;"><a href="my-orders">My Orders</a> <?php /*?>| <a href="wishlist">Wishlist</a><?php */?></span></h1>
        <div class="category-pro-detail" >
          <div class="register-deta">
          <div class="register-detail">
            
            <div class="register-frm-top-detail">
              <? if($message!=""){?><p align="left"><strong style="color:#FF0000"><?=$message;?></strong></p><? } ?>
			  <p>Please fill out the form below to gain access to the <?=$SITE_TITLE;?> inventory system to place an order. This system is for <?=$SITE_TITLE;?> Retailers Only. Your information will not be shared with any third parties. It is to verify you are a business and for shipping purposes. An email will be sent to you confirming your login id, password. You will not have access to place an order until your application is approved. We may contact you by email or telephone to verify information.</p>
            </div>
            <div class="register-frm">
              <form id="FrmRegister" name="FrmRegister" method="post" enctype="multipart/form-data">
                <div class="row"><label>Full Name:</label><div class="col"><input id="firstname" class="registertextbox" name="firstname" value="<?=stripslashes($SelUserQryRow["firstname"]);?>" type="text">* </div><div class="clear"></div></div>
                <div class="row rrow"><label>Email:</label><div class="col"><input id="email" class="registertextbox" name="email" value="<?=stripslashes($SelUserQryRow["email"]);?>" type="text">* </div><div class="clear"></div></div>
                <div class="row rrow right"><label>Password:</label><div class="col"><input id="password" class="registertextbox" name="password" value="<?=EnCry_Decry(stripslashes($SelUserQryRow["password"]));?>" type="text">(minimum 5 characters)* </div><div class="clear"></div></div>
                <div class="row rrow"><label>Address 1:</label><div class="col"><input id="address1" class="registertextbox" name="address1" value="<?=stripslashes($SelUserQryRow["address1"]);?>" type="text">* </div><div class="clear"></div></div>
                <div class="row rrow right"><label>Address 2:</label><div class="col"><input id="address2" class="registertextbox" name="address2" value="<?=stripslashes($SelUserQryRow["address2"]);?>" type="text"></div><div class="clear"></div></div>
                <div class="row rrow"><label>City:</label><div class="col"><input id="city" class="registertextbox" name="city" value="<?=stripslashes($SelUserQryRow["city"]);?>" type="text">* </div><div class="clear"></div></div>
                <div class="row rrow right"><label>State:</label><div class="col"><select id="state" class="registertextbox registertextbox-select" name="state"><option value="">Select</option><?=GetDropdown(state,state,statenew,' where 1=1 order by state asc',stripslashes($SelUserQryRow["state"]));?></select>* </div><div class="clear"></div></div>
                <div class="row rrow"><label>Zip:</label><div class="col"><input id="zip" class="registertextbox" name="zip" value="<?=stripslashes($SelUserQryRow["zip"]);?>" type="text">* </div><div class="clear"></div></div>
                <div class="row rrow right"><label>Country:</label><div class="col"><select id="country" class="registertextbox registertextbox-select" name="country"><option value="">Select</option><?=GetDropdown(country_name,country_name,country,' where 1=1 order by country_name asc',stripslashes($SelUserQryRow['country']));?></select>* </div><div class="clear"></div></div>
                <div class="row rrow"><label>Phone:</label><div class="col"><input id="hometel" class="registertextbox" name="hometel" value="<?=stripslashes($SelUserQryRow["hometel"]);?>" type="text">* </div><div class="clear"></div></div>
                <div class="row rrow right"><label>Fax:</label><div class="col"><input id="fax" class="registertextbox" name="fax" value="<?=stripslashes($SelUserQryRow["fax"]);?>" type="text"></div><div class="clear"></div></div>
                <div class="row rrow"><label>Company:</label><div class="col"><input id="company" class="registertextbox" name="company" value="<?=stripslashes($SelUserQryRow["company"]);?>" type="text"></div><div class="clear"></div></div>
                <div class="row rrow right"><label>Company URL:</label><div class="col"><input id="website" class="registertextbox" name="website" value="<?=stripslashes($SelUserQryRow["website"]);?>" type="text"></div><div class="clear"></div></div>
                <div class="row"><label>Company Site Name:</label><div class="col"><input id="sitename" class="registertextbox" name="sitename" value="<?=stripslashes($SelUserQryRow["sitename"]);?>" type="text"></div><div class="clear"></div></div>
                <div class="row"><label>Instant Messenger:</label><div class="col"><select id="imm" class="registertextbox registertextbox-select" name="imm"><option value="">Select</option><option value="AIM" <? if($SelUserQryRow['imm']=="AIM"){echo"selected";}?>>AIM</option><option value="ICQ" <? if($SelUserQryRow['imm']=="ICQ"){echo"selected";}?>>ICQ</option><option value="MSN" <? if($SelUserQryRow['imm']=="MSN"){echo"selected";}?>>MSN</option><option value="Yahoo" <? if($SelUserQryRow['imm']=="Yahoo"){echo"selected";}?>>Yahoo</option><option value="Gtalk" <? if($SelUserQryRow['imm']=="Gtalk"){echo"selected";}?>>Gtalk</option>
                    </select></div><div class="clear"></div></div>
                <div class="row"><label>About Your Business:</label><div class="col"><textarea id="aboutme" class="registertextbox" style="height:50px;" name="aboutme"><?=stripslashes($SelUserQryRow["aboutme"]);?></textarea></div><div class="clear"></div></div>
                <div class="row"><label></label><div class="col"><input id="newsletter" name="newsletter" value="Y" <? if($SelUserQryRow['newsletter']=="Y"){echo"checked";}?> type="checkbox"> Please describe your business establishment.(Required For Approval) </div>
                  <div class="clear"></div></div>
                
                <div class="row"><label></label><div class="allbutton"> <a chref="#" onClick="return Chkregister();">Update</a> </div>
                  <div class="clear"></div></div><input type="hidden" name="HidRegUser" id="HidRegUser" value="0" />
                <div class="clear"></div>
              </form>
            </div>
          </div>
        </div>
          <div class="clear">&nbsp;</div>
        </div>
      </div>
      <div class="clear">&nbsp;</div>
    </div>
  </div> -->
        <div class="wrapper">
            <div class="login-main">
                <div class="login-title">My Account</div>
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
									value="<?=stripslashes($SelUserQryRow["firstname"]);?>" type="text"> *
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="r-row rrow">
                                <label>Email:</label>
                                <div class="r-col">
                                    <input id="email" class="registertextbox" name="email" value="<?=stripslashes($SelUserQryRow["email"]);?>"
                                        type="text"> *
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="r-row rrow right">
                                <label>Password:</label>
                                <div class="r-col">
                                    <input id="password" class="registertextbox" name="password"
									value="<?=EnCry_Decry(stripslashes($SelUserQryRow["password"]));?>" type="text"> (minimum 5 characters)*
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="r-row rrow">
                                <label>Address 1:</label>
                                <div class="r-col">
                                    <input id="address1" class="registertextbox" name="address1"
									value="<?=stripslashes($SelUserQryRow["address1"]);?>" type="text"> *
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="r-row rrow right">
                                <label>Address 2:</label>
                                <div class="r-col">
                                    <input id="address2" class="registertextbox" name="address2"
									value="<?=stripslashes($SelUserQryRow["address2"]);?>" type="text">
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
                                    <input style="margin-left: 0;" id="newsletter" name="newsletter" value="Y"
                                        checked="checked" type="checkbox">
                                    Please describe your business establishment.(Required For Approval)
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="r-row">
                                <label></label>
                                <div class="r-col">
                                    <a class="register-btn" href="#" onClick="return Chkregister();">Update</a>
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
    <script language="JavaScript">
    $(document).ready(function() {
        $(".topnav").accordion({
            accordion: false,
            speed: 500,
            closedSign: '<i class="fa fa-plus"></i>',
            openedSign: '<i class="fa fa-minus"></i>'
        });
    });
    </script>
    <script src='js/hammer.min.js'></script>
    <script src="js/simplemenu.js"></script>
    <script src="mask_files/wddx.js"></script>
    <script src="mask_files/masks.js"></script>
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
    <? include("googleanalytic.php");?>
    <? include("dbclose.php");?>
</body>

</html>