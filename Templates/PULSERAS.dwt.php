<?php require_once('../Connections/TIEND.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "ACCESOCLIENTE.dwt.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
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

mysql_select_db($database_TIEND, $TIEND);
$query_PULSERAS = "SELECT * FROM pulceras";
$PULSERAS = mysql_query($query_PULSERAS, $TIEND) or die(mysql_error());
$row_PULSERAS = mysql_fetch_assoc($PULSERAS);
$totalRows_PULSERAS = mysql_num_rows($PULSERAS);

$colname_perfil = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_perfil = $_SESSION['MM_Username'];
}
mysql_select_db($database_TIEND, $TIEND);
$query_perfil = sprintf("SELECT * FROM clientes WHERE CORREO = %s", GetSQLValueString($colname_perfil, "text"));
$perfil = mysql_query($query_perfil, $TIEND) or die(mysql_error());
$row_perfil = mysql_fetch_assoc($perfil);
$totalRows_perfil = mysql_num_rows($perfil);
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
}
.D {
	text-align: center;
}
.D {
	background-color: #FFF;
}
.S {
	text-align: center;
	color: #000;
}
</style>
</head>

<body>
<table width="1338" border="0">
  <tr>
    <th height="158" colspan="5" class="D" scope="col"><img src="../IMAGENES/logo-pulseras-express.png" width="450" height="200" /></th>
  </tr>
  <tr>
    <td width="78" height="71">&nbsp;</td>
    <td width="252"><img src="../IMAGENES/82630af97fca3a45f0c35b80b564c0fe.png" width="300" height="161" /></td>
    <td width="362"><img src="../IMAGENES/N_amorypazsencilla.png" width="367" height="161" /></td>
    <td width="361"><img src="../IMAGENES/pulsera-bandera-lgbt-bioxig.jpg" width="254" height="176" /></td>
    <td width="245"><a href="PORTALCLIENTE.dwt.php"><img src="../IMAGENES/boton_regresar.png" width="300" height="150" /></a></td>
  </tr>
  <tr>
    <td height="244">&nbsp;</td>
    <td colspan="3" rowspan="2" class="S"><table width="850" height="185" border="2" align="center">
      <tr>
        <th width="174" scope="col">NOMBRE</th>
        <th width="163" scope="col">PRECIO</th>
        <th width="139" scope="col">TALLA</th>
        <th width="138" scope="col">MODELO</th>
        <th width="200" scope="col">STOCK</th>
      </tr>
      <?php do { ?>
        <tr>
          <td height="131"><div align="center"><?php echo $row_PULSERAS['nom_pulcera']; ?></div></td>
          <td><div align="center"><?php echo $row_PULSERAS['precio_unit']; ?></div></td>
          <td><div align="center"><?php echo $row_PULSERAS['id_talla']; ?></div></td>
          <td><img src="../IMAGENES/IMG/<?php echo $row_PULSERAS['imagen'];?>"width="100" height="100"/></td>
          <td><div align="center"><?php echo $row_PULSERAS['STOCK']; ?></div></td>
        </tr>
        <?php } while ($row_PULSERAS = mysql_fetch_assoc($PULSERAS)); ?>
    </table></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="103">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="150">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($PULSERAS);

mysql_free_result($perfil);
?>
