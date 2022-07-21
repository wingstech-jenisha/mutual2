<?
include("connect.php");
$_SESSION['UsErId'] = "";
$_SESSION['BUSI_UsErId'] = "";
$_SESSION['User_TypPe'] = "";
$_SESSION['UsErTyPe'] = "";
$_SESSION['CHECKOUT_UsErId'] = "";
unset($_SESSION['UsErId']);
unset($_SESSION['BUSI_UsErId']);
unset($_SESSION['UsErTyPe']);
unset($_SESSION['User_TypPe']);
setcookie("UsErId_COOKIE", "");
setcookie("UsErId_COKI", "", time() + (3600 * 24));
$_SESSION['shipmethod'] = "";
$_SESSION['shippingcost'] = "";
$_SESSION['shippingmethod'] = "";

unset($_SESSION['shipmethod']);
unset($_SESSION['shippingmethod']);
unset($_SESSION['shippingcost']);
?><script language="javascript">
    location.href = "<?= $SECURE_URL ?>/";
</script>