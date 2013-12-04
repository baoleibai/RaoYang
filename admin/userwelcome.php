<?php require_once('../Connections/raoYang.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
   $v_url=$_SERVER['HTTP_REFERER'];
   if( (!isset($_SESSION['MM_Username']))) {
	   session_destroy();
	   header("Location: http://www.goldshuttletextiles.com/admin/admin.php");
   }
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "admin.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
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

$colname_loggedinuser = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_loggedinuser = $_SESSION['MM_Username'];
}
mysql_select_db($database_raoYang, $raoYang);
$query_loggedinuser = sprintf("SELECT Surname, Firstname FROM Employee WHERE username = %s", GetSQLValueString($colname_loggedinuser, "text"));
$loggedinuser = mysql_query($query_loggedinuser, $raoYang) or die(mysql_error());
$row_loggedinuser = mysql_fetch_assoc($loggedinuser);
$totalRows_loggedinuser = mysql_num_rows($loggedinuser);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<title>RaoYang Gold Shuttle Textiles Factory</title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<meta name="Keywords" content="Jinsuo Cotton Textile Factory of Raoyang, China CVC 75/25 18*18 60*60 78" grey="" fabric="" for="" australia="" market,="" cvc="" 50="" plain="" polyester="" cotton="" bedding="" sheets="" fabric,="" t="" c="" 52="" 48="" 40s*40s="" 110*85="" 110"="" bleached="" white="" curtain="" home="" textile"="">
<meta name="Description" content="China Manufacturer, Trading Company of CVC 75/25 18*18 60*60 78" grey="" fabric="" for="" australia="" market,="" cvc="" 50="" plain="" polyester="" cotton="" bedding="" sheets="" fabric,="" t="" c="" 52="" 48="" 40s*40s="" 110*85="" 110"="" bleached="" white="" curtain="" home="" textile="" -="" jinsuo="" factory="" of="" raoyang"="">

<link href="/css/style.css" rel="stylesheet" type="text/css" />

</head>
<body>
<table width="100" border="0" align="center" cellpadding="0" cellspacing="0" class="outer">
	<tr><td class="name" align="center">饶阳金梭棉纺织厂网站管理页面<span class="name2"></span></td></tr></tr>
	
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td valign="top">
			<table width="923" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr><div class="inner_copy"></div>
					<td valign="top" id="left">
						<table width="194" border="0" align="center" cellpadding="0" cellspacing="0">
							<tr><td height="3"></td></tr>
							<tr>
							  <td height="20" class="cat-head">欢迎您: <?php echo $row_loggedinuser['Surname']; ?><?php echo $row_loggedinuser['Firstname']; ?></td></tr>
                             <tr>
							 <td height="20" class="cat-head"><a href="<?php echo $logoutAction ?>">退出登录</a></td></tr>
							<tr><td class="leftlinks"><a href="userwelcome.php" target="_self">添加产品</a></td></tr>
						</table>
					</td>
					<td valign="top">
						<table width="707" border="0" align="right" cellpadding="0" cellspacing="0">
							<tr>
								<td>
									<table width="707" border="0" align="right" cellpadding="0" cellspacing="0">
										<tr>
											<td valign="top">
<table border="0" width="707"  cellspacing="0" cellpadding="0">
													<tr>
														<td valign="top" class="box-border">
														  <form action="" method="post" name="addProduct" target="_self">
                                                            <table width="707" border="0" cellpadding="1">
  <tr>
    <th colspan="2"  class="box-head" scope="col">Add Product</th>
    </tr>
  <tr>
    <td width="120">Product Name:</td>
    <td width="577"><label>
      <input name="Name" type="text" id="Name" size="50" maxlength="100" />
    </label></td>
  </tr>
  <tr>
    <td>Unit Price (US $/ Meter):</td>
    <td><label>
      <input type="text" name="UnitPrice" id="UnitPrice" />
    </label></td>
  </tr>
  <tr>
    <td>Min. Order (Meter):</td>
    <td><label>
      <input type="text" name="MinOrder" id="MinOrder" />
    </label></td>
  </tr>
  <tr>
    <td>Trade Terms:</td>
    <td><input type="checkbox" name="checkbox" id="checkbox" /></td>
  </tr>
  <tr>
    <td>Payment Terms:</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Product Picture:</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Price Valid From:</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Price Valid To:</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" class="box-head">Basic Info.</td>
    </tr>
  <tr>
    <td>Material:</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Usage:</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Width (Inch):</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Extra Width (Inch):</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Weight (g/m²):</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Technics:</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Composition:</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Yarn Count:</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Yarn Type:</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Density:</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Edge:</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Parttern:</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Color:</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Export Markets:</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" class="box-head">Additional Info.</td>
    </tr>
  <tr>
    <td>Packing:</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Standars:</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Origin:</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>HS Code:</td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td>Production Capacity (Meter/Month):</td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td colspan="2" class="box-head">Product Description.</td>
    </tr>
    <tr>
    <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
    <td colspan="2">HS Code:</td>
    </tr>
</table>

                                                            
                                                            
                                                            </form>
														</td>
													</tr>
												</table>
											</td>
										</tr>
										
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td valign="top">
			<table width="923" border="0" align="center" cellpadding="0" cellspacing="0">
			</table>
		</td>
	</tr>
</table>
</body>
</html>
<?php
mysql_free_result($loggedinuser);
?>
