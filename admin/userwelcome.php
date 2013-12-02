<?php require_once('../Connections/raoYang.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
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
	<tr><td class="name">饶阳金梭棉纺织厂网站管理页面<span class="name2"></span></td></tr></tr>
	
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td valign="top">
			<table width="923" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr><div class="inner_copy"></div>
					<td valign="top" id="left">
						<table width="194" border="0" align="center" cellpadding="0" cellspacing="0">
							<tr><td height="3"></td></tr>
							<tr>
							  <td height="20" class="cat-head">欢迎您: <?php echo $row_loggedinuser['Surname']; ?></td></tr>
                             <tr>
							 <td height="20" class="cat-head"><a href="<?php echo $logoutAction ?>">退出登录</a></td></tr>
							<tr><td class="leftlinks"><a href="#" target="_blank">ï¿½ Category Name</a></td></tr>
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
															<table width="707"  border="0" align="center" cellpadding="0" cellspacing="0">
																<tr><td height="8"></td></tr>
																<tr><td class="box-head">Place Name</td></tr>
																<tr><td height="19">&nbsp;</td></tr>
																<tr><td align="center"><img src="images/beauty-products1.jpg" alt="beauty" style="border:1px solid #c2c2c2;" /></td></tr>
																<tr><td height="17"></td></tr>
																<tr><td class="smal-txt">sample text sample text sample text sample text sample text...</td></tr>
																<tr><td height="11"></td></tr>
																<tr>
																	<td height="50">
																		<table border="0" align="center" cellpadding="0" cellspacing="0">
																			<tr>
																				<td width="70" class="price">$72.00</td>
																				<td width="1" bgcolor="#D9D9D9"></td>
																				<td width="117">
																					<table width="94" border="0" align="center" cellpadding="0" cellspacing="0">
																						<tr><td class="add">&raquo; <a href="#" target="_blank">Add to Cart</a></td></tr>
																						<tr><td height="4"></td></tr>
																						<tr><td class="details">&raquo; <a href="#" target="_blank">Details</a></td></tr>
																					</table>
																				</td>
																			</tr>
																		</table>
																	</td>
																</tr>
															</table>
														</td>
														<td width="6" valign="top"></td>
														
													</tr>
												</table>
											</td>
										</tr>
										<tr><td valign="top">&nbsp;</td></tr>
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
