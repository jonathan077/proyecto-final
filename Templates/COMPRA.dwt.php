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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO venta (nombre, talla) VALUES (%s, %s)",
                       GetSQLValueString($_POST['nombre'], "int"),
                       GetSQLValueString($_POST['talla'], "text"));

  mysql_select_db($database_TIEND, $TIEND);
  $Result1 = mysql_query($insertSQL, $TIEND) or die(mysql_error());

  $insertGoTo = "PORTALCLIENTE.dwt.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_TIEND, $TIEND);
$query_TALLA = "SELECT * FROM tallas";
$TALLA = mysql_query($query_TALLA, $TIEND) or die(mysql_error());
$row_TALLA = mysql_fetch_assoc($TALLA);
$totalRows_TALLA = mysql_num_rows($TALLA);

mysql_select_db($database_TIEND, $TIEND);
$query_PULSERA = "SELECT * FROM pulceras";
$PULSERA = mysql_query($query_PULSERA, $TIEND) or die(mysql_error());
$row_PULSERA = mysql_fetch_assoc($PULSERA);
$totalRows_PULSERA = mysql_num_rows($PULSERA);
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
.D {	text-align: center;
}
</style>
</head>

<body>
<table width="1338" height="722" border="0">
  <tr>
    <th height="204" colspan="5" class="S" scope="col"><img src="../IMAGENES/logo-pulseras-express.png" width="450" height="200" /></th>
  </tr>
  <tr>
    <td width="94" height="174">&nbsp;</td>
    <td width="134">&nbsp;</td>
    <td width="559"><span class="D"><img src="../IMAGENES/VisaMasterCard.png" alt="" width="559" height="114" /></span></td>
    <td width="134">&nbsp;</td>
    <td width="347"><a href="PORTALCLIENTE.dwt.php"><img src="../IMAGENES/boton_regresar.png" width="300" height="150" align="right" /></a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3" rowspan="3">&nbsp;
      <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
        <table align="center">
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">ELIGE UNA PULSERA:</td>
            <td><select name="nombre">
              <?php
do {  
?>
              <option value="<?php echo $row_PULSERA['id_pulcera']?>"><?php echo $row_PULSERA['nom_pulcera']?></option>
              <?php
} while ($row_PULSERA = mysql_fetch_assoc($PULSERA));
  $rows = mysql_num_rows($PULSERA);
  if($rows > 0) {
      mysql_data_seek($PULSERA, 0);
	  $row_PULSERA = mysql_fetch_assoc($PULSERA);
  }
?>
            </select></td>
          </tr>
          <tr> </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">ELIGE UNA TALLA....:</td>
            <td><select name="talla">
              <?php
do {  
?>
              <option value="<?php echo $row_TALLA['id_talla']?>"><?php echo $row_TALLA['nom_talla']?></option>
              <?php
} while ($row_TALLA = mysql_fetch_assoc($TALLA));
  $rows = mysql_num_rows($TALLA);
  if($rows > 0) {
      mysql_data_seek($TALLA, 0);
	  $row_TALLA = mysql_fetch_assoc($TALLA);
  }
?>
            </select></td>
          </tr>
          <tr> </tr>
          <tr valign="baseline">
            <td height="52" align="right" nowrap="nowrap">&nbsp;</td>
            <td><input type="submit" value="REALIZAR VENTA" /></td>
          </tr>
        </table>
        <input type="hidden" name="MM_insert" value="form1" />
      </form>
    <p>&nbsp;</p></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="21">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($TALLA);

mysql_free_result($PULSERA);
?>
