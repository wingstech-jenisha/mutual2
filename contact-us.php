<? 
$page="contact-us";
include("connect.php");
$TopTab="contact-us";
$CMSQry="select * from mutual_staticpage where id='2'";
$CMSRes=mysql_query($CMSQry);
$CMSRow=mysql_fetch_object($CMSRes);
$pgtitle=trim(stripslashes($CMSRow->pgtitle));
$meta_desc=trim(stripslashes($CMSRow->meta_desc));
$meta_kwords=trim(stripslashes($CMSRow->meta_kwords));
$meta_h1title=trim(stripslashes($CMSRow->h1title));
$Home_name=stripslashes($CMSRow->name);
$Home_content=stripslashes($CMSRow->content);
if($_POST['HidRegUser']=="1")
{
	
	if(trim($_POST['name'])!='' && trim($_POST['email'])!='' && trim($_POST['message'])!='')
	{
		$get="SELECT * FROM mutual_contactus WHERE name='" . addslashes($_POST['name']) . "' AND email='" . addslashes($_POST['email']) . "' AND message='" . addslashes($_POST['message']) . "'";
		$getRs=mysql_query($get);
		$Totget=mysql_affected_rows();
		if($Totget<=0)
		{
			$InsertUserQry = "INSERT INTO mutual_contactus set 
			name='" . addslashes($_POST['name']) . "',
			email='" . addslashes($_POST['email']) . "',
			message='" . addslashes($_POST['message']) . "',
			regdate=now()";
			mysql_query($InsertUserQry);

			
			$subject1="Contact us request at flagginmart.com";
			$mailcontent1="<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"1000\">
							<tbody>
								<tr>
									<td align=\"left\" valign=\"top\">
										<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
											<tbody>
												<tr>
													<td align=\"left\" valign=\"middle\">
														<img src=\"https://www.flagginmart.com/logo.jpg\" /></td>
												</tr>
												<tr>
													<td align=\"left\" bgcolor=\"#FFFFFF\"  valign=\"top\">
														<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
															<tbody>
																<tr>
																	<td>
																		&nbsp;</td>
																</tr>
																<tr>
																	<td align=\"left\" style=\"line-height:22px;\" valign=\"top\">
																		Contact us request has been submitted with the below details:<br /><br />
																		Name: ".stripslashes($_POST['name'])."<br />
																		Email: ".stripslashes($_POST['email'])."<br />
																		Message: ".nl2br(stripslashes($_POST['message']))."<br /><br />
																		URL: <a href='https://www.flagginmart.com/contact-us'>https://www.flagginmart.com/contact-us</a><br /></td>
																</tr>
																<tr>
																	<td>
																		&nbsp;</td>
																</tr>
															</tbody>
														</table>
													</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>";
			//echo $subject1."<br>";echo $mailcontent1;exit;
			if($_SERVER['HTTP_HOST']!="yogs")
			{
				$headers  = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
				$headers .= "From: $SITE_TITLE <$ADMIN_MAIL>" . "\r\n";	
				mail("parth.rae@gmail.com", $subject1, $mailcontent1, $headers);
				//mail("rpaxis2@gmail.com", $subject1, $mailcontent1, $headers);
				
			}
			$message="Thank You! Your request has been submitted successfully!";
		}
	}
	else
	{
		$message="Please fill form.";
	}
}
if($meta_kwords==''){$meta_kwords=$pgtitle.", ".$METAKEYWORD;}
if($meta_desc==''){$meta_desc=$pgtitle.", ".$METADESCRIPTION;}
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
                        <div class="clear">&nbsp;</div>
                        <div class="login-deta" style="padding:0px;">
                            <div class="registered_customers-deta" style="float:left;width:100%;">
                                <h2 class="login-new-head"
                                    style="padding-left:0px;border-bottom: 1px solid #eee;padding-bottom:20px;">Contact
                                    Us</h2>
                                <form name="FrmRegister" enctype="multipart/form-data" method="post">
                                    <div class="login-frm-deta" style="padding-left:0px;">
                                        <? if($message!=""){?>
                                        <p align="left"><strong style="color:#FF0000"><?=$message;?></strong></p>
                                        <? } ?>
                                        <p>Alternatively, you may use the form below to submit inquiries, comments, or
                                            questions.</p>
                                        <div class="l-row">
                                            <label>Name<span>*</span></label>
                                            <div class="l-col">
                                                <input id="name" class="logintextbox" name="name" type="text"
                                                    style="width:100%;max-width:320px;">
                                            </div>
                                        </div>
                                        <div class="l-row">
                                            <label>Email Address <span>*</span></label>
                                            <div class="l-col">
                                                <input id="email" class="logintextbox" name="email" type="text"
                                                    style="width:100%;max-width:320px;">
                                            </div>
                                        </div>
                                        <div class="l-row"> <label>Message <span>*</span></label>
                                            <div class="l-col"><textarea id="message" class="logintextbox"
                                                    name="message"
                                                    style="width:100%;max-width:320px;height:120px"></textarea></div>
                                        </div>
                                    </div>
                                    <div class="login-bottom-btn" style="padding-left:0px;margin-top:0px;border:0px;">
                                        <a style="float:left;" class="login-bottom-btn-right" href="#" onClick="Chkregister();return false;">Submit</a>
                                        <div class="clear"></div>
                                    </div><input type="hidden" name="HidRegUser" id="HidRegUser" value="0" />
                                </form>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="clear">&nbsp;</div>
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

<script>
    function Chkregister() {
        form = document.FrmRegister;
        if (form.name.value == "") {
            alert("Please enter name.");
            form.name.focus();
            return false;
        }else if (!(/^[a-zA-Z' ]*$/.test(form.name.value))) {
            alert("Please enter a proper name.");
            form.name.focus();
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
        if (form.message.value == "") {
            alert("Please enter message.");
            form.message.focus();
            return false;
        }
        form.HidRegUser.value = 1;
        form.submit();
        return true;
    }

    function trim(stringToTrim) {
        return stringToTrim.replace(/^\s+|\s+$/g, "");
    }
    </script>
    <? include("dbclose.php"); ?>
</body>

</html>