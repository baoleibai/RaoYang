<?php require_once('Connections/raoYang.php'); ?>
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

mysql_select_db($database_raoYang, $raoYang);
$query_ProductCategoryRecordset = sprintf("SELECT GroupName FROM ProductGroups ORDER BY GroupName ASC");
$ProductCategoryRecordset = mysql_query($query_ProductCategoryRecordset, $raoYang) or die(mysql_error());
$row_ProductCategoryRecordset = mysql_fetch_assoc($ProductCategoryRecordset);
$totalRows_ProductCategoryRecordset = mysql_num_rows($ProductCategoryRecordset);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<title>RaoYang Gold Shuttle Textiles Factory</title>

<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<meta name="Keywords" content="Jinsuo Cotton Textile Factory of Raoyang, China CVC 75/25 18*18 60*60 78" grey="" fabric="" for="" australia="" market,="" cvc="" 50="" plain="" polyester="" cotton="" bedding="" sheets="" fabric,="" t="" c="" 52="" 48="" 40s*40s="" 110*85="" 110"="" bleached="" white="" curtain="" home="" textile"="">

<meta name="Description" content="China Manufacturer, Trading Company of CVC 75/25 18*18 60*60 78" grey="" fabric="" for="" australia="" market,="" cvc="" 50="" plain="" polyester="" cotton="" bedding="" sheets="" fabric,="" t="" c="" 52="" 48="" 40s*40s="" 110*85="" 110"="" bleached="" white="" curtain="" home="" textile="" -="" jinsuo="" factory="" of="" raoyang"="">

<link href="css/style.css" rel="stylesheet" type="text/css" />

</head>
<body>
<table width="100" border="0" align="center" cellpadding="0" cellspacing="0" class="outer">
	<tr><td class="name">Gold Shuttle Textiles Factory<span class="name2"> of RaoYang</span></td></tr>
	<tr>
		<td>
			<table width="923" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr>
				  <td id="rc1"></td>
					<td bgcolor="#00846c">
						<table border="0" align="center" cellpadding="0" cellspacing="0">
							<tr>
								<td class="toplinks"><a href="#">Homepage</a></td><td class="sap">|</td>
								<td class="toplinks"><a href="#">Products</a></td><td class="sap">|</td>
								<td class="toplinks"><a href="#">Services</a></td><td class="sap">|</td>
								<td class="toplinks"><a href="#">About us</a></td><td class="sap">|</td>
								<td class="toplinks"><a href="#">Contact us</a></td>
							</tr>
						</table>
				  </td>
					<td id="rc2"></td>
				</tr>
			</table>
	  </td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td valign="top">
			<table width="923" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr><div class="inner_copy"></div>
					<td valign="top" id="left">
                   <table width="194" border="0" align="center" cellpadding="0" cellspacing="0">
						    <tr><td height="3"></td></tr>
						    <tr><td height="20" class="cat-head">Product Categories</td></tr>
						<?php do { 
						 $colname_ProductCategoryRecordset = $row_ProductCategoryRecordset['GroupName'];
							  $query_ProductCategoryRecordsetNO = sprintf("SELECT ProductType FROM BasicProductInfo WHERE ProductType = %s", 
										  GetSQLValueString($colname_ProductCategoryRecordset, "text"));
							   $ProductCategoryRecordsetNO = mysql_query($query_ProductCategoryRecordsetNO, $raoYang) or die(mysql_error());
							  $Rows_ProductCategoryRecordsetNO = mysql_num_rows($ProductCategoryRecordsetNO);
						?>   <?php
							 if ( $Rows_ProductCategoryRecordsetNO > 0 ) {
							  ?> 
						    <tr><td class="leftlinks">
                         
                              
						      <a href="productDetails.php?productGroupURL= <?php echo $colname_ProductCategoryRecordset  ?>" target="_self"><?php
							  echo $row_ProductCategoryRecordset['GroupName'];
							  ?> 
                              (<?php 
							   echo $Rows_ProductCategoryRecordsetNO ?>)</a>
				        </td></tr>
                        <?php }?>
                         <?php } while ($row_ProductCategoryRecordset = mysql_fetch_assoc($ProductCategoryRecordset)); ?>
					      </table>
						  </td>
					<td valign="top">
						<table width="707" border="0" align="right" cellpadding="0" cellspacing="0">
							<tr><td class="tag" id="header">Company Slogan<br />will come here...</td></tr>
							<tr>
								<td>
									<table width="707" border="0" align="right" cellpadding="0" cellspacing="0">
										<tr><td valign="top" class="heading2">Whatï¿½s New Here ?</td></tr>
										<tr>
											<td valign="top">
												<table border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td valign="top" class="box-border">
															<table width="340" border="0" align="center" cellpadding="0" cellspacing="0">
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
														<td valign="top" class="box-border">
															<table width="340" border="0" align="center" cellpadding="0" cellspacing="0">
																<tr><td height="8"></td></tr>
																<tr><td class="box-head">Place Name</td></tr>
																<tr><td height="19">&nbsp;</td></tr>
																<tr><td align="center"><img src="images/beauty-products2.jpg" alt="beauty" width="250" height="193"	style="border:1px solid #c2c2c2;" /></td></tr>
																<tr><td height="17"></td></tr>
																<tr><td class="smal-txt">sample text sample text sample text sample text sample text...</td></tr>
																<tr><td height="11"></td></tr>
																<tr>
																	<td height="50">
																		<table border="0" align="center" cellpadding="0" cellspacing="0">
																			<tr>
																				<td width="70" class="price">$66.00</td>
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
				<tr>
					<td height="35" bgcolor="#C6C6C6">
						<table border="0" align="center" cellpadding="0" cellspacing="0">
							<tr>
								<td class="bottomlinks"><a href="#">Homepage</a></td><td class="sap2">|</td>
								<td class="bottomlinks"><a href="#">About us</a></td><td class="sap2">|</td>
								<td class="bottomlinks"><a href="#">Products</a></td><td class="sap2">|</td>
								<td class="bottomlinks"><a href="#">Services</a></td><td class="sap2">|</td>
								<td class="bottomlinks"><a href="#">Contact</a></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
<div id="footer"><div class="fleft">Copyright Statement</div><div class="fright">Popular free web templates <a href="http://www.websitetemplatesonline.com" target="_blank">at www.WebsiteTemplatesOnline.com</a>. Impressive <a href="http://www.flashtemplates.com/flash-templates/" title="Flash Templates for Websites">Flash Templates for Websites</a>.</div><div class="fcenter">Design by: <a href="http://www.templatesperfect.com/">Templatesperfect.com</a></div></div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>
<?php
mysql_free_result($ProductCategoryRecordset);
?>
