<?php include("../connect.php");

########## Google Settings.. Client ID, Client Secret #############
$google_client_id 		= '761060715315-s2rptdmu6ntah8fmsrq99to6iu3gi4kn.apps.googleusercontent.com';
$google_client_secret 	= 'VC0XsWJ4qYy6FrvlP7GcSk9K';
$google_redirect_url 	= ''.$SITE_URL.'/google-plus';
$google_developer_key 	= ' AIzaSyCG2V-4Eq9Tu-WtWvJyUq1qvte4ulQcmK0';

//include google api files
require_once 'src/Google_Client.php';
require_once 'src/contrib/Google_Oauth2Service.php';

if($_REQUEST['error']=='access_denied')
{
	header("location:".$SITE_URL."/login");
	exit;
}
//start session
//session_start();

$gClient = new Google_Client();
$gClient->setApplicationName('Login to RaceThread.com');
$gClient->setClientId($google_client_id);
$gClient->setClientSecret($google_client_secret);
$gClient->setRedirectUri($google_redirect_url);
$gClient->setDeveloperKey($google_developer_key);

$google_oauthV2 = new Google_Oauth2Service($gClient);

//If user wish to log out, we just unset Session variable
if (isset($_REQUEST['reset'])) 
{
  unset($_SESSION['token']);
  $gClient->revokeToken();
  header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL));
}
if (isset($_GET['code'])) 
{ 
	$gClient->authenticate($_GET['code']);
	$_SESSION['token'] = $gClient->getAccessToken();
	header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL));
	return;
}
if (isset($_SESSION['token'])) 
{ 
		$gClient->setAccessToken($_SESSION['token']);
}
if ($gClient->getAccessToken()) 
{
	  //Get user details if user is logged in
	  $user 				= $google_oauthV2->userinfo->get();
	  $user_id 				= $user['id'];
	  $user_name 			= filter_var($user['name'], FILTER_SANITIZE_SPECIAL_CHARS);
	  $email 				= filter_var($user['email'], FILTER_SANITIZE_EMAIL);
	  $profile_url 			= filter_var($user['link'], FILTER_VALIDATE_URL);
	  $profile_image_url 	= filter_var($user['picture'], FILTER_VALIDATE_URL);
	  $personMarkup 		= "$email<div><img src='$profile_image_url?sz=50'></div>";
	  $_SESSION['access_token'] 	= $gClient->getAccessToken();
}
else 
{
	$authUrl = $gClient->createAuthUrl();
}
//HTML page start
echo '<html xmlns="http://www.w3.org/1999/xhtml">';
echo '<head>';
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
echo '<title>Login with Google</title>';
echo '</head>';
echo '<body>';

if(isset($authUrl)) //user is not logged in, show login button
{
	echo "<script>window.location.href='".$authUrl."';</script>";
} 
else // user logged in 
{
    $SelUserRec = mysql_query("SELECT * FROM users WHERE username='".$user['email']."' or email='".$user['email']."'");
	$Totgetuser = mysql_num_rows($SelUserRec);
	if($Totgetuser<=0)
	{	
		$Passs=rand(1,999999999);
		$PasssWD=EnCry_Decry($Passs); 
		$UsrEMal=addslashes($user['email']);
		$Ynamee = $user['given_name'];
		$Ynamee2 = $user['family_name'];
		
		if($user['picture']!='')
		{
			$saveimagename=$user_id.".jpg";
			$imgurl_1 = $user['picture'];
			@copy($imgurl_1,"../Users/".$saveimagename."");
		}
		
		$UpdatQry="INSERT INTO users SET username='".addslashes($UsrEMal)."', picture= '".$saveimagename."',
		firstname='".addslashes($Ynamee)."',lastname='".addslashes($Ynamee2)."',ggid='".addslashes($user['id'])."',
		email='".addslashes($UsrEMal)."', password='".addslashes($PasssWD)."', 
		regdate=now(),
		approve='Active'";
		mysql_query($UpdatQry);
		$InserId=mysql_insert_id();
		$_SESSION['UsErId']=$InserId;
		
		if($_SESSION["FRMACCOUNT"]=="Y")
		{
			echo "<script>window.location.href='../myaccount';</script>";exit;
		}
		else
		{
			echo "<script>window.location.href='".$_SESSION["LoginBackUrl"]."';</script>";exit;
		}
	} 
	else
	{
		$Getvalue=mysql_fetch_array($SelUserRec);
		$_SESSION['UsErId']=$Getvalue['id'];
		if($_SESSION["FRMACCOUNT"]=="Y")
		{
			echo "<script>window.location.href='../myaccount';</script>";exit;
		}
		else
		{
			echo "<script>window.location.href='".$_SESSION["LoginBackUrl"]."';</script>";exit;
		}
	}	
}
echo '</body></html>';
?>