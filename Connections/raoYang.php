<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_raoYang = "mysql51.db.12081615.hostedresource.com";
$database_raoYang = "mysql51";
$username_raoYang = "mysql51";
$password_raoYang = "RQqunM74!";
$raoYang = mysql_pconnect($hostname_raoYang, $username_raoYang, $password_raoYang) or trigger_error(mysql_error(),E_USER_ERROR);
mysql_query("SET NAMES UTF8");
?>