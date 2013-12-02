<?php require_once('Connections/raoyangDB.php'); ?>
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

$currentPage = $_SERVER["PHP_SELF"];
mysql_query("SET NAMES UTF8"); 
$maxRows_dept_datasheet = 2;
$pageNum_dept_datasheet = 0;
if (isset($_GET['pageNum_dept_datasheet'])) {
  $pageNum_dept_datasheet = $_GET['pageNum_dept_datasheet'];
}
$startRow_dept_datasheet = $pageNum_dept_datasheet * $maxRows_dept_datasheet;

mysql_select_db($database_raoyangDB, $raoyangDB);
$query_dept_datasheet = "SELECT * FROM Dept";
$query_limit_dept_datasheet = sprintf("%s LIMIT %d, %d", $query_dept_datasheet, $startRow_dept_datasheet, $maxRows_dept_datasheet);
$dept_datasheet = mysql_query($query_limit_dept_datasheet, $raoyangDB) or die(mysql_error());
$row_dept_datasheet = mysql_fetch_assoc($dept_datasheet);

if (isset($_GET['totalRows_dept_datasheet'])) {
  $totalRows_dept_datasheet = $_GET['totalRows_dept_datasheet'];
} else {
  $all_dept_datasheet = mysql_query($query_dept_datasheet);
  $totalRows_dept_datasheet = mysql_num_rows($all_dept_datasheet);
}
$totalPages_dept_datasheet = ceil($totalRows_dept_datasheet/$maxRows_dept_datasheet)-1;

$maxRows_employee_datasheet = 1;
$pageNum_employee_datasheet = 0;
if (isset($_GET['pageNum_employee_datasheet'])) {
  $pageNum_employee_datasheet = $_GET['pageNum_employee_datasheet'];
}
$startRow_employee_datasheet = $pageNum_employee_datasheet * $maxRows_employee_datasheet;

mysql_select_db($database_raoyangDB, $raoyangDB);
$query_employee_datasheet = "SELECT * FROM Employee";
$query_limit_employee_datasheet = sprintf("%s LIMIT %d, %d", $query_employee_datasheet, $startRow_employee_datasheet, $maxRows_employee_datasheet);
$employee_datasheet = mysql_query($query_limit_employee_datasheet, $raoyangDB) or die(mysql_error());
$row_employee_datasheet = mysql_fetch_assoc($employee_datasheet);

if (isset($_GET['totalRows_employee_datasheet'])) {
  $totalRows_employee_datasheet = $_GET['totalRows_employee_datasheet'];
} else {
  $all_employee_datasheet = mysql_query($query_employee_datasheet);
  $totalRows_employee_datasheet = mysql_num_rows($all_employee_datasheet);
}
$totalPages_employee_datasheet = ceil($totalRows_employee_datasheet/$maxRows_employee_datasheet)-1;

$queryString_dept_datasheet = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_dept_datasheet") == false && 
        stristr($param, "totalRows_dept_datasheet") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_dept_datasheet = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_dept_datasheet = sprintf("&totalRows_dept_datasheet=%d%s", $totalRows_dept_datasheet, $queryString_dept_datasheet);

$queryString_employee_datasheet = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_employee_datasheet") == false && 
        stristr($param, "totalRows_employee_datasheet") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_employee_datasheet = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_employee_datasheet = sprintf("&totalRows_employee_datasheet=%d%s", $totalRows_employee_datasheet, $queryString_employee_datasheet);



?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>RaoYang Gold Shuttle Textiles Factory</title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<meta name="Keywords" content="Jinsuo Cotton Textile Factory of Raoyang, China CVC 75/25 18*18 60*60 78" grey="" fabric="" for="" australia="" market,="" cvc="" 50="" plain="" polyester="" cotton="" bedding="" sheets="" fabric,="" t="" c="" 52="" 48="" 40s*40s="" 110*85="" 110"="" bleached="" white="" curtain="" home="" textile"="">
<meta name="Description" content="China Manufacturer, Trading Company of CVC 75/25 18*18 60*60 78" grey="" fabric="" for="" australia="" market,="" cvc="" 50="" plain="" polyester="" cotton="" bedding="" sheets="" fabric,="" t="" c="" 52="" 48="" 40s*40s="" 110*85="" 110"="" bleached="" white="" curtain="" home="" textile="" -="" jinsuo="" factory="" of="" raoyang"="">
<style type="text/css">
body {
    text-align: center;
}

*{margin:0;padding:0}
body{font-size:18px;}
ul{margin:0; padding:0; list-style:none;}
a{text-decoration:none; color:#000;}

#wrap{position:relative; top:0px;width:876px; height:34px; line-height:34px; margin:0 auto;}
ul#menu li{float:left; display:block; width:92px;height:37px;line-height:37px;text-align:center;margin-right:2px;}
ul#menu li a:link{display:block;background:#EDEBEC;font-size:14px;color:#333;width:92px;height:37px;line-height:37px;}
ul#menu li a:hover,.red{background:#CE070E!important;color:#FFF!important;}
/*子菜单*/
ul#menu li ul{position:absolute; top:37px;width:90px; display:none;border:1px #CE070E solid;border-top:none;background:#FFF;}
ul#menu li ul li{float:left;}
ul#menu li ul li a:link{width:90px;height:37px;line-height:37px;background:#FFF;}
ul#menu li ul li a:hover{color:#CE070E; text-decoration:underline}
ul#menu li ul li{width:90px;height:37px;line-height:37px;float:left;}

</style>

</head>

<body>
<div class="container">
<div class="header" id="wrap">
<ul id="factoryLogo">Jinsuo Cotton Textile Factory of Raoyang</ul>
  <ul id="menu">
    <li><a href="http://www.goldshuttletextiles.com/" >Home</a></li>
    <li><a href="#" >最新动态页</a>
      <ul>
        <li><a href="#">聚焦凯撒</a></li>
        <li><a href="#">聚焦凯撒</a></li>
        <li><a href="#">聚焦凯撒</a></li> 
      </ul>
    </li>
    <li><a href="#" >产品预定</a></li>
    <li><a href="#" >帮助查询</a>
      <ul>
        <li><a href="http://www.goldshuttletextiles.com/">网页特效</a> | </li>
        <li><a href="#">聚焦凯撒</a> | </li>
        <li><a href="#">聚焦凯撒</a> | </li>
        <li><a href="#">聚焦凯撒</a> | </li>
        <li><a href="#">聚焦凯撒</a> | </li>
        <li><a href="#">聚焦凯撒</a></li> 
      </ul>
    </li>
    <li><a href="#" >会员俱乐部</a></li>
    <li><a href="http://www.goldshuttletextiles.com/" >网页教程</a></li>
  </ul> 
</div>


<p>
  <?php 
Echo "test";
 $hostname = "mysql51.db.12081615.hostedresource.com";
 $username = "mysql51";
 $password = "RQqunM74!";
 $dbname = "mysql51";	
$conn=mysql_connect($hostname,$username, $password) or die("sql server connection error ".mysql_error());
mysql_select_db($dbname);

//Fetching from your database table.
//$usertable = "testTable";
//$query = "SELECT * FROM $usertable";
//$result = mysql_query($query);
//$firstnamefield = "firstname";
//if ($result) {
//	while($row = mysql_fetch_array($result)) {
//		$name = $row["$firstnamefield"];
//                    echo "Name: $name<br>";
//	}
//}
			
Echo "test1";
?>
</p>
<table width="200" border="1">
  <tr>
    <th scope="col">Code</th>
    <th scope="col">Dept</th>
  </tr>
  <?php do { ?>
    <tr>
      <td height="20"><?php echo $row_dept_datasheet['Code']; ?></td>
      <td><?php echo $row_dept_datasheet['Dept']; ?></td>
    </tr>
    <?php } while ($row_dept_datasheet = mysql_fetch_assoc($dept_datasheet)); ?>
</table>
<table width="200" border="1">
  <tr>
    <th scope="col">first</th>
    <th scope="col">surname</th>
  </tr>
  <tr>
    <td><a href="<?php printf("%s?pageNum_dept_datasheet=%d%s", $currentPage, 0, $queryString_dept_datasheet); ?>">First</a></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo $row_employee_datasheet['Firstname']; ?></td>
    <td><?php echo $row_employee_datasheet['Surname']; ?></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</div>
<a href="<?php printf("%s?pageNum_employee_datasheet=%d%s", $currentPage, min($totalPages_employee_datasheet, $pageNum_employee_datasheet + 1), $queryString_employee_datasheet); ?>">Next</a>
</body>
</html>
<?php
mysql_free_result($dept_datasheet);

mysql_free_result($employee_datasheet);


?>
