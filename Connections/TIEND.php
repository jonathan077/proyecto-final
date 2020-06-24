<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_TIEND = "Localhost";
$database_TIEND = "pulcera";
$username_TIEND = "root";
$password_TIEND = "";
$TIEND = mysql_pconnect($hostname_TIEND, $username_TIEND, $password_TIEND) or trigger_error(mysql_error(),E_USER_ERROR); 
?>