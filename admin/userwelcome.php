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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "addProduct")) {
	foreach($_POST['Usage'] as $uses) 
    { 
        $UsageValues .= $uses ." "; 
    }
	foreach($_POST['EdgeTypeList'] as $uses) 
    { 
        $EdgeValues .= $uses ." "; 
    }
	foreach($_POST['Color'] as $uses) 
    { 
        $ColorValues .= $uses ." "; 
    }
  $insertSQL = sprintf("INSERT INTO BasicProductInfo (`Material Type`, Width, Weight, `Yarn Count`, Density, Color, `Usage`, Technics, Pattern, Composition, Edge, `Export Markets`, Name, TradeTerms, PaymentTerms, UnitPrice, MinOrder, PriceValidFrom, PriceValidTo, Style, YarnType, ExtraWidth, Picture, Trademark, Packing, Standard, Origin, HSCode, ProductCapacity, ProductDescription, Quality, Component, ModelNo) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Material'], "text"),
                       GetSQLValueString($_POST['Width'], "text"),
                       GetSQLValueString($_POST['Weight'], "text"),
                       GetSQLValueString($_POST['YarnCount'], "text"),
                       GetSQLValueString($_POST['Density'], "text"),
                       GetSQLValueString($ColorValues, "text"),
                       GetSQLValueString($UsageValues, "text"),
                       GetSQLValueString($_POST['Technics'], "text"),
                       GetSQLValueString($_POST['Pattern'], "text"),
                       GetSQLValueString($_POST['ProductCompositionList'], "text"),
                       GetSQLValueString($EdgeValues, "text"),
                       GetSQLValueString($_POST['ExportMarket'], "text"),
                       GetSQLValueString($_POST['Name'], "text"),
                       GetSQLValueString($_POST['TradeTerms'], "text"),
                       GetSQLValueString($_POST['PaymentTerms'], "text"),
                       GetSQLValueString($_POST['UnitPrice'], "text"),
                       GetSQLValueString($_POST['MinOrder'], "text"),
                       GetSQLValueString($_POST['ValidFrom'], "text"),
                       GetSQLValueString($_POST['ValidTo'], "text"),
                       GetSQLValueString($_POST['Style'], "text"),
                       GetSQLValueString($_POST['YarnType'], "text"),
                       GetSQLValueString($_POST['ExtraWidth'], "text"),
                       GetSQLValueString($_POST['PicName'], "text"),
                       GetSQLValueString($_POST['Trademark'], "text"),
                       GetSQLValueString($_POST['Packaging'], "text"),
                       GetSQLValueString($_POST['Standard'], "text"),
                       GetSQLValueString($_POST['Origin'], "text"),
                       GetSQLValueString($_POST['HsCode'], "text"),
                       GetSQLValueString($_POST['Capacity'], "text"),
                       GetSQLValueString($_POST['ProductDescription'], "text"),
                       GetSQLValueString($_POST['qualityList'], "text"),
                       GetSQLValueString($_POST['Component'], "text"),
                       GetSQLValueString($_POST['ModelNo'], "text"));

  mysql_select_db($database_raoYang, $raoYang);
  $Result1 = mysql_query($insertSQL, $raoYang) or die(mysql_error());

  $insertGoTo = "userwelcome.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
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

mysql_select_db($database_raoYang, $raoYang);
$query_EdgeTypeList = "SELECT * FROM ProductEdge ORDER BY id ASC";
$EdgeTypeList = mysql_query($query_EdgeTypeList, $raoYang) or die(mysql_error());
$row_EdgeTypeList = mysql_fetch_assoc($EdgeTypeList);
$totalRows_EdgeTypeList = mysql_num_rows($EdgeTypeList);

mysql_select_db($database_raoYang, $raoYang);
$query_TadeTerms = "SELECT * FROM TradeTerms ORDER BY id ASC";
$TadeTerms = mysql_query($query_TadeTerms, $raoYang) or die(mysql_error());
$row_TadeTerms = mysql_fetch_assoc($TadeTerms);
$totalRows_TadeTerms = mysql_num_rows($TadeTerms);

mysql_select_db($database_raoYang, $raoYang);
$query_ProductTypeList = "SELECT GroupName FROM ProductGroups ORDER BY GroupName ASC";
$ProductTypeList = mysql_query($query_ProductTypeList, $raoYang) or die(mysql_error());
$row_ProductTypeList = mysql_fetch_assoc($ProductTypeList);
$totalRows_ProductTypeList = mysql_num_rows($ProductTypeList);

mysql_select_db($database_raoYang, $raoYang);
$query_ColorList = "SELECT Color FROM ProductColor ORDER BY Color ASC";
$ColorList = mysql_query($query_ColorList, $raoYang) or die(mysql_error());
$row_ColorList = mysql_fetch_assoc($ColorList);
$totalRows_ColorList = mysql_num_rows($ColorList);

mysql_select_db($database_raoYang, $raoYang);
$query_ProductComposition = "SELECT composition FROM ProductComposition ORDER BY composition ASC";
$ProductComposition = mysql_query($query_ProductComposition, $raoYang) or die(mysql_error());
$row_ProductComposition = mysql_fetch_assoc($ProductComposition);
$totalRows_ProductComposition = mysql_num_rows($ProductComposition);

mysql_select_db($database_raoYang, $raoYang);
$query_StyleList = "SELECT style FROM ProductStyle ORDER BY style ASC";
$StyleList = mysql_query($query_StyleList, $raoYang) or die(mysql_error());
$row_StyleList = mysql_fetch_assoc($StyleList);
$totalRows_StyleList = mysql_num_rows($StyleList);

mysql_select_db($database_raoYang, $raoYang);
$query_TypeList = "SELECT quality FROM YarnType ORDER BY quality ASC";
$TypeList = mysql_query($query_TypeList, $raoYang) or die(mysql_error());
$row_TypeList = mysql_fetch_assoc($TypeList);
$totalRows_TypeList = mysql_num_rows($TypeList);

mysql_select_db($database_raoYang, $raoYang);
$query_QualityList = "SELECT quality FROM ProductQuality ORDER BY quality ASC";
$QualityList = mysql_query($query_QualityList, $raoYang) or die(mysql_error());
$row_QualityList = mysql_fetch_assoc($QualityList);
$totalRows_QualityList = mysql_num_rows($QualityList);

mysql_select_db($database_raoYang, $raoYang);
$query_UsageEecordset = "SELECT * FROM ProductUsage ORDER BY `usage` ASC";
$UsageEecordset = mysql_query($query_UsageEecordset, $raoYang) or die(mysql_error());
$row_UsageEecordset = mysql_fetch_assoc($UsageEecordset);
$totalRows_UsageEecordset = mysql_num_rows($UsageEecordset);
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
														  <form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="addProduct" target="_self">
                                                            <table width="707" border="0" cellpadding="1">
  <tr>
    <th colspan="2"  class="box-head" >Add Product</th>
    </tr>
  <tr>
    <td width="158">Product Name:</td>
    <td width="539"><label>
      <input name="Name" type="text" id="Name" size="50" maxlength="100" />
    </label></td>
  </tr>
  <tr>
    <td width="158">Product Type:</td>
    <td width="539"><select name="ProductType">
      <?php
do {  
?>
      <option value="<?php echo $row_ProductTypeList['GroupName']?>"><?php echo $row_ProductTypeList['GroupName']?></option>
      <?php
} while ($row_ProductTypeList = mysql_fetch_assoc($ProductTypeList));
  $rows = mysql_num_rows($ProductTypeList);
  if($rows > 0) {
      mysql_data_seek($ProductTypeList, 0);
	  $row_ProductTypeList = mysql_fetch_assoc($ProductTypeList);
  }
?>
    </select></td>
  </tr>
  <tr>
    <td>Unit Price (US $/ Meter):</td>
    <td><label>
      <input name="UnitPrice" type="text" id="UnitPrice" value="$ / Meter" />
    </label></td>
  </tr>
  <tr>
    <td>Min. Order (Meter):</td>
    <td><label>
      <input name="MinOrder" type="text" id="MinOrder" value="20000.0 Meter" />
    </label></td>
  </tr>
  <tr>
    <td>Trade Terms:</td>
    <td>
      <input name="TradeTerms" type="text" id="TradeTerms" value="FOB, CFR, CIF" /></td>
  </tr>
  <tr>
    <td>Payment Terms:</td>
    <td><label for="PaymentTerms"></label>
      <input name="PaymentTerms" type="text" id="PaymentTerms" value="L/C, T/T" /></td>
  </tr>
  <tr>
    <td>Picture Name:</td>
    <td><input name="PicName" type="text" /></td>
  </tr>
  <tr>
    <td>Price Valid From:</td>
    <td><input type="text" name="ValidFrom" id="ValidFrom" /></td>
  </tr>
  <tr>
    <td>Price Valid To:</td>
    <td><input type="text" name="ValidTo" id="ValidTo" /></td>
  </tr>
  <tr>
    <td colspan="2" class="box-head">Basic Info.</td>
    </tr>
    <tr>
    <td>Model No:</td>
    <td><label for="Model No"></label>
      <input name="ModelNo" type="text" id="ModelNo" /></td>
  </tr>
  <tr>
    <td>Material:</td>
    <td><label for="Material"></label>
      <input name="Material" type="text" id="Material" value="Cotton / Polyester" /></td>
  </tr>
  <tr>
    <td>Usage:</td>
    <td><p>
      <label for="Usage"></label>
      <select name="Usage[]" size="1" id="Usage"  multiple>
        <?php
do {  
?>
        <option value="<?php echo $row_UsageEecordset['usage']?>"><?php echo $row_UsageEecordset['usage']?></option>
        <?php
} while ($row_UsageEecordset = mysql_fetch_assoc($UsageEecordset));
  $rows = mysql_num_rows($UsageEecordset);
  if($rows > 0) {
      mysql_data_seek($UsageEecordset, 0);
	  $row_UsageEecordset = mysql_fetch_assoc($UsageEecordset);
  }
?>
      </select>
      </td>
  </tr>
  <tr>
    <td>Width (Inch):</td>
    <td><label for="Width"></label>
      <input type="text" name="Width" id="Width" /></td>
  </tr>
  <tr>
    <td>Extra Width (Inch):</td>
    <td><label for="ExtraWidth"></label>
      <input type="text" name="ExtraWidth" id="ExtraWidth" /></td>
  </tr>
  <tr>
    <td>Weight (g/m²):</td>
    <td><input name="Weight" type="text" id="Weight" value="g/m²" /></td>
  </tr>
  <tr>
    <td>Technics:</td>
    <td><input name="Technics" type="text" id="Technics" value="Woven" /></td>
  </tr>
  <tr>
    <td>Composition:</td>
    <td>
    <select name="ProductCompositionList" size="1" title="<?php echo $row_ProductComposition['composition']; ?>">
      <?php
do {  
?>
      <option value="<?php echo $row_ProductComposition['composition']?>"><?php echo $row_ProductComposition['composition']?></option>
      <?php
} while ($row_ProductComposition = mysql_fetch_assoc($ProductComposition));
  $rows = mysql_num_rows($ProductComposition);
  if($rows > 0) {
      mysql_data_seek($ProductComposition, 0);
	  $row_ProductComposition = mysql_fetch_assoc($ProductComposition);
  }
?>
    </select>
    </td>
  </tr>
  <tr>
    <td>Yarn Count:</td>
    <td><input name="YarnCount" type="text" id="YarnCount" value="32x32" /></td>
  </tr>
  <tr>
    <td>Yarn Type:</td>
    <td><p>
     
      <select name="YarnType" size="1">
        <option value=""></option>
        <?php
do {  
?>
        <option value="<?php echo $row_TypeList['quality']?>"><?php echo $row_TypeList['quality']?></option>
        <?php
} while ($row_TypeList = mysql_fetch_assoc($TypeList));
  $rows = mysql_num_rows($TypeList);
  if($rows > 0) {
      mysql_data_seek($TypeList, 0);
	  $row_TypeList = mysql_fetch_assoc($TypeList);
  }
?>
      </select>
      </td>
  </tr>
  <tr>
    <td>Yarn Density:</td>
    <td><input type="text" name="Density" id="Density" /></td>
  </tr>
  <tr>
    <td>Yarn Edge:</td>
    <td><label>
      <select name="EdgeTypeList[]" size="1" multiple="multiple">
        <?php
do {  
?>
        <option value="<?php echo $row_EdgeTypeList['Edge']?>"><?php echo $row_EdgeTypeList['Edge']?></option>
        <?php
} while ($row_EdgeTypeList = mysql_fetch_assoc($EdgeTypeList));
  $rows = mysql_num_rows($EdgeTypeList);
  if($rows > 0) {
      mysql_data_seek($EdgeTypeList, 0);
	  $row_EdgeTypeList = mysql_fetch_assoc($EdgeTypeList);
  }
?>
      </select>
    </label></td>
  </tr>
  <tr>
    <td>Pattern:</td>
    <td><input name="Pattern" type="text" id="Pattern" value="Plain" /></td>
  </tr>
  <tr>
    <td>Component:</td>
    <td><input name="Component" type="text" id="Component" /></td>
  </tr>
   <tr>
    <td>Yarn Style:</td>
    <td>
    <select name="Style" size="1">
      <option value=""></option>
      <?php
do {  
?>
      <option value="<?php echo $row_StyleList['style']?>"><?php echo $row_StyleList['style']?></option>
      <?php
} while ($row_StyleList = mysql_fetch_assoc($StyleList));
  $rows = mysql_num_rows($StyleList);
  if($rows > 0) {
      mysql_data_seek($StyleList, 0);
	  $row_StyleList = mysql_fetch_assoc($StyleList);
  }
?>
    </select>
    </td>
  </tr>
  <tr>
    <td>Yarn Color:</td>
    <td><select name="Color[]" size="1" multiple="multiple" id="Color">
      <?php
do {  
?>
      <option value="<?php echo $row_ColorList['Color']?>"><?php echo $row_ColorList['Color']?></option>
      <?php
} while ($row_ColorList = mysql_fetch_assoc($ColorList));
  $rows = mysql_num_rows($ColorList);
  if($rows > 0) {
      mysql_data_seek($ColorList, 0);
	  $row_ColorList = mysql_fetch_assoc($ColorList);
  }
?>
    </select></td>
  </tr>
  <tr>
    <td>Quality:</td>
    <td><select name="qualityList" size="1" id="qualityList">
      <option value=""></option>
      <?php
do {  
?>
      <option value="<?php echo $row_QualityList['quality']?>"><?php echo $row_QualityList['quality']?></option>
      <?php
} while ($row_QualityList = mysql_fetch_assoc($QualityList));
  $rows = mysql_num_rows($QualityList);
  if($rows > 0) {
      mysql_data_seek($QualityList, 0);
	  $row_QualityList = mysql_fetch_assoc($QualityList);
  }
?>
    </select></td>
  </tr>
  <tr>
    <td>Export Markets:</td>
    <td><input name="ExportMarket" type="text" id="ExportMarket" value="Global" /></td>
  </tr>
  <tr>
    <td colspan="2" class="box-head">Additional Info.</td>
    </tr>
    <tr>
    <td>Trademark:</td>
    <td><input name="Trademark" type="text" id="Trademark" value="JinSuo" /></td>
  </tr>
  <tr>
    <td>Packing:</td>
    <td><input name="Packaging" type="text" id="Packaging" value="Bales/Roll on Tube" /></td>
  </tr>
  <tr>
    <td>Standards:</td>
    <td><input name="Standard" type="text" id="Standard" value="SGS" /></td>
  </tr>
  <tr>
    <td>Origin:</td>
    <td><input name="Origin" type="text" id="Origin" value="Hebei Province, China" /></td>
  </tr>
  <tr>
    <td>HS Code:</td>
    <td><input type="text" name="HsCode" id="HsCode" /></td>
  </tr>
    <tr>
    <td>Production Capacity (Meter/Month):</td>
    <td><input name="Capacity" type="text" id="Capacity" value="200000 Meter/Month" /></td>
  </tr>
    <tr>
    <td colspan="2" class="box-head">Product Description.</td>
    </tr>
    <tr>
    <td colspan="2"><textarea name="ProductDescription" id="ProductDescription" cols="85" rows="10"></textarea></td>
    </tr>
    <tr> 
    <td colspan="2"  align="center">
      <input type="submit" name="insert" id="insert" value="提交" />
      <input type="reset" name="Reset" id="button" value="重设" /></td>
    </tr>
</table>
                                                            <input type="hidden" name="MM_insert" value="addProduct" />
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

mysql_free_result($EdgeTypeList);

mysql_free_result($TadeTerms);

mysql_free_result($ProductTypeList);

mysql_free_result($ColorList);

mysql_free_result($ProductComposition);

mysql_free_result($StyleList);

mysql_free_result($TypeList);

mysql_free_result($QualityList);

mysql_free_result($UsageEecordset);
?>
