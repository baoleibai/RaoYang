<?php require_once('../Connections/raoYang.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['username'])) {
  $loginUsername=$_POST['username'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "userwelcome.php";
  $MM_redirectLoginFailed = "admin.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_raoYang, $raoYang);
  
  $LoginRS__query=sprintf("SELECT username, password FROM Employee WHERE username=%s AND password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $raoYang) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<title>RaoYang Gold Shuttle Textiles Factory</title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<meta name="Keywords" content="Jinsuo Cotton Textile Factory of Raoyang, China CVC 75/25 18*18 60*60 78" grey="" fabric="" for="" australia="" market,="" cvc="" 50="" plain="" polyester="" cotton="" bedding="" sheets="" fabric,="" t="" c="" 52="" 48="" 40s*40s="" 110*85="" 110"="" bleached="" white="" curtain="" home="" textile"="">
<meta name="Description" content="China Manufacturer, Trading Company of CVC 75/25 18*18 60*60 78" grey="" fabric="" for="" australia="" market,="" cvc="" 50="" plain="" polyester="" cotton="" bedding="" sheets="" fabric,="" t="" c="" 52="" 48="" 40s*40s="" 110*85="" 110"="" bleached="" white="" curtain="" home="" textile="" -="" jinsuo="" factory="" of="" raoyang"="">

<link href="/css/style.css" rel="stylesheet" type="text/css" />


<script type="text/javascript">
<!--
function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
    } if (errors) alert('The following error(s) occurred:\n'+errors);
    document.MM_returnValue = (errors == '');
} }
//-->
</script>
</head>
<body >
<table width="100" height="232" border="0" align="center" cellpadding="0" cellspacing="0" class="outer">
	<tr>
	  <td class="name"  align="center">饶阳金梭棉纺织厂网站管理页面<span class="name2"></span></td></tr>
	<tr>
		<td height="162" valign="top"><form action="<?php echo $loginFormAction; ?>" method="POST" id="userlogin" onsubmit="MM_goToURL('parent','userwelcome.php');return document.MM_returnValue">
          <table width="247" border="0" align="center" cellpadding="1">
  <tr>
    <th colspan="2" scope="col" onfocus="MM_validateForm('username','','R','password','','R');return document.MM_returnValue">员工登陆</th>
    </tr>
    <tr>
    
    </tr>
  <tr>
    <td width="60">用户名</td>
    <td width="171">
      <input name="username" type="text" id="username" autocomplete="off" size="20" /></td>
  </tr>
  <tr>
    <td>密码</td>
    <td><label>
      <input name="password" type="password" id="password" autocomplete="off" size="20" />
    </label></td>
  </tr>
  <tr>
    <td colspan="2"  align="center"><label>
      <input type="submit" name="submit" id="submit" value="登录" />&nbsp;&nbsp;&nbsp;
       <input type="reset" name="reset" id="reset" value="清空" />
    </label></td>
    </tr>
</table>
          </form>
		</td>
	</tr>
</table>
</body>
</html>