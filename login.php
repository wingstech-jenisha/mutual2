<? 
include("connect.php");//error_reporting(E_ALL);
$TopTab="Login";$ShWSubMenu="Y";
$mesgg="";
function Get_CreatePasswordForgotSC()
{
	$chars = "abcdefghijkmnopq123456789rstuvwxyz123456789";    
	srand((double)microtime()*1000000);
    $i = 0;
    $pass = '' ;

    while ($i <= 5) {
        $num = rand() % 33;
        $tmp = substr($chars, $num, 1);
        $pass = $pass . $tmp;
        $i++;
    }
    return $pass;
}
$LoginBackUrlVari=$SITE_URL."/myaccount";	
if($_SERVER['HTTP_HOST']!='webster3' && $_POST['HidRegUser']!="1")
{
	//include("fbmain.php");
	if($_GET['code']!='')
	{
		$user = $facebook->getUser();
		$access_token = $facebook->getAccessToken();
	}	
}
if(isset($userInfo['id']) && $userInfo['id'] !='' && $_GET['code']!='' && $_POST['HidRegUser']!="1")
{
	$fbid=$userInfo['id'];
	$funame=addslashes($userInfo['username']);
	$ffname=addslashes($userInfo['first_name']);
	$flname=addslashes($userInfo['last_name']);
	$femail=addslashes($userInfo['email']);
	
	$SelUserRec = mysql_query("SELECT * FROM mutual_users WHERE fbid='".$fbid."'");
	$Totgetuser = mysql_num_rows($SelUserRec);
	if($Totgetuser<=0)
	{
		$filename = $fbid;
		$getCustomerQry="SELECT id from mutual_users WHERE (email='". $femail ."') ";	
		$getCustomerQryRs=mysql_query($getCustomerQry);
		$TotgetCustomer=mysql_affected_rows();
		if($TotgetCustomer<=0)
		{
			$filename = $fbid;
			$Passs=Get_CreatePasswordForgotSC();	
			$PasssWD=EnCry_Decry($Passs);
			$Ynamee = $ffname." ".$flname; 
			$UpdateUserQry="INSERT INTO mutual_users SET registerfrom='Facebook',
			firstname='".addslashes($ffname)."',
			password='".addslashes($PasssWD)."', 
			email='".addslashes($femail)."',regdate=now(),approve='Y',fbid='".$fbid."'";
			mysql_query($UpdateUserQry);
			$InserId=mysql_insert_id();
			$_SESSION['UsErId']=$InserId;
			
			header("location:".$LoginBackUrlVari."");exit;
		}
		else
		{
			$Getvalue=mysql_fetch_array($SelUserRec);
			$_SESSION['UsErId']=$Getvalue['id'];
			header("location:".$LoginBackUrlVari."");exit;
		}
	} 
	else
	{
		$Getvalue=mysql_fetch_array($SelUserRec);
		$_SESSION['UsErId']=$Getvalue['id'];
		header("location:".$LoginBackUrlVari."");exit;
	}
}
if($_POST['HidRegUser']=="1")
{
	$password = EnCry_Decry($_POST['password']);
	$query1="select id from mutual_users where email='".trim(addslashes(($_POST['email'])))."' AND password='".trim(addslashes(($password)))."'  ";
	$res=mysql_query($query1);
	$tot=mysql_affected_rows();
	if($tot>0)
	{
		$UpdateUserrq=mysql_fetch_object($res);
		$InserId=stripslashes($UpdateUserrq->id);
		
		$_SESSION['UsErId']=$InserId;
		
		//Coocke
		setcookie("UsErId_COKI",$row["id"],time()+(3600*168));
		
		if($_GET["back"]!="")
		{
			header("location:".$SECURE_URL."/".($_GET["back"]));exit;
		}
		else
		{
			header("location:".$SECURE_URL."/");exit;
		}
	}
	else
	{
		$message="Invalid login details. Try again.";
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
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <link rel="stylesheet" href="css/carouseller.css">
    <link rel="stylesheet" type="text/css" href="css/slick.css">
    <link rel="stylesheet" type="text/css" href="css/slick-theme.css">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/responsive.css" />
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css" />

</head>

<body>
    <? include("top.php");?>
    <div class="middlewrapper">
        <div class="wrapper">
            <div class="login-main">
                <div class="login-title">Login or Create an Account</div>
                <div class="login-detail">
                    <div class="login-right">
                        <div class="login-detail-title">Registered Customers</div>
                        <div class="login-frm">
                            <form name="FrmRegister" enctype="multipart/form-data" method="post">
                                <? if($message!=""){?>
                                <p align="left"><strong style="color:#FF0000"><?=$message;?></strong></p>
                                <? } ?>
                                <div class="login-frm-title">If you have an account with us, please log in.</div>
                                <div class="l-row">
                                    <label>Email Address <span>*</span></label>
                                    <div class="l-col">
                                        <input id="email" class="logintextbox" name="email" type="text">
                                    </div>
                                </div>
                                <div class="l-row">
                                    <label>Password <span>*</span></label>
                                    <div class="l-col">
                                        <input id="password" class="logintextbox" name="password" type="password">
                                    </div>
                                </div>
                                <div class="row"> <span style="margin:0;color:red;">*</span> Required Fields </div>
                                <div class="login-bottom-btn">
                                    <a class="login-bottom-btn-left forgot-pass-btn" href="forgot-password">Forgot Your
                                        Password?</a>
                                    <a class="login-bottom-btn-right" href="#"
                                        onClick="Chkregister();return false;">Login</a>
                                    <div class="clear"></div>
                                </div>
                                <input type="hidden" name="HidRegUser" id="HidRegUser" value="0">
                            </form>
                        </div>
                    </div>
                    <div class="login-left">
                        <div class="login-detail-title">New Customers</div>
                        <div class="new-custimer-title">Register with us for future convenience:</div>
                        <div class="customersdeta-detail">
                            <ul>
                                <li>Fast and easy check out</li>
                                <li>Easy access to your order history and status</li>
                                <li>Exclusive promotional offers and deals</li>
                                <li><b>Earn Rewards</b> on every purchase</li>
                                <li>Sign in with your preferred Social Network credentials</li>
                                <li>
                                    <a href="#"><img src="fblogin.png" alt="" /></a>
                                    <a href="#"><img src="googlelogin.png" alt="" /></a>
                                </li>
                            </ul>
                            <div class="login-bottom-btn">
                                <a class="login-bottom-btn-right" href="#">Register</a>
                                <div class="clear"></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>

    <? include("footer.php");?>
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
    function Chkregister() {
        form = document.FrmRegister;
        if (form.email.value == "") {
            alert("Please enter your email address.");
            form.email.focus();
            return false;
        } else if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(form.email.value))) {
            alert("Please enter a proper email address.");
            form.email.focus();
            return false;
        } else if (form.password.value == "") {
            alert("Please enter password.");
            form.password.focus();
            return false;
        } else {
            form.HidRegUser.value = 1;
            form.submit();
            return true;
        }
    }
    </script>
    <? include("dbclose.php");?>
</body>
</html>