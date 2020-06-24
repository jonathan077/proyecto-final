<?php require_once('../Connections/TIEND.php'); ?>
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

if (isset($_POST['correo'])) {
  $loginUsername=$_POST['correo'];
  $password=$_POST['contrasena'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "PORTALADMINISTRADOR.dwt.php";
  $MM_redirectLoginFailed = "INICIOADMI.dwt.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_TIEND, $TIEND);
  
  $LoginRS__query=sprintf("SELECT Correo, Contrasena FROM administrador WHERE Correo=%s AND Contrasena=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $TIEND) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
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
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- TemplateBeginEditable name="doctitle" -->
<title>Documento sin título</title>
<!-- TemplateEndEditable -->
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
<style type="text/css">
body {
	background-image: url(../IMAGENES/images.jpg);
}
.S {
	background-color: #FFF;
}
.D {
	text-align: center;
	font-size: 18px;
	color: #FFF;
}
</style>
</head>

<body>
<table width="1338" height="722" border="0">
  <tr>
    <th height="204" colspan="5" class="S" scope="col"><img src="../IMAGENES/logo-pulseras-express.png" width="450" height="200" /></th>
  </tr>
  <tr>
    <td height="73">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="146">&nbsp;</td>
    <td colspan="3" rowspan="3"><form id="form1" name="form1" method="POST" action="<?php echo $loginFormAction; ?>">
      <p align="center">&nbsp;</p>
      <p align="center">
        <label for="correo"></label>
CORREO:
<input type="text" name="correo" id="correo" />
      </p>
      <p align="center">
        <label for="contrasena"></label>
CONTRASEÑA:
<input type="password" name="contrasena" id="contrasena" />
      </p>
      <p align="center">
        <input type="submit" name="button" id="button" value="INGRESAR" />
      </p>
    </form>
    <p class="D"> SI NO EXISTEN ADMINISTRADORES REGISTREUNO <a href="REGISTROADMI.dwt.php">AQUI</a></p></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="147">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="75">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
