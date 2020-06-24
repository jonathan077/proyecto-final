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

if (isset($_POST['USUARIO2'])) {
  $loginUsername=$_POST['USUARIO2'];
  $password=$_POST['CONTRASEÑA'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "PORTALCLIENTE.dwt.php";
  $MM_redirectLoginFailed = "ACCESOCLIENTE.dwt.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_TIEND, $TIEND);
  
  $LoginRS__query=sprintf("SELECT CORREO, CONTRASENA FROM clientes WHERE CORREO=%s AND CONTRASENA=%s",
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
	text-align: center;
	color: #D6D6D6;
}
.D {
	background-color: #FFF;
}
.d {
}
.d #form1 table tr th {
	font-weight: bold;
	text-align: left;
	color: #000000;
}
.d #form1 table tr td {
	font-weight: bold;
	color: #000000;
}
.d {
	color: #000000;
	text-align: left;
}
.d p {
	text-align: center;
	font-size: 18px;
	color: #000000;
}
G {
	color: #000000;
}
C {
	color: #333333;
}
G {
	font-size: 36px;
}
</style>
</head>

<body>
<table width="1338" height="772" border="0" align="center">
  <tr>
    <th height="158" colspan="5" class="D" scope="col"><img src="../IMAGENES/logo-pulseras-express.png" width="450" height="200" /></th>
  </tr>
  <tr>
    <td width="174" height="191">&nbsp;</td>
    <td colspan="3" rowspan="3" class="d"><form id="form1" name="form1" method="POST" action="<?php echo $loginFormAction; ?>">
      <table width="367" border="2" align="center">
        <tr>
          <th width="111" height="47" scope="col">USUARIO</th>
          <th width="238" scope="col"><label for="USUARIO2"></label>
            <input type="text" name="USUARIO2" id="USUARIO2" /></th>
        </tr>
        <tr>
          <td height="51">CONTRASEÑA</td>
          <td><label for="CONTRASEÑA"></label>
            <input type="password" name="CONTRASEÑA" id="CONTRASEÑA" /></td>
        </tr>
        <tr>
          <td height="88"><input type="submit" name="button" id="button" value="INGRESAR" /></td>
          <td><input type="reset" name="button2" id="button2" value="Restablecer" /></td>
        </tr>
      </table>
      <label for="USUARIO"></label>
    </form>
      <p> SI NO TIENES UNA CUENTA REGISTRATE <a href="REGISTROCLIENTE.dwt.php">AQUI</a></p></td>
    <td width="365"><a href="../INDEX.php"><img src="../IMAGENES/boton_regresar.png" width="300" height="150" align="right" /></a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="165">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="154">&nbsp;</td>
    <td width="247">&nbsp;</td>
    <td width="247">&nbsp;</td>
    <td width="247">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
