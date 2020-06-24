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

mysql_select_db($database_TIEND, $TIEND);
$query_PULSERA2 = "SELECT * FROM pulceras";
$PULSERA2 = mysql_query($query_PULSERA2, $TIEND) or die(mysql_error());
$row_PULSERA2 = mysql_fetch_assoc($PULSERA2);
$totalRows_PULSERA2 = mysql_num_rows($PULSERA2);
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
	color: #000;
}
.s {
	background-color: #FFF;
}
</style>
</head>

<body>
<table width="1338" height="722" border="0">
  <tr>
    <th height="204" colspan="5" class="s" scope="col"><img src="../IMAGENES/logo-pulseras-express.png" width="450" height="200" /></th>
  </tr>
  <tr>
    <td width="33" height="196">&nbsp;</td>
    <td width="300"><img src="../IMAGENES/82630af97fca3a45f0c35b80b564c0fe.png" alt="" width="300" height="161" /></td>
    <td width="415"><img src="../IMAGENES/N_amorypazsencilla.png" alt="" width="367" height="161" /></td>
    <td width="285"><img src="../IMAGENES/pulsera-bandera-lgbt-bioxig.jpg" alt="" width="254" height="176" /></td>
    <td width="331"><a href="PORTALADMINISTRADOR.dwt.php"><img src="../IMAGENES/boton_regresar.png" width="300" height="150" align="right" /></a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3" rowspan="3"><div align="center">
      <table width="1019" border="1">
        <tr>
          <th width="158" scope="col">ID_PULSERA</th>
          <th width="173" scope="col">NOMBRE</th>
          <th width="162" scope="col">PRECIO</th>
          <th width="138" scope="col">TALLA</th>
          <th width="139" scope="col">MODELO</th>
          <th width="209" scope="col">STOCK</th>
          </tr>
        <?php do { ?>
          <tr>
            <td height="50"><div align="center"><?php echo $row_PULSERA2['id_pulcera']; ?></div></td>
            <td><div align="center"><?php echo $row_PULSERA2['nom_pulcera']; ?></div></td>
            <td><div align="center"><?php echo $row_PULSERA2['precio_unit']; ?></div></td>
            <td><div align="center"><?php echo $row_PULSERA2['id_talla']; ?></div></td>
            <td><img src="../IMAGENES/IMG/<?php echo $row_PULSERA2['imagen']; ?>"width="100" height="100" align="absmiddle"/></td>
            <td><div align="center"><?php echo $row_PULSERA2['STOCK']; ?></div></td>
            </tr>
          <?php } while ($row_PULSERA2 = mysql_fetch_assoc($PULSERA2)); ?>
      </table>
    </div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($PULSERA2);
?>
